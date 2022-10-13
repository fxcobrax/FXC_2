<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Suppliers;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\SuppliersRequest;
use Gate;

class SuppliersController extends Controller
{

    public function index()
    {
        if (Gate::none(['suppliers_allow', 'suppliers_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "suppliers";
		$admiko_data["sideBarActiveFolder"] = "dropdown_inventory";
        
        $tableData = Suppliers::orderByDesc("id")->get();
        return view("admin.suppliers.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['suppliers_allow'])) {
            return redirect(route("admin.suppliers.index"));
        }
        $admiko_data['sideBarActive'] = "suppliers";
		$admiko_data["sideBarActiveFolder"] = "dropdown_inventory";
        $admiko_data['formAction'] = route("admin.suppliers.store");
        
        
        return view("admin.suppliers.manage")->with(compact('admiko_data'));
    }

    public function store(SuppliersRequest $request)
    {
        if (Gate::none(['suppliers_allow'])) {
            return redirect(route("admin.suppliers.index"));
        }
        $data = $request->all();
        
        $Suppliers = Suppliers::create($data);
        
        return redirect(route("admin.suppliers.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $Suppliers = Suppliers::find($id);
        if (Gate::none(['suppliers_allow', 'suppliers_edit']) || !$Suppliers) {
            return redirect(route("admin.suppliers.index"));
        }

        $admiko_data['sideBarActive'] = "suppliers";
		$admiko_data["sideBarActiveFolder"] = "dropdown_inventory";
        $admiko_data['formAction'] = route("admin.suppliers.update", [$Suppliers->id]);
        
        
        $data = $Suppliers;
        return view("admin.suppliers.manage")->with(compact('admiko_data', 'data'));
    }

    public function update(SuppliersRequest $request,$id)
    {
        if (Gate::none(['suppliers_allow', 'suppliers_edit'])) {
            return redirect(route("admin.suppliers.index"));
        }
        $data = $request->all();
        $Suppliers = Suppliers::find($id);
        $Suppliers->update($data);
        
        return redirect(route("admin.suppliers.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['suppliers_allow'])) {
            return redirect(route("admin.suppliers.index"));
        }
        Suppliers::destroy($request->idDel);
        return back();
    }
    
    
    
}
