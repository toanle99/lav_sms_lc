<?php

namespace App\Http\Controllers\SupportTeam;

use App\Helpers\Qs;
use App\Helpers\Mk;
use App\Http\Requests\Student\StudentRecordCreate;
use App\Http\Requests\Student\StudentWritteCreate;
use App\Http\Requests\Student\StudentRecordUpdate;
use App\Repositories\LocationRepo;
use App\Repositories\MyClassRepo;
use App\Repositories\StudentRepo;
use App\Models\StudentWritte;
use App\Models\WritteType;
use App\Repositories\UserRepo;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StudentWritteController extends Controller
{
    protected $loc, $my_class, $user, $student;
    /*
    status:
        0: chờ xử lý
        1: phụ huynh duyệt
        2: giáo viên duyệt
        3: phụ huynh từ chối
        4: giáo viên từ chối 
        //    bgh     // báo cáo exel danh sách học sinh nghỉ học theo từng tuần
        //    gxp->report (all)

        //    teacher // báo cáo exel danh sách học sinh nghỉ học theo từng tuần
        //    gxp->report (class)
        
        //    parent  // Xem báo cáo thống kê của con mình
        //    gxp->report(student_id)
        // create -> Cả ngày, Buổi sáng, Buổi chiều
        // 
    */
    public function __construct(LocationRepo $loc, MyClassRepo $my_class, UserRepo $user, StudentRepo $student)
    {
         $this->loc = $loc;
         $this->my_class = $my_class;
         $this->user = $user;
         $this->student = $student;
    }

    public function index()
    {
        $ut  = WritteType::orderby('level')->get();
        $gxps = StudentWritte::orderbyDesc('date_at')->get();
        $user = Auth::user();
        
        if(Qs::userIsTeamSAT()){
            $ut = $ut->whereIn('level', [1,2,4]);
            $gxps = $gxps->whereIn('status', [1,2,4]);
            if(Qs::userIsTeacher()){
                // class of teacher 
                $cl_tcs =  $this->my_class->findClassIdsByTeacher($user->id);
                foreach($cl_tcs as $cl_tc)
                    $student = $this->student->findStudentIdsByClasses($cl_tc);

                // dd($gxps);
                // $src_ids =  $this->student->findStudentIdsByClass($student->my_class_id);            
                $gxps = $gxps->whereIn('student_record_id', $student);
            }
            
        }   
        if(Qs::userIsStudent()){
            // gxp of student
            $student = $this->student->getRecord(['id' => $user->id])->first();
            $gxps = $gxps->where('student_record_id', $student->id);
            $d['student_rc'] =  $this->student->findStudentsByClass($student->my_class_id);
            $d['student'] = $student;
        }
        
        
        
        $d['my_classes'] = $this->my_class->all();
        $d['parents'] = $this->user->getUserByType('parent');
        $d['gxp_types'] = $ut; 
        $d['gxps'] = $gxps;
        return view('pages.support_team.gxp.index', $d);
    }

    public function create()
    {
        $data['my_classes'] = $this->my_class->all();
        $data['parents'] = $this->user->getUserByType('parent');
        // $data['dorms'] = $this->student->getAllDorms();
        // $data['states'] = $this->loc->getStates();
        // $data['nationals'] = $this->loc->getAllNationals();
        return view('pages.support_team.gxp.add', $data);
    }
    
    public function pending()
    {
        $data['my_classes'] = $this->my_class->all();
        $data['parents'] = $this->user->getUserByType('parent');
        // $data['dorms'] = $this->student->getAllDorms();
        // $data['states'] = $this->loc->getStates();
        // $data['nationals'] = $this->loc->getAllNationals();
        return view('pages.support_team.gxp.add', $data);
    }

    public function store(StudentWritteCreate $req)
    {  
        $user = Auth::user();
        if(Qs::userIsStudent()){
            $student = $this->student->getRecord(['id' => $user->id])->first();
            $sr =  $req->only(Qs::getStudentWritte());   
            $sr['student_record_id'] = $student->id;
            $sr['date_at'] = date('Y-m-d', strtotime(str_replace('/', '-', $sr['date_at']))); 
            //
            $student_w = $this->student->getWrittes($student->id);
            
            $student_w = $student_w->where('date_at', date('Y-m-d', strtotime(str_replace('/', '-', $sr['date_at']))));
            $fill = 0;
            $fill_vs = Array();
            foreach($student_w as $st){ 
                switch($st->session_time) {
                    case 'Buổi sáng':{
                        $fill += 1;
                        array_push($fill_vs, 'Buổi sáng');
                        array_push($fill_vs, 'Cả ngày');
                        break;
                    }
                    
                    case 'Buổi chiều':{
                        $fill += 2;
                        array_push($fill_vs, 'Buổi chiều');
                        array_push($fill_vs, 'Cả ngày');
                        break;
                    }
                    case 'Cả ngày':{
                        $fill += 4;
                        array_push($fill_vs, 'Buổi chiều');
                        array_push($fill_vs, 'Buổi sáng');
                        array_push($fill_vs, 'Cả ngày');
                        break;
                    }
                }
            }
            if(in_array($sr['session_time'], $fill_vs)) {
                return back()->with('flash_error', __('msg.gxp_fill_'.$fill));
            }

            // 
            $this->student->createWritte($sr); // Create Student
            //
            return Qs::jsonStoreOk();
        }   
        return Qs::goWithDanger();        
    }

    public function update_st($gxp_id, $status)
    {
        $gxp_id = Qs::decodeHash($gxp_id);
        $status = Qs::decodeHash($status);
        $user = Auth::user();
        $gxp = StudentWritte::find($gxp_id);
        // người duyệt,         // admin // bgh         //      teacher             //  parent  
        // của ai               //                      //     of class             //  parent,
        // trạng thái cũ        //    1 -> 2|4        //      1-> 2|4              //  0 -> 1
        // thời gian xin        // 
        // status = 1 2 3 4
        $data = Array();
        switch ($status) {
            case 1: case 3: { // phu huynh 1/3 
                if(Qs::userIsParent() && $gxp->status == 0){
                    $data = [
                        "status" => $status,
                    ];
                }
                break;
            }
            case 2: case 4: {
                if(Qs::userIsTeamSAT() && $gxp->status == 1){
                    $st = $status==2?"accept_by":"deny_by"; 
                    $data = [
                        $st      => $user->id,
                        "status" => $status,
                    ];
                }
                break;
            } 
        }
        // dd(count($data) );
        if(count($data) >0) {
            //$this->student->updateWritte($gxp->id,$data);  
            foreach($data as $key=>$val){
                $gxp->$key = $val;
            }
            $gxp->save();
            return back()->with('flash_success', __('msg.gxp_st_to_'.$status));
        }else {
            return back()->with('flash_error', __('msg.gxp_st_er_'.$status));
        }
    }

    public function listByClass($class_id) 
    {
        $data['my_class'] = $mc = $this->my_class->getMC(['id' => $class_id])->first();
        $data['students'] = $this->student->findStudentsByClass($class_id);
        $data['sections'] = $this->my_class->getClassSections($class_id);

        return is_null($mc) ? Qs::goWithDanger() : view('pages.support_team.gxp.list', $data);
    }

    public function graduated()
    {
        $data['my_classes'] = $this->my_class->all();
        $data['students'] = $this->student->allGradStudents();

        return view('pages.support_team.gxp.graduated', $data);
    }

    public function not_graduated($sr_id)
    {
        $d['grad'] = 0;
        $d['grad_date'] = NULL;
        $d['session'] = Qs::getSetting('current_session');
        $this->student->updateRecord($sr_id, $d);

        return back()->with('flash_success', __('msg.update_ok'));
    }

    public function show($sr_id)
    {
        $sr_id = Qs::decodeHash($sr_id);
        if(!$sr_id){return Qs::goWithDanger();}

        $data['sr'] = $this->student->getRecord(['id' => $sr_id])->first();

        /* Prevent Other Students/Parents from viewing Profile of others */
        if(Auth::user()->id != $data['sr']->user_id && !Qs::userIsTeamSAT() && !Qs::userIsMyChild($data['sr']->user_id, Auth::user()->id)){
            return redirect(route('dashboard'))->with('pop_error', __('msg.denied'));
        }

        return view('pages.support_team.gxp.show', $data);
    }

    public function edit($sr_id)
    {
        $sr_id = Qs::decodeHash($sr_id);
        if(!$sr_id){return Qs::goWithDanger();}

        $data['sr'] = $this->student->getRecord(['id' => $sr_id])->first();
        $data['my_classes'] = $this->my_class->all();
        $data['parents'] = $this->user->getUserByType('parent');
        // $data['dorms'] = $this->student->getAllDorms();
        $data['states'] = $this->loc->getStates();
        $data['nationals'] = $this->loc->getAllNationals();
        return view('pages.support_team.gxp.edit', $data);
    }

    public function update(StudentRecordUpdate $req, $sr_id)
    {
        $sr_id = Qs::decodeHash($sr_id);
        if(!$sr_id){return Qs::goWithDanger();}

        $sr = $this->student->getRecord(['id' => $sr_id])->first();
        $d =  $req->only(Qs::getUserRecord());
        $d['name'] = ucwords($req->name);

        if($req->hasFile('photo')) {
            $photo = $req->file('photo');
            $f = Qs::getFileMetaData($photo); dd($f);
            $f['name'] = 'photo.' . $f['ext'];
            $f['path'] = $photo->storeAs(Qs::getUploadPath('student').$sr->user->code, $f['name']);
            $d['photo'] = asset('storage/' . $f['path']);
        }

        $this->user->update($sr->user->id, $d); // Update User Details

        $srec = $req->only(Qs::getStudentData());

        $this->student->updateRecord($sr_id, $srec); // Update St Rec

        /*** If Class/Section is Changed in Same Year, Delete Marks/ExamRecord of Previous Class/Section ****/
        Mk::deleteOldRecord($sr->user->id, $srec['my_class_id']);

        return Qs::jsonUpdateOk();
    }

    public function destroy($st_id)
    {
        $st_id = Qs::decodeHash($st_id);
        if(!$st_id){return Qs::goWithDanger();}

        $sr = $this->student->getRecord(['user_id' => $st_id])->first();
        $path = Qs::getUploadPath('student').$sr->user->code;
        Storage::exists($path) ? Storage::deleteDirectory($path) : false;
        $this->user->delete($sr->user->id);

        return back()->with('flash_success', __('msg.del_ok'));
    }

}
