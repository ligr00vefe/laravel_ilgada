<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
        $page = $request->input("page") ?? 1;
        $from_date = $request->input("from_date");
        $to_date = $request->input("to_date");
        $term = $request->input("worker");

        $get = DB::table("workers")
            ->when($from_date, function ($query, $from_date) {
                return $query->where("contract_start_date", ">=", $from_date);
            })
            ->when($to_date, function ($query, $to_date) {
                return $query->where("contract_end_date", "<=", $to_date);
            })
            ->when($term, function ($query, $term) {
                return $query->where("name", "like", "%{$term}%");
            });

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

        $get = DB::table("member")
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

        $email_arr = explode("@", $lists->email);
        $email_info = (object)['email1'=>$email_arr[0],'email2'=>$email_arr[1]];

        return view('user_modify', [ "lists" => $lists, "tel_info" => $tel_info, "phone_info" => $phone_info, "email_info" => $email_info ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("user_add");
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

        $upload1 = "";
        $file1Name = "";

        if ($request->file("photo1")) {
            $upload1 = $request->file("photo1")->store("images","public");
            $file1Name = $request->file("photo1")->getClientOriginalName();
        }

        $tel = $request->input("tel1")."-".$request->input("tel2")."-".$request->input("tel3");
        $phone = $request->input("phone1")."-".$request->input("phone2")."-".$request->input("phone3");
        $email = $request->input("email1")."@".$request->input("email2");

        $add = DB::table('member')->insert(
            [
                "user_id" => $request->input("user_id"),
                "password" => password_hash($request->input("pass"), PASSWORD_BCRYPT),
                "level" => "1",
//                "password" => $request->input("password"),
                "name" => $request->input("name"),
                "co_name" => $request->input("co_name"),
                "business_type" => $request->input("business_type"),
                "business_item" => $request->input("business_item"),
                "co_num" => $request->input("co_num"),
                "photo1" => $upload1,
                "ori_photo1" => $file1Name,
                "tel" => $tel,
                "phone" => $phone,
                "email" => $email,
                "zip_code" => $request->input("zip_code"),
                "address" => $request->input("address"),
                "address_detail" => $request->input("address_detail"),
                "bank" => $request->input("bank"),
                "bank_num" => $request->input("bank_num"),
                "bank_name" => $request->input("bank_name")
            ]
        );



        if ($add)
        {
            return redirect("/")->with("msg", "회원가입 되었습니다.");
        }
        else
        {
            return back()->with("error", "회원가입 실패했습니다. 다시 시도해 주세요");
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
//        $user_id = User::get_user_id();

//        $upload1 = "";
//        $file1Name = "";

        if ($request->file("photo1")) {
            $upload1 = $request->file("photo1")->store("images","public");
            $file1Name = $request->file("photo1")->getClientOriginalName();
        }else{
            $upload1 = $request->input("photo1");
            $file1Name = $request->input("ori_photo1");
        }

        $tel = $request->input("tel1")."-".$request->input("tel2")."-".$request->input("tel3");
        $phone = $request->input("phone1")."-".$request->input("phone2")."-".$request->input("phone3");
        $email = $request->input("email1")."@".$request->input("email2");

        $add = DB::table('member')->where("id", $request->input("id"))
            ->update(
            [
                "name" => $request->input("name"),
                "co_name" => $request->input("co_name"),
                "business_type" => $request->input("business_type"),
                "business_item" => $request->input("business_item"),
                "co_num" => $request->input("co_num"),
                "photo1" => $upload1,
                "ori_photo1" => $file1Name,
                "tel" => $tel,
                "phone" => $phone,
                "email" => $email,
                "zip_code" => $request->input("zip_code"),
                "address" => $request->input("address"),
                "address_detail" => $request->input("address_detail")
            ]
        );



        if ($add)
        {
            return redirect("/")->with("msg", "회원정보가 수정 되었습니다.");
        }
        else
        {
            return back()->with("error", "회원정보 수정 실패했습니다. 다시 시도해 주세요");
        }

//        $add = Worker::add($request);
//        session()->flash("msg", "이용자를 추가하거나 수정했습니다.");
//        return redirect("/worker/list");
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

}
