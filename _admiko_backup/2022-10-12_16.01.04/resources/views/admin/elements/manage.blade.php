@extends("admin.layouts.default")
@section('breadcrumbs')
    <li class="breadcrumb-item active"><a href="{{ route("admin.elements.index") }}">Elements</a></li>
    @if(isset($data))
        <li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_edit')}}</li>
    @else
        <li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_add')}}</li>
    @endIf
@endsection
@section('pageTitle')
<h1>Elements</h1>
@endsection
@section('pageInfo')
@endsection
@section('backBtn')
<a href="{{ route("admin.elements.index") }}"><i class="fas fa-angle-left"></i> {{trans('admiko.page_back_btn')}}</a>
@endsection
@section('content')
<div class="card formPage elements_manage admikoForm">
    <legend class="action">{{ isset($data) ? trans('admiko.update') : trans('admiko.add_new') }}</legend>
    <form method="POST" action="{{ $admiko_data['formAction'] }}" enctype="multipart/form-data" class="needs-validation" novalidate>
        @if(isset($data)) @method('PUT') @endIf
        @csrf
        <div class="card-body">
            @if ($errors->any())<div class="row"><div class="col-2"></div><div class="col"><div class="invalid-feedback d-block">@foreach($errors->all() as $error) {{$error}}<br> @endforeach</div></div></div>@endif
            <div class="row">
                
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="gender" class="col-md-2 col-form-label">Gender:</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="gender" name="gender"  placeholder="Gender"  value="{{{ old('gender', isset($data)?$data->gender : '') }}}">
                            <div class="invalid-feedback @if ($errors->has('gender')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="gender_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="feestatus" class="col-md-2 col-form-label">Fee Status:</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="feestatus" name="feestatus"  placeholder="Fee Status"  value="{{{ old('feestatus', isset($data)?$data->feestatus : '') }}}">
                            <div class="invalid-feedback @if ($errors->has('feestatus')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="feestatus_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="contract_type" class="col-md-2 col-form-label">Contract Type:</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="contract_type" name="contract_type"  placeholder="Contract Type"  value="{{{ old('contract_type', isset($data)?$data->contract_type : '') }}}">
                            <div class="invalid-feedback @if ($errors->has('contract_type')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="contract_type_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="role" class="col-md-2 col-form-label">Role:</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="role" name="role"  placeholder="Role"  value="{{{ old('role', isset($data)?$data->role : '') }}}">
                            <div class="invalid-feedback @if ($errors->has('role')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="role_help" class="text-muted"></small>
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
                    <a href="{{ route("admin.elements.index") }}" class="btn btn-secondary float-end" role="button">{{trans('admiko.table_cancel')}}</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection