<?php

namespace App\Http\Controllers;

use App\Models\NoticeBoard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NoticeBoardController extends Controller
{

    public function index(Request $request)
    {
        if($request->session()->has('user_token') && $request->session()->get('user_level')>9 ){
            $user_id = $request->session()->get('user_id');
            $user_code = $request->session()->get('user_code');
        }elseif($request->session()->has('user_token') && $request->session()->get('user_level')<10 ){
//            return view('index');
            return redirect("/")->with("msg", "관리자 권한이 필요합니다.");
        }else{
            return view('/login');
        }

        $page = $request->input("page") ?? 1;
        $from_date = $request->input("from_date");
        $to_date = $request->input("to_date");
        $term = $request->input("subject");

        $get = DB::table("board_notice")
            ->when($from_date, function ($query, $from_date) {
                return $query->where("created_at", ">=", $from_date);
            })
            ->when($to_date, function ($query, $to_date) {
                return $query->where("created_at", "<=", $to_date);
            })
            ->when($term, function ($query, $term) {
                return $query->where("subject", "like", "%{$term}%");
            })
            ->orderBy('created_at', 'desc');

        $paging = $get->count();
        $lists = $get->paginate(15);

        return view("admin.notice.index", [ "page" => $page, "lists"=>$lists, "paging"=>$paging ]);
    }

    public function list(Request $request)
    {
        if($request->session()->has('user_token')){
            $user_id = $request->session()->get('user_id');
            $user_code = $request->session()->get('user_code');
        }else{
            return view('/login');
        }

        $page = $request->input("page") ?? 1;
        $from_date = $request->input("from_date");
        $to_date = $request->input("to_date");
        $term = $request->input("subject");

        $get = DB::table("board_notice")
            ->when($from_date, function ($query, $from_date) {
                return $query->where("created_at", ">=", $from_date);
            })
            ->when($to_date, function ($query, $to_date) {
                return $query->where("created_at", "<=", $to_date);
            })
            ->when($term, function ($query, $term) {
                return $query->where("subject", "like", "%{$term}%");
            })
            ->orderBy('created_at', 'desc');

        $paging = $get->count();
        $lists = $get->paginate(15);

        return view("bbs.notice.index", [ "page" => $page, "lists"=>$lists, "paging"=>$paging ]);
    }

    /**
     * Display a view of the resource.
     *
     */
    public function view($id)
    {
        $get = DB::table("board_notice")
            ->where("id", "=", $id)
            ->first();

        $result = DB::table('board_notice')->where("id", $id)
            ->increment('hit',1);

        return view('admin.notice.view', [ "lists" => $get ]);
    }

    /**
     * Display a view of the resource.
     *
     */
    public function views($id)
    {
        $get = DB::table("board_notice")
            ->where("id", "=", $id)
            ->first();

        $result = DB::table('board_notice')->where("id", $id)
            ->increment('hit',1);

        return view('bbs.notice.view', [ "lists" => $get ]);
    }

    /**
     * Display a view of the resource.
     *
     */
    public function update($id)
    {
        $get = DB::table("board_notice")
            ->where("id", "=", $id)
            ->first();
        return view('admin.notice.update', [ "lists" => $get ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.notice.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $upload1 = "";
        $file1Name = "";
        $upload2 = "";
        $file2Name = "";
        $upload3 = "";
        $file3Name = "";
        $upload4 = "";
        $file4Name = "";
        $upload5 = "";
        $file5Name = "";
        $upload6 = "";
        $file6Name = "";

        if ($request->file("photo1")) {
            $upload1 = $request->file("photo1")->store("images", "public");
            $file1Name = $request->file("photo1")->getClientOriginalName();
        }
        if ($request->file("photo2")) {
            $upload2 = $request->file("photo2")->store("images", "public");
            $file2Name = $request->file("photo2")->getClientOriginalName();
        }

        $add = DB::table('board_notice')->insert(
            [
                "user_id" => $request->input("user_id"),
                "subject" => $request->input("subject"),
                "contents" => $request->input("contents"),
                "photo1" => $upload1,
                "ori_photo1" => $file1Name,
                "photo2" => $upload2,
                "ori_photo2" => $file2Name,
                "hit" => '0'
            ]
        );

        if ($add) {
            return redirect("/admin/notice")->with("msg", "글을 작성했습니다.");
        } else {
            return back()->with("error", "글 작성에 실패했습니다. 다시 시도해 주세요");
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $upload1 = "";
        $file1Name = "";
        $upload2 = "";
        $file2Name = "";

        if ($request->file("photo1")) {
            $upload1 = $request->file("photo1")->store("images/qna", "public");
            $file1Name = $request->file("photo1")->getClientOriginalName();
        }else{
            $upload1 = $request->input("ori_photo1");
            $file1Name = $request->input("file1name");
        }

        if ($request->file("photo2")) {
            $upload2 = $request->file("photo2")->store("images/qna", "public");
            $file2Name = $request->file("photo2")->getClientOriginalName();
        }else{
            $upload2 = $request->input("photo2");
            $file2Name = $request->input("file2name");
        }

        $add = DB::table('board_notice')->where("id", $request->input("id"))
            ->update(
            [
                "user_id" => $request->input("user_id"),
                "subject" => $request->input("subject"),
                "contents" => $request->input("contents"),
                "photo1" => $upload1,
                "ori_photo1" => $file1Name,
                "photo2" => $upload2,
                "ori_photo2" => $file2Name
            ]
        );

        if ($add) {
            return redirect("/admin/notice")->with("msg", "글을 작성했습니다.");
        } else {
            return back()->with("error", "글 작성에 실패했습니다. 다시 시도해 주세요");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function del($id)
    {
        $delete = DB::table('board_notice')->where("id", '=', $id)->delete();

        if ($delete)
        {
            return redirect()->route("admin.notice")->with("msg", "게시글을 삭제했습니다");
        }
        else
        {
            return back()->with("error", "삭제에 실패했습니다. 다시 시도해 주세요");
        }
    }

    /**
     * Remove notice list.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function notice_delete(Request $request)
    {
        $del_data = $request->input("del_data");
        $del_cnt = count($del_data);
        foreach ($del_data as $id) {
            $delete = DB::table('board_notice')->where("id", '=', $id)->delete();
        }

        if ($delete)
        {
            return response()->json(array('msg'=> $delete), 200);
        }
        else
        {
            return response()->json(array('msg'=> $delete), '');
        }
    }

}
