@extends('layouts.master')
@section('page_title', 'Quản lý giấy xin phép')
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Quản lý giấy xin phép</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-highlight">
                
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle {{Qs::userIsTeamSAT()||Qs::userIsParent()?'active':''}}" data-toggle="dropdown">Quản lý giấy xin phép </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        @foreach($gxp_types as $ut)
                            <a href="#ut-{{ Qs::hash($ut->id) }}" class="dropdown-item {{Qs::userIsTeamSAT()&& $ut->level==1?'show active':(Qs::userIsParent()&&$ut->level==0?'show active':'')}}" data-toggle="tab">{{ $ut['title'] }}</a>
                        @endforeach
                    </div>
                </li>
                @if(Qs::userIsStudent())
                <li class="nav-item"><a href="#new-user" class="nav-link {{Qs::userIsStudent()?'active':''}}" data-toggle="tab"><i class="icon-plus2"></i>Tạo giấy xin phép</a></li>
                @endif
            </ul>

            <div class="tab-content">
                @if(Qs::userIsStudent())
                <div class="tab-pane fade {{Qs::userIsStudent()?'show active':''}}" id="new-user">
                    <form id="ajax-reg" method="post" enctype="multipart/form-data" class="wizard-form steps-validation pt-4" action="{{ route('gxp.store') }}" data-fouc>
                        @csrf
                        <h6>Personal Data</h6>
                        <fieldset>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="my_class_id">Lớp: </label> 
                                        {{-- <input value="{{ old('my_class_id') }}" required type="text" name="my_class_id" placeholder="Họ tên " class="form-control"> --}}
                                        <select onchange="getStudentClass(this.value)" data-placeholder="Chọn ..." disabled required name="my_class_id" id="my_class_id" class="select-search form-control">
                                            <option value=""></option>
                                            @foreach($my_classes as $c)
                                                <option {{ ($student->my_class_id == $c->id ? 'selected' : '') }} value="{{ $c->id }}">{{ $c->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Họ & tên: <span class="text-danger">*</span></label> 
                                        <select required name="student_record_id" id="student_record_id" class="select-search form-control" disabled>
                                            <option value="0">Chọn học sinh ... </option>
                                            @foreach($student_rc as $c)
                                            <option {{ ($student->id == $c->id ? 'selected' : '') }} value="{{ $c->id }}">{{ $c->user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> 
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Ngày sinh:</label>
                                        <input name="dob" id="dob" value="{{ old('dob') }}" type="text" disabled class="form-control date-pick" placeholder="Date..." >
                                    </div>
                                </div> 
                                
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Ngày xin nghỉ: <span class="text-danger">*</span></label>
                                        <input onchange="getWritteByDate(this.value)" name="date_at" data-date-format='dd/mm/yyyy' value="{{ old('date_at') }}" type="text" class="form-control date-pick" required placeholder="Chọn ngày ...">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="my_class_id">Thời gian: <span class="text-danger">*</span></label> 
                                        <select required name="session_time" id="session_time" class="select-search form-control">
                                            <option value="">Chọn thời gian ... </option>
                                            <option {{ (old('session_time') == 'Buổi sáng' ? 'selected' : '') }} value="Cả ngày">Cả ngày</option> 
                                            <option {{ (old('session_time') == 'Buổi sáng' ? 'selected' : '') }} value="Buổi sáng">Buổi sáng</option>
                                            <option {{ (old('session_time') == 'Buổi chiều' ? 'selected' : '') }} value="Buổi chiều">Buổi chiều</option>  
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Lý do: <span class="text-danger">*</span></label>
                                        <input value="{{ old('reason') }}" required type="text" name="reason" placeholder="Lý do xin nghỉ ... " class="form-control">
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
                @endif
                @foreach($gxp_types as $id=>$ut)
                    <div class="tab-pane fade {{Qs::userIsTeamSAT()&& $ut->level==1?'show active':(Qs::userIsParent()&&$ut->level==0?'show active':'')}}" id="ut-{{Qs::hash($ut->id)}}" >                         
                        <table class="table datatable-button-html5-columns show">
                            <thead>
                            <tr>
                                <th>Stt</th> 
                                <th>Họ tên</th>
                                <th>Lớp</th>
                                <th>Ngày sinh</th>
                                <th>Ngày xin nghỉ</th>
                                <th>Thời gian</th>
                                <th>Lý do</th>
                                <th>Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($gxps->where('status', $ut->level) as $u)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $u->student_record->user->name }}</td>
                                    <td>{{ $u->student_record->my_class->name }}</td>
                                    <td>{{ $u->student_record->user->dob }}</td>
                                    <td>{{ $u->date_at }}</td>
                                    <td>{{ $u->session_time }}</td>
                                    <td>{{ $u->reason }}</td>
                                    <td class="text-center">
                                        <div class="list-icons">
                                            <div class="dropdown">
                                                <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                    <i class="icon-menu9"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-left"> 
                                                    @if(Qs::userIsParent()) 
                                                        <a id="{{ Qs::hash($u->id) }}" onclick="confirmAccept(this.id)" href="#" class="dropdown-item"><i class="icon-check"></i> Chấp nhận</a>
                                                        <form method="post" id="item-accept-{{ Qs::hash($u->id) }}" action="{{ route('gxp.update_st', ['gxp_id' => Qs::hash($u->id), 'status' => Qs::hash(1)]) }}" class="hidden">@csrf @method('get')</form>
                                                        
                                                        <a id="{{ Qs::hash($u->id) }}" onclick="confirmDeny(this.id)" href="#" class="dropdown-item"><i class="icon-cancel-circle2"></i> Từ chối</a>
                                                        <form method="post" id="item-deny-{{ Qs::hash($u->id) }}" action="{{ route('gxp.update_st', ['gxp_id' => Qs::hash($u->id), 'status' => Qs::hash(3)]) }}" class="hidden">@csrf @method('get')</form>
                                                
                                                    @endif

                                                    @if(Qs::userIsTeamSAT())
                                                        <a id="{{ Qs::hash($u->id) }}" onclick="confirmAccept(this.id)" href="#" class="dropdown-item"><i class="icon-check"></i> Chấp nhận</a>
                                                        <form method="post" id="item-accept-{{ Qs::hash($u->id) }}" action="{{ route('gxp.update_st', ['gxp_id' => Qs::hash($u->id), 'status' => Qs::hash(2)]) }}" class="hidden">@csrf @method('get')</form>
                                                        <a id="{{ Qs::hash($u->id) }}" onclick="confirmDeny(this.id)" href="#" class="dropdown-item"><i class="icon-cancel-circle2"></i> Từ chối</a>
                                                        <form method="post" id="item-deny-{{ Qs::hash($u->id) }}" action="{{ route('gxp.update_st', ['gxp_id' => Qs::hash($u->id), 'status' => Qs::hash(4)]) }}" class="hidden">@csrf @method('get')</form>
                                                    @endif  
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endforeach

            </div>
        </div>
    </div> 

@endsection
