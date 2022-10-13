<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\FeePayment;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\FeePaymentRequest;
use Gate;
use App\Models\Admin\FeeType;
use App\Models\Admin\StudentsList;
use App\Models\Admin\Elements;

class FeePaymentController extends Controller
{

    public function index()
    {
        if (Gate::none(['fee_payment_allow', 'fee_payment_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "fee_payment";
		$admiko_data["sideBarActiveFolder"] = "dropdown_fees";
        
        $tableData = FeePayment::orderByDesc("id")->get();
        return view("admin.fee_payment.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['fee_payment_allow'])) {
            return redirect(route("admin.fee_payment.index"));
        }
        $admiko_data['sideBarActive'] = "fee_payment";
		$admiko_data["sideBarActiveFolder"] = "dropdown_fees";
        $admiko_data['formAction'] = route("admin.fee_payment.store");
        
        
		$fee_type_all = FeeType::all()->sortBy("type_name")->pluck("type_name", "id");
		$students_list_all = StudentsList::all()->sortBy("first_name")->pluck("first_name", "id");
		$elements_all = Elements::all()->sortBy("feestatus")->pluck("feestatus", "id");
        return view("admin.fee_payment.manage")->with(compact('admiko_data','fee_type_all','students_list_all','elements_all'));
    }

    public function store(FeePaymentRequest $request)
    {
        if (Gate::none(['fee_payment_allow'])) {
            return redirect(route("admin.fee_payment.index"));
        }
        $data = $request->all();
        
        $FeePayment = FeePayment::create($data);
        
        return redirect(route("admin.fee_payment.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $FeePayment = FeePayment::find($id);
        if (Gate::none(['fee_payment_allow', 'fee_payment_edit']) || !$FeePayment) {
            return redirect(route("admin.fee_payment.index"));
        }

        $admiko_data['sideBarActive'] = "fee_payment";
		$admiko_data["sideBarActiveFolder"] = "dropdown_fees";
        $admiko_data['formAction'] = route("admin.fee_payment.update", [$FeePayment->id]);
        
        
		$fee_type_all = FeeType::all()->sortBy("type_name")->pluck("type_name", "id");
		$students_list_all = StudentsList::all()->sortBy("first_name")->pluck("first_name", "id");
		$elements_all = Elements::all()->sortBy("feestatus")->pluck("feestatus", "id");
        $data = $FeePayment;
        return view("admin.fee_payment.manage")->with(compact('admiko_data', 'data','fee_type_all','students_list_all','elements_all'));
    }

    public function update(FeePaymentRequest $request,$id)
    {
        if (Gate::none(['fee_payment_allow', 'fee_payment_edit'])) {
            return redirect(route("admin.fee_payment.index"));
        }
        $data = $request->all();
        $FeePayment = FeePayment::find($id);
        $FeePayment->update($data);
        
        return redirect(route("admin.fee_payment.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['fee_payment_allow'])) {
            return redirect(route("admin.fee_payment.index"));
        }
        FeePayment::destroy($request->idDel);
        return back();
    }
    
    
    
}
