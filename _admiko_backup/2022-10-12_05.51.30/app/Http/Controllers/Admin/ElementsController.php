<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Elements;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ElementsRequest;
use Gate;

class ElementsController extends Controller
{

    public function index()
    {
        if (Gate::none(['elements_allow', 'elements_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "elements";
		$admiko_data["sideBarActiveFolder"] = "";
        
        $tableData = Elements::orderByDesc("id")->get();
        return view("admin.elements.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['elements_allow'])) {
            return redirect(route("admin.elements.index"));
        }
        $admiko_data['sideBarActive'] = "elements";
		$admiko_data["sideBarActiveFolder"] = "";
        $admiko_data['formAction'] = route("admin.elements.store");
        
        
        return view("admin.elements.manage")->with(compact('admiko_data'));
    }

    public function store(ElementsRequest $request)
    {
        if (Gate::none(['elements_allow'])) {
            return redirect(route("admin.elements.index"));
        }
        $data = $request->all();
        
        $Elements = Elements::create($data);
        
        return redirect(route("admin.elements.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $Elements = Elements::find($id);
        if (Gate::none(['elements_allow', 'elements_edit']) || !$Elements) {
            return redirect(route("admin.elements.index"));
        }

        $admiko_data['sideBarActive'] = "elements";
		$admiko_data["sideBarActiveFolder"] = "";
        $admiko_data['formAction'] = route("admin.elements.update", [$Elements->id]);
        
        
        $data = $Elements;
        return view("admin.elements.manage")->with(compact('admiko_data', 'data'));
    }

    public function update(ElementsRequest $request,$id)
    {
        if (Gate::none(['elements_allow', 'elements_edit'])) {
            return redirect(route("admin.elements.index"));
        }
        $data = $request->all();
        $Elements = Elements::find($id);
        $Elements->update($data);
        
        return redirect(route("admin.elements.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['elements_allow'])) {
            return redirect(route("admin.elements.index"));
        }
        Elements::destroy($request->idDel);
        return back();
    }
    
    
    
}
