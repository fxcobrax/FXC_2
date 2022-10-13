@extends("admin.layouts.default")
@section('breadcrumbs')
    <li class="breadcrumb-item active"><a href="{{ route("admin.academic_year.index") }}">Academic Year</a></li>
    @if(isset($data))
        <li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_edit')}}</li>
    @else
        <li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_add')}}</li>
    @endIf
@endsection
@section('pageTitle')
<h1>Academic Year</h1>
@endsection
@section('pageInfo')
@endsection
@section('backBtn')
<a href="{{ route("admin.academic_year.index") }}"><i class="fas fa-angle-left"></i> {{trans('admiko.page_back_btn')}}</a>
@endsection
@section('content')
<div class="card formPage academic_year_manage admikoForm">
    <legend class="action">{{ isset($data) ? trans('admiko.update') : trans('admiko.add_new') }}</legend>
    <form method="POST" action="{{ $admiko_data['formAction'] }}" enctype="multipart/form-data" class="needs-validation" novalidate>
        @if(isset($data)) @method('PUT') @endIf
        @csrf
        <div class="card-body">
            @if ($errors->any())<div class="row"><div class="col-2"></div><div class="col"><div class="invalid-feedback d-block">@foreach($errors->all() as $error) {{$error}}<br> @endforeach</div></div></div>@endif
            <div class="row">
                
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="year_name" class="col-md-2 col-form-label">Year Name:</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="year_name" name="year_name"  placeholder="Year Name"  value="{{{ old('year_name', isset($data)?$data->year_name : '') }}}">
                            <div class="invalid-feedback @if ($errors->has('year_name')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="year_name_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="start_date" class="col-md-2 col-form-label">Start Date:</label>
                        <div class="col-md-10">
                            <div class="input-group" id="dateTimePicker_start_date" data-target-input="nearest">
                                <input type="text" autocomplete="off" style="max-width: 170px;border-right: unset;"
                                       data-date_time_format="{{config('admiko_config.form_date_time_format')}}"
                                       class="form-control datetimepicker-input dateTimePicker"
                                       data-target="#dateTimePicker_start_date"  id="start_date" data-toggle="datetimepicker"
                                       placeholder="Start Date" name="start_date" value="{{{ old('start_date', isset($data)?$data->start_date : '') }}}">
                                <div class="input-group-append input-group-text" data-target="#dateTimePicker_start_date" data-toggle="datetimepicker">
                                    <i class="fas fa-calendar-alt fa-fw"></i>
                                </div>
                            </div>
                            <div class="invalid-feedback @if ($errors->has('start_date')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="start_date_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="end_date" class="col-md-2 col-form-label">End Date:</label>
                        <div class="col-md-10">
                            <div class="input-group" id="dateTimePicker_end_date" data-target-input="nearest">
                                <input type="text" autocomplete="off" style="max-width: 170px;border-right: unset;"
                                       data-date_time_format="{{config('admiko_config.form_date_time_format')}}"
                                       class="form-control datetimepicker-input dateTimePicker"
                                       data-target="#dateTimePicker_end_date"  id="end_date" data-toggle="datetimepicker"
                                       placeholder="End Date" name="end_date" value="{{{ old('end_date', isset($data)?$data->end_date : '') }}}">
                                <div class="input-group-append input-group-text" data-target="#dateTimePicker_end_date" data-toggle="datetimepicker">
                                    <i class="fas fa-calendar-alt fa-fw"></i>
                                </div>
                            </div>
                            <div class="invalid-feedback @if ($errors->has('end_date')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="end_date_help" class="text-muted"></small>
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
                    <a href="{{ route("admin.academic_year.index") }}" class="btn btn-secondary float-end" role="button">{{trans('admiko.table_cancel')}}</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection