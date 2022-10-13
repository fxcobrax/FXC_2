<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\MarkExercise;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\MarkExerciseRequest;
use Gate;
use App\Models\Admin\StudentsList;
use App\Models\Admin\Exercise;

class MarkExerciseController extends Controller
{

    public function index()
    {
        if (Gate::none(['mark_exercise_allow', 'mark_exercise_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "mark_exercise";
		$admiko_data["sideBarActiveFolder"] = "dropdown_class_activities";
        
        $tableData = MarkExercise::orderByDesc("id")->get();
        return view("admin.mark_exercise.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['mark_exercise_allow'])) {
            return redirect(route("admin.mark_exercise.index"));
        }
        $admiko_data['sideBarActive'] = "mark_exercise";
		$admiko_data["sideBarActiveFolder"] = "dropdown_class_activities";
        $admiko_data['formAction'] = route("admin.mark_exercise.store");
        
        
		$students_list_all = StudentsList::all()->sortBy("first_name")->pluck("first_name", "id");
		$exercise_all = Exercise::all()->sortBy("exercise_name")->pluck("exercise_name", "id");
        return view("admin.mark_exercise.manage")->with(compact('admiko_data','students_list_all','exercise_all'));
    }

    public function store(MarkExerciseRequest $request)
    {
        if (Gate::none(['mark_exercise_allow'])) {
            return redirect(route("admin.mark_exercise.index"));
        }
        $data = $request->all();
        
        $MarkExercise = MarkExercise::create($data);
        
        return redirect(route("admin.mark_exercise.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $MarkExercise = MarkExercise::find($id);
        if (Gate::none(['mark_exercise_allow', 'mark_exercise_edit']) || !$MarkExercise) {
            return redirect(route("admin.mark_exercise.index"));
        }

        $admiko_data['sideBarActive'] = "mark_exercise";
		$admiko_data["sideBarActiveFolder"] = "dropdown_class_activities";
        $admiko_data['formAction'] = route("admin.mark_exercise.update", [$MarkExercise->id]);
        
        
		$students_list_all = StudentsList::all()->sortBy("first_name")->pluck("first_name", "id");
		$exercise_all = Exercise::all()->sortBy("exercise_name")->pluck("exercise_name", "id");
        $data = $MarkExercise;
        return view("admin.mark_exercise.manage")->with(compact('admiko_data', 'data','students_list_all','exercise_all'));
    }

    public function update(MarkExerciseRequest $request,$id)
    {
        if (Gate::none(['mark_exercise_allow', 'mark_exercise_edit'])) {
            return redirect(route("admin.mark_exercise.index"));
        }
        $data = $request->all();
        $MarkExercise = MarkExercise::find($id);
        $MarkExercise->update($data);
        
        return redirect(route("admin.mark_exercise.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['mark_exercise_allow'])) {
            return redirect(route("admin.mark_exercise.index"));
        }
        MarkExercise::destroy($request->idDel);
        return back();
    }
    
    
    
}
