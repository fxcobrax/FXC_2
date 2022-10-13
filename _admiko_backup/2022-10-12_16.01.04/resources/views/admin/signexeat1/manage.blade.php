@extends("admin.layouts.default")
@section('breadcrumbs')
    <li class="breadcrumb-item active"><a href="{{ route("admin.signexeat1.index") }}">Sign Exeat</a></li>
    @if(isset($data))
        <li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_edit')}}</li>
    @else
        <li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_add')}}</li>
    @endIf
@endsection
@section('pageTitle')
<h1>Sign Exeat</h1>
@endsection
@section('pageInfo')
@endsection
@section('backBtn')
<a href="{{ route("admin.signexeat1.index") }}"><i class="fas fa-angle-left"></i> {{trans('admiko.page_back_btn')}}</a>
@endsection
@section('content')
<div class="card formPage signexeat1_manage admikoForm">
    <legend class="action">{{ isset($data) ? trans('admiko.update') : trans('admiko.add_new') }}</legend>
    <form method="POST" action="{{ $admiko_data['formAction'] }}" enctype="multipart/form-data" class="needs-validation" novalidate>
        @if(isset($data)) @method('PUT') @endIf
        @csrf
        <div class="card-body">
            @if ($errors->any())<div class="row"><div class="col-2"></div><div class="col"><div class="invalid-feedback d-block">@foreach($errors->all() as $error) {{$error}}<br> @endforeach</div></div></div>@endif
            <div class="row">
                
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
                        <label for="from" class="col-md-2 col-form-label">From:*</label>
                        <div class="col-md-10">
                            <div class="input-group" id="dateTimePicker_from" data-target-input="nearest">
                                <input type="text" autocomplete="off" style="max-width: 170px;border-right: unset;"
                                       data-date_time_format="{{config('admiko_config.form_date_time_format')}}"
                                       class="form-control datetimepicker-input dateTimePicker"
                                       data-target="#dateTimePicker_from" required="true" id="from" data-toggle="datetimepicker"
                                       placeholder="From" name="from" value="{{{ old('from', isset($data)?$data->from : '') }}}">
                                <div class="input-group-append input-group-text" data-target="#dateTimePicker_from" data-toggle="datetimepicker">
                                    <i class="fas fa-calendar-alt fa-fw"></i>
                                </div>
                            </div>
                            <div class="invalid-feedback @if ($errors->has('from')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="from_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="to" class="col-md-2 col-form-label">To:*</label>
                        <div class="col-md-10">
                            <div class="input-group" id="dateTimePicker_to" data-target-input="nearest">
                                <input type="text" autocomplete="off" style="max-width: 170px;border-right: unset;"
                                       data-date_time_format="{{config('admiko_config.form_date_time_format')}}"
                                       class="form-control datetimepicker-input dateTimePicker"
                                       data-target="#dateTimePicker_to" required="true" id="to" data-toggle="datetimepicker"
                                       placeholder="To" name="to" value="{{{ old('to', isset($data)?$data->to : '') }}}">
                                <div class="input-group-append input-group-text" data-target="#dateTimePicker_to" data-toggle="datetimepicker">
                                    <i class="fas fa-calendar-alt fa-fw"></i>
                                </div>
                            </div>
                            <div class="invalid-feedback @if ($errors->has('to')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="to_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="reason" class="col-md-2 col-form-label">Reason:*</label>
                        <div class="col-md-10">
                            <textarea class="form-control form-control-textarea simple_text_editor" id="reason" name="reason" required="true" placeholder="Reason">{{{ old('reason', isset($data)?$data->reason : '') }}}</textarea>
                            <div class="invalid-feedback @if ($errors->has('reason')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="reason_help" class="text-muted"></small>
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
                    <a href="{{ route("admin.signexeat1.index") }}" class="btn btn-secondary float-end" role="button">{{trans('admiko.table_cancel')}}</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection