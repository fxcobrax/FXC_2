@extends("admin.layouts.default")
@section('breadcrumbs')
    <li class="breadcrumb-item active"><a href="{{ route("admin.staffs.index") }}">Staffs</a></li>
    @if(isset($data))
        <li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_edit')}}</li>
    @else
        <li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_add')}}</li>
    @endIf
@endsection
@section('pageTitle')
<h1>Staffs</h1>
@endsection
@section('pageInfo')
@endsection
@section('backBtn')
<a href="{{ route("admin.staffs.index") }}"><i class="fas fa-angle-left"></i> {{trans('admiko.page_back_btn')}}</a>
@endsection
@section('content')
<div class="card formPage staffs_manage admikoForm">
    <legend class="action">{{ isset($data) ? trans('admiko.update') : trans('admiko.add_new') }}</legend>
    <form method="POST" action="{{ $admiko_data['formAction'] }}" enctype="multipart/form-data" class="needs-validation" novalidate>
        @if(isset($data)) @method('PUT') @endIf
        @csrf
        <div class="card-body">
            @if ($errors->any())<div class="row"><div class="col-2"></div><div class="col"><div class="invalid-feedback d-block">@foreach($errors->all() as $error) {{$error}}<br> @endforeach</div></div></div>@endif
            <div class="row">
                
                <div class=" col-12">
                    <div class="form-group row admiko_separator">
                        <label class="col-12 col-form-label">Personal Info</label>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row multiSelect">
                        <label for="role" class="col-md-2 col-form-label">Role:*</label>
                        <div class="col-md-10" style="position: relative">
                            <select class="form-select" id="role" name="role" required="true" data-placeholder="{{trans('admiko.select')}}" style="width: 100%" data-width="100%" data-allow-clear="true">
                                
                                @foreach($elements_all as $id => $value)
                                    <option value="{{ $id }}" {{ (old('role') ? old('role') : $data->role ?? '') == $id ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback @if ($errors->has('role')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="role_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>

                <div class=" col-12">
                    <div class="form-group row">
                        <label for="full_name" class="col-md-2 col-form-label">Full Name:*</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="full_name" name="full_name" required="true" placeholder="Full Name"  value="{{{ old('full_name', isset($data)?$data->full_name : '') }}}">
                            <div class="invalid-feedback @if ($errors->has('full_name')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="full_name_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="gender" class="col-md-2 col-form-label">Gender:*</label>
                        <div class="col-md-10">
                            <select class="form-select" id="gender" name="gender" required="true">
                                
                                @foreach($elements_all as $id => $value)
                                    <option value="{{ $id }}" {{ (old('gender') ? old('gender') : $data->gender ?? '') == $id ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback @if ($errors->has('gender')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="gender_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>

                <div class=" col-12">
                    <div class="form-group row">
                        <label for="date_of_birth" class="col-md-2 col-form-label">Date Of Birth:*</label>
                        <div class="col-md-10">
                            <div class="input-group" id="dateTimePicker_date_of_birth" data-target-input="nearest">
                                <input type="text" autocomplete="off" style="max-width: 170px;border-right: unset;"
                                       data-date_time_format="{{config('admiko_config.form_date_time_format')}}"
                                       class="form-control datetimepicker-input dateTimePicker"
                                       data-target="#dateTimePicker_date_of_birth" required="true" id="date_of_birth" data-toggle="datetimepicker"
                                       placeholder="Date Of Birth" name="date_of_birth" value="{{{ old('date_of_birth', isset($data)?$data->date_of_birth : '') }}}">
                                <div class="input-group-append input-group-text" data-target="#dateTimePicker_date_of_birth" data-toggle="datetimepicker">
                                    <i class="fas fa-calendar-alt fa-fw"></i>
                                </div>
                            </div>
                            <div class="invalid-feedback @if ($errors->has('date_of_birth')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="date_of_birth_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="address" class="col-md-2 col-form-label">Address:</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="address" name="address"  placeholder="Address"  value="{{{ old('address', isset($data)?$data->address : '') }}}">
                            <div class="invalid-feedback @if ($errors->has('address')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="address_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="picture" class="col-md-2 col-form-label">Picture:</label>
                        <div class="col-md-10">
                            @if (isset($data->picture) && Storage::disk(config("admiko_config.filesystem"))->exists($admiko_data['fileInfo']["picture"]['original']["folder"].$data->picture))
                            <a href="{{ Storage::disk(config("admiko_config.filesystem"))->url($admiko_data['fileInfo']["picture"]['original']["folder"].$data->picture) }}" target="_blank" class="tableImage">
                                    <img src="{{ Storage::disk(config("admiko_config.filesystem"))->url($admiko_data['fileInfo']["picture"]['original']["folder"].$data->picture) }}">
                                </a><br>
                                <div class="form-check form-checkbox">
                                <input class="form-check-input" type="checkbox" name="picture_admiko_delete" id="picture_admiko_delete" value="1">
                                <label class="form-check-label" for="picture_admiko_delete"> {{trans('admiko.remove_file')}}</label>
                            </div>
                            @endif
                            <input type="file" class="imageUpload mt-1" id="picture" accept=".jpg,.png,.jpeg" data-type=".jpg,.png,.jpeg"  name="picture"  data-selected="{{trans('admiko.selected_image_preview')}}" >
                            <input type="hidden" id="picture_admiko_current" name="picture_admiko_current" value="{{$data->picture??''}}">
                            <div class="invalid-feedback @if ($errors->has('picture')) d-block @endif" data-required="{{trans('admiko.required_image')}}" data-size="{{trans('admiko.required_size')}}" data-type="{{trans('admiko.required_type')}}">
                                @if ($errors->has('picture')){{ $errors->first('picture') }}@endif
                            </div>
                            <small id="picture_help" class="text-muted">{{trans("admiko.file_extension_limit")}}.jpg,.png,.jpeg. {{trans("admiko.recommended")}}{{trans("admiko.width")}}1920px, {{trans("admiko.height")}}1080px. {{trans("admiko.image_action")}}{{trans("admiko.image_action_resize")}}.</small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="phone_number" class="col-md-2 col-form-label">Phone Number:</label>
                        <div class="col-md-10">
                            <input type="number" class="form-control limitPozNegNumbers numbersWidth" id="phone_number" name="phone_number"  placeholder="Phone Number"
                                   step="1" 
                                   value="{{{ old('phone_number', isset($data)?$data->phone_number : '') }}}">
                            <div class="invalid-feedback @if ($errors->has('phone_number')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="phone_number_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="email" class="col-md-2 col-form-label">Email:</label>
                        <div class="col-md-10">
                            <input type="email" class="form-control" id="email" name="email"  placeholder="Email"  value="{{{ old('email', $data->email??'') }}}">
                            <div class="invalid-feedback @if ($errors->has('email')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="email_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="document" class="col-md-2 col-form-label">Document:</label>
                        <div class="col-md-10">
                            @if (isset($data->document) && Storage::disk(config("admiko_config.filesystem"))->exists($admiko_data['fileInfo']["document"]['original']["folder"].$data->document))
                            <a href="{{ Storage::disk(config("admiko_config.filesystem"))->url($admiko_data['fileInfo']["document"]['original']["folder"].$data->document)}}" target="_blank">{{$data->document}}</a><br>
                                <div class="form-check form-checkbox">
                                <input class="form-check-input" type="checkbox" name="document_admiko_delete" id="document_admiko_delete" value="1">
                                <label class="form-check-label" for="document_admiko_delete"> {{trans('admiko.remove_file')}}</label>
                            </div>
                            @endif
                            <input type="file" class="fileUpload mt-1" id="document"  name="document" >
                            <input type="hidden" id="document_admiko_current" name="document_admiko_current" value="{{$data->document??''}}">
                            <div class="invalid-feedback @if ($errors->has('document')) d-block @endif" data-required="{{trans('admiko.required_text')}}" data-size="{{trans('admiko.required_size')}}" data-type="{{trans('admiko.required_type')}}">
                                @if ($errors->has('document')){{ $errors->first('document') }}@endif
                            </div>
                            <small id="document_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row admiko_separator">
                        <label class="col-12 col-form-label">Payroll Details</label>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row multiSelect">
                        <label for="contract_type" class="col-md-2 col-form-label">Contract Type:</label>
                        <div class="col-md-10" style="position: relative">
                            <select class="form-select" id="contract_type" name="contract_type"  data-placeholder="{{trans('admiko.select')}}" style="width: 100%" data-width="100%" data-allow-clear="true">
                                <option value="">{{trans("admiko.select")}}</option>
                                @foreach($elements_all as $id => $value)
                                    <option value="{{ $id }}" {{ (old('contract_type') ? old('contract_type') : $data->contract_type ?? '') == $id ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback @if ($errors->has('contract_type')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="contract_type_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>

                <div class=" col-12">
                    <div class="form-group row">
                        <label for="salary" class="col-md-2 col-form-label">Salary:</label>
                        <div class="col-md-10">
                            <div class="input-group">
                            <div class="input-group-prepend input-group-text">₵</div>
                                <input type="text" class="form-control limitPozNegDecNumbers moneyWidth" id="salary" name="salary" 
                                       placeholder="Salary" step="0.01"  data-min="1" min="1" data-decimal="2"
                                       value="{{{ old('salary', isset($data)?$data->salary : '') }}}">
                                <div class="invalid-feedback @if ($errors->has('salary')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            </div>
                            <small id="salary_help" class="text-muted"> Min: 1</small>
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
                    <a href="{{ route("admin.staffs.index") }}" class="btn btn-secondary float-end" role="button">{{trans('admiko.table_cancel')}}</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection