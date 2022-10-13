@extends("admin.layouts.default")
@section('breadcrumbs')
    <li class="breadcrumb-item active"><a href="{{ route("admin.dorms.index") }}">Dorms</a></li>
    @if(isset($data))
        <li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_edit')}}</li>
    @else
        <li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_add')}}</li>
    @endIf
@endsection
@section('pageTitle')
<h1>Dorms</h1>
@endsection
@section('pageInfo')
@endsection
@section('backBtn')
<a href="{{ route("admin.dorms.index") }}"><i class="fas fa-angle-left"></i> {{trans('admiko.page_back_btn')}}</a>
@endsection
@section('content')
<div class="card formPage dorms_manage admikoForm">
    <legend class="action">{{ isset($data) ? trans('admiko.update') : trans('admiko.add_new') }}</legend>
    <form method="POST" action="{{ $admiko_data['formAction'] }}" enctype="multipart/form-data" class="needs-validation" novalidate>
        @if(isset($data)) @method('PUT') @endIf
        @csrf
        <div class="card-body">
            @if ($errors->any())<div class="row"><div class="col-2"></div><div class="col"><div class="invalid-feedback d-block">@foreach($errors->all() as $error) {{$error}}<br> @endforeach</div></div></div>@endif
            <div class="row">
                
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="dorm_name" class="col-md-2 col-form-label">Dorm Name:*</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="dorm_name" name="dorm_name" required="true" placeholder="Dorm Name"  value="{{{ old('dorm_name', isset($data)?$data->dorm_name : '') }}}">
                            <div class="invalid-feedback @if ($errors->has('dorm_name')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="dorm_name_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row multiSelect">
                        <label for="dorm_type" class="col-md-2 col-form-label">Dorm Type:*</label>
                        <div class="col-md-10" style="position: relative">
                            <select class="form-select" id="dorm_type" name="dorm_type" required="true" data-placeholder="{{trans('admiko.select')}}" style="width: 100%" data-width="100%" data-allow-clear="true">
                                
                                @foreach($dorm_type_all as $id => $value)
                                    <option value="{{ $id }}" {{ (old('dorm_type') ? old('dorm_type') : $data->dorm_type ?? '') == $id ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback @if ($errors->has('dorm_type')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="dorm_type_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>

                <div class=" col-12">
                    <div class="form-group row">
                        <label for="description" class="col-md-2 col-form-label">Description:</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="description" name="description"  placeholder="Description"  value="{{{ old('description', isset($data)?$data->description : '') }}}">
                            <div class="invalid-feedback @if ($errors->has('description')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="description_help" class="text-muted"></small>
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
                    <a href="{{ route("admin.dorms.index") }}" class="btn btn-secondary float-end" role="button">{{trans('admiko.table_cancel')}}</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection