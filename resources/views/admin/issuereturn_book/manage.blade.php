@extends("admin.layouts.default")
@section('breadcrumbs')
    <li class="breadcrumb-item active"><a href="{{ route("admin.issuereturn_book.index") }}">Issue/Return Book</a></li>
    @if(isset($data))
        <li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_edit')}}</li>
    @else
        <li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_add')}}</li>
    @endIf
@endsection
@section('pageTitle')
<h1>Issue/Return Book</h1>
@endsection
@section('pageInfo')
@endsection
@section('backBtn')
<a href="{{ route("admin.issuereturn_book.index") }}"><i class="fas fa-angle-left"></i> {{trans('admiko.page_back_btn')}}</a>
@endsection
@section('content')
<div class="card formPage issuereturn_book_manage admikoForm">
    <legend class="action">{{ isset($data) ? trans('admiko.update') : trans('admiko.add_new') }}</legend>
    <form method="POST" action="{{ $admiko_data['formAction'] }}" enctype="multipart/form-data" class="needs-validation" novalidate>
        @if(isset($data)) @method('PUT') @endIf
        @csrf
        <div class="card-body">
            @if ($errors->any())<div class="row"><div class="col-2"></div><div class="col"><div class="invalid-feedback d-block">@foreach($errors->all() as $error) {{$error}}<br> @endforeach</div></div></div>@endif
            <div class="row">
                
                <div class=" col-12">
                    <div class="form-group row multiSelect">
                        <label for="book_name" class="col-md-2 col-form-label">Book Name:*</label>
                        <div class="col-md-10" style="position: relative">
                            <select class="form-select" id="book_name" name="book_name" required="true" data-placeholder="{{trans('admiko.select')}}" style="width: 100%" data-width="100%" data-allow-clear="true">
                                
                                @foreach($book_list_all as $id => $value)
                                    <option value="{{ $id }}" {{ (old('book_name') ? old('book_name') : $data->book_name ?? '') == $id ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback @if ($errors->has('book_name')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="book_name_help" class="text-muted"></small>
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
                        <label class="col-form-label col-md-2">Status:*</label>
                        <div class="col-md-10">
                            <div class="row pt-2">
                            @foreach($status_all as $id => $value)
                                @php $checked = ""; @endphp
                                @if(old('status') == $id)
                                    @php $checked = "checked"; @endphp
                                @elseIf(isset($data) && $data->status == $id)
                                    @php $checked = "checked"; @endphp
                                @elseIf($loop->index == 0)
                                @php $checked = "checked"; @endphp
                                @endIf
                                <div class="col-12">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" name="status" id="status{{ $id }}" value="{{ $id }}" {{$checked}} >
                                        <label class="form-check-label" for="status{{ $id }}">{{ $value }}</label>
                                    </div>
                                </div>
                            @endforeach
                            </div>
                            <div class="invalid-feedback @if ($errors->has('status')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="status_help" class="text-muted"></small>
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
                    <a href="{{ route("admin.issuereturn_book.index") }}" class="btn btn-secondary float-end" role="button">{{trans('admiko.table_cancel')}}</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection