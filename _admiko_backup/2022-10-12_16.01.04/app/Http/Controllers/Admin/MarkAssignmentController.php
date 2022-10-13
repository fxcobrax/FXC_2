<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\MarkAssignment;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\MarkAssignmentRequest;
use Gate;
use App\Models\Admin\Assignment;
use App\Models\Admin\StudentsList;

class MarkAssignmentController extends Controller
{

    public function index()
    {
        if (Gate::none(['mark_assignment_allow', 'mark_assignment_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "mark_assignment";
		$admiko_data["sideBarActiveFolder"] = "dropdown_class_activities";
        
        $tableData = MarkAssignment::orderByDesc("id")->get();
        return view("admin.mark_assignment.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['mark_assignment_allow'])) {
            return redirect(route("admin.mark_assignment.index"));
        }
        $admiko_data['sideBarActive'] = "mark_assignment";
		$admiko_data["sideBarActiveFolder"] = "dropdown_class_activities";
        $admiko_data['formAction'] = route("admin.mark_assignment.store");
        
        
		$assignment_all = Assignment::all()->sortBy("assignment_name")->pluck("assignment_name", "id");
		$students_list_all = StudentsList::all()->sortBy("first_name")->pluck("first_name", "id");
        return view("admin.mark_assignment.manage")->with(compact('admiko_data','assignment_all','students_list_all'));
    }

    public function store(MarkAssignmentRequest $request)
    {
        if (Gate::none(['mark_assignment_allow'])) {
            return redirect(route("admin.mark_assignment.index"));
        }
        $data = $request->all();
        
        $MarkAssignment = MarkAssignment::create($data);
        
        return redirect(route("admin.mark_assignment.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $MarkAssignment = MarkAssignment::find($id);
        if (Gate::none(['mark_assignment_allow', 'mark_assignment_edit']) || !$MarkAssignment) {
            return redirect(route("admin.mark_assignment.index"));
        }

        $admiko_data['sideBarActive'] = "mark_assignment";
		$admiko_data["sideBarActiveFolder"] = "dropdown_class_activities";
        $admiko_data['formAction'] = route("admin.mark_assignment.update", [$MarkAssignment->id]);
        
        
		$assignment_all = Assignment::all()->sortBy("assignment_name")->pluck("assignment_name", "id");
		$students_list_all = StudentsList::all()->sortBy("first_name")->pluck("first_name", "id");
        $data = $MarkAssignment;
        return view("admin.mark_assignment.manage")->with(compact('admiko_data', 'data','assignment_all','students_list_all'));
    }

    public function update(MarkAssignmentRequest $request,$id)
    {
        if (Gate::none(['mark_assignment_allow', 'mark_assignment_edit'])) {
            return redirect(route("admin.mark_assignment.index"));
        }
        $data = $request->all();
        $MarkAssignment = MarkAssignment::find($id);
        $MarkAssignment->update($data);
        
        return redirect(route("admin.mark_assignment.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['mark_assignment_allow'])) {
            return redirect(route("admin.mark_assignment.index"));
        }
        MarkAssignment::destroy($request->idDel);
        return back();
    }
    
    
    
}
