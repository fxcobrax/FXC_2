<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\LeaveType;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\LeaveTypeRequest;
use Gate;

class LeaveTypeController extends Controller
{

    public function index()
    {
        if (Gate::none(['leave_type_allow', 'leave_type_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "leave_type";
		$admiko_data["sideBarActiveFolder"] = "dropdown_leave";
        
        $tableData = LeaveType::orderByDesc("id")->get();
        return view("admin.leave_type.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['leave_type_allow'])) {
            return redirect(route("admin.leave_type.index"));
        }
        $admiko_data['sideBarActive'] = "leave_type";
		$admiko_data["sideBarActiveFolder"] = "dropdown_leave";
        $admiko_data['formAction'] = route("admin.leave_type.store");
        
        
        return view("admin.leave_type.manage")->with(compact('admiko_data'));
    }

    public function store(LeaveTypeRequest $request)
    {
        if (Gate::none(['leave_type_allow'])) {
            return redirect(route("admin.leave_type.index"));
        }
        $data = $request->all();
        
        $LeaveType = LeaveType::create($data);
        
        return redirect(route("admin.leave_type.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $LeaveType = LeaveType::find($id);
        if (Gate::none(['leave_type_allow', 'leave_type_edit']) || !$LeaveType) {
            return redirect(route("admin.leave_type.index"));
        }

        $admiko_data['sideBarActive'] = "leave_type";
		$admiko_data["sideBarActiveFolder"] = "dropdown_leave";
        $admiko_data['formAction'] = route("admin.leave_type.update", [$LeaveType->id]);
        
        
        $data = $LeaveType;
        return view("admin.leave_type.manage")->with(compact('admiko_data', 'data'));
    }

    public function update(LeaveTypeRequest $request,$id)
    {
        if (Gate::none(['leave_type_allow', 'leave_type_edit'])) {
            return redirect(route("admin.leave_type.index"));
        }
        $data = $request->all();
        $LeaveType = LeaveType::find($id);
        $LeaveType->update($data);
        
        return redirect(route("admin.leave_type.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['leave_type_allow'])) {
            return redirect(route("admin.leave_type.index"));
        }
        LeaveType::destroy($request->idDel);
        return back();
    }
    
    
    
}
