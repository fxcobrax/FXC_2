<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\FeeType;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\FeeTypeRequest;
use Gate;

class FeeTypeController extends Controller
{

    public function index()
    {
        if (Gate::none(['fee_type_allow', 'fee_type_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "fee_type";
		$admiko_data["sideBarActiveFolder"] = "dropdown_fees";
        
        $tableData = FeeType::orderByDesc("id")->get();
        return view("admin.fee_type.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['fee_type_allow'])) {
            return redirect(route("admin.fee_type.index"));
        }
        $admiko_data['sideBarActive'] = "fee_type";
		$admiko_data["sideBarActiveFolder"] = "dropdown_fees";
        $admiko_data['formAction'] = route("admin.fee_type.store");
        
        
        return view("admin.fee_type.manage")->with(compact('admiko_data'));
    }

    public function store(FeeTypeRequest $request)
    {
        if (Gate::none(['fee_type_allow'])) {
            return redirect(route("admin.fee_type.index"));
        }
        $data = $request->all();
        
        $FeeType = FeeType::create($data);
        
        return redirect(route("admin.fee_type.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $FeeType = FeeType::find($id);
        if (Gate::none(['fee_type_allow', 'fee_type_edit']) || !$FeeType) {
            return redirect(route("admin.fee_type.index"));
        }

        $admiko_data['sideBarActive'] = "fee_type";
		$admiko_data["sideBarActiveFolder"] = "dropdown_fees";
        $admiko_data['formAction'] = route("admin.fee_type.update", [$FeeType->id]);
        
        
        $data = $FeeType;
        return view("admin.fee_type.manage")->with(compact('admiko_data', 'data'));
    }

    public function update(FeeTypeRequest $request,$id)
    {
        if (Gate::none(['fee_type_allow', 'fee_type_edit'])) {
            return redirect(route("admin.fee_type.index"));
        }
        $data = $request->all();
        $FeeType = FeeType::find($id);
        $FeeType->update($data);
        
        return redirect(route("admin.fee_type.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['fee_type_allow'])) {
            return redirect(route("admin.fee_type.index"));
        }
        FeeType::destroy($request->idDel);
        return back();
    }
    
    
    
}
