@extends('layouts.master')
@section('page_title', 'Quản lý người dùng')
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Quản lý người dùng</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="nav-item"><a href="#new-user" class="nav-link active" data-toggle="tab">Tạo người dùng mới</a></li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Quản lý người dùng</a>
                    <div class="dropdown-menu dropdown-menu-right">
                        @foreach($user_types as $ut)
                            <a href="#ut-{{ Qs::hash($ut->id) }}" class="dropdown-item" data-toggle="tab">{{ $ut->name }}</a>
                        @endforeach
                    </div>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="new-user">
                    <form method="post" enctype="multipart/form-data" class="wizard-form steps-validation ajax-store pt-2" action="{{ route('users.store') }}" data-fouc>
                        @csrf
                        <h6>Personal Data</h6>
                        <fieldset>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="user_type"> Chọn Người dùng: <span class="text-danger">*</span></label>
                                        <select required data-placeholder="Select User" class="form-control select" name="user_type" id="user_type">
                                        @foreach($user_types as $ut)
                                            <option value="{{ Qs::hash($ut->id) }}">{{ $ut->name }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tên đầy đủ: <span class="text-danger">*</span></label>
                                        <input value="{{ old('name') }}" required type="text" name="name" placeholder="Full Name" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Địa chỉ: <span class="text-danger">*</span></label>
                                        <input value="{{ old('address') }}" class="form-control" placeholder="Address" name="address" type="text" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="gender">Giới tính: <span class="text-danger">*</span></label>
                                        <select class="select form-control" id="gender" name="gender" required data-fouc data-placeholder="Choose..">
                                            <option value=""></option>
                                            <option {{ (old('gender') == 'Nam') ? 'selected' : '' }} value="Nam">Nam</option>
                                            <option {{ (old('gender') == 'Nữ') ? 'selected' : '' }} value="Nữ">Nữ</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Email: <span class="text-danger">*</span></label>
                                        <input value="{{ old('email') }}" type="email" name="email" class="form-control" required placeholder="your@email.com">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Username: <span class="text-danger">*</span></label>
                                        <input value="{{ old('username') }}" required type="text" name="username" class="form-control" placeholder="Username">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Điện thoại:</label>
                                        <input value="{{ old('phone') }}" type="text" name="phone" class="form-control" placeholder="+8498234567" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                {{-- <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Năm sinh:</label>
                                        <input autocomplete="off" name="dob" value="{{ old('dob') }}" type="text" class="form-control date-pick" placeholder="Select Date...">
                                    </div>
                                </div> --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Ngày làm việc:</label>
                                        <input autocomplete="off" name="emp_date" value="{{ old('emp_date') }}" type="text" class="form-control date-pick" placeholder="Select Date...">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="password">Mật khẩu: </label>
                                        <input id="password" type="password" name="password" class="form-control"  >
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="d-block">Ảnh CCCD/CMT:</label>
                                        <input value="{{ old('photo') }}" accept="image/*" type="file" name="photo" class="form-input-styled" data-fouc>
                                        <span class="form-text text-muted">Accepted Images: jpeg, png. Max file size 2Mb</span>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>

                @foreach($user_types as $ut)
                    <div class="tab-pane fade" id="ut-{{Qs::hash($ut->id)}}">                         
                        <table class="table datatable-button-html5-columns">
                            <thead>
                            <tr>
                                <th>Stt</th>
                                <th>Photo</th>
                                <th>Họ tên</th>
                                <th>Username</th>
                                <th>Điện thoại</th>
                                <th>Email</th>
                                <th>Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users->where('user_type', $ut->title) as $u)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><img class="rounded-circle" style="height: 40px; width: 40px;" src="{{ $u->photo }}" alt="photo"></td>
                                    <td>{{ $u->name }}</td>
                                    <td>{{ $u->username }}</td>
                                    <td>{{ $u->phone }}</td>
                                    <td>{{ $u->email }}</td>
                                    <td class="text-center">
                                        <div class="list-icons">
                                            <div class="dropdown">
                                                <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                    <i class="icon-menu9"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-left">
                                                    <!-- View Profile -->
                                                    <a href="{{ route('users.show', Qs::hash($u->id)) }}" class="dropdown-item">
                                                        <i class="icon-eye"></i> Xem hồ sơ</a>
                                                    <!-- Edit -->
                                                    <a href="{{ route('users.edit', Qs::hash($u->id)) }}" class="dropdown-item">
                                                        <i class="icon-pencil"></i> Chỉnh sửa</a>
                                                @if(Qs::userIsSuperAdmin())
                                                    <a href="{{ route('users.reset_pass', Qs::hash($u->id)) }}" class="dropdown-item">
                                                        <i class="icon-lock"></i> Đặt lại mật khẩu</a>
                                                    <!-- Delete -->
                                                    <a id="{{ Qs::hash($u->id) }}" onclick="confirmDelete(this.id)" href="#" class="dropdown-item"><i class="icon-trash"></i> Xóa</a>
                                                    <form method="post" id="item-delete-{{ Qs::hash($u->id) }}" action="{{ route('users.destroy', Qs::hash($u->id)) }}" class="hidden">@csrf @method('delete')</form>
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
