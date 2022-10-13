@extends("admin.layouts.default")
@section('breadcrumbs')
    <li class="breadcrumb-item active"><a href="{{ route("admin.assign_vehicle.index") }}">Assign Vehicle</a></li>
    @if(isset($data))
        <li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_edit')}}</li>
    @else
        <li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_add')}}</li>
    @endIf
@endsection
@section('pageTitle')
<h1>Assign Vehicle</h1>
@endsection
@section('pageInfo')
@endsection
@section('backBtn')
<a href="{{ route("admin.assign_vehicle.index") }}"><i class="fas fa-angle-left"></i> {{trans('admiko.page_back_btn')}}</a>
@endsection
@section('content')
<div class="card formPage assign_vehicle_manage admikoForm">
    <legend class="action">{{ isset($data) ? trans('admiko.update') : trans('admiko.add_new') }}</legend>
    <form method="POST" action="{{ $admiko_data['formAction'] }}" enctype="multipart/form-data" class="needs-validation" novalidate>
        @if(isset($data)) @method('PUT') @endIf
        @csrf
        <div class="card-body">
            @if ($errors->any())<div class="row"><div class="col-2"></div><div class="col"><div class="invalid-feedback d-block">@foreach($errors->all() as $error) {{$error}}<br> @endforeach</div></div></div>@endif
            <div class="row">
                
                <div class=" col-12">
                    <div class="form-group row multiSelect">
                        <label for="vehicle_id" class="col-md-2 col-form-label">Vehicle ID:*</label>
                        <div class="col-md-10" style="position: relative">
                            <select class="form-select" id="vehicle_id" name="vehicle_id" required="true" data-placeholder="{{trans('admiko.select')}}" style="width: 100%" data-width="100%" data-allow-clear="true">
                                
                                @foreach($vehicles_all as $id => $value)
                                    <option value="{{ $id }}" {{ (old('vehicle_id') ? old('vehicle_id') : $data->vehicle_id ?? '') == $id ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback @if ($errors->has('vehicle_id')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="vehicle_id_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>

                <div class=" col-12">
                    <div class="form-group row multiSelect">
                        <label for="driver" class="col-md-2 col-form-label">Driver:*</label>
                        <div class="col-md-10" style="position: relative">
                            <select class="form-select" id="driver" name="driver" required="true" data-placeholder="{{trans('admiko.select')}}" style="width: 100%" data-width="100%" data-allow-clear="true">
                                
                                @foreach($staffs_all as $id => $value)
                                    <option value="{{ $id }}" {{ (old('driver') ? old('driver') : $data->driver ?? '') == $id ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback @if ($errors->has('driver')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="driver_help" class="text-muted"></small>
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
                    <a href="{{ route("admin.assign_vehicle.index") }}" class="btn btn-secondary float-end" role="button">{{trans('admiko.table_cancel')}}</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection