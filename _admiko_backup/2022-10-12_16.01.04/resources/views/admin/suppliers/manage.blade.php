@extends("admin.layouts.default")
@section('breadcrumbs')
    <li class="breadcrumb-item active"><a href="{{ route("admin.suppliers.index") }}">Suppliers</a></li>
    @if(isset($data))
        <li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_edit')}}</li>
    @else
        <li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_add')}}</li>
    @endIf
@endsection
@section('pageTitle')
<h1>Suppliers</h1>
@endsection
@section('pageInfo')
@endsection
@section('backBtn')
<a href="{{ route("admin.suppliers.index") }}"><i class="fas fa-angle-left"></i> {{trans('admiko.page_back_btn')}}</a>
@endsection
@section('content')
<div class="card formPage suppliers_manage admikoForm">
    <legend class="action">{{ isset($data) ? trans('admiko.update') : trans('admiko.add_new') }}</legend>
    <form method="POST" action="{{ $admiko_data['formAction'] }}" enctype="multipart/form-data" class="needs-validation" novalidate>
        @if(isset($data)) @method('PUT') @endIf
        @csrf
        <div class="card-body">
            @if ($errors->any())<div class="row"><div class="col-2"></div><div class="col"><div class="invalid-feedback d-block">@foreach($errors->all() as $error) {{$error}}<br> @endforeach</div></div></div>@endif
            <div class="row">
                
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="supplier_name" class="col-md-2 col-form-label">Supplier Name:*</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="supplier_name" name="supplier_name" required="true" placeholder="Supplier Name"  value="{{{ old('supplier_name', isset($data)?$data->supplier_name : '') }}}">
                            <div class="invalid-feedback @if ($errors->has('supplier_name')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="supplier_name_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="company" class="col-md-2 col-form-label">Company:*</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="company" name="company" required="true" placeholder="Company"  value="{{{ old('company', isset($data)?$data->company : '') }}}">
                            <div class="invalid-feedback @if ($errors->has('company')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="company_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="address" class="col-md-2 col-form-label">Address:*</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="address" name="address" required="true" placeholder="Address"  value="{{{ old('address', isset($data)?$data->address : '') }}}">
                            <div class="invalid-feedback @if ($errors->has('address')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="address_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="phone_number" class="col-md-2 col-form-label">Phone Number:*</label>
                        <div class="col-md-10">
                            <input type="number" class="form-control limitPozNegNumbers numbersWidth" id="phone_number" name="phone_number" required="true" placeholder="Phone Number"
                                   step="1" 
                                   value="{{{ old('phone_number', isset($data)?$data->phone_number : '') }}}">
                            <div class="invalid-feedback @if ($errors->has('phone_number')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="phone_number_help" class="text-muted"></small>
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
                    <a href="{{ route("admin.suppliers.index") }}" class="btn btn-secondary float-end" role="button">{{trans('admiko.table_cancel')}}</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection