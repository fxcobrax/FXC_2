<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Department;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\DepartmentRequest;
use Gate;

class DepartmentController extends Controller
{

    public function index()
    {
        if (Gate::none(['department_allow', 'department_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "department";
		$admiko_data["sideBarActiveFolder"] = "dropdown_facilities";
        
        $tableData = Department::orderByDesc("id")->get();
        return view("admin.department.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['department_allow'])) {
            return redirect(route("admin.department.index"));
        }
        $admiko_data['sideBarActive'] = "department";
		$admiko_data["sideBarActiveFolder"] = "dropdown_facilities";
        $admiko_data['formAction'] = route("admin.department.store");
        
        
        return view("admin.department.manage")->with(compact('admiko_data'));
    }

    public function store(DepartmentRequest $request)
    {
        if (Gate::none(['department_allow'])) {
            return redirect(route("admin.department.index"));
        }
        $data = $request->all();
        
        $Department = Department::create($data);
        
        return redirect(route("admin.department.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $Department = Department::find($id);
        if (Gate::none(['department_allow', 'department_edit']) || !$Department) {
            return redirect(route("admin.department.index"));
        }

        $admiko_data['sideBarActive'] = "department";
		$admiko_data["sideBarActiveFolder"] = "dropdown_facilities";
        $admiko_data['formAction'] = route("admin.department.update", [$Department->id]);
        
        
        $data = $Department;
        return view("admin.department.manage")->with(compact('admiko_data', 'data'));
    }

    public function update(DepartmentRequest $request,$id)
    {
        if (Gate::none(['department_allow', 'department_edit'])) {
            return redirect(route("admin.department.index"));
        }
        $data = $request->all();
        $Department = Department::find($id);
        $Department->update($data);
        
        return redirect(route("admin.department.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['department_allow'])) {
            return redirect(route("admin.department.index"));
        }
        Department::destroy($request->idDel);
        return back();
    }
    
    
    
}
