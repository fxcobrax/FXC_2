<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Expense;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ExpenseRequest;
use Gate;

class ExpenseController extends Controller
{

    public function index()
    {
        if (Gate::none(['expense_allow', 'expense_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "expense";
		$admiko_data["sideBarActiveFolder"] = "_account";
        
        $tableData = Expense::orderByDesc("id")->get();
        return view("admin.expense.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['expense_allow'])) {
            return redirect(route("admin.expense.index"));
        }
        $admiko_data['sideBarActive'] = "expense";
		$admiko_data["sideBarActiveFolder"] = "_account";
        $admiko_data['formAction'] = route("admin.expense.store");
        
        
        return view("admin.expense.manage")->with(compact('admiko_data'));
    }

    public function store(ExpenseRequest $request)
    {
        if (Gate::none(['expense_allow'])) {
            return redirect(route("admin.expense.index"));
        }
        $data = $request->all();
        
        $Expense = Expense::create($data);
        
        return redirect(route("admin.expense.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $Expense = Expense::find($id);
        if (Gate::none(['expense_allow', 'expense_edit']) || !$Expense) {
            return redirect(route("admin.expense.index"));
        }

        $admiko_data['sideBarActive'] = "expense";
		$admiko_data["sideBarActiveFolder"] = "_account";
        $admiko_data['formAction'] = route("admin.expense.update", [$Expense->id]);
        
        
        $data = $Expense;
        return view("admin.expense.manage")->with(compact('admiko_data', 'data'));
    }

    public function update(ExpenseRequest $request,$id)
    {
        if (Gate::none(['expense_allow', 'expense_edit'])) {
            return redirect(route("admin.expense.index"));
        }
        $data = $request->all();
        $Expense = Expense::find($id);
        $Expense->update($data);
        
        return redirect(route("admin.expense.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['expense_allow'])) {
            return redirect(route("admin.expense.index"));
        }
        Expense::destroy($request->idDel);
        return back();
    }
    
    
    
}
