@extends('layouts.master')
@section('page_title', 'Trang chủ')
@section('content')

    @if(Qs::userIsTeamSA())
    <div class="row">
        <div class="col-sm-6 col-xl-3">
            <div class="card card-body bg-blue-400 has-bg-image">
                <div class="media">
                    <div class="media-body">
                        <h3 class="mb-0">{{ $users->where('user_type', 'student')->count() }}</h3>
                        <span class="text-uppercase font-size-xs font-weight-bold">Total Students</span>
                    </div>

                    <div class="ml-3 align-self-center">
                        <i class="icon-users4 icon-3x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card card-body bg-danger-400 has-bg-image">
                <div class="media">
                    <div class="media-body">
                        <h3 class="mb-0">{{ $users->where('user_type', 'teacher')->count() }}</h3>
                        <span class="text-uppercase font-size-xs">Total Teachers</span>
                    </div>

                    <div class="ml-3 align-self-center">
                        <i class="icon-users2 icon-3x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card card-body bg-success-400 has-bg-image">
                <div class="media">
                    <div class="mr-3 align-self-center">
                        <i class="icon-pointer icon-3x opacity-75"></i>
                    </div>

                    <div class="media-body text-right">
                        <h3 class="mb-0">{{ $users->where('user_type', 'admin')->count() }}</h3>
                        <span class="text-uppercase font-size-xs">Total Administrators</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card card-body bg-indigo-400 has-bg-image">
                <div class="media">
                    <div class="mr-3 align-self-center">
                        <i class="icon-user icon-3x opacity-75"></i>
                    </div>

                    <div class="media-body text-right">
                        <h3 class="mb-0">{{ $users->where('user_type', 'parent')->count() }}</h3>
                        <span class="text-uppercase font-size-xs">Total Parents</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">Drashboard</h5>
            {!! Qs::getPanelOptions() !!}
        </div>
        @if(Qs::userIsStudent())
        <div class="card-body">  
            <div class="tab-content"> 
                <div class="row">
                    <div class="col-sm-6 col-xl-3">
                        <div class="card card-body bg-blue-400 has-bg-image">
                            <div class="media">
                                <div class="media-body text-center">
                                    <h2 class="mb-0">{{count($gxps)}}</h2>
                                    <span class="text-uppercase font-size-xs font-weight-bold">Tổng số đơn đã gửi đi</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-2">
                        <div class="card card-body bg-success-400 has-bg-image">
                            <div class="media">
                                <div class="media-body text-center">
                                    <h2 class="mb-0">{{count($gxps->where('status','1'))}}</h2>
                                    <span class="text-uppercase font-size-xs">Số đơn phụ huynh phê duyệt</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-2">
                        <div class="card card-body bg-orange-300 has-bg-image">
                            <div class="media"> 
                                <div class="media-body text-center">
                                    <h2 class="mb-0">{{count($gxps->where('status','3'))}}</h2>
                                    <span class="text-uppercase font-size-xs">Số đơn bị phụ huynh từ chối</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="card card-body bg-success-800 has-bg-image">
                            <div class="media">
                                <div class="media-body text-center">
                                    <h2 class="mb-0">{{count($gxps->where('status','2'))}}</h2>
                                    <span class="text-uppercase font-size-xs">Số đơn giáo viên phê duyệt</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-2">
                        <div class="card card-body bg-danger-400 has-bg-image">
                            <div class="media"> 
                                <div class="media-body text-center">
                                    <h2 class="mb-0">{{count($gxps->where('status','4'))}}</h2>
                                    <span class="text-uppercase font-size-xs">Số đơn giáo viên từ chối</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
        @endif
    </div>
    
    @endsection
