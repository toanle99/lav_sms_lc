@extends('layouts.master')
@section('page_title', 'Thông tin Lớp - '.$c->name)
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Thông tin Lớp </h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-4 row">
                    <label class="col-lg-3 col-form-label font-weight-semibold">Tên lớp <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input name="name" disabled="disabled" value="{{ $c->name }}" required type="text" class="form-control" placeholder="Name of Class">
                    </div>
                </div> 
                <div class="form-group row col-md-5">
                    <label for="teacher_id" class="col-lg-3 col-form-label font-weight-semibold">Giáo viên</label>
                    <div class="col-lg-9">
                        <select data-placeholder="Chọn giáo viên" disabled class="form-control select-search" name="teacher_id" id="teacher_id">
                            <option value=""></option>
                            @foreach($teachers as $t)
                                <option {{ $c->teacher_id == $t->id ? 'selected' : '' }} value="{{ Qs::hash($t->id) }}">{{ $t->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row col-md-3">
                    <label for="class_type_id" class="col-lg-5 col-form-label font-weight-semibold">Loại lớp</label>
                    <div class="col-lg-7">
                        <input class="form-control" disabled="disabled" value="{{ $c->class_type->name }}" title="Class Type" type="text">
                    </div>
                </div>  
            </div>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="all-students">
                    <table class="table datatable-button-html5-columns">
                        <thead>
                        <tr>
                            <th>Stt</th>
                            <th>Photo</th>
                            <th>Họ tên</th> 
                            {{-- <th>Lớp</th> --}}
                            <th>Phụ huynh</th>
                            <th>Email</th>
                            <th>Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($students as $s)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><img class="rounded-circle" style="height: 40px; width: 40px;" src="{{ $s->user->photo }}" alt="photo"></td>
                                <td>{{ $s->user->name }}</td>
                                <td>
                                    @if(isset($s->my_parent['name']))
                                    <a href="{{route('users.show', Qs::hash($s->my_parent['id']))}}">{{ $s->my_parent['name'] }}</a> 
                                    @endif
                                </td>
                                <td>{{ $s->user->email }}</td>
                                <td class="text-center">
                                    <div class="list-icons">
                                        <div class="dropdown">
                                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-left">
                                                <a href="{{ route('students.show', Qs::hash($s->id)) }}" class="dropdown-item"><i class="icon-eye"></i> Xem thông tin</a>
                                                @if(Qs::userIsTeamSA())
                                                    <a href="{{ route('students.edit', Qs::hash($s->id)) }}" class="dropdown-item"><i class="icon-pencil"></i> Chỉnh sửa </a>
                                                    <a href="{{ route('st.reset_pass', Qs::hash($s->user->id)) }}" class="dropdown-item"><i class="icon-lock"></i> Đặt lại mật khẩu</a>
                                                @endif
                                                {{-- <a target="_blank" href="{{ route('marks.year_selector', Qs::hash($s->user->id)) }}" class="dropdown-item"><i class="icon-check"></i> Marksheet</a> --}}

                                                {{--Delete--}}
                                                @if(Qs::userIsSuperAdmin())
                                                    <a id="{{ Qs::hash($s->user->id) }}" onclick="confirmDelete(this.id)" href="#" class="dropdown-item"><i class="icon-trash"></i> Xóa</a>
                                                    <form method="post" id="item-delete-{{ Qs::hash($s->user->id) }}" action="{{ route('students.destroy', Qs::hash($s->user->id)) }}" class="hidden">@csrf @method('delete')</form>
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

            </div>
        </div>
    </div>

    {{--Class Edit Ends--}}

@endsection
