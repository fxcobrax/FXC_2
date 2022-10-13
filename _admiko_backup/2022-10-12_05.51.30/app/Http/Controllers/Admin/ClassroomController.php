<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Classroom;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ClassroomRequest;
use Gate;

class ClassroomController extends Controller
{

    public function index()
    {
        if (Gate::none(['classroom_allow', 'classroom_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "classroom";
		$admiko_data["sideBarActiveFolder"] = "dropdown_academics";
        
        $tableData = Classroom::orderByDesc("id")->get();
        return view("admin.classroom.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['classroom_allow'])) {
            return redirect(route("admin.classroom.index"));
        }
        $admiko_data['sideBarActive'] = "classroom";
		$admiko_data["sideBarActiveFolder"] = "dropdown_academics";
        $admiko_data['formAction'] = route("admin.classroom.store");
        
        
        return view("admin.classroom.manage")->with(compact('admiko_data'));
    }

    public function store(ClassroomRequest $request)
    {
        if (Gate::none(['classroom_allow'])) {
            return redirect(route("admin.classroom.index"));
        }
        $data = $request->all();
        
        $Classroom = Classroom::create($data);
        
        return redirect(route("admin.classroom.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $Classroom = Classroom::find($id);
        if (Gate::none(['classroom_allow', 'classroom_edit']) || !$Classroom) {
            return redirect(route("admin.classroom.index"));
        }

        $admiko_data['sideBarActive'] = "classroom";
		$admiko_data["sideBarActiveFolder"] = "dropdown_academics";
        $admiko_data['formAction'] = route("admin.classroom.update", [$Classroom->id]);
        
        
        $data = $Classroom;
        return view("admin.classroom.manage")->with(compact('admiko_data', 'data'));
    }

    public function update(ClassroomRequest $request,$id)
    {
        if (Gate::none(['classroom_allow', 'classroom_edit'])) {
            return redirect(route("admin.classroom.index"));
        }
        $data = $request->all();
        $Classroom = Classroom::find($id);
        $Classroom->update($data);
        
        return redirect(route("admin.classroom.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['classroom_allow'])) {
            return redirect(route("admin.classroom.index"));
        }
        Classroom::destroy($request->idDel);
        return back();
    }
    
    
    
}
