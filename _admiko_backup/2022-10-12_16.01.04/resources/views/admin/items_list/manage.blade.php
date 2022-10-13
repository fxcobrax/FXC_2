@extends("admin.layouts.default")
@section('breadcrumbs')
    <li class="breadcrumb-item active"><a href="{{ route("admin.items_list.index") }}">Items List</a></li>
    @if(isset($data))
        <li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_edit')}}</li>
    @else
        <li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_add')}}</li>
    @endIf
@endsection
@section('pageTitle')
<h1>Items List</h1>
@endsection
@section('pageInfo')
@endsection
@section('backBtn')
<a href="{{ route("admin.items_list.index") }}"><i class="fas fa-angle-left"></i> {{trans('admiko.page_back_btn')}}</a>
@endsection
@section('content')
<div class="card formPage items_list_manage admikoForm">
    <legend class="action">{{ isset($data) ? trans('admiko.update') : trans('admiko.add_new') }}</legend>
    <form method="POST" action="{{ $admiko_data['formAction'] }}" enctype="multipart/form-data" class="needs-validation" novalidate>
        @if(isset($data)) @method('PUT') @endIf
        @csrf
        <div class="card-body">
            @if ($errors->any())<div class="row"><div class="col-2"></div><div class="col"><div class="invalid-feedback d-block">@foreach($errors->all() as $error) {{$error}}<br> @endforeach</div></div></div>@endif
            <div class="row">
                
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="item_name" class="col-md-2 col-form-label">Item Name:*</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="item_name" name="item_name" required="true" placeholder="Item Name"  value="{{{ old('item_name', isset($data)?$data->item_name : '') }}}">
                            <div class="invalid-feedback @if ($errors->has('item_name')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="item_name_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row multiSelect">
                        <label for="type" class="col-md-2 col-form-label">Type:*</label>
                        <div class="col-md-10" style="position: relative">
                            <select class="form-select" id="type" name="type" required="true" data-placeholder="{{trans('admiko.select')}}" style="width: 100%" data-width="100%" data-allow-clear="true">
                                
                                @foreach($item_type_all as $id => $value)
                                    <option value="{{ $id }}" {{ (old('type') ? old('type') : $data->type ?? '') == $id ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback @if ($errors->has('type')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="type_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>

                <div class=" col-12">
                    <div class="form-group row">
                        <label for="quantity" class="col-md-2 col-form-label">Quantity:*</label>
                        <div class="col-md-10">
                            <input type="number" class="form-control limitPozNegNumbers numbersWidth" id="quantity" name="quantity" required="true" placeholder="Quantity"
                                   step="1"  data-min="1" min="1"
                                   value="{{{ old('quantity', isset($data)?$data->quantity : '') }}}">
                            <div class="invalid-feedback @if ($errors->has('quantity')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="quantity_help" class="text-muted"> Min: 1</small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="price" class="col-md-2 col-form-label">Price/unit:*</label>
                        <div class="col-md-10">
                            <div class="input-group">
                            <div class="input-group-prepend input-group-text">₵</div>
                                <input type="text" class="form-control limitPozNegDecNumbers moneyWidth" id="price" name="price" required="true"
                                       placeholder="Price/unit" step="0.01"  data-min="0" min="0" data-decimal="2"
                                       value="{{{ old('price', isset($data)?$data->price : '') }}}">
                                <div class="invalid-feedback @if ($errors->has('price')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            </div>
                            <small id="price_help" class="text-muted"> Min: 0</small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row multiSelect">
                        <label for="supplier" class="col-md-2 col-form-label">Supplier:</label>
                        <div class="col-md-10" style="position: relative">
                            <select class="form-select" id="supplier" name="supplier"  data-placeholder="{{trans('admiko.select')}}" style="width: 100%" data-width="100%" data-allow-clear="true">
                                <option value="">{{trans("admiko.select")}}</option>
                                @foreach($suppliers_all as $id => $value)
                                    <option value="{{ $id }}" {{ (old('supplier') ? old('supplier') : $data->supplier ?? '') == $id ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback @if ($errors->has('supplier')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="supplier_help" class="text-muted"></small>
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
                    <a href="{{ route("admin.items_list.index") }}" class="btn btn-secondary float-end" role="button">{{trans('admiko.table_cancel')}}</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection