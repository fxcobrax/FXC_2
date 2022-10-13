<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Signexeat1;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Signexeat1Request;
use Gate;
use App\Models\Admin\StudentsList;

class Signexeat1Controller extends Controller
{

    public function index()
    {
        if (Gate::none(['signexeat1_allow', 'signexeat1_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "signexeat1";
		$admiko_data["sideBarActiveFolder"] = "dropdown_leave";
        
        $tableData = Signexeat1::orderByDesc("id")->get();
        return view("admin.signexeat1.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['signexeat1_allow'])) {
            return redirect(route("admin.signexeat1.index"));
        }
        $admiko_data['sideBarActive'] = "signexeat1";
		$admiko_data["sideBarActiveFolder"] = "dropdown_leave";
        $admiko_data['formAction'] = route("admin.signexeat1.store");
        
        
		$students_list_all = StudentsList::all()->sortBy("first_name")->pluck("first_name", "id");
        return view("admin.signexeat1.manage")->with(compact('admiko_data','students_list_all'));
    }

    public function store(Signexeat1Request $request)
    {
        if (Gate::none(['signexeat1_allow'])) {
            return redirect(route("admin.signexeat1.index"));
        }
        $data = $request->all();
        
        $Signexeat1 = Signexeat1::create($data);
        
        return redirect(route("admin.signexeat1.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $Signexeat1 = Signexeat1::find($id);
        if (Gate::none(['signexeat1_allow', 'signexeat1_edit']) || !$Signexeat1) {
            return redirect(route("admin.signexeat1.index"));
        }

        $admiko_data['sideBarActive'] = "signexeat1";
		$admiko_data["sideBarActiveFolder"] = "dropdown_leave";
        $admiko_data['formAction'] = route("admin.signexeat1.update", [$Signexeat1->id]);
        
        
		$students_list_all = StudentsList::all()->sortBy("first_name")->pluck("first_name", "id");
        $data = $Signexeat1;
        return view("admin.signexeat1.manage")->with(compact('admiko_data', 'data','students_list_all'));
    }

    public function update(Signexeat1Request $request,$id)
    {
        if (Gate::none(['signexeat1_allow', 'signexeat1_edit'])) {
            return redirect(route("admin.signexeat1.index"));
        }
        $data = $request->all();
        $Signexeat1 = Signexeat1::find($id);
        $Signexeat1->update($data);
        
        return redirect(route("admin.signexeat1.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['signexeat1_allow'])) {
            return redirect(route("admin.signexeat1.index"));
        }
        Signexeat1::destroy($request->idDel);
        return back();
    }
    
    
    
}
