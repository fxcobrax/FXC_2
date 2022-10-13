<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\NoticeBoard;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\NoticeBoardRequest;
use Gate;

class NoticeBoardController extends Controller
{

    public function index()
    {
        if (Gate::none(['notice_board_allow', 'notice_board_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "notice_board";
		$admiko_data["sideBarActiveFolder"] = "dropdown_communicate";
        
        $tableData = NoticeBoard::orderByDesc("id")->get();
        return view("admin.notice_board.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['notice_board_allow'])) {
            return redirect(route("admin.notice_board.index"));
        }
        $admiko_data['sideBarActive'] = "notice_board";
		$admiko_data["sideBarActiveFolder"] = "dropdown_communicate";
        $admiko_data['formAction'] = route("admin.notice_board.store");
        
        
        return view("admin.notice_board.manage")->with(compact('admiko_data'));
    }

    public function store(NoticeBoardRequest $request)
    {
        if (Gate::none(['notice_board_allow'])) {
            return redirect(route("admin.notice_board.index"));
        }
        $data = $request->all();
        
        $NoticeBoard = NoticeBoard::create($data);
        
        return redirect(route("admin.notice_board.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $NoticeBoard = NoticeBoard::find($id);
        if (Gate::none(['notice_board_allow', 'notice_board_edit']) || !$NoticeBoard) {
            return redirect(route("admin.notice_board.index"));
        }

        $admiko_data['sideBarActive'] = "notice_board";
		$admiko_data["sideBarActiveFolder"] = "dropdown_communicate";
        $admiko_data['formAction'] = route("admin.notice_board.update", [$NoticeBoard->id]);
        
        
        $data = $NoticeBoard;
        return view("admin.notice_board.manage")->with(compact('admiko_data', 'data'));
    }

    public function update(NoticeBoardRequest $request,$id)
    {
        if (Gate::none(['notice_board_allow', 'notice_board_edit'])) {
            return redirect(route("admin.notice_board.index"));
        }
        $data = $request->all();
        $NoticeBoard = NoticeBoard::find($id);
        $NoticeBoard->update($data);
        
        return redirect(route("admin.notice_board.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['notice_board_allow'])) {
            return redirect(route("admin.notice_board.index"));
        }
        NoticeBoard::destroy($request->idDel);
        return back();
    }
    
    
    
}
