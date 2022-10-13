{{--IMPORTANT: this page will be overwritten and any change will be lost!! Use custom_sidebar_bottom.blade.php and custom_sidebar_top.blade.php--}}

@if(Gate::any(['academic_year_allow','academic_year_edit','classes_allow','classes_edit','subjects_allow','subjects_edit','classroom_allow','classroom_edit']))
<li class="nav-item dropdown{{ $admiko_data['sideBarActiveFolder'] === "dropdown_academics" ? " open" : "" }}">
    <a href="#" class="nav-link dropdown-link"><i class="fas fa-archway fa-fw"></i>Academics</a>
    <ul class="nav flex-column dropdown-content" {!! $admiko_data['sideBarActiveFolder'] === "dropdown_academics" ? ' style="display:block"' : '' !!}>
	@if(Gate::any(['academic_year_allow', 'academic_year_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "academic_year" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.academic_year.index')}}"><i class="fas fa-layer-group fa-fw"></i>Academic Year</a></li>
	@endIf
	@if(Gate::any(['classes_allow', 'classes_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "classes" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.classes.index')}}"><i class="fas fa-city fa-fw"></i>Classes</a></li>
	@endIf
	@if(Gate::any(['subjects_allow', 'subjects_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "subjects" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.subjects.index')}}"><i class="fas fa-book fa-fw"></i>Subjects</a></li>
	@endIf
	@if(Gate::any(['classroom_allow', 'classroom_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "classroom" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.classroom.index')}}"><i class="fab fa-simplybuilt fa-fw"></i>Classroom</a></li>
	@endIf
    </ul>
</li>
@endIf
@if(Gate::any(['students_list_allow','students_list_edit']))
<li class="nav-item dropdown{{ $admiko_data['sideBarActiveFolder'] === "dropdown_students" ? " open" : "" }}">
    <a href="#" class="nav-link dropdown-link"><i class="fas fa-folder-open fa-fw"></i>Students</a>
    <ul class="nav flex-column dropdown-content" {!! $admiko_data['sideBarActiveFolder'] === "dropdown_students" ? ' style="display:block"' : '' !!}>
	@if(Gate::any(['students_list_allow', 'students_list_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "students_list" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.students_list.index')}}"><i class="fas fa-user-graduate fa-fw"></i>Students List</a></li>
	@endIf
    </ul>
</li>
@endIf
@if(Gate::any(['exercise_allow','exercise_edit','assignment_allow','assignment_edit','classtest_allow','classtest_edit','examination_allow','examination_edit','mark_exercise_allow','mark_exercise_edit','mark_assignment_allow','mark_assignment_edit','mark_classtest_allow','mark_classtest_edit','mark_exams_allow','mark_exams_edit']))
<li class="nav-item dropdown{{ $admiko_data['sideBarActiveFolder'] === "dropdown_class_activities" ? " open" : "" }}">
    <a href="#" class="nav-link dropdown-link"><i class="fas fa-folder-open fa-fw"></i>Class Activities</a>
    <ul class="nav flex-column dropdown-content" {!! $admiko_data['sideBarActiveFolder'] === "dropdown_class_activities" ? ' style="display:block"' : '' !!}>
	@if(Gate::any(['exercise_allow', 'exercise_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "exercise" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.exercise.index')}}"><i class="fas fa-file-alt fa-fw"></i>Exercise</a></li>
	@endIf
	@if(Gate::any(['assignment_allow', 'assignment_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "assignment" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.assignment.index')}}"><i class="fas fa-file-alt fa-fw"></i>Assignment</a></li>
	@endIf






    </ul>
</li>
@endIf
@if(Gate::any(['income_allow','income_edit','expense_allow','expense_edit','pay_salary_allow','pay_salary_edit']))
<li class="nav-item dropdown{{ $admiko_data['sideBarActiveFolder'] === "_account" ? " open" : "" }}">
    <a href="#" class="nav-link dropdown-link"><i class="fas fa-folder-open fa-fw"></i>Account</a>
    <ul class="nav flex-column dropdown-content" {!! $admiko_data['sideBarActiveFolder'] === "_account" ? ' style="display:block"' : '' !!}>



    </ul>
</li>
@endIf
@if(Gate::any(['fee_type_allow','fee_type_edit','fee_payment_allow','fee_payment_edit']))
<li class="nav-item dropdown{{ $admiko_data['sideBarActiveFolder'] === "dropdown_fees" ? " open" : "" }}">
    <a href="#" class="nav-link dropdown-link"><i class="fas fa-folder-open fa-fw"></i>Fees</a>
    <ul class="nav flex-column dropdown-content" {!! $admiko_data['sideBarActiveFolder'] === "dropdown_fees" ? ' style="display:block"' : '' !!}>


    </ul>
</li>
@endIf
@if(Gate::any(['notice_board_allow','notice_board_edit','events_allow','events_edit']))
<li class="nav-item dropdown{{ $admiko_data['sideBarActiveFolder'] === "dropdown_communicate" ? " open" : "" }}">
    <a href="#" class="nav-link dropdown-link"><i class="fas fa-folder-open fa-fw"></i>Communicate</a>
    <ul class="nav flex-column dropdown-content" {!! $admiko_data['sideBarActiveFolder'] === "dropdown_communicate" ? ' style="display:block"' : '' !!}>


    </ul>
</li>
@endIf
@if(Gate::any(['leave_type_allow','leave_type_edit','apply_for_leave_allow','apply_for_leave_edit','exeat_type_allow','exeat_type_edit','sign_exeat_allow','sign_exeat_edit']))
<li class="nav-item dropdown{{ $admiko_data['sideBarActiveFolder'] === "dropdown_leave" ? " open" : "" }}">
    <a href="#" class="nav-link dropdown-link"><i class="fas fa-folder-open fa-fw"></i>Leave</a>
    <ul class="nav flex-column dropdown-content" {!! $admiko_data['sideBarActiveFolder'] === "dropdown_leave" ? ' style="display:block"' : '' !!}>




    </ul>
</li>
@endIf
@if(Gate::any(['book_category_allow','book_category_edit','book_type_allow','book_type_edit','book_list_allow','book_list_edit','issuereturn_book_allow','issuereturn_book_edit']))
<li class="nav-item dropdown{{ $admiko_data['sideBarActiveFolder'] === "dropdown_library" ? " open" : "" }}">
    <a href="#" class="nav-link dropdown-link"><i class="fas fa-folder-open fa-fw"></i>Library</a>
    <ul class="nav flex-column dropdown-content" {!! $admiko_data['sideBarActiveFolder'] === "dropdown_library" ? ' style="display:block"' : '' !!}>




    </ul>
</li>
@endIf
@if(Gate::any(['item_category_allow','item_category_edit','item_type_allow','item_type_edit','items_list_allow','items_list_edit','purchaseissue_item_allow','purchaseissue_item_edit','suppliers_allow','suppliers_edit']))
<li class="nav-item dropdown{{ $admiko_data['sideBarActiveFolder'] === "dropdown_inventory" ? " open" : "" }}">
    <a href="#" class="nav-link dropdown-link"><i class="fas fa-folder-open fa-fw"></i>Inventory</a>
    <ul class="nav flex-column dropdown-content" {!! $admiko_data['sideBarActiveFolder'] === "dropdown_inventory" ? ' style="display:block"' : '' !!}>





    </ul>
</li>
@endIf
@if(Gate::any(['routes_allow','routes_edit']))
<li class="nav-item dropdown{{ $admiko_data['sideBarActiveFolder'] === "dropdown_transport" ? " open" : "" }}">
    <a href="#" class="nav-link dropdown-link"><i class="fas fa-folder-open fa-fw"></i>Transport</a>
    <ul class="nav flex-column dropdown-content" {!! $admiko_data['sideBarActiveFolder'] === "dropdown_transport" ? ' style="display:block"' : '' !!}>
	@if(Gate::any(['routes_allow', 'routes_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "routes" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.routes.index')}}"><i class="fas fa-file-alt fa-fw"></i>Routes</a></li>
	@endIf
    </ul>
</li>
@endIf


@if(Gate::any(['dorm_type_allow','dorm_type_edit','dorms_allow','dorms_edit','dorm_rooms_allow','dorm_rooms_edit','assign_dormitory_allow','assign_dormitory_edit']))
<li class="nav-item dropdown{{ $admiko_data['sideBarActiveFolder'] === "dropdown_dormitory" ? " open" : "" }}">
    <a href="#" class="nav-link dropdown-link"><i class="fas fa-folder-open fa-fw"></i>Dormitory</a>
    <ul class="nav flex-column dropdown-content" {!! $admiko_data['sideBarActiveFolder'] === "dropdown_dormitory" ? ' style="display:block"' : '' !!}>
	@if(Gate::any(['dorm_type_allow', 'dorm_type_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "dorm_type" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.dorm_type.index')}}"><i class="fas fa-file-alt fa-fw"></i>Dorm Type</a></li>
	@endIf
	@if(Gate::any(['dorms_allow', 'dorms_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "dorms" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.dorms.index')}}"><i class="fas fa-file-alt fa-fw"></i>Dorms</a></li>
	@endIf


    </ul>
</li>
@endIf
@if(Gate::any(['department_allow','department_edit','clubs_allow','clubs_edit']))
<li class="nav-item dropdown{{ $admiko_data['sideBarActiveFolder'] === "dropdown_facilities" ? " open" : "" }}">
    <a href="#" class="nav-link dropdown-link"><i class="fas fa-folder-open fa-fw"></i>Facilities</a>
    <ul class="nav flex-column dropdown-content" {!! $admiko_data['sideBarActiveFolder'] === "dropdown_facilities" ? ' style="display:block"' : '' !!}>
	@if(Gate::any(['department_allow', 'department_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "department" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.department.index')}}"><i class="fas fa-file-alt fa-fw"></i>Department</a></li>
	@endIf
	@if(Gate::any(['clubs_allow', 'clubs_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "clubs" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.clubs.index')}}"><i class="fas fa-file-alt fa-fw"></i>Clubs</a></li>
	@endIf
    </ul>
</li>
@endIf

@if(Gate::any(['elements_allow', 'elements_edit']))
<li class="nav-item{{ $admiko_data['sideBarActive'] === "elements" ? " active" : "" }}"><a class="nav-link" href="{{route('admin.elements.index')}}"><i class="fas fa-file-alt fa-fw"></i>Elements</a></li>
@endIf