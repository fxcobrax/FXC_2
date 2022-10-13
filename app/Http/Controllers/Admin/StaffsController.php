<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Staffs;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\StaffsRequest;
use Gate;
use App\Models\Admin\Elements;

class StaffsController extends Controller
{

    public function index()
    {
        if (Gate::none(['staffs_allow', 'staffs_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "staffs";
		$admiko_data["sideBarActiveFolder"] = "";
        $admiko_data["fileInfo"] = Staffs::$admiko_file_info;
        $tableData = Staffs::orderByDesc("id")->get();
        return view("admin.staffs.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['staffs_allow'])) {
            return redirect(route("admin.staffs.index"));
        }
        $admiko_data['sideBarActive'] = "staffs";
		$admiko_data["sideBarActiveFolder"] = "";
        $admiko_data['formAction'] = route("admin.staffs.store");
        $admiko_data["fileInfo"] = Staffs::$admiko_file_info;
        
		$elements_all = Elements::all()->sortBy("contract_type")->pluck("contract_type", "id");
        return view("admin.staffs.manage")->with(compact('admiko_data','elements_all'));
    }

    public function store(StaffsRequest $request)
    {
        if (Gate::none(['staffs_allow'])) {
            return redirect(route("admin.staffs.index"));
        }
        $data = $request->all();
        
        $Staffs = Staffs::create($data);
        
        return redirect(route("admin.staffs.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $Staffs = Staffs::find($id);
        if (Gate::none(['staffs_allow', 'staffs_edit']) || !$Staffs) {
            return redirect(route("admin.staffs.index"));
        }

        $admiko_data['sideBarActive'] = "staffs";
		$admiko_data["sideBarActiveFolder"] = "";
        $admiko_data['formAction'] = route("admin.staffs.update", [$Staffs->id]);
        $admiko_data["fileInfo"] = Staffs::$admiko_file_info;
        
		$elements_all = Elements::all()->sortBy("contract_type")->pluck("contract_type", "id");
        $data = $Staffs;
        return view("admin.staffs.manage")->with(compact('admiko_data', 'data','elements_all'));
    }

    public function update(StaffsRequest $request,$id)
    {
        if (Gate::none(['staffs_allow', 'staffs_edit'])) {
            return redirect(route("admin.staffs.index"));
        }
        $data = $request->all();
        $Staffs = Staffs::find($id);
        $Staffs->update($data);
        
        return redirect(route("admin.staffs.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['staffs_allow'])) {
            return redirect(route("admin.staffs.index"));
        }
        Staffs::destroy($request->idDel);
        return back();
    }
    
    
    
}
