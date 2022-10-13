@extends("admin.layouts.default")
@section('breadcrumbs')
    <li class="breadcrumb-item active"><a href="{{ route("admin.purchaseissue_item.index") }}">Purchase/Issue Item</a></li>
    @if(isset($data))
        <li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_edit')}}</li>
    @else
        <li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_add')}}</li>
    @endIf
@endsection
@section('pageTitle')
<h1>Purchase/Issue Item</h1>
@endsection
@section('pageInfo')
@endsection
@section('backBtn')
<a href="{{ route("admin.purchaseissue_item.index") }}"><i class="fas fa-angle-left"></i> {{trans('admiko.page_back_btn')}}</a>
@endsection
@section('content')
<div class="card formPage purchaseissue_item_manage admikoForm">
    <legend class="action">{{ isset($data) ? trans('admiko.update') : trans('admiko.add_new') }}</legend>
    <form method="POST" action="{{ $admiko_data['formAction'] }}" enctype="multipart/form-data" class="needs-validation" novalidate>
        @if(isset($data)) @method('PUT') @endIf
        @csrf
        <div class="card-body">
            @if ($errors->any())<div class="row"><div class="col-2"></div><div class="col"><div class="invalid-feedback d-block">@foreach($errors->all() as $error) {{$error}}<br> @endforeach</div></div></div>@endif
            <div class="row">
                
                <div class=" col-12">
                    <div class="form-group row multiSelectSort">
                        <label for="items" class="col-md-2 col-form-label">Items:*</label>
                        <div class="col-md-10" style="position: relative">
                            <select name="items[]" data-placeholder="{{trans('admiko.select_from_list')}}" multiple="multiple" id="items" required="true" style="width: 100%" data-allow-clear="true">
                            @php $orderId=0; @endphp
                            @foreach($items_list_all as $id => $value)
                                @php $selected = ""; @endphp
                                @php $orderId++; @endphp
                                @if(in_array($id, old('items', [])))
                                    @php $selected = "selected"; @endphp
                                @elseIf(isset($data) && $data->items_many->contains($id))
                                    @php $selected = "selected"; @endphp
                                    @php $orderId = $data->items_many->firstWhere('id', $id)->pivot->admiko_order; @endphp
                                @endIf
                                <option value="{{ $id }}" {{$selected}} data-order="{{$orderId}}">{{ $value }}</option>
                            @endforeach
                            </select>
                            <div class="invalid-feedback @if ($errors->has('items')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="items_help" class="text-muted"></small>
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
                        <label for="quantity" class="col-md-2 col-form-label">Quantity:*</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="quantity" name="quantity" required="true" placeholder="Quantity"  value="{{{ old('quantity', isset($data)?$data->quantity : '') }}}">
                            <div class="invalid-feedback @if ($errors->has('quantity')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="quantity_help" class="text-muted">eg: 12, 2, 4 (for three items)</small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="amount" class="col-md-2 col-form-label">Amount:</label>
                        <div class="col-md-10">
                            <div class="input-group">
                            <div class="input-group-prepend input-group-text">₵</div>
                                <input type="text" class="form-control limitPozNegDecNumbers moneyWidth" id="amount" name="amount" 
                                       placeholder="Amount" step="0.01"  data-min="0" min="0" data-decimal="2"
                                       value="{{{ old('amount', isset($data)?$data->amount : '') }}}">
                                <div class="invalid-feedback @if ($errors->has('amount')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            </div>
                            <small id="amount_help" class="text-muted"> Min: 0</small>
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
                    <a href="{{ route("admin.purchaseissue_item.index") }}" class="btn btn-secondary float-end" role="button">{{trans('admiko.table_cancel')}}</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection