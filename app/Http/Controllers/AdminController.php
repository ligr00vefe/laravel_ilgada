<?php

namespace App\Http\Controllers;

use App\Models\Auths;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class AdminController extends Controller
{
    use HasFactory;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $user_id = Auths::get_user_id();
        if($request->session()->has('user_token') && $request->session()->get('user_level')>9 ){
            $user_id = $request->session()->get('user_id');
            $user_code = $request->session()->get('user_code');
        }elseif($request->session()->has('user_token') && $request->session()->get('user_level')<10 ){
//            return view('index');
            return redirect("/")->with("msg", "관리자 권한이 필요합니다.");
        }else{
            return view('/login');
        }

//          var_dump($user_id,$user_code);
//        var_dump($count);

        $defaultDate = date('Y-m-d', strtotime('-1 month'));
        $new_cnt = DB::table("member")->where("created_at", ">=", $defaultDate)->count();
        $new_pay = DB::table("payments")->where("created_at", ">=", $defaultDate)->count();
        $new_qna = DB::table("board_qna")->where("created_at", ">=", $defaultDate)->count();

        $member = DB::table("member")
            ->select('member.id', 'member.user_id', 'member.co_name', 'member.co_num', 'member.tel', 'member.phone', 'payments.start_date', 'payments.end_date', 'payments.status')
            ->leftjoin('payments','payments.co_code','=','member.id')
            ->orderBy('member.created_at', 'desc')
            ->limit(5)->get();
        $members = $member;

        $qna = DB::table("board_qna")
            ->select('id', 'subject', 'user_id', 'created_at', 'hit')
            ->orderBy('created_at', 'desc')
            ->limit(5)->get();
        $qnas = $qna;

        return view("admin.index", [
            "new_cnt" => $new_cnt,
            "new_pay" => $new_pay,
            "new_qna" => $new_qna,
            "members" => $members,
            "qnas" => $qnas
        ]);

//        return View('admin.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function member(Request $request)
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
        $term = $request->input("term");
//        $term = $request->input("term");

        $get = DB::table("member")
            ->select('member.*', 'payments.start_date', 'payments.end_date', 'payments.status')
            ->leftjoin('payments','payments.co_code','=','member.id')
            ->when($from_date, function ($query, $from_date) {
                return $query->where("created_at", ">=", $from_date);
            })
            ->when($to_date, function ($query, $to_date) {
                return $query->where("created_at", "<=", $to_date);
            })
            ->when($term, function ($query, $term) {
                return $query->where("name", "like", "%{$term}%");
            });


        $paging = $get->count();
        $lists = $get->paginate(15);

        return view("admin.member.list", [ "page" => $page, "lists"=>$lists, "paging"=>$paging ]);
//        return View('admin.member.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
//        return view("admin.member.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $user_id = User::get_user_id();

        $upload1 = "";
        $file1Name = "";

        if ($request->file("photo1")) {
            $upload1 = $request->file("photo1")->store("member","public");
            $file1Name = $request->file("photo1")->getClientOriginalName();
        }

        $tel = $request->input("tel1")."-".$request->input("tel2")."-".$request->input("tel3");
        $phone = $request->input("phone1")."-".$request->input("phone2")."-".$request->input("phone3");
        $email = $request->input("email1")."@".$request->input("email2");

//        $add = DB::table('member')->insert(
        $add = DB::table('member')->insertGetId(
            [
                "user_id" => $request->input("user_id"),
                "password" => password_hash($request->input("pass"), PASSWORD_BCRYPT ),
//                "password" => Hash::make($request->input("pass"),
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

        $endDate = date('Y-m-d h:i:s', strtotime('+1 month'));
        $paymentDate = date('Y-m-d h:i:s', strtotime('+7 day'));

        $result = DB::table('payments')->insert(
            [
                "status" => "Y",
                "user_id" => $request->input("user_id"),
                "co_code" => $add,
                "period" => "1month",
                "start_date" => now(),
                "end_date" => $endDate,
                "payment_type" => "bank",
                "payment_date" => $paymentDate
            ]
        );


        if ($add)
        {
            return redirect("/admin/member")->with("msg", "회원가입 되었습니다.");
        }
        else
        {
            return back()->with("error", "회원가입 실패했습니다. 다시 시도해 주세요");
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
            ->select('member.*', 'payments.start_date', 'payments.end_date', 'payments.status')
            ->leftjoin('payments','payments.co_code','=','member.id')
            ->where("member.id", "=", $id)
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

        return view('admin.member.update', [ "lists" => $lists, "tel_info" => $tel_info, "phone_info" => $phone_info, "email_info" => $email_info ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
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
            return redirect("/admin/member")->with("msg", "회원정보가 수정 되었습니다.");
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $del_data = $request->input("del_data");
        $del_cnt = count($del_data);
        foreach ($del_data as $id) {
            $delete = DB::table('member')->where("id", '=', $id)->delete();
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function submenu()
    {
        //
    }

}
