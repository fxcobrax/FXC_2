@extends("admin.layouts.default")
@section('breadcrumbs')
    <li class="breadcrumb-item active"><a href="{{ route("admin.mark_exams.index") }}">Mark Exams</a></li>
    @if(isset($data))
        <li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_edit')}}</li>
    @else
        <li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_add')}}</li>
    @endIf
@endsection
@section('pageTitle')
<h1>Mark Exams</h1>
@endsection
@section('pageInfo')
@endsection
@section('backBtn')
<a href="{{ route("admin.mark_exams.index") }}"><i class="fas fa-angle-left"></i> {{trans('admiko.page_back_btn')}}</a>
@endsection
@section('content')
<div class="card formPage mark_exams_manage admikoForm">
    <legend class="action">{{ isset($data) ? trans('admiko.update') : trans('admiko.add_new') }}</legend>
    <form method="POST" action="{{ $admiko_data['formAction'] }}" enctype="multipart/form-data" class="needs-validation" novalidate>
        @if(isset($data)) @method('PUT') @endIf
        @csrf
        <div class="card-body">
            @if ($errors->any())<div class="row"><div class="col-2"></div><div class="col"><div class="invalid-feedback d-block">@foreach($errors->all() as $error) {{$error}}<br> @endforeach</div></div></div>@endif
            <div class="row">
                
                <div class=" col-12">
                    <div class="form-group row multiSelect">
                        <label for="exam_name" class="col-md-2 col-form-label">Exam Name:*</label>
                        <div class="col-md-10" style="position: relative">
                            <select class="form-select" id="exam_name" name="exam_name" required="true" data-placeholder="{{trans('admiko.select')}}" style="width: 100%" data-width="100%" data-allow-clear="true">
                                
                                @foreach($examination_all as $id => $value)
                                    <option value="{{ $id }}" {{ (old('exam_name') ? old('exam_name') : $data->exam_name ?? '') == $id ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback @if ($errors->has('exam_name')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="exam_name_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>

                <div class=" col-12">
                    <div class="form-group row multiSelect">
                        <label for="student_name" class="col-md-2 col-form-label">Student Name:*</label>
                        <div class="col-md-10" style="position: relative">
                            <select class="form-select" id="student_name" name="student_name" required="true" data-placeholder="{{trans('admiko.select')}}" style="width: 100%" data-width="100%" data-allow-clear="true">
                                
                                @foreach($students_list_all as $id => $value)
                                    <option value="{{ $id }}" {{ (old('student_name') ? old('student_name') : $data->student_name ?? '') == $id ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback @if ($errors->has('student_name')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="student_name_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>

                <div class=" col-12">
                    <div class="form-group row">
                        <label for="marks" class="col-md-2 col-form-label">Marks:</label>
                        <div class="col-md-10">
                            <input type="number" class="form-control limitPozNegNumbers numbersWidth" id="marks" name="marks"  placeholder="Marks"
                                   step="1" 
                                   value="{{{ old('marks', isset($data)?$data->marks : '') }}}">
                            <div class="invalid-feedback @if ($errors->has('marks')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="marks_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="date" class="col-md-2 col-form-label">Date:</label>
                        <div class="col-md-10">
                            <div class="input-group" id="dateTimePicker_date" data-target-input="nearest">
                                <input type="text" autocomplete="off" style="max-width: 170px;border-right: unset;"
                                       data-date_time_format="{{config('admiko_config.form_date_time_format')}}"
                                       class="form-control datetimepicker-input dateTimePicker"
                                       data-target="#dateTimePicker_date"  id="date" data-toggle="datetimepicker"
                                       placeholder="Date" name="date" value="{{{ old('date', isset($data)?$data->date : '') }}}">
                                <div class="input-group-append input-group-text" data-target="#dateTimePicker_date" data-toggle="datetimepicker">
                                    <i class="fas fa-calendar-alt fa-fw"></i>
                                </div>
                            </div>
                            <div class="invalid-feedback @if ($errors->has('date')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="date_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer form-actions" id="form-group-buttons">
            <div class="row">
                <div class="col-2"></div>
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary float-start me-1 mb-1 mb-sm-0 save-button">{{trans('admiko.table_save')}}</button>
                    <a href="{{ route("admin.mark_exams.index") }}" class="btn btn-secondary float-end" role="button">{{trans('admiko.table_cancel')}}</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection