<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\ApplyForLeave;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ApplyForLeaveRequest;
use Gate;
use App\Models\Admin\Staffs;
use App\Models\Admin\LeaveType;

class ApplyForLeaveController extends Controller
{

    public function index()
    {
        if (Gate::none(['apply_for_leave_allow', 'apply_for_leave_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "apply_for_leave";
		$admiko_data["sideBarActiveFolder"] = "dropdown_leave";
        
        $tableData = ApplyForLeave::orderByDesc("id")->get();
        return view("admin.apply_for_leave.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['apply_for_leave_allow'])) {
            return redirect(route("admin.apply_for_leave.index"));
        }
        $admiko_data['sideBarActive'] = "apply_for_leave";
		$admiko_data["sideBarActiveFolder"] = "dropdown_leave";
        $admiko_data['formAction'] = route("admin.apply_for_leave.store");
        
        
		$staffs_all = Staffs::all()->sortBy("full_name")->pluck("full_name", "id");
		$leave_type_all = LeaveType::all()->sortBy("type_name")->pluck("type_name", "id");
        return view("admin.apply_for_leave.manage")->with(compact('admiko_data','staffs_all','leave_type_all'));
    }

    public function store(ApplyForLeaveRequest $request)
    {
        if (Gate::none(['apply_for_leave_allow'])) {
            return redirect(route("admin.apply_for_leave.index"));
        }
        $data = $request->all();
        
        $ApplyForLeave = ApplyForLeave::create($data);
        
        return redirect(route("admin.apply_for_leave.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $ApplyForLeave = ApplyForLeave::find($id);
        if (Gate::none(['apply_for_leave_allow', 'apply_for_leave_edit']) || !$ApplyForLeave) {
            return redirect(route("admin.apply_for_leave.index"));
        }

        $admiko_data['sideBarActive'] = "apply_for_leave";
		$admiko_data["sideBarActiveFolder"] = "dropdown_leave";
        $admiko_data['formAction'] = route("admin.apply_for_leave.update", [$ApplyForLeave->id]);
        
        
		$staffs_all = Staffs::all()->sortBy("full_name")->pluck("full_name", "id");
		$leave_type_all = LeaveType::all()->sortBy("type_name")->pluck("type_name", "id");
        $data = $ApplyForLeave;
        return view("admin.apply_for_leave.manage")->with(compact('admiko_data', 'data','staffs_all','leave_type_all'));
    }

    public function update(ApplyForLeaveRequest $request,$id)
    {
        if (Gate::none(['apply_for_leave_allow', 'apply_for_leave_edit'])) {
            return redirect(route("admin.apply_for_leave.index"));
        }
        $data = $request->all();
        $ApplyForLeave = ApplyForLeave::find($id);
        $ApplyForLeave->update($data);
        
        return redirect(route("admin.apply_for_leave.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['apply_for_leave_allow'])) {
            return redirect(route("admin.apply_for_leave.index"));
        }
        ApplyForLeave::destroy($request->idDel);
        return back();
    }
    
    
    
}
