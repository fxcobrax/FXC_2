<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Assignment;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\AssignmentRequest;
use Gate;
use App\Models\Admin\Classes;
use App\Models\Admin\Subjects;

class AssignmentController extends Controller
{

    public function index()
    {
        if (Gate::none(['assignment_allow', 'assignment_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "assignment";
		$admiko_data["sideBarActiveFolder"] = "dropdown_class_activities";
        
        $tableData = Assignment::orderByDesc("id")->get();
        return view("admin.assignment.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['assignment_allow'])) {
            return redirect(route("admin.assignment.index"));
        }
        $admiko_data['sideBarActive'] = "assignment";
		$admiko_data["sideBarActiveFolder"] = "dropdown_class_activities";
        $admiko_data['formAction'] = route("admin.assignment.store");
        
        
		$classes_all = Classes::all()->sortBy("class_name")->pluck("class_name", "id");
		$subjects_all = Subjects::all()->sortBy("sudject_name")->pluck("sudject_name", "id");
        return view("admin.assignment.manage")->with(compact('admiko_data','classes_all','subjects_all'));
    }

    public function store(AssignmentRequest $request)
    {
        if (Gate::none(['assignment_allow'])) {
            return redirect(route("admin.assignment.index"));
        }
        $data = $request->all();
        
        $Assignment = Assignment::create($data);
        
        return redirect(route("admin.assignment.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $Assignment = Assignment::find($id);
        if (Gate::none(['assignment_allow', 'assignment_edit']) || !$Assignment) {
            return redirect(route("admin.assignment.index"));
        }

        $admiko_data['sideBarActive'] = "assignment";
		$admiko_data["sideBarActiveFolder"] = "dropdown_class_activities";
        $admiko_data['formAction'] = route("admin.assignment.update", [$Assignment->id]);
        
        
		$classes_all = Classes::all()->sortBy("class_name")->pluck("class_name", "id");
		$subjects_all = Subjects::all()->sortBy("sudject_name")->pluck("sudject_name", "id");
        $data = $Assignment;
        return view("admin.assignment.manage")->with(compact('admiko_data', 'data','classes_all','subjects_all'));
    }

    public function update(AssignmentRequest $request,$id)
    {
        if (Gate::none(['assignment_allow', 'assignment_edit'])) {
            return redirect(route("admin.assignment.index"));
        }
        $data = $request->all();
        $Assignment = Assignment::find($id);
        $Assignment->update($data);
        
        return redirect(route("admin.assignment.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['assignment_allow'])) {
            return redirect(route("admin.assignment.index"));
        }
        Assignment::destroy($request->idDel);
        return back();
    }
    
    
    
}
