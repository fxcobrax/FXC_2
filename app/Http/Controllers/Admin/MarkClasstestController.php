<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\MarkClasstest;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\MarkClasstestRequest;
use Gate;
use App\Models\Admin\Classtest;
use App\Models\Admin\StudentsList;

class MarkClasstestController extends Controller
{

    public function index()
    {
        if (Gate::none(['mark_classtest_allow', 'mark_classtest_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "mark_classtest";
		$admiko_data["sideBarActiveFolder"] = "dropdown_class_activities";
        
        $tableData = MarkClasstest::orderByDesc("id")->get();
        return view("admin.mark_classtest.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['mark_classtest_allow'])) {
            return redirect(route("admin.mark_classtest.index"));
        }
        $admiko_data['sideBarActive'] = "mark_classtest";
		$admiko_data["sideBarActiveFolder"] = "dropdown_class_activities";
        $admiko_data['formAction'] = route("admin.mark_classtest.store");
        
        
		$classtest_all = Classtest::all()->sortBy("test_name")->pluck("test_name", "id");
		$students_list_all = StudentsList::all()->sortBy("first_name")->pluck("first_name", "id");
        return view("admin.mark_classtest.manage")->with(compact('admiko_data','classtest_all','students_list_all'));
    }

    public function store(MarkClasstestRequest $request)
    {
        if (Gate::none(['mark_classtest_allow'])) {
            return redirect(route("admin.mark_classtest.index"));
        }
        $data = $request->all();
        
        $MarkClasstest = MarkClasstest::create($data);
        
        return redirect(route("admin.mark_classtest.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $MarkClasstest = MarkClasstest::find($id);
        if (Gate::none(['mark_classtest_allow', 'mark_classtest_edit']) || !$MarkClasstest) {
            return redirect(route("admin.mark_classtest.index"));
        }

        $admiko_data['sideBarActive'] = "mark_classtest";
		$admiko_data["sideBarActiveFolder"] = "dropdown_class_activities";
        $admiko_data['formAction'] = route("admin.mark_classtest.update", [$MarkClasstest->id]);
        
        
		$classtest_all = Classtest::all()->sortBy("test_name")->pluck("test_name", "id");
		$students_list_all = StudentsList::all()->sortBy("first_name")->pluck("first_name", "id");
        $data = $MarkClasstest;
        return view("admin.mark_classtest.manage")->with(compact('admiko_data', 'data','classtest_all','students_list_all'));
    }

    public function update(MarkClasstestRequest $request,$id)
    {
        if (Gate::none(['mark_classtest_allow', 'mark_classtest_edit'])) {
            return redirect(route("admin.mark_classtest.index"));
        }
        $data = $request->all();
        $MarkClasstest = MarkClasstest::find($id);
        $MarkClasstest->update($data);
        
        return redirect(route("admin.mark_classtest.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['mark_classtest_allow'])) {
            return redirect(route("admin.mark_classtest.index"));
        }
        MarkClasstest::destroy($request->idDel);
        return back();
    }
    
    
    
}
