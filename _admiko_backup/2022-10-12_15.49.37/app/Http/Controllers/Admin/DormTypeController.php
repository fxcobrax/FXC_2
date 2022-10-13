<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\DormType;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\DormTypeRequest;
use Gate;

class DormTypeController extends Controller
{

    public function index()
    {
        if (Gate::none(['dorm_type_allow', 'dorm_type_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "dorm_type";
		$admiko_data["sideBarActiveFolder"] = "dropdown_dormitory";
        
        $tableData = DormType::orderByDesc("id")->get();
        return view("admin.dorm_type.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['dorm_type_allow'])) {
            return redirect(route("admin.dorm_type.index"));
        }
        $admiko_data['sideBarActive'] = "dorm_type";
		$admiko_data["sideBarActiveFolder"] = "dropdown_dormitory";
        $admiko_data['formAction'] = route("admin.dorm_type.store");
        
        
        return view("admin.dorm_type.manage")->with(compact('admiko_data'));
    }

    public function store(DormTypeRequest $request)
    {
        if (Gate::none(['dorm_type_allow'])) {
            return redirect(route("admin.dorm_type.index"));
        }
        $data = $request->all();
        
        $DormType = DormType::create($data);
        
        return redirect(route("admin.dorm_type.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $DormType = DormType::find($id);
        if (Gate::none(['dorm_type_allow', 'dorm_type_edit']) || !$DormType) {
            return redirect(route("admin.dorm_type.index"));
        }

        $admiko_data['sideBarActive'] = "dorm_type";
		$admiko_data["sideBarActiveFolder"] = "dropdown_dormitory";
        $admiko_data['formAction'] = route("admin.dorm_type.update", [$DormType->id]);
        
        
        $data = $DormType;
        return view("admin.dorm_type.manage")->with(compact('admiko_data', 'data'));
    }

    public function update(DormTypeRequest $request,$id)
    {
        if (Gate::none(['dorm_type_allow', 'dorm_type_edit'])) {
            return redirect(route("admin.dorm_type.index"));
        }
        $data = $request->all();
        $DormType = DormType::find($id);
        $DormType->update($data);
        
        return redirect(route("admin.dorm_type.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['dorm_type_allow'])) {
            return redirect(route("admin.dorm_type.index"));
        }
        DormType::destroy($request->idDel);
        return back();
    }
    
    
    
}
