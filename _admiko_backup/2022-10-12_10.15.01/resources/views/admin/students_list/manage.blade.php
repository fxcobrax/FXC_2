@extends("admin.layouts.default")
@section('breadcrumbs')
    <li class="breadcrumb-item active"><a href="{{ route("admin.students_list.index") }}">Students List</a></li>
    @if(isset($data))
        <li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_edit')}}</li>
    @else
        <li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_add')}}</li>
    @endIf
@endsection
@section('pageTitle')
<h1>Students List</h1>
@endsection
@section('pageInfo')
@endsection
@section('backBtn')
<a href="{{ route("admin.students_list.index") }}"><i class="fas fa-angle-left"></i> {{trans('admiko.page_back_btn')}}</a>
@endsection
@section('content')
<div class="card formPage students_list_manage admikoForm">
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
                    <div class="form-group row">
                        <label for="first_name" class="col-md-2 col-form-label">First Name:*</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="first_name" name="first_name" required="true" placeholder="First Name"  value="{{{ old('first_name', isset($data)?$data->first_name : '') }}}">
                            <div class="invalid-feedback @if ($errors->has('first_name')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="first_name_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="last_name" class="col-md-2 col-form-label">Last Name:*</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="last_name" name="last_name" required="true" placeholder="Last Name"  value="{{{ old('last_name', isset($data)?$data->last_name : '') }}}">
                            <div class="invalid-feedback @if ($errors->has('last_name')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="last_name_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="gender" class="col-md-2 col-form-label">Gender:</label>
                        <div class="col-md-10">
                            <select class="form-select" id="gender" name="gender" >
                                <option value="">{{trans("admiko.select")}}</option>
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
                        <label for="national_id" class="col-md-2 col-form-label">National ID:*</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="national_id" name="national_id" required="true" placeholder="National ID"  value="{{{ old('national_id', isset($data)?$data->national_id : '') }}}">
                            <div class="invalid-feedback @if ($errors->has('national_id')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="national_id_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="email" class="col-md-2 col-form-label">Email:*</label>
                        <div class="col-md-10">
                            <input type="email" class="form-control" id="email" name="email" required="true" placeholder="Email"  value="{{{ old('email', $data->email??'') }}}">
                            <div class="invalid-feedback @if ($errors->has('email')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="email_help" class="text-muted"></small>
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
                        <label for="student_picture" class="col-md-2 col-form-label">Student Picture:</label>
                        <div class="col-md-10">
                            @if (isset($data->student_picture) && Storage::disk(config("admiko_config.filesystem"))->exists($admiko_data['fileInfo']["student_picture"]['original']["folder"].$data->student_picture))
                            <a href="{{ Storage::disk(config("admiko_config.filesystem"))->url($admiko_data['fileInfo']["student_picture"]['original']["folder"].$data->student_picture) }}" target="_blank" class="tableImage">
                                    <img src="{{ Storage::disk(config("admiko_config.filesystem"))->url($admiko_data['fileInfo']["student_picture"]['original']["folder"].$data->student_picture) }}">
                                </a><br>
                                <div class="form-check form-checkbox">
                                <input class="form-check-input" type="checkbox" name="student_picture_admiko_delete" id="student_picture_admiko_delete" value="1">
                                <label class="form-check-label" for="student_picture_admiko_delete"> {{trans('admiko.remove_file')}}</label>
                            </div>
                            @endif
                            <input type="file" class="imageUpload mt-1" id="student_picture" accept=".jpg,.png,.jpeg" data-type=".jpg,.png,.jpeg" data-size="10" name="student_picture"  data-selected="{{trans('admiko.selected_image_preview')}}" >
                            <input type="hidden" id="student_picture_admiko_current" name="student_picture_admiko_current" value="{{$data->student_picture??''}}">
                            <div class="invalid-feedback @if ($errors->has('student_picture')) d-block @endif" data-required="{{trans('admiko.required_image')}}" data-size="{{trans('admiko.required_size')}}" data-type="{{trans('admiko.required_type')}}">
                                @if ($errors->has('student_picture')){{ $errors->first('student_picture') }}@endif
                            </div>
                            <small id="student_picture_help" class="text-muted">{{trans("admiko.file_size_limit")}}10 MB. {{trans("admiko.file_extension_limit")}}.jpg,.png,.jpeg. {{trans("admiko.recommended")}}{{trans("admiko.width")}}1920px, {{trans("admiko.height")}}1080px. {{trans("admiko.image_action")}}{{trans("admiko.image_action_resize")}}.</small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row admiko_separator">
                        <label class="col-12 col-form-label">Address Info</label>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="residential_address" class="col-md-2 col-form-label">Residential Address:*</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="residential_address" name="residential_address" required="true" placeholder="Residential Address"  value="{{{ old('residential_address', isset($data)?$data->residential_address : '') }}}">
                            <div class="invalid-feedback @if ($errors->has('residential_address')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="residential_address_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="digital_address" class="col-md-2 col-form-label">Digital Address:</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="digital_address" name="digital_address"  placeholder="Digital Address"  value="{{{ old('digital_address', isset($data)?$data->digital_address : '') }}}">
                            <div class="invalid-feedback @if ($errors->has('digital_address')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="digital_address_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="popular_landmark" class="col-md-2 col-form-label">Popular Landmark:</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="popular_landmark" name="popular_landmark"  placeholder="Popular Landmark"  value="{{{ old('popular_landmark', isset($data)?$data->popular_landmark : '') }}}">
                            <div class="invalid-feedback @if ($errors->has('popular_landmark')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="popular_landmark_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row admiko_separator">
                        <label class="col-12 col-form-label">Parent/Guardian Info</label>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="fullname" class="col-md-2 col-form-label">Full Name:*</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="fullname" name="fullname" required="true" placeholder="Full Name"  value="{{{ old('fullname', isset($data)?$data->fullname : '') }}}">
                            <div class="invalid-feedback @if ($errors->has('fullname')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="fullname_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="occupation" class="col-md-2 col-form-label">Occupation:</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="occupation" name="occupation"  placeholder="Occupation"  value="{{{ old('occupation', isset($data)?$data->occupation : '') }}}">
                            <div class="invalid-feedback @if ($errors->has('occupation')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="occupation_help" class="text-muted"></small>
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
                        <label for="phone_number1" class="col-md-2 col-form-label">Phone Number:*</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="phone_number1" name="phone_number1" required="true" placeholder="Phone Number"  value="{{{ old('phone_number1', isset($data)?$data->phone_number1 : '') }}}">
                            <div class="invalid-feedback @if ($errors->has('phone_number1')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="phone_number1_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row admiko_separator">
                        <label class="col-12 col-form-label">Academics</label>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row multiSelect">
                        <label for="select_class" class="col-md-2 col-form-label">Select Class:*</label>
                        <div class="col-md-10" style="position: relative">
                            <select class="form-select" id="select_class" name="select_class" required="true" data-placeholder="{{trans('admiko.select')}}" style="width: 100%" data-width="100%" data-allow-clear="true">
                                
                                @foreach($classes_all as $id => $value)
                                    <option value="{{ $id }}" {{ (old('select_class') ? old('select_class') : $data->select_class ?? '') == $id ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback @if ($errors->has('select_class')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="select_class_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>

                <div class=" col-12">
                    <div class="form-group row">
                        <label for="select_department" class="col-md-2 col-form-label">Select Department:</label>
                        <div class="col-md-10">
                            <select class="form-select" id="select_department" name="select_department" >
                                <option value="">{{trans("admiko.select")}}</option>
                                @foreach($department_all as $id => $value)
                                    <option value="{{ $id }}" {{ (old('select_department') ? old('select_department') : $data->select_department ?? '') == $id ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback @if ($errors->has('select_department')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="select_department_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>

                <div class=" col-12">
                    <div class="form-group row">
                        <label for="select_club" class="col-md-2 col-form-label">Select Club:</label>
                        <div class="col-md-10">
                            <select class="form-select" id="select_club" name="select_club" >
                                <option value="">{{trans("admiko.select")}}</option>
                                @foreach($clubs_all as $id => $value)
                                    <option value="{{ $id }}" {{ (old('select_club') ? old('select_club') : $data->select_club ?? '') == $id ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback @if ($errors->has('select_club')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="select_club_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>

                <div class=" col-12">
                    <div class="form-group row admiko_separator">
                        <label class="col-12 col-form-label">Dormitory Info</label>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="dormitory_name" class="col-md-2 col-form-label">Dormitory Name:</label>
                        <div class="col-md-10">
                            <select class="form-select" id="dormitory_name" name="dormitory_name" >
                                <option value="">{{trans("admiko.select")}}</option>
                                @foreach($dorms_all as $id => $value)
                                    <option value="{{ $id }}" {{ (old('dormitory_name') ? old('dormitory_name') : $data->dormitory_name ?? '') == $id ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback @if ($errors->has('dormitory_name')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="dormitory_name_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>

                <div class=" col-12">
                    <div class="form-group row admiko_separator">
                        <label class="col-12 col-form-label">Transportation Info</label>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="select_route" class="col-md-2 col-form-label">Select Route:</label>
                        <div class="col-md-10">
                            <select class="form-select" id="select_route" name="select_route" >
                                <option value="">{{trans("admiko.select")}}</option>
                                @foreach($routes_all as $id => $value)
                                    <option value="{{ $id }}" {{ (old('select_route') ? old('select_route') : $data->select_route ?? '') == $id ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback @if ($errors->has('select_route')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="select_route_help" class="text-muted"></small>
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
                    <a href="{{ route("admin.students_list.index") }}" class="btn btn-secondary float-end" role="button">{{trans('admiko.table_cancel')}}</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection