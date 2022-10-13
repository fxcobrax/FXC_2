<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Classes;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ClassesRequest;
use Gate;
use App\Models\Admin\Classroom;

class ClassesController extends Controller
{

    public function index()
    {
        if (Gate::none(['classes_allow', 'classes_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "classes";
		$admiko_data["sideBarActiveFolder"] = "dropdown_academics";
        
        $tableData = Classes::orderByDesc("id")->get();
        return view("admin.classes.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['classes_allow'])) {
            return redirect(route("admin.classes.index"));
        }
        $admiko_data['sideBarActive'] = "classes";
		$admiko_data["sideBarActiveFolder"] = "dropdown_academics";
        $admiko_data['formAction'] = route("admin.classes.store");
        
        
		$classroom_all = Classroom::all()->sortBy("room_name")->pluck("room_name", "id");
        return view("admin.classes.manage")->with(compact('admiko_data','classroom_all'));
    }

    public function store(ClassesRequest $request)
    {
        if (Gate::none(['classes_allow'])) {
            return redirect(route("admin.classes.index"));
        }
        $data = $request->all();
        
        $Classes = Classes::create($data);
        
        return redirect(route("admin.classes.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $Classes = Classes::find($id);
        if (Gate::none(['classes_allow', 'classes_edit']) || !$Classes) {
            return redirect(route("admin.classes.index"));
        }

        $admiko_data['sideBarActive'] = "classes";
		$admiko_data["sideBarActiveFolder"] = "dropdown_academics";
        $admiko_data['formAction'] = route("admin.classes.update", [$Classes->id]);
        
        
		$classroom_all = Classroom::all()->sortBy("room_name")->pluck("room_name", "id");
        $data = $Classes;
        return view("admin.classes.manage")->with(compact('admiko_data', 'data','classroom_all'));
    }

    public function update(ClassesRequest $request,$id)
    {
        if (Gate::none(['classes_allow', 'classes_edit'])) {
            return redirect(route("admin.classes.index"));
        }
        $data = $request->all();
        $Classes = Classes::find($id);
        $Classes->update($data);
        
        return redirect(route("admin.classes.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['classes_allow'])) {
            return redirect(route("admin.classes.index"));
        }
        Classes::destroy($request->idDel);
        return back();
    }
    
    
    
}
