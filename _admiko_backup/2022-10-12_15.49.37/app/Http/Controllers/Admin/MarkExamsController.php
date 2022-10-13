<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\MarkExams;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\MarkExamsRequest;
use Gate;
use App\Models\Admin\Examination;
use App\Models\Admin\StudentsList;

class MarkExamsController extends Controller
{

    public function index()
    {
        if (Gate::none(['mark_exams_allow', 'mark_exams_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "mark_exams";
		$admiko_data["sideBarActiveFolder"] = "dropdown_class_activities";
        
        $tableData = MarkExams::orderByDesc("id")->get();
        return view("admin.mark_exams.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['mark_exams_allow'])) {
            return redirect(route("admin.mark_exams.index"));
        }
        $admiko_data['sideBarActive'] = "mark_exams";
		$admiko_data["sideBarActiveFolder"] = "dropdown_class_activities";
        $admiko_data['formAction'] = route("admin.mark_exams.store");
        
        
		$examination_all = Examination::all()->sortBy("exams_name")->pluck("exams_name", "id");
		$students_list_all = StudentsList::all()->sortBy("first_name")->pluck("first_name", "id");
        return view("admin.mark_exams.manage")->with(compact('admiko_data','examination_all','students_list_all'));
    }

    public function store(MarkExamsRequest $request)
    {
        if (Gate::none(['mark_exams_allow'])) {
            return redirect(route("admin.mark_exams.index"));
        }
        $data = $request->all();
        
        $MarkExams = MarkExams::create($data);
        
        return redirect(route("admin.mark_exams.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $MarkExams = MarkExams::find($id);
        if (Gate::none(['mark_exams_allow', 'mark_exams_edit']) || !$MarkExams) {
            return redirect(route("admin.mark_exams.index"));
        }

        $admiko_data['sideBarActive'] = "mark_exams";
		$admiko_data["sideBarActiveFolder"] = "dropdown_class_activities";
        $admiko_data['formAction'] = route("admin.mark_exams.update", [$MarkExams->id]);
        
        
		$examination_all = Examination::all()->sortBy("exams_name")->pluck("exams_name", "id");
		$students_list_all = StudentsList::all()->sortBy("first_name")->pluck("first_name", "id");
        $data = $MarkExams;
        return view("admin.mark_exams.manage")->with(compact('admiko_data', 'data','examination_all','students_list_all'));
    }

    public function update(MarkExamsRequest $request,$id)
    {
        if (Gate::none(['mark_exams_allow', 'mark_exams_edit'])) {
            return redirect(route("admin.mark_exams.index"));
        }
        $data = $request->all();
        $MarkExams = MarkExams::find($id);
        $MarkExams->update($data);
        
        return redirect(route("admin.mark_exams.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['mark_exams_allow'])) {
            return redirect(route("admin.mark_exams.index"));
        }
        MarkExams::destroy($request->idDel);
        return back();
    }
    
    
    
}
