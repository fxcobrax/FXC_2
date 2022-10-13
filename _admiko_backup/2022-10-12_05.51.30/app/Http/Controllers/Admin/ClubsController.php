<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Clubs;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ClubsRequest;
use Gate;

class ClubsController extends Controller
{

    public function index()
    {
        if (Gate::none(['clubs_allow', 'clubs_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "clubs";
		$admiko_data["sideBarActiveFolder"] = "dropdown_facilities";
        
        $tableData = Clubs::orderByDesc("id")->get();
        return view("admin.clubs.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['clubs_allow'])) {
            return redirect(route("admin.clubs.index"));
        }
        $admiko_data['sideBarActive'] = "clubs";
		$admiko_data["sideBarActiveFolder"] = "dropdown_facilities";
        $admiko_data['formAction'] = route("admin.clubs.store");
        
        
        return view("admin.clubs.manage")->with(compact('admiko_data'));
    }

    public function store(ClubsRequest $request)
    {
        if (Gate::none(['clubs_allow'])) {
            return redirect(route("admin.clubs.index"));
        }
        $data = $request->all();
        
        $Clubs = Clubs::create($data);
        
        return redirect(route("admin.clubs.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $Clubs = Clubs::find($id);
        if (Gate::none(['clubs_allow', 'clubs_edit']) || !$Clubs) {
            return redirect(route("admin.clubs.index"));
        }

        $admiko_data['sideBarActive'] = "clubs";
		$admiko_data["sideBarActiveFolder"] = "dropdown_facilities";
        $admiko_data['formAction'] = route("admin.clubs.update", [$Clubs->id]);
        
        
        $data = $Clubs;
        return view("admin.clubs.manage")->with(compact('admiko_data', 'data'));
    }

    public function update(ClubsRequest $request,$id)
    {
        if (Gate::none(['clubs_allow', 'clubs_edit'])) {
            return redirect(route("admin.clubs.index"));
        }
        $data = $request->all();
        $Clubs = Clubs::find($id);
        $Clubs->update($data);
        
        return redirect(route("admin.clubs.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['clubs_allow'])) {
            return redirect(route("admin.clubs.index"));
        }
        Clubs::destroy($request->idDel);
        return back();
    }
    
    
    
}
