<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Routes;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\RoutesRequest;
use Gate;

class RoutesController extends Controller
{

    public function index()
    {
        if (Gate::none(['routes_allow', 'routes_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "routes";
		$admiko_data["sideBarActiveFolder"] = "dropdown_transport";
        
        $tableData = Routes::orderByDesc("id")->get();
        return view("admin.routes.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['routes_allow'])) {
            return redirect(route("admin.routes.index"));
        }
        $admiko_data['sideBarActive'] = "routes";
		$admiko_data["sideBarActiveFolder"] = "dropdown_transport";
        $admiko_data['formAction'] = route("admin.routes.store");
        
        
        return view("admin.routes.manage")->with(compact('admiko_data'));
    }

    public function store(RoutesRequest $request)
    {
        if (Gate::none(['routes_allow'])) {
            return redirect(route("admin.routes.index"));
        }
        $data = $request->all();
        
        $Routes = Routes::create($data);
        
        return redirect(route("admin.routes.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $Routes = Routes::find($id);
        if (Gate::none(['routes_allow', 'routes_edit']) || !$Routes) {
            return redirect(route("admin.routes.index"));
        }

        $admiko_data['sideBarActive'] = "routes";
		$admiko_data["sideBarActiveFolder"] = "dropdown_transport";
        $admiko_data['formAction'] = route("admin.routes.update", [$Routes->id]);
        
        
        $data = $Routes;
        return view("admin.routes.manage")->with(compact('admiko_data', 'data'));
    }

    public function update(RoutesRequest $request,$id)
    {
        if (Gate::none(['routes_allow', 'routes_edit'])) {
            return redirect(route("admin.routes.index"));
        }
        $data = $request->all();
        $Routes = Routes::find($id);
        $Routes->update($data);
        
        return redirect(route("admin.routes.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['routes_allow'])) {
            return redirect(route("admin.routes.index"));
        }
        Routes::destroy($request->idDel);
        return back();
    }
    
    
    
}
