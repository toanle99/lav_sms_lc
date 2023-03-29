<?php

namespace App\Http\Controllers\SupportTeam;

use App\Helpers\Qs;
use App\Http\Requests\MyClass\ClassCreate;
use App\Http\Requests\MyClass\ClassUpdate;
use App\Repositories\MyClassRepo;
use App\Repositories\UserRepo;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MyClassController extends Controller
{
    protected $my_class, $user;

    public function __construct(MyClassRepo $my_class, UserRepo $user)
    {
        $this->middleware('teamSAT', ['except' => ['show', 'destroy',]]);
        $this->middleware('super_admin', ['only' => ['destroy',] ]);

        $this->my_class = $my_class;
        $this->user = $user;
    }

    public function index()
    {
        $user = Auth::user();
        $myClass = $this->my_class->allbyUser(); 
        if(Qs::userIsTeacher($user->id)) $myClass = $myClass->where('teacher_id', ' = ', $user->id); 
        $d['my_classes'] = $myClass;
        $d['class_types'] = $this->my_class->getTypes();
        $d['teachers'] = $this->user->getUserByType('teacher');
        return view('pages.support_team.classes.index', $d);
    }

    public function show($id)
    {
        $d['c'] = $c = $this->my_class->find($id);
        $d['teachers'] = $this->user->getUserByType('teacher'); 
        $d['students'] = $this->my_class->findStudentsByClass($id);
        return view('pages.support_team.classes.show', $d) ;
    }

    public function store(ClassCreate $req)
    {
        $data = $req->all();
        $mc = $this->my_class->create($data);

        // Create Default Section
        // $s =['my_class_id' => $mc->id,
        //     'name' => 'A',
        //     'active' => 1,
        //     'teacher_id' => NULL,
        // ];

        // $this->my_class->createSection($s);

        return Qs::jsonStoreOk();
    }

    public function edit($id)
    {
        $d['c'] = $c = $this->my_class->find($id);
        $d['teachers'] = $this->user->getUserByType('teacher');
        return view('pages.support_team.classes.edit', $d) ;
    }

    public function update(ClassUpdate $req, $id)
    {
        $data = $req->only(['name', 'teacher_id']);
        $data['teacher_id'] = Qs::decodeHash($data['teacher_id']);

        $this->my_class->update($id, $data);

        return Qs::jsonUpdateOk();
    }

    public function destroy($id)
    {
        $this->my_class->delete($id);
        return back()->with('flash_success', __('msg.del_ok'));
    }

}
