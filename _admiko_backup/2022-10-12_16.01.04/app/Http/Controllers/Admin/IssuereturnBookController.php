<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\IssuereturnBook;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\IssuereturnBookRequest;
use Gate;
use App\Models\Admin\BookList;
use App\Models\Admin\StudentsList;

class IssuereturnBookController extends Controller
{

    public function index()
    {
        if (Gate::none(['issuereturn_book_allow', 'issuereturn_book_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "issuereturn_book";
		$admiko_data["sideBarActiveFolder"] = "dropdown_library";
        
        $tableData = IssuereturnBook::orderByDesc("id")->get();
        return view("admin.issuereturn_book.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['issuereturn_book_allow'])) {
            return redirect(route("admin.issuereturn_book.index"));
        }
        $admiko_data['sideBarActive'] = "issuereturn_book";
		$admiko_data["sideBarActiveFolder"] = "dropdown_library";
        $admiko_data['formAction'] = route("admin.issuereturn_book.store");
        
        
		$book_list_all = BookList::all()->sortBy("book_name")->pluck("book_name", "id");
		$students_list_all = StudentsList::all()->sortBy("first_name")->pluck("first_name", "id");
		$status_all = IssuereturnBook::STATUS_CONS;
        return view("admin.issuereturn_book.manage")->with(compact('admiko_data','book_list_all','students_list_all','status_all'));
    }

    public function store(IssuereturnBookRequest $request)
    {
        if (Gate::none(['issuereturn_book_allow'])) {
            return redirect(route("admin.issuereturn_book.index"));
        }
        $data = $request->all();
        
        $IssuereturnBook = IssuereturnBook::create($data);
        
        return redirect(route("admin.issuereturn_book.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $IssuereturnBook = IssuereturnBook::find($id);
        if (Gate::none(['issuereturn_book_allow', 'issuereturn_book_edit']) || !$IssuereturnBook) {
            return redirect(route("admin.issuereturn_book.index"));
        }

        $admiko_data['sideBarActive'] = "issuereturn_book";
		$admiko_data["sideBarActiveFolder"] = "dropdown_library";
        $admiko_data['formAction'] = route("admin.issuereturn_book.update", [$IssuereturnBook->id]);
        
        
		$book_list_all = BookList::all()->sortBy("book_name")->pluck("book_name", "id");
		$students_list_all = StudentsList::all()->sortBy("first_name")->pluck("first_name", "id");
		$status_all = IssuereturnBook::STATUS_CONS;
        $data = $IssuereturnBook;
        return view("admin.issuereturn_book.manage")->with(compact('admiko_data', 'data','book_list_all','students_list_all','status_all'));
    }

    public function update(IssuereturnBookRequest $request,$id)
    {
        if (Gate::none(['issuereturn_book_allow', 'issuereturn_book_edit'])) {
            return redirect(route("admin.issuereturn_book.index"));
        }
        $data = $request->all();
        $IssuereturnBook = IssuereturnBook::find($id);
        $IssuereturnBook->update($data);
        
        return redirect(route("admin.issuereturn_book.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['issuereturn_book_allow'])) {
            return redirect(route("admin.issuereturn_book.index"));
        }
        IssuereturnBook::destroy($request->idDel);
        return back();
    }
    
    
    
}
