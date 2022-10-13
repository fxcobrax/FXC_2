<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Subjects;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\SubjectsRequest;
use Gate;

class SubjectsController extends Controller
{

    public function index()
    {
        if (Gate::none(['subjects_allow', 'subjects_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "subjects";
		$admiko_data["sideBarActiveFolder"] = "dropdown_academics";
        
        $tableData = Subjects::orderByDesc("id")->get();
        return view("admin.subjects.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['subjects_allow'])) {
            return redirect(route("admin.subjects.index"));
        }
        $admiko_data['sideBarActive'] = "subjects";
		$admiko_data["sideBarActiveFolder"] = "dropdown_academics";
        $admiko_data['formAction'] = route("admin.subjects.store");
        
        
        return view("admin.subjects.manage")->with(compact('admiko_data'));
    }

    public function store(SubjectsRequest $request)
    {
        if (Gate::none(['subjects_allow'])) {
            return redirect(route("admin.subjects.index"));
        }
        $data = $request->all();
        
        $Subjects = Subjects::create($data);
        
        return redirect(route("admin.subjects.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $Subjects = Subjects::find($id);
        if (Gate::none(['subjects_allow', 'subjects_edit']) || !$Subjects) {
            return redirect(route("admin.subjects.index"));
        }

        $admiko_data['sideBarActive'] = "subjects";
		$admiko_data["sideBarActiveFolder"] = "dropdown_academics";
        $admiko_data['formAction'] = route("admin.subjects.update", [$Subjects->id]);
        
        
        $data = $Subjects;
        return view("admin.subjects.manage")->with(compact('admiko_data', 'data'));
    }

    public function update(SubjectsRequest $request,$id)
    {
        if (Gate::none(['subjects_allow', 'subjects_edit'])) {
            return redirect(route("admin.subjects.index"));
        }
        $data = $request->all();
        $Subjects = Subjects::find($id);
        $Subjects->update($data);
        
        return redirect(route("admin.subjects.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['subjects_allow'])) {
            return redirect(route("admin.subjects.index"));
        }
        Subjects::destroy($request->idDel);
        return back();
    }
    
    
    
}
