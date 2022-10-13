@extends("admin.layouts.default")
@section('breadcrumbs')
    <li class="breadcrumb-item active"><a href="{{ route("admin.notice_board.index") }}">Notice Board</a></li>
    @if(isset($data))
        <li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_edit')}}</li>
    @else
        <li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_add')}}</li>
    @endIf
@endsection
@section('pageTitle')
<h1>Notice Board</h1>
@endsection
@section('pageInfo')
@endsection
@section('backBtn')
<a href="{{ route("admin.notice_board.index") }}"><i class="fas fa-angle-left"></i> {{trans('admiko.page_back_btn')}}</a>
@endsection
@section('content')
<div class="card formPage notice_board_manage admikoForm">
    <legend class="action">{{ isset($data) ? trans('admiko.update') : trans('admiko.add_new') }}</legend>
    <form method="POST" action="{{ $admiko_data['formAction'] }}" enctype="multipart/form-data" class="needs-validation" novalidate>
        @if(isset($data)) @method('PUT') @endIf
        @csrf
        <div class="card-body">
            @if ($errors->any())<div class="row"><div class="col-2"></div><div class="col"><div class="invalid-feedback d-block">@foreach($errors->all() as $error) {{$error}}<br> @endforeach</div></div></div>@endif
            <div class="row">
                
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="title" class="col-md-2 col-form-label">Title:*</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="title" name="title" required="true" placeholder="Title"  value="{{{ old('title', isset($data)?$data->title : '') }}}">
                            <div class="invalid-feedback @if ($errors->has('title')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="title_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="content" class="col-md-2 col-form-label">Content:*</label>
                        <div class="col-md-10">
                            <textarea class="form-control form-control-textarea simple_text_editor" id="content" name="content" required="true" placeholder="Content">{{{ old('content', isset($data)?$data->content : '') }}}</textarea>
                            <div class="invalid-feedback @if ($errors->has('content')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="content_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="date_time" class="col-md-2 col-form-label">Date &amp; Time:</label>
                        <div class="col-md-10">
                            <div class="input-group" id="dateTimePicker_date_time" data-target-input="nearest">
                                <input type="text" autocomplete="off" style="max-width: 170px;border-right: unset;"
                                       data-date_time_format="{{config('admiko_config.form_date_time_format')}}"
                                       class="form-control datetimepicker-input dateTimePicker"
                                       data-target="#dateTimePicker_date_time"  id="date_time" data-toggle="datetimepicker"
                                       placeholder="Date &amp; Time" name="date_time" value="{{{ old('date_time', isset($data)?$data->date_time : '') }}}">
                                <div class="input-group-append input-group-text" data-target="#dateTimePicker_date_time" data-toggle="datetimepicker">
                                    <i class="fas fa-calendar-alt fa-fw"></i>
                                </div>
                            </div>
                            <div class="invalid-feedback @if ($errors->has('date_time')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="date_time_help" class="text-muted"></small>
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
                    <a href="{{ route("admin.notice_board.index") }}" class="btn btn-secondary float-end" role="button">{{trans('admiko.table_cancel')}}</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection