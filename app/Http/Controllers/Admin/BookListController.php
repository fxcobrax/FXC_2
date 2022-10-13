<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\BookList;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\BookListRequest;
use Gate;
use App\Models\Admin\BookType;

class BookListController extends Controller
{

    public function index()
    {
        if (Gate::none(['book_list_allow', 'book_list_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "book_list";
		$admiko_data["sideBarActiveFolder"] = "dropdown_library";
        
        $tableData = BookList::orderByDesc("id")->get();
        return view("admin.book_list.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['book_list_allow'])) {
            return redirect(route("admin.book_list.index"));
        }
        $admiko_data['sideBarActive'] = "book_list";
		$admiko_data["sideBarActiveFolder"] = "dropdown_library";
        $admiko_data['formAction'] = route("admin.book_list.store");
        
        
		$book_type_all = BookType::all()->sortBy("type_name")->pluck("type_name", "id");
        return view("admin.book_list.manage")->with(compact('admiko_data','book_type_all'));
    }

    public function store(BookListRequest $request)
    {
        if (Gate::none(['book_list_allow'])) {
            return redirect(route("admin.book_list.index"));
        }
        $data = $request->all();
        
        $BookList = BookList::create($data);
        
        return redirect(route("admin.book_list.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $BookList = BookList::find($id);
        if (Gate::none(['book_list_allow', 'book_list_edit']) || !$BookList) {
            return redirect(route("admin.book_list.index"));
        }

        $admiko_data['sideBarActive'] = "book_list";
		$admiko_data["sideBarActiveFolder"] = "dropdown_library";
        $admiko_data['formAction'] = route("admin.book_list.update", [$BookList->id]);
        
        
		$book_type_all = BookType::all()->sortBy("type_name")->pluck("type_name", "id");
        $data = $BookList;
        return view("admin.book_list.manage")->with(compact('admiko_data', 'data','book_type_all'));
    }

    public function update(BookListRequest $request,$id)
    {
        if (Gate::none(['book_list_allow', 'book_list_edit'])) {
            return redirect(route("admin.book_list.index"));
        }
        $data = $request->all();
        $BookList = BookList::find($id);
        $BookList->update($data);
        
        return redirect(route("admin.book_list.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['book_list_allow'])) {
            return redirect(route("admin.book_list.index"));
        }
        BookList::destroy($request->idDel);
        return back();
    }
    
    
    
}
