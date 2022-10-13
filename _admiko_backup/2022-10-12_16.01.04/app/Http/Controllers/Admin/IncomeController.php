<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Income;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\IncomeRequest;
use Gate;

class IncomeController extends Controller
{

    public function index()
    {
        if (Gate::none(['income_allow', 'income_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "income";
		$admiko_data["sideBarActiveFolder"] = "_account";
        
        $tableData = Income::orderByDesc("id")->get();
        return view("admin.income.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['income_allow'])) {
            return redirect(route("admin.income.index"));
        }
        $admiko_data['sideBarActive'] = "income";
		$admiko_data["sideBarActiveFolder"] = "_account";
        $admiko_data['formAction'] = route("admin.income.store");
        
        
        return view("admin.income.manage")->with(compact('admiko_data'));
    }

    public function store(IncomeRequest $request)
    {
        if (Gate::none(['income_allow'])) {
            return redirect(route("admin.income.index"));
        }
        $data = $request->all();
        
        $Income = Income::create($data);
        
        return redirect(route("admin.income.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $Income = Income::find($id);
        if (Gate::none(['income_allow', 'income_edit']) || !$Income) {
            return redirect(route("admin.income.index"));
        }

        $admiko_data['sideBarActive'] = "income";
		$admiko_data["sideBarActiveFolder"] = "_account";
        $admiko_data['formAction'] = route("admin.income.update", [$Income->id]);
        
        
        $data = $Income;
        return view("admin.income.manage")->with(compact('admiko_data', 'data'));
    }

    public function update(IncomeRequest $request,$id)
    {
        if (Gate::none(['income_allow', 'income_edit'])) {
            return redirect(route("admin.income.index"));
        }
        $data = $request->all();
        $Income = Income::find($id);
        $Income->update($data);
        
        return redirect(route("admin.income.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['income_allow'])) {
            return redirect(route("admin.income.index"));
        }
        Income::destroy($request->idDel);
        return back();
    }
    
    
    
}
