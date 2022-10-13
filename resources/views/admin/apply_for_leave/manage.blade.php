@extends("admin.layouts.default")
@section('breadcrumbs')
    <li class="breadcrumb-item active"><a href="{{ route("admin.apply_for_leave.index") }}">Apply For Leave</a></li>
    @if(isset($data))
        <li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_edit')}}</li>
    @else
        <li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_add')}}</li>
    @endIf
@endsection
@section('pageTitle')
<h1>Apply For Leave</h1>
@endsection
@section('pageInfo')
@endsection
@section('backBtn')
<a href="{{ route("admin.apply_for_leave.index") }}"><i class="fas fa-angle-left"></i> {{trans('admiko.page_back_btn')}}</a>
@endsection
@section('content')
<div class="card formPage apply_for_leave_manage admikoForm">
    <legend class="action">{{ isset($data) ? trans('admiko.update') : trans('admiko.add_new') }}</legend>
    <form method="POST" action="{{ $admiko_data['formAction'] }}" enctype="multipart/form-data" class="needs-validation" novalidate>
        @if(isset($data)) @method('PUT') @endIf
        @csrf
        <div class="card-body">
            @if ($errors->any())<div class="row"><div class="col-2"></div><div class="col"><div class="invalid-feedback d-block">@foreach($errors->all() as $error) {{$error}}<br> @endforeach</div></div></div>@endif
            <div class="row">
                
                <div class=" col-12">
                    <div class="form-group row multiSelect">
                        <label for="staff_name" class="col-md-2 col-form-label">Staff Name:*</label>
                        <div class="col-md-10" style="position: relative">
                            <select class="form-select" id="staff_name" name="staff_name" required="true" data-placeholder="{{trans('admiko.select')}}" style="width: 100%" data-width="100%" data-allow-clear="true">
                                
                                @foreach($staffs_all as $id => $value)
                                    <option value="{{ $id }}" {{ (old('staff_name') ? old('staff_name') : $data->staff_name ?? '') == $id ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback @if ($errors->has('staff_name')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="staff_name_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>

                <div class=" col-12">
                    <div class="form-group row multiSelect">
                        <label for="leave_type" class="col-md-2 col-form-label">Leave Type:*</label>
                        <div class="col-md-10" style="position: relative">
                            <select class="form-select" id="leave_type" name="leave_type" required="true" data-placeholder="{{trans('admiko.select')}}" style="width: 100%" data-width="100%" data-allow-clear="true">
                                
                                @foreach($leave_type_all as $id => $value)
                                    <option value="{{ $id }}" {{ (old('leave_type') ? old('leave_type') : $data->leave_type ?? '') == $id ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback @if ($errors->has('leave_type')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="leave_type_help" class="text-muted"></small>
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
                    <a href="{{ route("admin.apply_for_leave.index") }}" class="btn btn-secondary float-end" role="button">{{trans('admiko.table_cancel')}}</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection