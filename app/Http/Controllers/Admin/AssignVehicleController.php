<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\AssignVehicle;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\AssignVehicleRequest;
use Gate;
use App\Models\Admin\Vehicles;
use App\Models\Admin\Staffs;

class AssignVehicleController extends Controller
{

    public function index()
    {
        if (Gate::none(['assign_vehicle_allow', 'assign_vehicle_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "assign_vehicle";
		$admiko_data["sideBarActiveFolder"] = "dropdown_transport";
        
        $tableData = AssignVehicle::orderByDesc("id")->get();
        return view("admin.assign_vehicle.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['assign_vehicle_allow'])) {
            return redirect(route("admin.assign_vehicle.index"));
        }
        $admiko_data['sideBarActive'] = "assign_vehicle";
		$admiko_data["sideBarActiveFolder"] = "dropdown_transport";
        $admiko_data['formAction'] = route("admin.assign_vehicle.store");
        
        
		$vehicles_all = Vehicles::all()->sortBy("vehicle_id")->pluck("vehicle_id", "id");
		$staffs_all = Staffs::all()->sortBy("full_name")->pluck("full_name", "id");
        return view("admin.assign_vehicle.manage")->with(compact('admiko_data','vehicles_all','staffs_all'));
    }

    public function store(AssignVehicleRequest $request)
    {
        if (Gate::none(['assign_vehicle_allow'])) {
            return redirect(route("admin.assign_vehicle.index"));
        }
        $data = $request->all();
        
        $AssignVehicle = AssignVehicle::create($data);
        
        return redirect(route("admin.assign_vehicle.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $AssignVehicle = AssignVehicle::find($id);
        if (Gate::none(['assign_vehicle_allow', 'assign_vehicle_edit']) || !$AssignVehicle) {
            return redirect(route("admin.assign_vehicle.index"));
        }

        $admiko_data['sideBarActive'] = "assign_vehicle";
		$admiko_data["sideBarActiveFolder"] = "dropdown_transport";
        $admiko_data['formAction'] = route("admin.assign_vehicle.update", [$AssignVehicle->id]);
        
        
		$vehicles_all = Vehicles::all()->sortBy("vehicle_id")->pluck("vehicle_id", "id");
		$staffs_all = Staffs::all()->sortBy("full_name")->pluck("full_name", "id");
        $data = $AssignVehicle;
        return view("admin.assign_vehicle.manage")->with(compact('admiko_data', 'data','vehicles_all','staffs_all'));
    }

    public function update(AssignVehicleRequest $request,$id)
    {
        if (Gate::none(['assign_vehicle_allow', 'assign_vehicle_edit'])) {
            return redirect(route("admin.assign_vehicle.index"));
        }
        $data = $request->all();
        $AssignVehicle = AssignVehicle::find($id);
        $AssignVehicle->update($data);
        
        return redirect(route("admin.assign_vehicle.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['assign_vehicle_allow'])) {
            return redirect(route("admin.assign_vehicle.index"));
        }
        AssignVehicle::destroy($request->idDel);
        return back();
    }
    
    
    
}
