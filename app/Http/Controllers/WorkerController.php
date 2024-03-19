<?php

namespace App\Http\Controllers;

use App\Models\Laborer;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Worker;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
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
        $term = $request->input("worker");

        $get = DB::table("workers")
            ->when($from_date, function ($query, $from_date) {
                return $query->where("created_at", ">=", $from_date);
            })
            ->when($to_date, function ($query, $to_date) {
                return $query->where("created_at", "<=", $to_date);
            })
            ->when($term, function ($query, $term) {
                return $query->where("name", "like", "%{$term}%");
            })
            ->where("provider_seq", "=", $user_code)
            ->orderBy('created_at', 'desc');

        $paging = $get->count();
        $lists = $get->paginate(15);

        return view("worker.list", [ "page" => $page, "lists"=>$lists, "paging"=>$paging ]);
    }

    /**
     * Display a view of the resource.
     *
     */
    public function view($id)
    {
        $get = DB::table("workers")
            ->where("id", "=", $id)
            ->first();

        return view('worker.view', [ "lists" => $get ]);
    }

    /**
     * Display a view of the resource.
     *
     */
    public function view_pop($id)
    {
        $get = DB::table("workers")
            ->where("id", "=", $id)
            ->first();
        return view('worker.view_pop', [ "lists" => $get ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {

        $get = DB::table("workers")
            ->where("id", "=", $id)
            ->first();

        $lists = $get;

        $tel_arr = explode("-", $lists->tel);
        $tel_cnt =count($tel_arr);



        if($tel_cnt>2){
            $tel_info = (object)['tel1'=>$tel_arr[0],'tel2'=>$tel_arr[1],'tel3'=>$tel_arr[2]];
        }else{
            $tel_num_cnt = Str::length($lists->tel);
            var_dump($tel_num_cnt);

            if($tel_cnt>11){
                $tel_arr[0] = substr($lists->tel,0,3);
                $tel_arr[1] = substr($lists->tel,3,4);
                $tel_arr[2] = substr($lists->tel,6,4);
                $tel_info = (object)['tel1'=>$tel_arr[0],'tel2'=>$tel_arr[1],'tel3'=>$tel_arr[2]];
            }else{
                $tel_arr[0] = substr($lists->tel,0,3);
                $tel_arr[1] = substr($lists->tel,3,4);
                $tel_arr[2] = substr($lists->tel,6,4);
                $tel_info = (object)['tel1'=>$tel_arr[0],'tel2'=>$tel_arr[1],'tel3'=>$tel_arr[2]];
            }
        }

        $phone_arr = explode("-", $lists->phone);
        $phone_cnt =count($phone_arr);

        if($phone_cnt>2){
            $phone_info = (object)['phone1'=>$phone_arr[0],'phone2'=>$phone_arr[1],'phone3'=>$phone_arr[2]];
        }else{
            $phone_arr[0] = substr($lists->phone,0,3);
            $phone_arr[1] = substr($lists->phone,3,4);
            $phone_arr[2] = substr($lists->phone,6,4);
            $phone_info = (object)['phone1'=>$phone_arr[0],'phone2'=>$phone_arr[1],'phone3'=>$phone_arr[2]];
        }

        return view('worker.update', [ "lists" => $lists, "tel_info" => $tel_info, "phone_info" => $phone_info ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("worker.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $user_id = User::get_user_id();
        if($request->session()->has('user_token')){
            $user_id = $request->session()->get('user_id');
            $user_code = $request->session()->get('user_code');
        }else{
            return view('/login');
        }

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

//        $size = Storage::size($request->file("photo1"));
//        var_dump($size);exit;

        if ($request->file("photo1")) {
            $upload1 = $request->file("photo1")->store("images","public");
            $file1Name = $request->file("photo1")->getClientOriginalName();
        }
        if ($request->file("photo2")) {
            $upload2 = $request->file("photo2")->store("images","public");
            $file2Name = $request->file("photo2")->getClientOriginalName();
        }
        if ($request->file("photo3")) {
            $upload3 = $request->file("photo3")->store("images","public");
            $file3Name = $request->file("photo3")->getClientOriginalName();
        }
        if ($request->file("photo4")) {
            $upload4 = $request->file("photo4")->store("images","public");
            $file4Name = $request->file("photo4")->getClientOriginalName();
        }
        if ($request->file("photo5")) {
            $upload5 = $request->file("photo5")->store("images","public");
            $file5Name = $request->file("photo5")->getClientOriginalName();
        }
        if ($request->file("personal_information")) {
            $upload6 = $request->file("personal_information")->store("infos","public");
            $file6Name = $request->file("personal_information")->getClientOriginalName();
        }

        $tel = $request->input("tel1")."-".$request->input("tel2")."-".$request->input("tel3");
        $phone = $request->input("phone1")."-".$request->input("phone2")."-".$request->input("phone3");

        $add = DB::table('workers')->insert(
            [
                "provider_seq" => $user_code,
                "name" => $request->input("name"),
                "rsNo" => $request->input("jumin_num"),
                "photo1" => $upload1,
                "ori_photo1" => $file1Name,
                "photo2" => $upload2,
                "ori_photo2" => $file2Name,
                "photo3" => $upload3,
                "ori_photo3" => $file3Name,
                "photo4" => $upload4,
                "ori_photo4" => $file4Name,
                "photo5" => $upload5,
                "ori_photo5" => $file5Name,
                "target_key" => $request->input("barcode"),
                "zip_code" => $request->input("zip_code"),
                "address" => $request->input("address"),
                "address_detail" => $request->input("address_detail"),
                "tel" => $tel,
                "phone" => $phone,
                "category1" => $request->input("category1"),
                "category2" => $request->input("category2"),
                "chk_days" => '0',
                "credit" => $request->input("credit"),
                "percent" => $request->input("percent"),
                "gender" => $request->input("gender"),
                "bank" => $request->input("bank"),
                "bank_num" => $request->input("bank_num"),
                "car_yn" => $request->input("car_yn"),
                "personal_information" => $upload6,
                "ori_filename" => $file6Name,
                "memo" => $request->input("memo")
            ]
        );



        if ($add)
        {
            return redirect("/worker/list")->with("msg", "글을 작성했습니다.");
        }
        else
        {
            return back()->with("error", "글 작성에 실패했습니다. 다시 시도해 주세요");
        }

//        $add = Worker::add($request);
//        session()->flash("msg", "이용자를 추가하거나 수정했습니다.");
//        return redirect("/worker/list");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $add = worker::edit($request);
        session()->flash("msg", "이용자를 추가하거나 수정했습니다.");
        return redirect("/worker/list");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function sort($type, $page = 1)
    {
        $type_arr = [
            "mng" => "mng",
            "mna" => "mna",
            "gna" => "gna",
            "lna" => "lna",
            "snt" => "snt",
        ];

        function show($msg)
        {
            echo "<pre>";
            print_r($msg);
            echo "</pre>";
        }

        $lists = Worker::sort($type);
        $averageLists = Worker::averageSort($type);


        if ($type == "mna") {
            // 연인원 데이터
            $averageTotalType1 = $lists['averageTotalType1'];
            $averageTotalType2 = $lists['averageTotalType2'];
            $averageLists = $lists['averageAges'];

            $totalType1 = $lists['totalType1'];
            $totalType2 = $lists['totalType2'];
            $lists = $lists['ages'];

        }

        if ($type == "gna" || $type == "lna") {
            $averageTotalType1 = $lists['averageTotalType1'];
            $averageLists = $lists['averageAges'];

            $totalType1 = $lists['totalType1'];
            $lists = $lists['ages'];
        }


        $columns = Worker::$disables_key;


        return view("member.sort.{$type_arr[$type]}", [
            "page" => $page,
            "type" => $type,
            "lists" => $lists,
            "averageLists" => $averageLists ?? [],
            "columns" => $columns,
            "totalType1" => $totalType1 ?? [],
            "totalType2" => $totalType2 ?? [],
            "averageTotalType1" => $averageTotalType1 ?? [],
            "averageTotalType2" => $averageTotalType2 ?? [],
        ]);
    }

//    public function service($page = 1, Request $request)
//    {
//        $get = Worker::getAll($request);
//
//        return view("member.serviceCheckList", ["page" => $page, "members" => $get['member']]);
//    }

    public static function service_list(Request $request)
    {
        $get = Worker::get_service_using($request);

        return view("member.serviceList", [
            "lists" => $get['lists'],
            "total" => $get['total'],
            "paging" => $get['paging'],
            "page" => $request->input("page") ?? 1
        ]);
    }

    public function delete(Request $request)
    {
        $del_data = $request->input("del_data");
        $del_cnt = count($del_data);
        foreach ($del_data as $id) {
            $delete = DB::table('workers')->where("id", '=', $id)->delete();
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
