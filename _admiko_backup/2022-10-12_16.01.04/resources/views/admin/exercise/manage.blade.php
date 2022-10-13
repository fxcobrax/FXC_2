@extends("admin.layouts.default")
@section('breadcrumbs')
    <li class="breadcrumb-item active"><a href="{{ route("admin.exercise.index") }}">Exercise</a></li>
    @if(isset($data))
        <li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_edit')}}</li>
    @else
        <li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_add')}}</li>
    @endIf
@endsection
@section('pageTitle')
<h1>Exercise</h1>
@endsection
@section('pageInfo')
@endsection
@section('backBtn')
<a href="{{ route("admin.exercise.index") }}"><i class="fas fa-angle-left"></i> {{trans('admiko.page_back_btn')}}</a>
@endsection
@section('content')
<div class="card formPage exercise_manage admikoForm">
    <legend class="action">{{ isset($data) ? trans('admiko.update') : trans('admiko.add_new') }}</legend>
    <form method="POST" action="{{ $admiko_data['formAction'] }}" enctype="multipart/form-data" class="needs-validation" novalidate>
        @if(isset($data)) @method('PUT') @endIf
        @csrf
        <div class="card-body">
            @if ($errors->any())<div class="row"><div class="col-2"></div><div class="col"><div class="invalid-feedback d-block">@foreach($errors->all() as $error) {{$error}}<br> @endforeach</div></div></div>@endif
            <div class="row">
                
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="exercise_name" class="col-md-2 col-form-label">Exercise Name:*</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="exercise_name" name="exercise_name" required="true" placeholder="Exercise Name"  value="{{{ old('exercise_name', isset($data)?$data->exercise_name : '') }}}">
                            <div class="invalid-feedback @if ($errors->has('exercise_name')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="exercise_name_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row multiSelect">
                        <label for="class" class="col-md-2 col-form-label">Class:*</label>
                        <div class="col-md-10" style="position: relative">
                            <select class="form-select" id="class" name="class" required="true" data-placeholder="{{trans('admiko.select')}}" style="width: 100%" data-width="100%" data-allow-clear="true">
                                
                                @foreach($classes_all as $id => $value)
                                    <option value="{{ $id }}" {{ (old('class') ? old('class') : $data->class ?? '') == $id ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback @if ($errors->has('class')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="class_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>

                <div class=" col-12">
                    <div class="form-group row">
                        <label for="subject" class="col-md-2 col-form-label">Subject:*</label>
                        <div class="col-md-10">
                            <select class="form-select" id="subject" name="subject" required="true">
                                
                                @foreach($subjects_all as $id => $value)
                                    <option value="{{ $id }}" {{ (old('subject') ? old('subject') : $data->subject ?? '') == $id ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback @if ($errors->has('subject')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="subject_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>

                <div class=" col-12">
                    <div class="form-group row">
                        <label for="marks" class="col-md-2 col-form-label">Marks:*</label>
                        <div class="col-md-10">
                            <input type="number" class="form-control limitPozNegNumbers numbersWidth" id="marks" name="marks" required="true" placeholder="Marks"
                                   step="1"  data-min="1" min="1"
                                   value="{{{ old('marks', isset($data)?$data->marks : '') }}}">
                            <div class="invalid-feedback @if ($errors->has('marks')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="marks_help" class="text-muted"> Min: 1</small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="date" class="col-md-2 col-form-label">Date:*</label>
                        <div class="col-md-10">
                            <div class="input-group" id="dateTimePicker_date" data-target-input="nearest">
                                <input type="text" autocomplete="off" style="max-width: 170px;border-right: unset;"
                                       data-date_time_format="{{config('admiko_config.form_date_time_format')}}"
                                       class="form-control datetimepicker-input dateTimePicker"
                                       data-target="#dateTimePicker_date" required="true" id="date" data-toggle="datetimepicker"
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
                    <a href="{{ route("admin.exercise.index") }}" class="btn btn-secondary float-end" role="button">{{trans('admiko.table_cancel')}}</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection