<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Classtest;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ClasstestRequest;
use Gate;
use App\Models\Admin\Classes;
use App\Models\Admin\Subjects;

class ClasstestController extends Controller
{

    public function index()
    {
        if (Gate::none(['classtest_allow', 'classtest_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "classtest";
		$admiko_data["sideBarActiveFolder"] = "dropdown_class_activities";
        
        $tableData = Classtest::orderByDesc("id")->get();
        return view("admin.classtest.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['classtest_allow'])) {
            return redirect(route("admin.classtest.index"));
        }
        $admiko_data['sideBarActive'] = "classtest";
		$admiko_data["sideBarActiveFolder"] = "dropdown_class_activities";
        $admiko_data['formAction'] = route("admin.classtest.store");
        
        
		$classes_all = Classes::all()->sortBy("class_name")->pluck("class_name", "id");
		$subjects_all = Subjects::all()->sortBy("sudject_name")->pluck("sudject_name", "id");
        return view("admin.classtest.manage")->with(compact('admiko_data','classes_all','subjects_all'));
    }

    public function store(ClasstestRequest $request)
    {
        if (Gate::none(['classtest_allow'])) {
            return redirect(route("admin.classtest.index"));
        }
        $data = $request->all();
        
        $Classtest = Classtest::create($data);
        
        return redirect(route("admin.classtest.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $Classtest = Classtest::find($id);
        if (Gate::none(['classtest_allow', 'classtest_edit']) || !$Classtest) {
            return redirect(route("admin.classtest.index"));
        }

        $admiko_data['sideBarActive'] = "classtest";
		$admiko_data["sideBarActiveFolder"] = "dropdown_class_activities";
        $admiko_data['formAction'] = route("admin.classtest.update", [$Classtest->id]);
        
        
		$classes_all = Classes::all()->sortBy("class_name")->pluck("class_name", "id");
		$subjects_all = Subjects::all()->sortBy("sudject_name")->pluck("sudject_name", "id");
        $data = $Classtest;
        return view("admin.classtest.manage")->with(compact('admiko_data', 'data','classes_all','subjects_all'));
    }

    public function update(ClasstestRequest $request,$id)
    {
        if (Gate::none(['classtest_allow', 'classtest_edit'])) {
            return redirect(route("admin.classtest.index"));
        }
        $data = $request->all();
        $Classtest = Classtest::find($id);
        $Classtest->update($data);
        
        return redirect(route("admin.classtest.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['classtest_allow'])) {
            return redirect(route("admin.classtest.index"));
        }
        Classtest::destroy($request->idDel);
        return back();
    }
    
    
    
}
