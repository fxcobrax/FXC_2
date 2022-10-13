<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\StudentsList;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\StudentsListRequest;
use Gate;
use App\Models\Admin\Elements;
use App\Models\Admin\Classes;
use App\Models\Admin\Department;
use App\Models\Admin\Clubs;
use App\Models\Admin\Dorms;
use App\Models\Admin\Routes;

class StudentsListController extends Controller
{

    public function index()
    {
        if (Gate::none(['students_list_allow', 'students_list_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "students_list";
		$admiko_data["sideBarActiveFolder"] = "dropdown_students";
        $admiko_data["fileInfo"] = StudentsList::$admiko_file_info;
        $tableData = StudentsList::orderByDesc("id")->get();
        return view("admin.students_list.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['students_list_allow'])) {
            return redirect(route("admin.students_list.index"));
        }
        $admiko_data['sideBarActive'] = "students_list";
		$admiko_data["sideBarActiveFolder"] = "dropdown_students";
        $admiko_data['formAction'] = route("admin.students_list.store");
        $admiko_data["fileInfo"] = StudentsList::$admiko_file_info;
        
		$elements_all = Elements::all()->sortBy("gender")->pluck("gender", "id");
		$classes_all = Classes::all()->sortBy("class_name")->pluck("class_name", "id");
		$department_all = Department::all()->sortBy("dept_name")->pluck("dept_name", "id");
		$clubs_all = Clubs::all()->sortBy("club_name")->pluck("club_name", "id");
		$dorms_all = Dorms::all()->sortBy("dorm_name")->pluck("dorm_name", "id");
		$routes_all = Routes::all()->sortBy("route_name")->pluck("route_name", "id");
        return view("admin.students_list.manage")->with(compact('admiko_data','elements_all','classes_all','department_all','clubs_all','dorms_all','routes_all'));
    }

    public function store(StudentsListRequest $request)
    {
        if (Gate::none(['students_list_allow'])) {
            return redirect(route("admin.students_list.index"));
        }
        $data = $request->all();
        
        $StudentsList = StudentsList::create($data);
        
        return redirect(route("admin.students_list.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $StudentsList = StudentsList::find($id);
        if (Gate::none(['students_list_allow', 'students_list_edit']) || !$StudentsList) {
            return redirect(route("admin.students_list.index"));
        }

        $admiko_data['sideBarActive'] = "students_list";
		$admiko_data["sideBarActiveFolder"] = "dropdown_students";
        $admiko_data['formAction'] = route("admin.students_list.update", [$StudentsList->id]);
        $admiko_data["fileInfo"] = StudentsList::$admiko_file_info;
        
		$elements_all = Elements::all()->sortBy("gender")->pluck("gender", "id");
		$classes_all = Classes::all()->sortBy("class_name")->pluck("class_name", "id");
		$department_all = Department::all()->sortBy("dept_name")->pluck("dept_name", "id");
		$clubs_all = Clubs::all()->sortBy("club_name")->pluck("club_name", "id");
		$dorms_all = Dorms::all()->sortBy("dorm_name")->pluck("dorm_name", "id");
		$routes_all = Routes::all()->sortBy("route_name")->pluck("route_name", "id");
        $data = $StudentsList;
        return view("admin.students_list.manage")->with(compact('admiko_data', 'data','elements_all','classes_all','department_all','clubs_all','dorms_all','routes_all'));
    }

    public function update(StudentsListRequest $request,$id)
    {
        if (Gate::none(['students_list_allow', 'students_list_edit'])) {
            return redirect(route("admin.students_list.index"));
        }
        $data = $request->all();
        $StudentsList = StudentsList::find($id);
        $StudentsList->update($data);
        
        return redirect(route("admin.students_list.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['students_list_allow'])) {
            return redirect(route("admin.students_list.index"));
        }
        StudentsList::destroy($request->idDel);
        return back();
    }
    
    
    
}
