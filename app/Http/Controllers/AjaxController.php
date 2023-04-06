<?php

namespace App\Http\Controllers;

use App\Helpers\Qs;
use App\Repositories\LocationRepo;
use App\Repositories\MyClassRepo;
use App\Repositories\StudentRepo;

use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    protected $loc, $my_class;

    public function __construct(LocationRepo $loc, MyClassRepo $my_class, StudentRepo $student_repo)
    {
        $this->loc = $loc;
        $this->my_class = $my_class;
        $this->student_repo = $student_repo;
    }

    public function get_lga($state_id)
    {
//        $state_id = Qs::decodeHash($state_id);
//        return ['id' => Qs::hash($q->id), 'name' => $q->name];

        $lgas = $this->loc->getLGAs($state_id);
        return $data = $lgas->map(function($q){
            return ['id' => $q->id, 'name' => $q->name];
        })->all();
    }

    public function getStudentWritteByDays($date)
    {   
        $date = date('Y-m-d', strtotime($date)); 
        
        $user = Auth::user();
        if(Qs::userIsStudent()){
            $student = $this->student_repo->getRecord(['id' => $user->id])->first();
            //
            $student_w = $this->student_repo->getWrittes($student->id);

            $student_w = $student_w->where('date_at', $date);
            $fill = 0;
            // buổi sáng  +1 ,
            // chiều +2 
            // =>   0       |        1          |      2            |      3                |      4
            // cả ngày + 4 
            //  chưa đki    |  đki buổi sáng    | đk buổi chiều     | đk sáng và chiều      | đk cả ngày
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
                // die($st);
            }
            // 
            // return 'msg.gxp_st_er_1';
            // die($student_w); 
            // $d['section'] = 'msg.gxp_st_er_1';
            if($fill == 0) 
            return response()->json(['fills'=>$fill_vs, 'fill'=>$fill, 'status'=>'success','flash_success'=>__('msg.gxp_fill_'.$fill).' '.date('d/m/Y', strtotime($date)) ]);

            return response()->json(['fills'=>$fill_vs, 'fill'=>$fill , 'status'=>'warning','flash_warning'=>__('msg.gxp_fill_'.$fill).' '.date('d/m/Y', strtotime($date)) ]);

            
        }   
        return response()->json(['status'=>'error','flash_error'=>__('msg.gxp_st_er') ]);       
    }

    public function get_class_student($class_id)
    {
        $user = Auth::user();

        // $sections = $this->student_repo->findStudentsByClass($class_id);
        // return $sections = $sections->map(function($q){
        //     return ['id' => $q->id, 'name' => $q->user->name, 'dob' => $q->user->dob];
        // })->all();
    }

    public function get_class_sections($class_id)
    {
        $sections = $this->my_class->getClassSections($class_id);
        return $sections = $sections->map(function($q){
            return ['id' => $q->id, 'name' => $q->name];
        })->all();
    }

    public function get_class_subjects($class_id)
    {
        $sections = $this->my_class->getClassSections($class_id);
        $subjects = $this->my_class->findSubjectByClass($class_id);

        if(Qs::userIsTeacher()){
            $subjects = $this->my_class->findSubjectByTeacher(Auth::user()->id)->where('my_class_id', $class_id);
        }

        $d['sections'] = $sections->map(function($q){
            return ['id' => $q->id, 'name' => $q->name];
        })->all();
        $d['subjects'] = $subjects->map(function($q){
            return ['id' => $q->id, 'name' => $q->name];
        })->all();

        return $d;
    }

}
