<?php
/** Admiko routes. This file will be overwritten on page import. Don't add your code here! **/

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;

/**AcademicYear**/
Route::delete("academic_year/destroy", [AcademicYearController::class,"destroy"])->name("academic_year.delete");
Route::resource("academic_year", AcademicYearController::class)->parameters(["academic_year" => "academic_year"]);
/**Classes**/
Route::delete("classes/destroy", [ClassesController::class,"destroy"])->name("classes.delete");
Route::resource("classes", ClassesController::class)->parameters(["classes" => "classes"]);
/**Subjects**/
Route::delete("subjects/destroy", [SubjectsController::class,"destroy"])->name("subjects.delete");
Route::resource("subjects", SubjectsController::class)->parameters(["subjects" => "subjects"]);
/**Classroom**/
Route::delete("classroom/destroy", [ClassroomController::class,"destroy"])->name("classroom.delete");
Route::resource("classroom", ClassroomController::class)->parameters(["classroom" => "classroom"]);
/**StudentsList**/
Route::delete("students_list/destroy", [StudentsListController::class,"destroy"])->name("students_list.delete");
Route::resource("students_list", StudentsListController::class)->parameters(["students_list" => "students_list"]);
/**Exercise**/
Route::delete("exercise/destroy", [ExerciseController::class,"destroy"])->name("exercise.delete");
Route::resource("exercise", ExerciseController::class)->parameters(["exercise" => "exercise"]);
/**Assignment**/
Route::delete("assignment/destroy", [AssignmentController::class,"destroy"])->name("assignment.delete");
Route::resource("assignment", AssignmentController::class)->parameters(["assignment" => "assignment"]);
/**Classtest**/
Route::delete("classtest/destroy", [ClasstestController::class,"destroy"])->name("classtest.delete");
Route::resource("classtest", ClasstestController::class)->parameters(["classtest" => "classtest"]);
/**Examination**/
Route::delete("examination/destroy", [ExaminationController::class,"destroy"])->name("examination.delete");
Route::resource("examination", ExaminationController::class)->parameters(["examination" => "examination"]);
/**MarkExercise**/
Route::delete("mark_exercise/destroy", [MarkExerciseController::class,"destroy"])->name("mark_exercise.delete");
Route::resource("mark_exercise", MarkExerciseController::class)->parameters(["mark_exercise" => "mark_exercise"]);
/**MarkAssignment**/
Route::delete("mark_assignment/destroy", [MarkAssignmentController::class,"destroy"])->name("mark_assignment.delete");
Route::resource("mark_assignment", MarkAssignmentController::class)->parameters(["mark_assignment" => "mark_assignment"]);
/**MarkClasstest**/
Route::delete("mark_classtest/destroy", [MarkClasstestController::class,"destroy"])->name("mark_classtest.delete");
Route::resource("mark_classtest", MarkClasstestController::class)->parameters(["mark_classtest" => "mark_classtest"]);
/**MarkExams**/
Route::delete("mark_exams/destroy", [MarkExamsController::class,"destroy"])->name("mark_exams.delete");
Route::resource("mark_exams", MarkExamsController::class)->parameters(["mark_exams" => "mark_exams"]);
/**WalletBalance**/
Route::delete("wallet_balance/destroy", [WalletBalanceController::class,"destroy"])->name("wallet_balance.delete");
Route::resource("wallet_balance", WalletBalanceController::class)->parameters(["wallet_balance" => "wallet_balance"]);
/**Income**/
Route::delete("income/destroy", [IncomeController::class,"destroy"])->name("income.delete");
Route::resource("income", IncomeController::class)->parameters(["income" => "income"]);
/**Expense**/
Route::delete("expense/destroy", [ExpenseController::class,"destroy"])->name("expense.delete");
Route::resource("expense", ExpenseController::class)->parameters(["expense" => "expense"]);
/**PaySalary**/
Route::delete("pay_salary/destroy", [PaySalaryController::class,"destroy"])->name("pay_salary.delete");
Route::resource("pay_salary", PaySalaryController::class)->parameters(["pay_salary" => "pay_salary"]);
/**FeeType**/
Route::delete("fee_type/destroy", [FeeTypeController::class,"destroy"])->name("fee_type.delete");
Route::resource("fee_type", FeeTypeController::class)->parameters(["fee_type" => "fee_type"]);
/**FeePayment**/
Route::delete("fee_payment/destroy", [FeePaymentController::class,"destroy"])->name("fee_payment.delete");
Route::resource("fee_payment", FeePaymentController::class)->parameters(["fee_payment" => "fee_payment"]);
/**NoticeBoard**/
Route::delete("notice_board/destroy", [NoticeBoardController::class,"destroy"])->name("notice_board.delete");
Route::resource("notice_board", NoticeBoardController::class)->parameters(["notice_board" => "notice_board"]);
/**Events**/
Route::delete("events/destroy", [EventsController::class,"destroy"])->name("events.delete");
Route::resource("events", EventsController::class)->parameters(["events" => "events"]);
/**LeaveType**/
Route::delete("leave_type/destroy", [LeaveTypeController::class,"destroy"])->name("leave_type.delete");
Route::resource("leave_type", LeaveTypeController::class)->parameters(["leave_type" => "leave_type"]);
/**ApplyForLeave**/
Route::delete("apply_for_leave/destroy", [ApplyForLeaveController::class,"destroy"])->name("apply_for_leave.delete");
Route::resource("apply_for_leave", ApplyForLeaveController::class)->parameters(["apply_for_leave" => "apply_for_leave"]);
/**Signexeat1**/
Route::delete("signexeat1/destroy", [Signexeat1Controller::class,"destroy"])->name("signexeat1.delete");
Route::resource("signexeat1", Signexeat1Controller::class)->parameters(["signexeat1" => "signexeat1"]);
/**BookCategory**/
Route::delete("book_category/destroy", [BookCategoryController::class,"destroy"])->name("book_category.delete");
Route::resource("book_category", BookCategoryController::class)->parameters(["book_category" => "book_category"]);
/**BookType**/
Route::delete("book_type/destroy", [BookTypeController::class,"destroy"])->name("book_type.delete");
Route::resource("book_type", BookTypeController::class)->parameters(["book_type" => "book_type"]);
/**BookList**/
Route::delete("book_list/destroy", [BookListController::class,"destroy"])->name("book_list.delete");
Route::resource("book_list", BookListController::class)->parameters(["book_list" => "book_list"]);
/**IssuereturnBook**/
Route::delete("issuereturn_book/destroy", [IssuereturnBookController::class,"destroy"])->name("issuereturn_book.delete");
Route::resource("issuereturn_book", IssuereturnBookController::class)->parameters(["issuereturn_book" => "issuereturn_book"]);
/**ItemCategory**/
Route::delete("item_category/destroy", [ItemCategoryController::class,"destroy"])->name("item_category.delete");
Route::resource("item_category", ItemCategoryController::class)->parameters(["item_category" => "item_category"]);
/**ItemType**/
Route::delete("item_type/destroy", [ItemTypeController::class,"destroy"])->name("item_type.delete");
Route::resource("item_type", ItemTypeController::class)->parameters(["item_type" => "item_type"]);
/**ItemsList**/
Route::delete("items_list/destroy", [ItemsListController::class,"destroy"])->name("items_list.delete");
Route::resource("items_list", ItemsListController::class)->parameters(["items_list" => "items_list"]);
/**PurchaseissueItem**/
Route::delete("purchaseissue_item/destroy", [PurchaseissueItemController::class,"destroy"])->name("purchaseissue_item.delete");
Route::resource("purchaseissue_item", PurchaseissueItemController::class)->parameters(["purchaseissue_item" => "purchaseissue_item"]);
/**Suppliers**/
Route::delete("suppliers/destroy", [SuppliersController::class,"destroy"])->name("suppliers.delete");
Route::resource("suppliers", SuppliersController::class)->parameters(["suppliers" => "suppliers"]);
/**Routes**/
Route::delete("routes/destroy", [RoutesController::class,"destroy"])->name("routes.delete");
Route::resource("routes", RoutesController::class)->parameters(["routes" => "routes"]);
/**Vehicles**/
Route::delete("vehicles/destroy", [VehiclesController::class,"destroy"])->name("vehicles.delete");
Route::resource("vehicles", VehiclesController::class)->parameters(["vehicles" => "vehicles"]);
/**AssignVehicle**/
Route::delete("assign_vehicle/destroy", [AssignVehicleController::class,"destroy"])->name("assign_vehicle.delete");
Route::resource("assign_vehicle", AssignVehicleController::class)->parameters(["assign_vehicle" => "assign_vehicle"]);
/**DormType**/
Route::delete("dorm_type/destroy", [DormTypeController::class,"destroy"])->name("dorm_type.delete");
Route::resource("dorm_type", DormTypeController::class)->parameters(["dorm_type" => "dorm_type"]);
/**Dorms**/
Route::delete("dorms/destroy", [DormsController::class,"destroy"])->name("dorms.delete");
Route::resource("dorms", DormsController::class)->parameters(["dorms" => "dorms"]);
/**Department**/
Route::delete("department/destroy", [DepartmentController::class,"destroy"])->name("department.delete");
Route::resource("department", DepartmentController::class)->parameters(["department" => "department"]);
/**Clubs**/
Route::delete("clubs/destroy", [ClubsController::class,"destroy"])->name("clubs.delete");
Route::resource("clubs", ClubsController::class)->parameters(["clubs" => "clubs"]);
/**Staffs**/
Route::delete("staffs/destroy", [StaffsController::class,"destroy"])->name("staffs.delete");
Route::resource("staffs", StaffsController::class)->parameters(["staffs" => "staffs"]);
/**Elements**/
Route::delete("elements/destroy", [ElementsController::class,"destroy"])->name("elements.delete");
Route::resource("elements", ElementsController::class)->parameters(["elements" => "elements"]);
