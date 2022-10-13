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
    <a href="#" class="nav-link dropdown-link"><i class="fas fa-user-graduate fa-fw"></i>Students</a>
    <ul class="nav flex-column dropdown-content" {!! $admiko_data['sideBarActiveFolder'] === "dropdown_students" ? ' style="display:block"' : '' !!}>
	@if(Gate::any(['students_list_allow', 'students_list_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "students_list" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.students_list.index')}}"><i class="fas fa-user-graduate fa-fw"></i>Students List</a></li>
	@endIf
    </ul>
</li>
@endIf
@if(Gate::any(['exercise_allow','exercise_edit','assignment_allow','assignment_edit','classtest_allow','classtest_edit','examination_allow','examination_edit','mark_exercise_allow','mark_exercise_edit','mark_assignment_allow','mark_assignment_edit','mark_classtest_allow','mark_classtest_edit','mark_exams_allow','mark_exams_edit']))
<li class="nav-item dropdown{{ $admiko_data['sideBarActiveFolder'] === "dropdown_class_activities" ? " open" : "" }}">
    <a href="#" class="nav-link dropdown-link"><i class="fas fa-person-booth fa-fw"></i>Class Activities</a>
    <ul class="nav flex-column dropdown-content" {!! $admiko_data['sideBarActiveFolder'] === "dropdown_class_activities" ? ' style="display:block"' : '' !!}>
	@if(Gate::any(['exercise_allow', 'exercise_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "exercise" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.exercise.index')}}"><i class="fas fa-file-alt fa-fw"></i>Exercise</a></li>
	@endIf
	@if(Gate::any(['assignment_allow', 'assignment_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "assignment" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.assignment.index')}}"><i class="fas fa-file-alt fa-fw"></i>Assignment</a></li>
	@endIf
	@if(Gate::any(['classtest_allow', 'classtest_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "classtest" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.classtest.index')}}"><i class="fas fa-file-alt fa-fw"></i>Classtest</a></li>
	@endIf
	@if(Gate::any(['examination_allow', 'examination_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "examination" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.examination.index')}}"><i class="fas fa-file-alt fa-fw"></i>Examination</a></li>
	@endIf
	@if(Gate::any(['mark_exercise_allow', 'mark_exercise_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "mark_exercise" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.mark_exercise.index')}}"><i class="fas fa-file-alt fa-fw"></i>Mark Exercise</a></li>
	@endIf
	@if(Gate::any(['mark_assignment_allow', 'mark_assignment_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "mark_assignment" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.mark_assignment.index')}}"><i class="fas fa-file-alt fa-fw"></i>Mark Assignment</a></li>
	@endIf
	@if(Gate::any(['mark_classtest_allow', 'mark_classtest_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "mark_classtest" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.mark_classtest.index')}}"><i class="fas fa-file-alt fa-fw"></i>Mark Classtest</a></li>
	@endIf
	@if(Gate::any(['mark_exams_allow', 'mark_exams_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "mark_exams" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.mark_exams.index')}}"><i class="fas fa-file-alt fa-fw"></i>Mark Exams</a></li>
	@endIf
    </ul>
</li>
@endIf
@if(Gate::any(['wallet_balance_allow','wallet_balance_edit','income_allow','income_edit','expense_allow','expense_edit','pay_salary_allow','pay_salary_edit']))
<li class="nav-item dropdown{{ $admiko_data['sideBarActiveFolder'] === "_account" ? " open" : "" }}">
    <a href="#" class="nav-link dropdown-link"><i class="fab fa-monero fa-fw"></i>Account</a>
    <ul class="nav flex-column dropdown-content" {!! $admiko_data['sideBarActiveFolder'] === "_account" ? ' style="display:block"' : '' !!}>

	@if(Gate::any(['income_allow', 'income_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "income" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.income.index')}}"><i class="fas fa-money-bill-wave fa-fw"></i>Income</a></li>
	@endIf
	@if(Gate::any(['expense_allow', 'expense_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "expense" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.expense.index')}}"><i class="fas fa-money-bill-wave-alt fa-fw"></i>Expense</a></li>
	@endIf
	@if(Gate::any(['pay_salary_allow', 'pay_salary_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "pay_salary" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.pay_salary.index')}}"><i class="fas fa-money-check-alt fa-fw"></i>Pay Salary</a></li>
	@endIf
    </ul>
</li>
@endIf
@if(Gate::any(['fee_type_allow','fee_type_edit','fee_payment_allow','fee_payment_edit']))
<li class="nav-item dropdown{{ $admiko_data['sideBarActiveFolder'] === "dropdown_fees" ? " open" : "" }}">
    <a href="#" class="nav-link dropdown-link"><i class="fas fa-archive fa-fw"></i>Fees</a>
    <ul class="nav flex-column dropdown-content" {!! $admiko_data['sideBarActiveFolder'] === "dropdown_fees" ? ' style="display:block"' : '' !!}>
	@if(Gate::any(['fee_type_allow', 'fee_type_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "fee_type" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.fee_type.index')}}"><i class="fas fa-barcode fa-fw"></i>Fee Type</a></li>
	@endIf
	@if(Gate::any(['fee_payment_allow', 'fee_payment_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "fee_payment" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.fee_payment.index')}}"><i class="fas fa-chart-area fa-fw"></i>Fee Payment</a></li>
	@endIf
    </ul>
</li>
@endIf
@if(Gate::any(['notice_board_allow','notice_board_edit','events_allow','events_edit']))
<li class="nav-item dropdown{{ $admiko_data['sideBarActiveFolder'] === "dropdown_communicate" ? " open" : "" }}">
    <a href="#" class="nav-link dropdown-link"><i class="fab fa-facebook-messenger fa-fw"></i>Communicate</a>
    <ul class="nav flex-column dropdown-content" {!! $admiko_data['sideBarActiveFolder'] === "dropdown_communicate" ? ' style="display:block"' : '' !!}>
	@if(Gate::any(['notice_board_allow', 'notice_board_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "notice_board" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.notice_board.index')}}"><i class="fas fa-chalkboard-teacher fa-fw"></i>Notice Board</a></li>
	@endIf
	@if(Gate::any(['events_allow', 'events_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "events" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.events.index')}}"><i class="fas fa-campground fa-fw"></i>Events</a></li>
	@endIf
    </ul>
</li>
@endIf
@if(Gate::any(['leave_type_allow','leave_type_edit','apply_for_leave_allow','apply_for_leave_edit','signexeat1_allow','signexeat1_edit']))
<li class="nav-item dropdown{{ $admiko_data['sideBarActiveFolder'] === "dropdown_leave" ? " open" : "" }}">
    <a href="#" class="nav-link dropdown-link"><i class="fas fa-file-export fa-fw"></i>Leave</a>
    <ul class="nav flex-column dropdown-content" {!! $admiko_data['sideBarActiveFolder'] === "dropdown_leave" ? ' style="display:block"' : '' !!}>
	@if(Gate::any(['leave_type_allow', 'leave_type_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "leave_type" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.leave_type.index')}}"><i class="fas fa-braille fa-fw"></i>Leave Type</a></li>
	@endIf
	@if(Gate::any(['apply_for_leave_allow', 'apply_for_leave_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "apply_for_leave" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.apply_for_leave.index')}}"><i class="fas fa-ethernet fa-fw"></i>Apply For Leave</a></li>
	@endIf
	@if(Gate::any(['signexeat1_allow', 'signexeat1_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "signexeat1" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.signexeat1.index')}}"><i class="fas fa-door-closed fa-fw"></i>Sign Exeat</a></li>
	@endIf
    </ul>
</li>
@endIf
@if(Gate::any(['book_category_allow','book_category_edit','book_type_allow','book_type_edit','book_list_allow','book_list_edit','issuereturn_book_allow','issuereturn_book_edit']))
<li class="nav-item dropdown{{ $admiko_data['sideBarActiveFolder'] === "dropdown_library" ? " open" : "" }}">
    <a href="#" class="nav-link dropdown-link"><i class="fas fa-book fa-fw"></i>Library</a>
    <ul class="nav flex-column dropdown-content" {!! $admiko_data['sideBarActiveFolder'] === "dropdown_library" ? ' style="display:block"' : '' !!}>
	@if(Gate::any(['book_category_allow', 'book_category_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "book_category" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.book_category.index')}}"><i class="fas fa-book-medical fa-fw"></i>Book Category</a></li>
	@endIf
	@if(Gate::any(['book_type_allow', 'book_type_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "book_type" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.book_type.index')}}"><i class="fas fa-book-medical fa-fw"></i>Book Type</a></li>
	@endIf
	@if(Gate::any(['book_list_allow', 'book_list_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "book_list" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.book_list.index')}}"><i class="fas fa-book-medical fa-fw"></i>Book List</a></li>
	@endIf
	@if(Gate::any(['issuereturn_book_allow', 'issuereturn_book_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "issuereturn_book" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.issuereturn_book.index')}}"><i class="fas fa-book-reader fa-fw"></i>Issue/Return Book</a></li>
	@endIf
    </ul>
</li>
@endIf
@if(Gate::any(['item_category_allow','item_category_edit','item_type_allow','item_type_edit','items_list_allow','items_list_edit','purchaseissue_item_allow','purchaseissue_item_edit','suppliers_allow','suppliers_edit']))
<li class="nav-item dropdown{{ $admiko_data['sideBarActiveFolder'] === "dropdown_inventory" ? " open" : "" }}">
    <a href="#" class="nav-link dropdown-link"><i class="fas fa-align-justify fa-fw"></i>Inventory</a>
    <ul class="nav flex-column dropdown-content" {!! $admiko_data['sideBarActiveFolder'] === "dropdown_inventory" ? ' style="display:block"' : '' !!}>
	@if(Gate::any(['item_category_allow', 'item_category_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "item_category" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.item_category.index')}}"><i class="fas fa-cart-plus fa-fw"></i>Item Category</a></li>
	@endIf
	@if(Gate::any(['item_type_allow', 'item_type_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "item_type" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.item_type.index')}}"><i class="fab fa-opencart fa-fw"></i>Item Type</a></li>
	@endIf
	@if(Gate::any(['items_list_allow', 'items_list_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "items_list" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.items_list.index')}}"><i class="fas fa-shopping-cart fa-fw"></i>Items List</a></li>
	@endIf
	@if(Gate::any(['purchaseissue_item_allow', 'purchaseissue_item_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "purchaseissue_item" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.purchaseissue_item.index')}}"><i class="fas fa-luggage-cart fa-fw"></i>Purchase/Issue Item</a></li>
	@endIf
	@if(Gate::any(['suppliers_allow', 'suppliers_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "suppliers" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.suppliers.index')}}"><i class="fas fa-boxes fa-fw"></i>Suppliers</a></li>
	@endIf
    </ul>
</li>
@endIf
@if(Gate::any(['routes_allow','routes_edit','vehicles_allow','vehicles_edit','assign_vehicle_allow','assign_vehicle_edit']))
<li class="nav-item dropdown{{ $admiko_data['sideBarActiveFolder'] === "dropdown_transport" ? " open" : "" }}">
    <a href="#" class="nav-link dropdown-link"><i class="fas fa-car-alt fa-fw"></i>Transport</a>
    <ul class="nav flex-column dropdown-content" {!! $admiko_data['sideBarActiveFolder'] === "dropdown_transport" ? ' style="display:block"' : '' !!}>
	@if(Gate::any(['routes_allow', 'routes_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "routes" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.routes.index')}}"><i class="fas fa-road fa-fw"></i>Routes</a></li>
	@endIf
	@if(Gate::any(['vehicles_allow', 'vehicles_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "vehicles" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.vehicles.index')}}"><i class="fas fa-car-side fa-fw"></i>Vehicles</a></li>
	@endIf
	@if(Gate::any(['assign_vehicle_allow', 'assign_vehicle_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "assign_vehicle" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.assign_vehicle.index')}}"><i class="fas fa-car fa-fw"></i>Assign Vehicle</a></li>
	@endIf
    </ul>
</li>
@endIf
@if(Gate::any(['dorm_type_allow','dorm_type_edit','dorms_allow','dorms_edit']))
<li class="nav-item dropdown{{ $admiko_data['sideBarActiveFolder'] === "dropdown_dormitory" ? " open" : "" }}">
    <a href="#" class="nav-link dropdown-link"><i class="fas fa-warehouse fa-fw"></i>Dormitory</a>
    <ul class="nav flex-column dropdown-content" {!! $admiko_data['sideBarActiveFolder'] === "dropdown_dormitory" ? ' style="display:block"' : '' !!}>
	@if(Gate::any(['dorm_type_allow', 'dorm_type_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "dorm_type" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.dorm_type.index')}}"><i class="fas fa-home fa-fw"></i>Dorm Type</a></li>
	@endIf
	@if(Gate::any(['dorms_allow', 'dorms_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "dorms" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.dorms.index')}}"><i class="fab fa-houzz fa-fw"></i>Dorms</a></li>
	@endIf
    </ul>
</li>
@endIf
@if(Gate::any(['department_allow','department_edit','clubs_allow','clubs_edit']))
<li class="nav-item dropdown{{ $admiko_data['sideBarActiveFolder'] === "dropdown_facilities" ? " open" : "" }}">
    <a href="#" class="nav-link dropdown-link"><i class="fab fa-buromobelexperte fa-fw"></i>Facilities</a>
    <ul class="nav flex-column dropdown-content" {!! $admiko_data['sideBarActiveFolder'] === "dropdown_facilities" ? ' style="display:block"' : '' !!}>
	@if(Gate::any(['department_allow', 'department_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "department" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.department.index')}}"><i class="fas fa-city fa-fw"></i>Department</a></li>
	@endIf
	@if(Gate::any(['clubs_allow', 'clubs_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "clubs" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.clubs.index')}}"><i class="fab fa-cc-diners-club fa-fw"></i>Clubs</a></li>
	@endIf
    </ul>
</li>
@endIf
@if(Gate::any(['staffs_allow', 'staffs_edit']))
<li class="nav-item{{ $admiko_data['sideBarActive'] === "staffs" ? " active" : "" }}"><a class="nav-link" href="{{route('admin.staffs.index')}}"><i class="fas fa-user-friends fa-fw"></i>Staffs</a></li>
@endIf
@if(Gate::any(['elements_allow', 'elements_edit']))
<li class="nav-item{{ $admiko_data['sideBarActive'] === "elements" ? " active" : "" }}"><a class="nav-link" href="{{route('admin.elements.index')}}"><i class="fas fa-toolbox fa-fw"></i>Elements</a></li>
@endIf