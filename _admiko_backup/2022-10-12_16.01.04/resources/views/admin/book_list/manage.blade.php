@extends("admin.layouts.default")
@section('breadcrumbs')
    <li class="breadcrumb-item active"><a href="{{ route("admin.book_list.index") }}">Book List</a></li>
    @if(isset($data))
        <li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_edit')}}</li>
    @else
        <li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_add')}}</li>
    @endIf
@endsection
@section('pageTitle')
<h1>Book List</h1>
@endsection
@section('pageInfo')
@endsection
@section('backBtn')
<a href="{{ route("admin.book_list.index") }}"><i class="fas fa-angle-left"></i> {{trans('admiko.page_back_btn')}}</a>
@endsection
@section('content')
<div class="card formPage book_list_manage admikoForm">
    <legend class="action">{{ isset($data) ? trans('admiko.update') : trans('admiko.add_new') }}</legend>
    <form method="POST" action="{{ $admiko_data['formAction'] }}" enctype="multipart/form-data" class="needs-validation" novalidate>
        @if(isset($data)) @method('PUT') @endIf
        @csrf
        <div class="card-body">
            @if ($errors->any())<div class="row"><div class="col-2"></div><div class="col"><div class="invalid-feedback d-block">@foreach($errors->all() as $error) {{$error}}<br> @endforeach</div></div></div>@endif
            <div class="row">
                
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="book_name" class="col-md-2 col-form-label">Book Name:*</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="book_name" name="book_name" required="true" placeholder="Book Name"  value="{{{ old('book_name', isset($data)?$data->book_name : '') }}}">
                            <div class="invalid-feedback @if ($errors->has('book_name')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="book_name_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row multiSelect">
                        <label for="type" class="col-md-2 col-form-label">Type:*</label>
                        <div class="col-md-10" style="position: relative">
                            <select class="form-select" id="type" name="type" required="true" data-placeholder="{{trans('admiko.select')}}" style="width: 100%" data-width="100%" data-allow-clear="true">
                                
                                @foreach($book_type_all as $id => $value)
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
                        <label for="author" class="col-md-2 col-form-label">Author:</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="author" name="author"  placeholder="Author"  value="{{{ old('author', isset($data)?$data->author : '') }}}">
                            <div class="invalid-feedback @if ($errors->has('author')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="author_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="rank_id" class="col-md-2 col-form-label">Rank ID:</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="rank_id" name="rank_id"  placeholder="Rank ID"  value="{{{ old('rank_id', isset($data)?$data->rank_id : '') }}}">
                            <div class="invalid-feedback @if ($errors->has('rank_id')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="rank_id_help" class="text-muted"></small>
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
                    <a href="{{ route("admin.book_list.index") }}" class="btn btn-secondary float-end" role="button">{{trans('admiko.table_cancel')}}</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection