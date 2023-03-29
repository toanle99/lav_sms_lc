@extends('layouts.master')
@section('page_title', 'Thêm mới giấy xin phép')
@section('content')
        <div class="card">
            <div class="card-header bg-white header-elements-inline">
                <h6 class="card-title">Thêm mới Giấy xin phép</h6>

                {!! Qs::getPanelOptions() !!}
            </div>

            <form id="ajax-reg" method="post" enctype="multipart/form-data" class="wizard-form steps-validation pt-4" action="{{ route('gxp.store') }}" data-fouc>
               @csrf
                <h6>Personal data</h6>
                <fieldset>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="my_class_id">Lớp: </label> 
                                <select onchange="getStudentClass(this.value)" data-placeholder="Chọn ..." required name="my_class_id" id="my_class_id" class="select-search form-control">
                                    <option value=""></option>
                                    @foreach($my_classes as $c)
                                        <option {{ (old('my_class_id') == $c->id ? 'selected' : '') }} value="{{ $c->id }}">{{ $c->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Họ & tên: <span class="text-danger">*</span></label>
                                <select required name="student_record_id" id="student_record_id" class="select-search form-control">
                                    <option value="0">Chọn học sinh ... </option>
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
                                <input name="date_at" data-date-format='dd/mm/yyyy' value="{{ old('date_at') }}" type="text" class="form-control date-pick" required placeholder="Chọn ngày ...">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="my_class_id">Thời gian: <span class="text-danger">*</span></label> 
                                <select required name="session_time" id="session_time" class="select-search form-control">
                                    <option value="Cả ngày">Cả ngày</option> 
                                    <option {{ (old('session_time') == 'Buổi sáng' ? 'selected' : '') }} value="Buổi sáng">Buổi sáng</option>
                                    <option {{ (old('session_time') == 'Buổi chiều' ? 'selected' : '') }} value="Buổi chiều">Buổi chiều</option>  
                                    <option {{ (old('session_time') == 'Buổi tối' ? 'selected' : '') }} value="Buổi tối">Buổi tối</option>  
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
    @endsection
