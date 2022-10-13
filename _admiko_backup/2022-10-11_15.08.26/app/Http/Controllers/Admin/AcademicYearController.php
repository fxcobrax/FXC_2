<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\AcademicYear;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\AcademicYearRequest;
use Gate;

class AcademicYearController extends Controller
{

    public function index()
    {
        if (Gate::none(['academic_year_allow', 'academic_year_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "academic_year";
		$admiko_data["sideBarActiveFolder"] = "";
        
        $tableData = AcademicYear::orderByDesc("id")->get();
        return view("admin.academic_year.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['academic_year_allow'])) {
            return redirect(route("admin.academic_year.index"));
        }
        $admiko_data['sideBarActive'] = "academic_year";
		$admiko_data["sideBarActiveFolder"] = "";
        $admiko_data['formAction'] = route("admin.academic_year.store");
        
        
        return view("admin.academic_year.manage")->with(compact('admiko_data'));
    }

    public function store(AcademicYearRequest $request)
    {
        if (Gate::none(['academic_year_allow'])) {
            return redirect(route("admin.academic_year.index"));
        }
        $data = $request->all();
        
        $AcademicYear = AcademicYear::create($data);
        
        return redirect(route("admin.academic_year.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $AcademicYear = AcademicYear::find($id);
        if (Gate::none(['academic_year_allow', 'academic_year_edit']) || !$AcademicYear) {
            return redirect(route("admin.academic_year.index"));
        }

        $admiko_data['sideBarActive'] = "academic_year";
		$admiko_data["sideBarActiveFolder"] = "";
        $admiko_data['formAction'] = route("admin.academic_year.update", [$AcademicYear->id]);
        
        
        $data = $AcademicYear;
        return view("admin.academic_year.manage")->with(compact('admiko_data', 'data'));
    }

    public function update(AcademicYearRequest $request,$id)
    {
        if (Gate::none(['academic_year_allow', 'academic_year_edit'])) {
            return redirect(route("admin.academic_year.index"));
        }
        $data = $request->all();
        $AcademicYear = AcademicYear::find($id);
        $AcademicYear->update($data);
        
        return redirect(route("admin.academic_year.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['academic_year_allow'])) {
            return redirect(route("admin.academic_year.index"));
        }
        AcademicYear::destroy($request->idDel);
        return back();
    }
    
    
    
}
