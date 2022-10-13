<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\TestPage;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\TestPageRequest;
use Gate;

class TestPageController extends Controller
{

    public function index()
    {
        if (Gate::none(['test_page_allow', 'test_page_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "test_page";
		$admiko_data["sideBarActiveFolder"] = "";
        
        $tableData = TestPage::orderByDesc("id")->get();
        return view("admin.test_page.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['test_page_allow'])) {
            return redirect(route("admin.test_page.index"));
        }
        $admiko_data['sideBarActive'] = "test_page";
		$admiko_data["sideBarActiveFolder"] = "";
        $admiko_data['formAction'] = route("admin.test_page.store");
        
        
        return view("admin.test_page.manage")->with(compact('admiko_data'));
    }

    public function store(TestPageRequest $request)
    {
        if (Gate::none(['test_page_allow'])) {
            return redirect(route("admin.test_page.index"));
        }
        $data = $request->all();
        
        $TestPage = TestPage::create($data);
        
        return redirect(route("admin.test_page.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $TestPage = TestPage::find($id);
        if (Gate::none(['test_page_allow', 'test_page_edit']) || !$TestPage) {
            return redirect(route("admin.test_page.index"));
        }

        $admiko_data['sideBarActive'] = "test_page";
		$admiko_data["sideBarActiveFolder"] = "";
        $admiko_data['formAction'] = route("admin.test_page.update", [$TestPage->id]);
        
        
        $data = $TestPage;
        return view("admin.test_page.manage")->with(compact('admiko_data', 'data'));
    }

    public function update(TestPageRequest $request,$id)
    {
        if (Gate::none(['test_page_allow', 'test_page_edit'])) {
            return redirect(route("admin.test_page.index"));
        }
        $data = $request->all();
        $TestPage = TestPage::find($id);
        $TestPage->update($data);
        
        return redirect(route("admin.test_page.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['test_page_allow'])) {
            return redirect(route("admin.test_page.index"));
        }
        TestPage::destroy($request->idDel);
        return back();
    }
    
    
    
}
