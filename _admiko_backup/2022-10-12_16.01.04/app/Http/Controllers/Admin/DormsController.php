<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Dorms;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\DormsRequest;
use Gate;
use App\Models\Admin\DormType;

class DormsController extends Controller
{

    public function index()
    {
        if (Gate::none(['dorms_allow', 'dorms_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "dorms";
		$admiko_data["sideBarActiveFolder"] = "dropdown_dormitory";
        
        $tableData = Dorms::orderByDesc("id")->get();
        return view("admin.dorms.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['dorms_allow'])) {
            return redirect(route("admin.dorms.index"));
        }
        $admiko_data['sideBarActive'] = "dorms";
		$admiko_data["sideBarActiveFolder"] = "dropdown_dormitory";
        $admiko_data['formAction'] = route("admin.dorms.store");
        
        
		$dorm_type_all = DormType::all()->sortBy("dorm_type")->pluck("dorm_type", "id");
        return view("admin.dorms.manage")->with(compact('admiko_data','dorm_type_all'));
    }

    public function store(DormsRequest $request)
    {
        if (Gate::none(['dorms_allow'])) {
            return redirect(route("admin.dorms.index"));
        }
        $data = $request->all();
        
        $Dorms = Dorms::create($data);
        
        return redirect(route("admin.dorms.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $Dorms = Dorms::find($id);
        if (Gate::none(['dorms_allow', 'dorms_edit']) || !$Dorms) {
            return redirect(route("admin.dorms.index"));
        }

        $admiko_data['sideBarActive'] = "dorms";
		$admiko_data["sideBarActiveFolder"] = "dropdown_dormitory";
        $admiko_data['formAction'] = route("admin.dorms.update", [$Dorms->id]);
        
        
		$dorm_type_all = DormType::all()->sortBy("dorm_type")->pluck("dorm_type", "id");
        $data = $Dorms;
        return view("admin.dorms.manage")->with(compact('admiko_data', 'data','dorm_type_all'));
    }

    public function update(DormsRequest $request,$id)
    {
        if (Gate::none(['dorms_allow', 'dorms_edit'])) {
            return redirect(route("admin.dorms.index"));
        }
        $data = $request->all();
        $Dorms = Dorms::find($id);
        $Dorms->update($data);
        
        return redirect(route("admin.dorms.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['dorms_allow'])) {
            return redirect(route("admin.dorms.index"));
        }
        Dorms::destroy($request->idDel);
        return back();
    }
    
    
    
}
