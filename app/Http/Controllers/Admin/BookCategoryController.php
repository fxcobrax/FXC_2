<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\BookCategory;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\BookCategoryRequest;
use Gate;

class BookCategoryController extends Controller
{

    public function index()
    {
        if (Gate::none(['book_category_allow', 'book_category_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "book_category";
		$admiko_data["sideBarActiveFolder"] = "dropdown_library";
        
        $tableData = BookCategory::orderByDesc("id")->get();
        return view("admin.book_category.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['book_category_allow'])) {
            return redirect(route("admin.book_category.index"));
        }
        $admiko_data['sideBarActive'] = "book_category";
		$admiko_data["sideBarActiveFolder"] = "dropdown_library";
        $admiko_data['formAction'] = route("admin.book_category.store");
        
        
        return view("admin.book_category.manage")->with(compact('admiko_data'));
    }

    public function store(BookCategoryRequest $request)
    {
        if (Gate::none(['book_category_allow'])) {
            return redirect(route("admin.book_category.index"));
        }
        $data = $request->all();
        
        $BookCategory = BookCategory::create($data);
        
        return redirect(route("admin.book_category.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $BookCategory = BookCategory::find($id);
        if (Gate::none(['book_category_allow', 'book_category_edit']) || !$BookCategory) {
            return redirect(route("admin.book_category.index"));
        }

        $admiko_data['sideBarActive'] = "book_category";
		$admiko_data["sideBarActiveFolder"] = "dropdown_library";
        $admiko_data['formAction'] = route("admin.book_category.update", [$BookCategory->id]);
        
        
        $data = $BookCategory;
        return view("admin.book_category.manage")->with(compact('admiko_data', 'data'));
    }

    public function update(BookCategoryRequest $request,$id)
    {
        if (Gate::none(['book_category_allow', 'book_category_edit'])) {
            return redirect(route("admin.book_category.index"));
        }
        $data = $request->all();
        $BookCategory = BookCategory::find($id);
        $BookCategory->update($data);
        
        return redirect(route("admin.book_category.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['book_category_allow'])) {
            return redirect(route("admin.book_category.index"));
        }
        BookCategory::destroy($request->idDel);
        return back();
    }
    
    
    
}
