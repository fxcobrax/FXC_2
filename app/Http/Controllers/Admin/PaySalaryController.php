<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\PaySalary;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\PaySalaryRequest;
use Gate;
use App\Models\Admin\Staffs;

class PaySalaryController extends Controller
{

    public function index()
    {
        if (Gate::none(['pay_salary_allow', 'pay_salary_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "pay_salary";
		$admiko_data["sideBarActiveFolder"] = "_account";
        
        $tableData = PaySalary::orderByDesc("id")->get();
        return view("admin.pay_salary.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['pay_salary_allow'])) {
            return redirect(route("admin.pay_salary.index"));
        }
        $admiko_data['sideBarActive'] = "pay_salary";
		$admiko_data["sideBarActiveFolder"] = "_account";
        $admiko_data['formAction'] = route("admin.pay_salary.store");
        
        
		$staffs_all = Staffs::all()->sortBy("full_name")->pluck("full_name", "id");
		$status_all = PaySalary::STATUS_CONS;
        return view("admin.pay_salary.manage")->with(compact('admiko_data','staffs_all','status_all'));
    }

    public function store(PaySalaryRequest $request)
    {
        if (Gate::none(['pay_salary_allow'])) {
            return redirect(route("admin.pay_salary.index"));
        }
        $data = $request->all();
        
        $PaySalary = PaySalary::create($data);
        
        return redirect(route("admin.pay_salary.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $PaySalary = PaySalary::find($id);
        if (Gate::none(['pay_salary_allow', 'pay_salary_edit']) || !$PaySalary) {
            return redirect(route("admin.pay_salary.index"));
        }

        $admiko_data['sideBarActive'] = "pay_salary";
		$admiko_data["sideBarActiveFolder"] = "_account";
        $admiko_data['formAction'] = route("admin.pay_salary.update", [$PaySalary->id]);
        
        
		$staffs_all = Staffs::all()->sortBy("full_name")->pluck("full_name", "id");
		$status_all = PaySalary::STATUS_CONS;
        $data = $PaySalary;
        return view("admin.pay_salary.manage")->with(compact('admiko_data', 'data','staffs_all','status_all'));
    }

    public function update(PaySalaryRequest $request,$id)
    {
        if (Gate::none(['pay_salary_allow', 'pay_salary_edit'])) {
            return redirect(route("admin.pay_salary.index"));
        }
        $data = $request->all();
        $PaySalary = PaySalary::find($id);
        $PaySalary->update($data);
        
        return redirect(route("admin.pay_salary.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['pay_salary_allow'])) {
            return redirect(route("admin.pay_salary.index"));
        }
        PaySalary::destroy($request->idDel);
        return back();
    }
    
    
    
}
