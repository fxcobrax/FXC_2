<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Vehicles;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\VehiclesRequest;
use Gate;
use App\Models\Admin\Routes;

class VehiclesController extends Controller
{

    public function index()
    {
        if (Gate::none(['vehicles_allow', 'vehicles_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "vehicles";
		$admiko_data["sideBarActiveFolder"] = "dropdown_transport";
        
        $tableData = Vehicles::orderByDesc("id")->get();
        return view("admin.vehicles.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['vehicles_allow'])) {
            return redirect(route("admin.vehicles.index"));
        }
        $admiko_data['sideBarActive'] = "vehicles";
		$admiko_data["sideBarActiveFolder"] = "dropdown_transport";
        $admiko_data['formAction'] = route("admin.vehicles.store");
        
        
		$routes_all = Routes::all()->sortBy("route_name")->pluck("route_name", "id");
        return view("admin.vehicles.manage")->with(compact('admiko_data','routes_all'));
    }

    public function store(VehiclesRequest $request)
    {
        if (Gate::none(['vehicles_allow'])) {
            return redirect(route("admin.vehicles.index"));
        }
        $data = $request->all();
        
        $Vehicles = Vehicles::create($data);
        
        return redirect(route("admin.vehicles.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $Vehicles = Vehicles::find($id);
        if (Gate::none(['vehicles_allow', 'vehicles_edit']) || !$Vehicles) {
            return redirect(route("admin.vehicles.index"));
        }

        $admiko_data['sideBarActive'] = "vehicles";
		$admiko_data["sideBarActiveFolder"] = "dropdown_transport";
        $admiko_data['formAction'] = route("admin.vehicles.update", [$Vehicles->id]);
        
        
		$routes_all = Routes::all()->sortBy("route_name")->pluck("route_name", "id");
        $data = $Vehicles;
        return view("admin.vehicles.manage")->with(compact('admiko_data', 'data','routes_all'));
    }

    public function update(VehiclesRequest $request,$id)
    {
        if (Gate::none(['vehicles_allow', 'vehicles_edit'])) {
            return redirect(route("admin.vehicles.index"));
        }
        $data = $request->all();
        $Vehicles = Vehicles::find($id);
        $Vehicles->update($data);
        
        return redirect(route("admin.vehicles.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['vehicles_allow'])) {
            return redirect(route("admin.vehicles.index"));
        }
        Vehicles::destroy($request->idDel);
        return back();
    }
    
    
    
}
