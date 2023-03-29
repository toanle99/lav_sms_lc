@extends('layouts.master')
@section('page_title', 'Student Profile - '.$sr->user->name)
@section('content')
<div class="row">
    <div class="col-md-3 text-center">
        <div class="card">
            <div class="card-body">
                <img style="width: 90%; height:90%" src="{{ $sr->user->photo }}" alt="photo" class="rounded-circle">
                <br>
                <h3 class="mt-3">{{ $sr->user->name }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs nav-tabs-highlight">
                    <li class="nav-item">
                        <a href="#" class="nav-link active">{{ $sr->user->name }}</a>
                    </li>
                </ul>

                <div class="tab-content"> 
                    <div class="tab-pane fade show active" id="basic-info">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td class="font-weight-bold">Họ tên</td>
                                    <td>{{ $sr->user->name }}</td>
                                </tr> 
                                <tr>
                                    <td class="font-weight-bold">Lớp</td>
                                    <td>{{ $sr->my_class->name }}</td>
                                </tr>
                                @if($sr->my_parent_id)
                                    <tr>
                                        <td class="font-weight-bold">Phụ huynh</td>
                                        <td>
                                            <span>
                                                <a target="_blank" href="{{ route('users.show', Qs::hash($sr->my_parent_id)) }}">{{ $sr->my_parent->name }}</a>
                                            </span>
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <td class="font-weight-bold">Năm nhập học</td>
                                    <td>{{ $sr->year_admitted }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Giới tính</td>
                                    <td>{{ $sr->user->gender }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Địa chỉ</td>
                                    <td>{{ $sr->user->address }}</td>
                                </tr>
                                @if($sr->user->email)
                                <tr>
                                    <td class="font-weight-bold">Email</td>
                                    <td>{{$sr->user->email }}</td>
                                </tr>
                                @endif
                                @if($sr->user->phone)
                                    <tr>
                                        <td class="font-weight-bold">SĐT</td>
                                        <td>{{$sr->user->phone }}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td class="font-weight-bold">Năm sinh</td>
                                    <td>{{$sr->user->dob }}</td>
                                </tr> 
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


    {{--Student Profile Ends--}}

@endsection
