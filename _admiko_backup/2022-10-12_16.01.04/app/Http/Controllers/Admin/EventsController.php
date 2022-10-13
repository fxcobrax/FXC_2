<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Events;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\EventsRequest;
use Gate;

class EventsController extends Controller
{

    public function index()
    {
        if (Gate::none(['events_allow', 'events_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "events";
		$admiko_data["sideBarActiveFolder"] = "dropdown_communicate";
        
        $tableData = Events::orderByDesc("id")->get();
        return view("admin.events.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['events_allow'])) {
            return redirect(route("admin.events.index"));
        }
        $admiko_data['sideBarActive'] = "events";
		$admiko_data["sideBarActiveFolder"] = "dropdown_communicate";
        $admiko_data['formAction'] = route("admin.events.store");
        
        
        return view("admin.events.manage")->with(compact('admiko_data'));
    }

    public function store(EventsRequest $request)
    {
        if (Gate::none(['events_allow'])) {
            return redirect(route("admin.events.index"));
        }
        $data = $request->all();
        
        $Events = Events::create($data);
        
        return redirect(route("admin.events.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $Events = Events::find($id);
        if (Gate::none(['events_allow', 'events_edit']) || !$Events) {
            return redirect(route("admin.events.index"));
        }

        $admiko_data['sideBarActive'] = "events";
		$admiko_data["sideBarActiveFolder"] = "dropdown_communicate";
        $admiko_data['formAction'] = route("admin.events.update", [$Events->id]);
        
        
        $data = $Events;
        return view("admin.events.manage")->with(compact('admiko_data', 'data'));
    }

    public function update(EventsRequest $request,$id)
    {
        if (Gate::none(['events_allow', 'events_edit'])) {
            return redirect(route("admin.events.index"));
        }
        $data = $request->all();
        $Events = Events::find($id);
        $Events->update($data);
        
        return redirect(route("admin.events.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['events_allow'])) {
            return redirect(route("admin.events.index"));
        }
        Events::destroy($request->idDel);
        return back();
    }
    
    
    
}
