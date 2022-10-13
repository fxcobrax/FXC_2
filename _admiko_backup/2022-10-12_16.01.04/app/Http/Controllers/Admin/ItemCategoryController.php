<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\ItemCategory;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ItemCategoryRequest;
use Gate;

class ItemCategoryController extends Controller
{

    public function index()
    {
        if (Gate::none(['item_category_allow', 'item_category_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "item_category";
		$admiko_data["sideBarActiveFolder"] = "dropdown_inventory";
        
        $tableData = ItemCategory::orderByDesc("id")->get();
        return view("admin.item_category.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['item_category_allow'])) {
            return redirect(route("admin.item_category.index"));
        }
        $admiko_data['sideBarActive'] = "item_category";
		$admiko_data["sideBarActiveFolder"] = "dropdown_inventory";
        $admiko_data['formAction'] = route("admin.item_category.store");
        
        
        return view("admin.item_category.manage")->with(compact('admiko_data'));
    }

    public function store(ItemCategoryRequest $request)
    {
        if (Gate::none(['item_category_allow'])) {
            return redirect(route("admin.item_category.index"));
        }
        $data = $request->all();
        
        $ItemCategory = ItemCategory::create($data);
        
        return redirect(route("admin.item_category.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $ItemCategory = ItemCategory::find($id);
        if (Gate::none(['item_category_allow', 'item_category_edit']) || !$ItemCategory) {
            return redirect(route("admin.item_category.index"));
        }

        $admiko_data['sideBarActive'] = "item_category";
		$admiko_data["sideBarActiveFolder"] = "dropdown_inventory";
        $admiko_data['formAction'] = route("admin.item_category.update", [$ItemCategory->id]);
        
        
        $data = $ItemCategory;
        return view("admin.item_category.manage")->with(compact('admiko_data', 'data'));
    }

    public function update(ItemCategoryRequest $request,$id)
    {
        if (Gate::none(['item_category_allow', 'item_category_edit'])) {
            return redirect(route("admin.item_category.index"));
        }
        $data = $request->all();
        $ItemCategory = ItemCategory::find($id);
        $ItemCategory->update($data);
        
        return redirect(route("admin.item_category.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['item_category_allow'])) {
            return redirect(route("admin.item_category.index"));
        }
        ItemCategory::destroy($request->idDel);
        return back();
    }
    
    
    
}
