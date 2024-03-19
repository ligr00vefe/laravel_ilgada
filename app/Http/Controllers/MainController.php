<?php

namespace App\Http\Controllers;

use App\Models\Laborer;
//use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Auths;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

//        $user_id = Auths::get_user_id();
        if($request->session()->has('user_token')){
            $user_id = $request->session()->get('user_id');
            $user_code = $request->session()->get('user_code');
        }else{
            return view('/login');
        }

//          var_dump($user_id,$user_code);
//        var_dump($count);

        $defaultDate = date('Y-m-d', strtotime('-1 month'));
        $count = DB::table("workers")->where("provider_seq", "=", $user_code)
            ->where("created_at", ">=", $defaultDate)->count();
        $new = DB::table("company")->where("provider_seq", "=", $user_code)
            ->where("created_at", ">=", $defaultDate)->count();

        $post = DB::table("post")
            ->select('post.work_date', 'workers.name', 'company.co_name',
                DB::raw("(`post`.`day_price` * `post`.`work_day`) as day_price"))
            ->leftjoin('workers','post.user_code','=','workers.id')
            ->leftjoin('company','post.co_code','=','company.id')
            ->where("post.provider_seq", "=", $user_code)
            ->orderBy('post.work_date', 'desc')
            ->limit(5)->get();
            $lists = $post;

        $worker = DB::table("workers")
            ->select('id','created_at', 'name', 'category1', 'category2', 'credit', 'chk_days')
            ->where("provider_seq", "=", $user_code)
            ->orderBy('created_at', 'desc')
            ->limit(5)->get();
        $workers = $worker;

        $company = DB::table("company")
            ->select('id','created_at', 'co_name', 'address', 'credit')
            ->where("provider_seq", "=", $user_code)
            ->orderBy('created_at', 'desc')
            ->limit(5)->get();
        $companys = $company;

        //        $new = User::whereRaw("YEARWEEK(created_at) = YEARWEEK(now())")->count();
//        $users = User::orderByDesc("id")->limit(5)->get();
//        $payments = UserGoodsLists::orderByDesc("id")->limit(3)->get();
//        $qnas = QNA::orderByDesc("id")->limit(5)->get();
//
//        foreach ($users as $user)
//        {
//            $user->payments_info = UserGoodsLists::where("user_id", "=", $user->id)
//                ->where("end_date", ">=", date("Y-m-d"))
//                ->orderByDesc("end_date")
//                ->first();
//        }
//
//        foreach ($payments as $payment)
//        {
//            $payment->goods_info = $payment->goods;
//            $payment->user_info = $payment->user;
//        }
//
        return view("index", [
            "count" => $count,
            "new" => $new,
            "post" => $lists,
            "workers" => $workers,
            "companys" => $companys
        ]);


//        $login = Auths::login();
//        $data = $request->session()->all();
//        $id1=$request->session()->has('user_id');
//        $id2=$request->session()->exists('user_id');
//        $id3 = $request->session()->get('user_id');
//        var_dump($id1, $id2, $id3);
//        if ($request->session()->has('user_token')) {
//            return redirect("/login");
//        }else{
//            return redirect("/");
//        }

//        if ($request->session()->exists('user_token')) {
//            echo"333";
//            //
//        }else{
//            echo"444";
//        }

//        if (!$login) {
////            echo"N";
//            return redirect("/login");
//        }else{
////            echo"Y";
//            return redirect("/");
//        }

//        return View('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function info()
    {
        phpinfo();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
