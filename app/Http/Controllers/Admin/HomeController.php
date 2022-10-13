<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\StudentsList;
use App\Models\Admin\Admins\Admins;
use App\Models\Admin\BookList;
use App\Models\Admin\ItemsList;

class HomeController extends Controller
{
    public function index()
    {
        $admiko_data['sideBarActive'] = "home";
        $admiko_data['sideBarActiveFolder'] = "";
        
        $students_list = StudentsList::count();
        $Admins = Admins::count();
        $book_list = BookList::count();
        $items_list = ItemsList::count();

        return view('admin.home.index')->with(compact('admiko_data', 'students_list', 'Admins', 'book_list', 'items_list'));

    }
}
