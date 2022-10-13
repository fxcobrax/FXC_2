<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\ItemsList;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ItemsListRequest;
use Gate;
use App\Models\Admin\ItemType;
use App\Models\Admin\Suppliers;

class ItemsListController extends Controller
{

    public function index()
    {
        if (Gate::none(['items_list_allow', 'items_list_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "items_list";
		$admiko_data["sideBarActiveFolder"] = "dropdown_inventory";
        
        $tableData = ItemsList::orderByDesc("id")->get();
        return view("admin.items_list.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['items_list_allow'])) {
            return redirect(route("admin.items_list.index"));
        }
        $admiko_data['sideBarActive'] = "items_list";
		$admiko_data["sideBarActiveFolder"] = "dropdown_inventory";
        $admiko_data['formAction'] = route("admin.items_list.store");
        
        
		$item_type_all = ItemType::all()->sortBy("type_name")->pluck("type_name", "id");
		$suppliers_all = Suppliers::all()->sortBy("supplier_name")->pluck("supplier_name", "id");
        return view("admin.items_list.manage")->with(compact('admiko_data','item_type_all','suppliers_all'));
    }

    public function store(ItemsListRequest $request)
    {
        if (Gate::none(['items_list_allow'])) {
            return redirect(route("admin.items_list.index"));
        }
        $data = $request->all();
        
        $ItemsList = ItemsList::create($data);
        
        return redirect(route("admin.items_list.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $ItemsList = ItemsList::find($id);
        if (Gate::none(['items_list_allow', 'items_list_edit']) || !$ItemsList) {
            return redirect(route("admin.items_list.index"));
        }

        $admiko_data['sideBarActive'] = "items_list";
		$admiko_data["sideBarActiveFolder"] = "dropdown_inventory";
        $admiko_data['formAction'] = route("admin.items_list.update", [$ItemsList->id]);
        
        
		$item_type_all = ItemType::all()->sortBy("type_name")->pluck("type_name", "id");
		$suppliers_all = Suppliers::all()->sortBy("supplier_name")->pluck("supplier_name", "id");
        $data = $ItemsList;
        return view("admin.items_list.manage")->with(compact('admiko_data', 'data','item_type_all','suppliers_all'));
    }

    public function update(ItemsListRequest $request,$id)
    {
        if (Gate::none(['items_list_allow', 'items_list_edit'])) {
            return redirect(route("admin.items_list.index"));
        }
        $data = $request->all();
        $ItemsList = ItemsList::find($id);
        $ItemsList->update($data);
        
        return redirect(route("admin.items_list.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['items_list_allow'])) {
            return redirect(route("admin.items_list.index"));
        }
        ItemsList::destroy($request->idDel);
        return back();
    }
    
    
    
}
