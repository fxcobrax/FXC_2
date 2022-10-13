<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\BookType;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\BookTypeRequest;
use Gate;
use App\Models\Admin\BookCategory;

class BookTypeController extends Controller
{

    public function index()
    {
        if (Gate::none(['book_type_allow', 'book_type_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "book_type";
		$admiko_data["sideBarActiveFolder"] = "dropdown_library";
        
        $tableData = BookType::orderByDesc("id")->get();
        return view("admin.book_type.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['book_type_allow'])) {
            return redirect(route("admin.book_type.index"));
        }
        $admiko_data['sideBarActive'] = "book_type";
		$admiko_data["sideBarActiveFolder"] = "dropdown_library";
        $admiko_data['formAction'] = route("admin.book_type.store");
        
        
		$book_category_all = BookCategory::all()->sortBy("category_name")->pluck("category_name", "id");
        return view("admin.book_type.manage")->with(compact('admiko_data','book_category_all'));
    }

    public function store(BookTypeRequest $request)
    {
        if (Gate::none(['book_type_allow'])) {
            return redirect(route("admin.book_type.index"));
        }
        $data = $request->all();
        
        $BookType = BookType::create($data);
        
        return redirect(route("admin.book_type.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $BookType = BookType::find($id);
        if (Gate::none(['book_type_allow', 'book_type_edit']) || !$BookType) {
            return redirect(route("admin.book_type.index"));
        }

        $admiko_data['sideBarActive'] = "book_type";
		$admiko_data["sideBarActiveFolder"] = "dropdown_library";
        $admiko_data['formAction'] = route("admin.book_type.update", [$BookType->id]);
        
        
		$book_category_all = BookCategory::all()->sortBy("category_name")->pluck("category_name", "id");
        $data = $BookType;
        return view("admin.book_type.manage")->with(compact('admiko_data', 'data','book_category_all'));
    }

    public function update(BookTypeRequest $request,$id)
    {
        if (Gate::none(['book_type_allow', 'book_type_edit'])) {
            return redirect(route("admin.book_type.index"));
        }
        $data = $request->all();
        $BookType = BookType::find($id);
        $BookType->update($data);
        
        return redirect(route("admin.book_type.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['book_type_allow'])) {
            return redirect(route("admin.book_type.index"));
        }
        BookType::destroy($request->idDel);
        return back();
    }
    
    
    
}
