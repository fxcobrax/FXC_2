<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Examination;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ExaminationRequest;
use Gate;
use App\Models\Admin\Classes;
use App\Models\Admin\Subjects;

class ExaminationController extends Controller
{

    public function index()
    {
        if (Gate::none(['examination_allow', 'examination_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "examination";
		$admiko_data["sideBarActiveFolder"] = "dropdown_class_activities";
        
        $tableData = Examination::orderByDesc("id")->get();
        return view("admin.examination.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['examination_allow'])) {
            return redirect(route("admin.examination.index"));
        }
        $admiko_data['sideBarActive'] = "examination";
		$admiko_data["sideBarActiveFolder"] = "dropdown_class_activities";
        $admiko_data['formAction'] = route("admin.examination.store");
        
        
		$classes_all = Classes::all()->sortBy("class_name")->pluck("class_name", "id");
		$subjects_all = Subjects::all()->sortBy("sudject_name")->pluck("sudject_name", "id");
        return view("admin.examination.manage")->with(compact('admiko_data','classes_all','subjects_all'));
    }

    public function store(ExaminationRequest $request)
    {
        if (Gate::none(['examination_allow'])) {
            return redirect(route("admin.examination.index"));
        }
        $data = $request->all();
        
        $Examination = Examination::create($data);
        
        return redirect(route("admin.examination.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $Examination = Examination::find($id);
        if (Gate::none(['examination_allow', 'examination_edit']) || !$Examination) {
            return redirect(route("admin.examination.index"));
        }

        $admiko_data['sideBarActive'] = "examination";
		$admiko_data["sideBarActiveFolder"] = "dropdown_class_activities";
        $admiko_data['formAction'] = route("admin.examination.update", [$Examination->id]);
        
        
		$classes_all = Classes::all()->sortBy("class_name")->pluck("class_name", "id");
		$subjects_all = Subjects::all()->sortBy("sudject_name")->pluck("sudject_name", "id");
        $data = $Examination;
        return view("admin.examination.manage")->with(compact('admiko_data', 'data','classes_all','subjects_all'));
    }

    public function update(ExaminationRequest $request,$id)
    {
        if (Gate::none(['examination_allow', 'examination_edit'])) {
            return redirect(route("admin.examination.index"));
        }
        $data = $request->all();
        $Examination = Examination::find($id);
        $Examination->update($data);
        
        return redirect(route("admin.examination.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['examination_allow'])) {
            return redirect(route("admin.examination.index"));
        }
        Examination::destroy($request->idDel);
        return back();
    }
    
    
    
}
