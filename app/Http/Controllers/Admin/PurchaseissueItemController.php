<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\PurchaseissueItem;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\PurchaseissueItemRequest;
use Gate;
use App\Models\Admin\ItemsList;
use App\Models\Admin\StudentsList;

class PurchaseissueItemController extends Controller
{

    public function index()
    {
        if (Gate::none(['purchaseissue_item_allow', 'purchaseissue_item_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "purchaseissue_item";
		$admiko_data["sideBarActiveFolder"] = "dropdown_inventory";
        
        $tableData = PurchaseissueItem::orderByDesc("id")->get();
        return view("admin.purchaseissue_item.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['purchaseissue_item_allow'])) {
            return redirect(route("admin.purchaseissue_item.index"));
        }
        $admiko_data['sideBarActive'] = "purchaseissue_item";
		$admiko_data["sideBarActiveFolder"] = "dropdown_inventory";
        $admiko_data['formAction'] = route("admin.purchaseissue_item.store");
        
        
		$items_list_all = ItemsList::all()->sortBy("item_name")->pluck("item_name", "id");
		$students_list_all = StudentsList::all()->sortBy("first_name")->pluck("first_name", "id");
        return view("admin.purchaseissue_item.manage")->with(compact('admiko_data','items_list_all','students_list_all'));
    }

    public function store(PurchaseissueItemRequest $request)
    {
        if (Gate::none(['purchaseissue_item_allow'])) {
            return redirect(route("admin.purchaseissue_item.index"));
        }
        $data = $request->all();
        
        $PurchaseissueItem = PurchaseissueItem::create($data);
        $PurchaseissueItem->items_many()->sync($request->input("items", []));
		if($request->input("items")){ foreach($request->input("items") as $key=>$id) { $PurchaseissueItem->items_many()->updateExistingPivot($id, ["admiko_order"=>$key]); }}
        return redirect(route("admin.purchaseissue_item.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $PurchaseissueItem = PurchaseissueItem::find($id);
        if (Gate::none(['purchaseissue_item_allow', 'purchaseissue_item_edit']) || !$PurchaseissueItem) {
            return redirect(route("admin.purchaseissue_item.index"));
        }

        $admiko_data['sideBarActive'] = "purchaseissue_item";
		$admiko_data["sideBarActiveFolder"] = "dropdown_inventory";
        $admiko_data['formAction'] = route("admin.purchaseissue_item.update", [$PurchaseissueItem->id]);
        
        
		$items_list_all = ItemsList::all()->sortBy("item_name")->pluck("item_name", "id");
		$students_list_all = StudentsList::all()->sortBy("first_name")->pluck("first_name", "id");
        $data = $PurchaseissueItem;
        return view("admin.purchaseissue_item.manage")->with(compact('admiko_data', 'data','items_list_all','students_list_all'));
    }

    public function update(PurchaseissueItemRequest $request,$id)
    {
        if (Gate::none(['purchaseissue_item_allow', 'purchaseissue_item_edit'])) {
            return redirect(route("admin.purchaseissue_item.index"));
        }
        $data = $request->all();
        $PurchaseissueItem = PurchaseissueItem::find($id);
        $PurchaseissueItem->update($data);
        $PurchaseissueItem->items_many()->sync($request->input("items", []));
		if($request->input("items")){ foreach($request->input("items") as $key=>$id) { $PurchaseissueItem->items_many()->updateExistingPivot($id, ["admiko_order"=>$key]); }}
        return redirect(route("admin.purchaseissue_item.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['purchaseissue_item_allow'])) {
            return redirect(route("admin.purchaseissue_item.index"));
        }
        PurchaseissueItem::destroy($request->idDel);
        return back();
    }
    
    
    
}
