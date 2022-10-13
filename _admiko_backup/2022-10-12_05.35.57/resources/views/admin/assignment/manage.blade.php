@extends("admin.layouts.default")
@section('breadcrumbs')
    <li class="breadcrumb-item active"><a href="{{ route("admin.assignment.index") }}">Assignment</a></li>
    @if(isset($data))
        <li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_edit')}}</li>
    @else
        <li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_add')}}</li>
    @endIf
@endsection
@section('pageTitle')
<h1>Assignment</h1>
@endsection
@section('pageInfo')
@endsection
@section('backBtn')
<a href="{{ route("admin.assignment.index") }}"><i class="fas fa-angle-left"></i> {{trans('admiko.page_back_btn')}}</a>
@endsection
@section('content')
<div class="card formPage assignment_manage admikoForm">
    <legend class="action">{{ isset($data) ? trans('admiko.update') : trans('admiko.add_new') }}</legend>
    <form method="POST" action="{{ $admiko_data['formAction'] }}" enctype="multipart/form-data" class="needs-validation" novalidate>
        @if(isset($data)) @method('PUT') @endIf
        @csrf
        <div class="card-body">
            @if ($errors->any())<div class="row"><div class="col-2"></div><div class="col"><div class="invalid-feedback d-block">@foreach($errors->all() as $error) {{$error}}<br> @endforeach</div></div></div>@endif
            <div class="row">
                
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="assignment_name" class="col-md-2 col-form-label">Assignment Name:</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="assignment_name" name="assignment_name"  placeholder="Assignment Name"  value="{{{ old('assignment_name', isset($data)?$data->assignment_name : '') }}}">
                            <div class="invalid-feedback @if ($errors->has('assignment_name')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="assignment_name_help" class="text-muted"></small>
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
            </div>
        </div>
        <div class="card-footer form-actions" id="form-group-buttons">
            <div class="row">
                <div class="col-2"></div>
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary float-start me-1 mb-1 mb-sm-0 save-button">{{trans('admiko.table_save')}}</button>
                    <a href="{{ route("admin.assignment.index") }}" class="btn btn-secondary float-end" role="button">{{trans('admiko.table_cancel')}}</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection