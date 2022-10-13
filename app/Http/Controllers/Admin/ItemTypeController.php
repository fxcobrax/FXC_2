<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\ItemType;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ItemTypeRequest;
use Gate;
use App\Models\Admin\ItemCategory;

class ItemTypeController extends Controller
{

    public function index()
    {
        if (Gate::none(['item_type_allow', 'item_type_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "item_type";
		$admiko_data["sideBarActiveFolder"] = "dropdown_inventory";
        
        $tableData = ItemType::orderByDesc("id")->get();
        return view("admin.item_type.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['item_type_allow'])) {
            return redirect(route("admin.item_type.index"));
        }
        $admiko_data['sideBarActive'] = "item_type";
		$admiko_data["sideBarActiveFolder"] = "dropdown_inventory";
        $admiko_data['formAction'] = route("admin.item_type.store");
        
        
		$item_category_all = ItemCategory::all()->sortBy("category_name")->pluck("category_name", "id");
        return view("admin.item_type.manage")->with(compact('admiko_data','item_category_all'));
    }

    public function store(ItemTypeRequest $request)
    {
        if (Gate::none(['item_type_allow'])) {
            return redirect(route("admin.item_type.index"));
        }
        $data = $request->all();
        
        $ItemType = ItemType::create($data);
        
        return redirect(route("admin.item_type.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $ItemType = ItemType::find($id);
        if (Gate::none(['item_type_allow', 'item_type_edit']) || !$ItemType) {
            return redirect(route("admin.item_type.index"));
        }

        $admiko_data['sideBarActive'] = "item_type";
		$admiko_data["sideBarActiveFolder"] = "dropdown_inventory";
        $admiko_data['formAction'] = route("admin.item_type.update", [$ItemType->id]);
        
        
		$item_category_all = ItemCategory::all()->sortBy("category_name")->pluck("category_name", "id");
        $data = $ItemType;
        return view("admin.item_type.manage")->with(compact('admiko_data', 'data','item_category_all'));
    }

    public function update(ItemTypeRequest $request,$id)
    {
        if (Gate::none(['item_type_allow', 'item_type_edit'])) {
            return redirect(route("admin.item_type.index"));
        }
        $data = $request->all();
        $ItemType = ItemType::find($id);
        $ItemType->update($data);
        
        return redirect(route("admin.item_type.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['item_type_allow'])) {
            return redirect(route("admin.item_type.index"));
        }
        ItemType::destroy($request->idDel);
        return back();
    }
    
    
    
}
