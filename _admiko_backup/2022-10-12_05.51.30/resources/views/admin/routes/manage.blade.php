@extends("admin.layouts.default")
@section('breadcrumbs')
    <li class="breadcrumb-item active"><a href="{{ route("admin.routes.index") }}">Routes</a></li>
    @if(isset($data))
        <li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_edit')}}</li>
    @else
        <li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_add')}}</li>
    @endIf
@endsection
@section('pageTitle')
<h1>Routes</h1>
@endsection
@section('pageInfo')
@endsection
@section('backBtn')
<a href="{{ route("admin.routes.index") }}"><i class="fas fa-angle-left"></i> {{trans('admiko.page_back_btn')}}</a>
@endsection
@section('content')
<div class="card formPage routes_manage admikoForm">
    <legend class="action">{{ isset($data) ? trans('admiko.update') : trans('admiko.add_new') }}</legend>
    <form method="POST" action="{{ $admiko_data['formAction'] }}" enctype="multipart/form-data" class="needs-validation" novalidate>
        @if(isset($data)) @method('PUT') @endIf
        @csrf
        <div class="card-body">
            @if ($errors->any())<div class="row"><div class="col-2"></div><div class="col"><div class="invalid-feedback d-block">@foreach($errors->all() as $error) {{$error}}<br> @endforeach</div></div></div>@endif
            <div class="row">
                
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="route_name" class="col-md-2 col-form-label">Route Name:</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="route_name" name="route_name"  placeholder="Route Name"  value="{{{ old('route_name', isset($data)?$data->route_name : '') }}}">
                            <div class="invalid-feedback @if ($errors->has('route_name')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="route_name_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="fee_charge" class="col-md-2 col-form-label">Fee Charge:</label>
                        <div class="col-md-10">
                            <div class="input-group">
                            <div class="input-group-prepend input-group-text">₵</div>
                                <input type="text" class="form-control limitPozNegDecNumbers moneyWidth" id="fee_charge" name="fee_charge" 
                                       placeholder="Fee Charge" step="0.01"  data-min="1" min="1" data-decimal="2"
                                       value="{{{ old('fee_charge', isset($data)?$data->fee_charge : '') }}}">
                                <div class="invalid-feedback @if ($errors->has('fee_charge')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            </div>
                            <small id="fee_charge_help" class="text-muted"> Min: 1</small>
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
                    <a href="{{ route("admin.routes.index") }}" class="btn btn-secondary float-end" role="button">{{trans('admiko.table_cancel')}}</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection