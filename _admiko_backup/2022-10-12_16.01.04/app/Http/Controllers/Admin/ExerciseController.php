<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Exercise;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ExerciseRequest;
use Gate;
use App\Models\Admin\Classes;
use App\Models\Admin\Subjects;

class ExerciseController extends Controller
{

    public function index()
    {
        if (Gate::none(['exercise_allow', 'exercise_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "exercise";
		$admiko_data["sideBarActiveFolder"] = "dropdown_class_activities";
        
        $tableData = Exercise::orderByDesc("id")->get();
        return view("admin.exercise.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['exercise_allow'])) {
            return redirect(route("admin.exercise.index"));
        }
        $admiko_data['sideBarActive'] = "exercise";
		$admiko_data["sideBarActiveFolder"] = "dropdown_class_activities";
        $admiko_data['formAction'] = route("admin.exercise.store");
        
        
		$classes_all = Classes::all()->sortBy("class_name")->pluck("class_name", "id");
		$subjects_all = Subjects::all()->sortBy("sudject_name")->pluck("sudject_name", "id");
        return view("admin.exercise.manage")->with(compact('admiko_data','classes_all','subjects_all'));
    }

    public function store(ExerciseRequest $request)
    {
        if (Gate::none(['exercise_allow'])) {
            return redirect(route("admin.exercise.index"));
        }
        $data = $request->all();
        
        $Exercise = Exercise::create($data);
        
        return redirect(route("admin.exercise.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $Exercise = Exercise::find($id);
        if (Gate::none(['exercise_allow', 'exercise_edit']) || !$Exercise) {
            return redirect(route("admin.exercise.index"));
        }

        $admiko_data['sideBarActive'] = "exercise";
		$admiko_data["sideBarActiveFolder"] = "dropdown_class_activities";
        $admiko_data['formAction'] = route("admin.exercise.update", [$Exercise->id]);
        
        
		$classes_all = Classes::all()->sortBy("class_name")->pluck("class_name", "id");
		$subjects_all = Subjects::all()->sortBy("sudject_name")->pluck("sudject_name", "id");
        $data = $Exercise;
        return view("admin.exercise.manage")->with(compact('admiko_data', 'data','classes_all','subjects_all'));
    }

    public function update(ExerciseRequest $request,$id)
    {
        if (Gate::none(['exercise_allow', 'exercise_edit'])) {
            return redirect(route("admin.exercise.index"));
        }
        $data = $request->all();
        $Exercise = Exercise::find($id);
        $Exercise->update($data);
        
        return redirect(route("admin.exercise.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['exercise_allow'])) {
            return redirect(route("admin.exercise.index"));
        }
        Exercise::destroy($request->idDel);
        return back();
    }
    
    
    
}
