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


class PostController extends Controller
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
        $term = $request->input("term");

        $get = DB::table("post")
            ->select('post.*', 'workers.percent', 'company.memo')
            ->leftjoin('workers','post.user_code','=','workers.id')
            ->leftjoin('company','post.co_code','=','company.id')
    //            ->get();
            ->when($from_date, function ($query, $from_date) {
                return $query->where("post.created_at", ">=", $from_date);
            })
            ->when($to_date, function ($query, $to_date) {
                return $query->where("post.created_at", "<=", $to_date);
            })
            ->when($term, function ($query, $term) {
                return $query->where("post.name", "like", "%{$term}%");
            })
            ->where("post.provider_seq", "=", $user_code)
            ->orderBy('created_at', 'desc');
        $lists = $get;
    //var_dump($get->work_date);
    //        $tot_price = $get->input("day_price") + $get->input("work_day");
    //        $vat_price = percent($tot_price, $get->input("vat_percent"));
    //        $calc_price = $tot_price - $vat_price;
    //        $unpaid_price = $calc_price - $get->input("deposit_price") + $get->input('add_price');

        $paging = $lists->count();
        $lists = $lists->paginate(15);

        foreach ($lists as $datas) {
            $calc_data['tot_price'] = $datas->day_price;
    //            $calc_data['tot_price'] = $datas->day_price + $datas->work_day;
    //            $calc_data['vat_price'] = percent($calc_data['tot_price'], $datas->vat_percent);
    //            $calc_data['calc_price'] = $calc_data['tot_price'] + $calc_data['vat_price'];
    //            $calc_data['unpaid_price'] = $calc_data['calc_price'] - $datas->deposit_price + $datas->add_price;
        }

                return view("post.list", [ "page" => $page, "lists"=>$lists, "paging"=>$paging ]);

        $attached_url = $_SERVER['REQUEST_URI'];
//        switch($attached_url) {
//            case "/post/list" :
//                return view("post.list", [ "page" => $page, "lists"=>$lists, "paging"=>$paging ]);
//
//            case "/post/worker_list" :
//                return view("post.worker_list", [ "page" => $page, "lists"=>$lists, "paging"=>$paging ]);
//
//            case "/post/company_list" :
//                return view("post.company_list", [ "page" => $page, "lists"=>$lists, "paging"=>$paging ]);
//
//            default :
//                return view("post.list", [ "page" => $page, "lists"=>$lists, "paging"=>$paging ]);
//
//        }
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function company_index(Request $request)
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
        $term = $request->input("term");

        $get = DB::table("post")
            ->select('post.*', 'workers.percent', 'company.memo')
            ->leftjoin('workers','post.user_code','=','workers.id')
            ->leftjoin('company','post.co_code','=','company.id')
            //            ->get();
            ->when($from_date, function ($query, $from_date) {
                return $query->where("post.created_at", ">=", $from_date);
            })
            ->when($to_date, function ($query, $to_date) {
                return $query->where("post.created_at", "<=", $to_date);
            })
            ->when($term, function ($query, $term) {
                return $query->where("post.co_name", "like", "%{$term}%");
            })
            ->where("post.provider_seq", "=", $user_code)
            ->orderBy('created_at', 'desc');
        $lists = $get;
        //var_dump($get->work_date);
        //        $tot_price = $get->input("day_price") + $get->input("work_day");
        //        $vat_price = percent($tot_price, $get->input("vat_percent"));
        //        $calc_price = $tot_price - $vat_price;
        //        $unpaid_price = $calc_price - $get->input("deposit_price") + $get->input('add_price');

        $paging = $lists->count();
        $lists = $lists->paginate(15);

        foreach ($lists as $datas) {
            $calc_data['tot_price'] = $datas->day_price;
            //            $calc_data['tot_price'] = $datas->day_price + $datas->work_day;
            //            $calc_data['vat_price'] = percent($calc_data['tot_price'], $datas->vat_percent);
            //            $calc_data['calc_price'] = $calc_data['tot_price'] + $calc_data['vat_price'];
            //            $calc_data['unpaid_price'] = $calc_data['calc_price'] - $datas->deposit_price + $datas->add_price;
        }


                return view("post.company_list", [ "page" => $page, "lists"=>$lists, "paging"=>$paging ]);

        $attached_url = $_SERVER['REQUEST_URI'];
//        var_dump($attached_url);
//        switch($attached_url) {
//            case "/post/list" :
//                return view("post.list", [ "page" => $page, "lists"=>$lists, "paging"=>$paging ]);
//
//            case "/post/worker_list" :
//                return view("post.worker_list", [ "page" => $page, "lists"=>$lists, "paging"=>$paging ]);
//
//            case "/post/company_list" :
//                return view("post.company_list", [ "page" => $page, "lists"=>$lists, "paging"=>$paging ]);
//
//            default :
//                return view("post.list", [ "page" => $page, "lists"=>$lists, "paging"=>$paging ]);
//
//        }
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function worker_index(Request $request)
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
        $term = $request->input("term");

        $get = DB::table("post")
            ->select('post.*', 'workers.percent', 'company.memo')
            ->leftjoin('workers','post.user_code','=','workers.id')
            ->leftjoin('company','post.co_code','=','company.id')
            //            ->get();
            ->when($from_date, function ($query, $from_date) {
                return $query->where("post.created_at", ">=", $from_date);
            })
            ->when($to_date, function ($query, $to_date) {
                return $query->where("post.created_at", "<=", $to_date);
            })
            ->when($term, function ($query, $term) {
                return $query->where("post.name", "like", "%{$term}%");
            })
            ->where("post.provider_seq", "=", $user_code)
            ->orderBy('created_at', 'desc');
        $lists = $get;
        //var_dump($get->work_date);
        //        $tot_price = $get->input("day_price") + $get->input("work_day");
        //        $vat_price = percent($tot_price, $get->input("vat_percent"));
        //        $calc_price = $tot_price - $vat_price;
        //        $unpaid_price = $calc_price - $get->input("deposit_price") + $get->input('add_price');

        $paging = $lists->count();
        $lists = $lists->paginate(15);

        foreach ($lists as $datas) {
            $calc_data['tot_price'] = $datas->day_price;
            //            $calc_data['tot_price'] = $datas->day_price + $datas->work_day;
            //            $calc_data['vat_price'] = percent($calc_data['tot_price'], $datas->vat_percent);
            //            $calc_data['calc_price'] = $calc_data['tot_price'] + $calc_data['vat_price'];
            //            $calc_data['unpaid_price'] = $calc_data['calc_price'] - $datas->deposit_price + $datas->add_price;
        }

                return view("post.worker_list", [ "page" => $page, "lists"=>$lists, "paging"=>$paging ]);


        $attached_url = $_SERVER['REQUEST_URI'];
//        switch($attached_url) {
//            case "/post/list" :
//                return view("post.list", [ "page" => $page, "lists"=>$lists, "paging"=>$paging ]);
//
//            case "/post/worker_list" :
//                return view("post.worker_list", [ "page" => $page, "lists"=>$lists, "paging"=>$paging ]);
//
//            case "/post/company_list" :
//                return view("post.company_list", [ "page" => $page, "lists"=>$lists, "paging"=>$paging ]);
//
//            default :
//                return view("post.list", [ "page" => $page, "lists"=>$lists, "paging"=>$paging ]);
//
//        }
    }


    /**
     * Display a listing of the resource.
     *
     */
    public function account(Request $request)
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
        $term = $request->input("company");
        if ($request->session()->has('user_token')) {
            $id = $request->session()->get('user_id');
            $provider_seq = $request->session()->get('user_code');
        }else{
            $provider_seq = "";
        }

        $get = DB::table("post")
            ->select( DB::raw('count(`post`.`id`) as cnt' ),  'post.co_code', 'company.co_name', DB::raw("min(`post`.`work_date`) as start_date"), DB::raw('max(`post`.`work_date`) as end_date'),
                DB::raw("DATE_FORMAT(`post`.`work_date`,'%Y-%m') as months ") )
            ->leftjoin('workers','post.user_code','=','workers.id')
            ->leftjoin('company','post.co_code','=','company.id')

//default
//            ->when($from_date, function ($query, $from_date) {
//                return $query->where('post.work_date', ">=", $from_date." 00:00:00");
//            }, function ($query) {
//                $defaultDate = date('Y-m-d h:i:s', strtotime('-1 month'));
//                return $query->where('post.work_date', ">=", $defaultDate);
//            })

            ->when($from_date, function ($query, $from_date) {
                return $query->where('post.work_date', ">=", $from_date." 00:00:00");
            })
            ->when($to_date, function ($query, $to_date) {
                return $query->where('post.work_date', "<=", $to_date." 23:59:59");
            })
            ->when($term, function ($query, $term) {
                return $query->where('company.co_name', "like", "%{$term}%");
            })
            ->where("post.provider_seq", "=", $provider_seq)
            ->groupBy('post.co_code', 'company.co_name', DB::raw("DATE_FORMAT(`post`.`work_date`,'%Y%m') ") )
            ->orderBy('company.id', 'desc');

            $lists = $get;
            $min = $lists->min('post.co_code');
            $paging = $lists->count();
            $lists = $lists->paginate(15);
            $id = ($request->input("id")) ? $request->input("id") : $min;
            $start_date = $request->input("month")."-01";
            $end_date = $request->input("month").'-01 00:00:00';
            $end_date = date('Y-m-t', strtotime($end_date));
            $co_info = (object)['co_code'=>$id, 'month'=>$request->input("month"), 'start_date'=>$start_date,'end_date'=>$end_date];


        if(!$lists==""){
            $mem_info = DB::table("member")
                ->where("id", "=", $provider_seq)
                ->first();
            $mem_info = (object)$mem_info;
        }else{
            $mem_info = "";
            $mem_info = (object)$mem_info;
        }
//        var_dump($mem_info);exit;

        if(!$lists==""){
            $com_info = DB::table("company")
                ->where("id", "=", $provider_seq)
                ->first();
            $com_info = (object)$com_info;
        }else{
            $com_info = "";
            $com_info = (object)$com_info;
        }


        $tot_data = DB::table("post")
            ->select( DB::raw("DATE_FORMAT(`post`.`work_date`,'%d') as day "), DB::raw('count(`post`.`id`) as cnt' ), DB::raw("sum(`post`.`work_day`) as work_day"), DB::raw('sum(`post`.`day_price`) as day_price'))
            ->leftjoin('workers','post.user_code','=','workers.id')
            ->leftjoin('company','post.co_code','=','company.id')

            ->where("post.provider_seq", "=", $provider_seq)
            ->where("post.co_code", "=", $id)
//            ->where('post.work_date', ">=", $start_date)
//            ->where('post.work_date', "<=", $end_date)
            ->whereBetween('post.work_date', [$start_date, $end_date])

            ->groupBy('post.co_code', 'company.co_name', DB::raw("DATE_FORMAT(`post`.`work_date`,'%d') "),'post.work_date' )
            ->orderBy('post.work_date', 'asc')
            ->get();
        $tot_datas = $tot_data;

        $tot_data = [];
        foreach ($tot_datas as $key => $val) {
            for($i=0;$i<=31;$i++){
//                var_dump(($val->day == $i));
//                    echo $i.", ".$val->day;
                if($val->day == $i){
//                        echo" y<br>";
                    $work_day = $val->work_day;
                    $day_price = $val->day_price;
                    $tot_data[$i] = (object)['day'=>$i,'work_day'=>$work_day, 'day_price'=>$day_price];
                }else{
//                        echo"n <br>";
                    $work_day = '' ;
                    $day_price = '' ;
                    $tot_data[$i] = (object)['day'=>$i,'work_day'=>$work_day, 'day_price'=>$day_price];
                }
//                    $tot_data = $tot_data;
            }
//                $tot_data = $tot_data;
        }
//        var_dump($tot_data);

//        $tot_data = [];
//        for($i=0;$i<=31;$i++){
//            foreach ($tot_datas as $key => $val) {
//                if($val->day == $i){
////                        echo" y<br>";
//                    $work_day = $val->work_day;
//                    $day_price = $val->day_price;
//                    $tot_data[$i] = (object)['day'=>$i,'work_day'=>$work_day, 'day_price'=>$day_price];
//                }else{
////                        echo"n <br>";
//                    $work_day = '' ;
//                    $day_price = '' ;
//                    $tot_data[$i] = (object)['day'=>$i,'work_day'=>$work_day, 'day_price'=>$day_price];
//                }
//            }
//            $tot_data = (object)$tot_data;
//        }


//        print_r($tot_data);
//        var_dump($com_info);exit;

//        return view("post.account_list", [ "page" => $page, "lists"=>$lists, "paging"=>$paging,  "subpage" => $subpage, "view_data"=>$sublists, "subpaging"=>$subpaging ]);
        return view("post.account_list", [ "page" => $page, "lists"=>$lists, "paging"=>$paging, "com_info"=>$com_info, "mem_info"=>$mem_info, "co_info"=>$co_info, "tot_data"=>$tot_datas ] );
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function wageslist(Request $request)
    {
        if (!$request->session()->has('user_token')) {
            $request->session()->flash("msg", "로그인 해주세요.");
            return redirect("/login");
        }

        $page = $request->input("page") ?? 1;
        $from_date = $request->input("from_date");
        $to_date = $request->input("to_date");
        $term = $request->input("company");
        if ($request->session()->has('user_token')) {
            $id = $request->session()->get('user_id');
            $provider_seq = $request->session()->get('user_code');
        }else{
            $provider_seq = "";
        }

//        $provider_seq = "1";
//        $subpage = $request->input("subpage") ?? 1;


        $get = DB::table("post")
            ->select( DB::raw('count(`post`.`id`) as cnt' ),  'post.co_code', 'company.co_name', DB::raw("min(`post`.`work_date`) as start_date"), DB::raw('max(`post`.`work_date`) as end_date'),
                DB::raw("DATE_FORMAT(`post`.`work_date`,'%Y-%m') as months ") )
            ->leftjoin('workers','post.user_code','=','workers.id')
            ->leftjoin('company','post.co_code','=','company.id')

//default
//            ->when($from_date, function ($query, $from_date) {
//                return $query->where('post.work_date', ">=", $from_date." 00:00:00");
//            }, function ($query) {
//                $defaultDate = date('Y-m-d h:i:s', strtotime('-1 month'));
//                return $query->where('post.work_date', ">=", $defaultDate);
//            })

            ->when($from_date, function ($query, $from_date) {
                return $query->where('post.work_date', ">=", $from_date." 00:00:00");
            })
            ->when($to_date, function ($query, $to_date) {
                return $query->where('post.work_date', "<=", $to_date." 23:59:59");
            })
            ->when($term, function ($query, $term) {
                return $query->where('company.co_name', "like", "%{$term}%");
            })
            ->where("post.provider_seq", "=", $provider_seq)
            ->groupBy('post.co_code', 'company.co_name', DB::raw("DATE_FORMAT(`post`.`work_date`,'%Y%m') ") )
            ->orderBy('company.id', 'desc');

        $lists = $get;
        $min = $lists->min('post.co_code');
//        $start_date = $lists->min('post.work_date');
//        $end_date = $lists->max('post.work_date');
        $paging = $lists->count();
        $lists = $lists->paginate(15);
        $id = ($request->input("id")) ? $request->input("id") : $min;
        $co_info = (object)['co_code'=>$id,'month'=>$request->input("month")];
        $start_date = $request->input("month")."-01";
        $end_date = $request->input("month").'-01 00:00:00';
        $end_date = date('Y-m-t', strtotime($end_date));

        $get_view = DB::table("company")
            ->where("id", "=", $id)
            ->first();

        return view("post.account_wageslist", [ "page" => $page, "lists"=>$lists, "paging"=>$paging, "view_data"=>$get_view ]);
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function identity(Request $request)
    {
        if (!$request->session()->has('user_token')) {
            $request->session()->flash("msg", "로그인 해주세요.");
            return redirect("/login");
        }

        $page = $request->input("page") ?? 1;
        $from_date = $request->input("from_date");
        $to_date = $request->input("to_date");
        $term = $request->input("company");
        if ($request->session()->has('user_token')) {
            $id = $request->session()->get('user_id');
            $provider_seq = $request->session()->get('user_code');
        }else{
            $provider_seq = "";
        }

//        $provider_seq = "1";
//        $subpage = $request->input("subpage") ?? 1;


        $get = DB::table("post")
            ->select( DB::raw('count(`post`.`id`) as cnt' ),  'post.co_code', 'company.co_name', DB::raw("min(`post`.`work_date`) as start_date"), DB::raw('max(`post`.`work_date`) as end_date'),
                DB::raw("DATE_FORMAT(`post`.`work_date`,'%Y-%m') as months ") )
            ->leftjoin('workers','post.user_code','=','workers.id')
            ->leftjoin('company','post.co_code','=','company.id')

//default
//            ->when($from_date, function ($query, $from_date) {
//                return $query->where('post.work_date', ">=", $from_date." 00:00:00");
//            }, function ($query) {
//                $defaultDate = date('Y-m-d h:i:s', strtotime('-1 month'));
//                return $query->where('post.work_date', ">=", $defaultDate);
//            })

            ->when($from_date, function ($query, $from_date) {
                return $query->where('post.work_date', ">=", $from_date." 00:00:00");
            })
            ->when($to_date, function ($query, $to_date) {
                return $query->where('post.work_date', "<=", $to_date." 23:59:59");
            })
            ->when($term, function ($query, $term) {
                return $query->where('company.co_name', "like", "%{$term}%");
            })
            ->where("post.provider_seq", "=", $provider_seq)
            ->groupBy('post.co_code', 'company.co_name', DB::raw("DATE_FORMAT(`post`.`work_date`,'%Y%m') ") )
            ->orderBy('company.id', 'desc');

        $lists = $get;
        $min = $lists->min('post.co_code');
//        $start_date = $lists->min('post.work_date');
//        $end_date = $lists->max('post.work_date');
        $paging = $lists->count();
        $lists = $lists->paginate(15);
        $id = ($request->input("id")) ? $request->input("id") : $min;
        $co_info = (object)['co_code'=>$id,'month'=>$request->input("month")];
        $start_date = $request->input("month")."-01";
        $end_date = $request->input("month").'-01 00:00:00';
        $end_date = date('Y-m-t', strtotime($end_date));

        if($lists){
            $get_view = DB::table("post")
                ->distinct("workers.id","workers.rsNo","workers.name","workers.photo1","workers.photo2")
                ->select("workers.id","workers.rsNo","workers.name","workers.address","workers.photo1","workers.photo2")
                ->leftjoin('workers','post.user_code','=','workers.id')
                ->leftjoin('company','post.co_code','=','company.id')
                ->when($from_date, function ($query, $from_date) {
                    return $query->where('post.work_date', ">=", $from_date." 00:00:00");
//                }, function ($query) {
//                    $defaultDate = date('Y-m-d h:i:s', strtotime('-7 day'));
//                    return $query->where('post.work_date', ">=", $defaultDate);
                })
                ->when($to_date, function ($query, $to_date) {
                    return $query->where('post.work_date', "<=", $to_date." 23:59:59");
//                }, function ($query) {
//                    $defaultDate = date('Y-m-d h:i:s' );
//                    return $query->where('post.work_date', "<=", $defaultDate);
                })
//            ->distinct("post.co_code","post.co_name")
//            ->distinct("post.co_code","post.co_name")
                ->where("post.provider_seq", "=", $provider_seq)
                ->where("company.id", "=", $id)
            ->get();
//            ->groupBy("workers.id")
//                ->get();
//            var_dump($get_view); exit;
        }else{
//            $get_view = (object)[];
            $get_view = "";
        }

        return view("post.account_identity", [ "page" => $page, "lists"=>$lists, "paging"=>$paging, "view_data"=>$get_view ]);
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function certificate(Request $request)
    {
        if (!$request->session()->has('user_token')) {
            $request->session()->flash("msg", "로그인 해주세요.");
            return redirect("/login");
        }

        $page = $request->input("page") ?? 1;
        $from_date = $request->input("from_date");
        $to_date = $request->input("to_date");
        $term = $request->input("company");
        if ($request->session()->has('user_token')) {
            $id = $request->session()->get('user_id');
            $provider_seq = $request->session()->get('user_code');
        }else{
            $provider_seq = "";
        }

//        $provider_seq = "1";
//        $subpage = $request->input("subpage") ?? 1;


        $get = DB::table("post")
            ->select( DB::raw('count(`post`.`id`) as cnt' ),  'post.co_code', 'company.co_name', DB::raw("min(`post`.`work_date`) as start_date"), DB::raw('max(`post`.`work_date`) as end_date'),
                DB::raw("DATE_FORMAT(`post`.`work_date`,'%Y-%m') as months ") )
            ->leftjoin('workers','post.user_code','=','workers.id')
            ->leftjoin('company','post.co_code','=','company.id')

//default
//            ->when($from_date, function ($query, $from_date) {
//                return $query->where('post.work_date', ">=", $from_date." 00:00:00");
//            }, function ($query) {
//                $defaultDate = date('Y-m-d h:i:s', strtotime('-1 month'));
//                return $query->where('post.work_date', ">=", $defaultDate);
//            })

            ->when($from_date, function ($query, $from_date) {
                return $query->where('post.work_date', ">=", $from_date." 00:00:00");
            })
            ->when($to_date, function ($query, $to_date) {
                return $query->where('post.work_date', "<=", $to_date." 23:59:59");
            })
            ->when($term, function ($query, $term) {
                return $query->where('company.co_name', "like", "%{$term}%");
            })
            ->where("post.provider_seq", "=", $provider_seq)
            ->groupBy('post.co_code', 'company.co_name', DB::raw("DATE_FORMAT(`post`.`work_date`,'%Y%m') ") )
            ->orderBy('company.id', 'desc');

        $lists = $get;
        $min = $lists->min('post.co_code');
//        $start_date = $lists->min('post.work_date');
//        $end_date = $lists->max('post.work_date');
        $paging = $lists->count();
        $lists = $lists->paginate(15);
        $id = ($request->input("id")) ? $request->input("id") : $min;
        $co_info = (object)['co_code'=>$id,'month'=>$request->input("month")];
        $start_date = $request->input("month")."-01";
        $end_date = $request->input("month").'-01 00:00:00';
        $end_date = date('Y-m-t', strtotime($end_date));

        if($lists){
            $get_view = DB::table("post")
                ->distinct("workers.id","workers.rsNo","workers.name","workers.photo1","workers.photo2")
                ->select("workers.id","workers.rsNo","workers.name","workers.address","workers.photo3")
                ->leftjoin('workers','post.user_code','=','workers.id')
                ->leftjoin('company','post.co_code','=','company.id')
                ->when($from_date, function ($query, $from_date) {
                    return $query->where('post.work_date', ">=", $from_date." 00:00:00");
//                }, function ($query) {
//                    $defaultDate = date('Y-m-d h:i:s', strtotime('-7 day'));
//                    return $query->where('post.work_date', ">=", $defaultDate);
                })
                ->when($to_date, function ($query, $to_date) {
                    return $query->where('post.work_date', "<=", $to_date." 23:59:59");
//                }, function ($query) {
//                    $defaultDate = date('Y-m-d h:i:s' );
//                    return $query->where('post.work_date', "<=", $defaultDate);
                })
                ->where("post.provider_seq", "=", $provider_seq)
                ->where("company.id", "=", $id)
                ->get();
        }else{
            $get_view = "";
        }

        return view("post.account_certificate", [ "page" => $page, "lists"=>$lists, "paging"=>$paging, "view_data"=>$get_view ]);
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function mandator(Request $request)
    {
        if (!$request->session()->has('user_token')) {
            $request->session()->flash("msg", "로그인 해주세요.");
            return redirect("/login");
        }

        $page = $request->input("page") ?? 1;
        $from_date = $request->input("from_date");
        $to_date = $request->input("to_date");
        $term = $request->input("company");
        if ($request->session()->has('user_token')) {
            $id = $request->session()->get('user_id');
            $provider_seq = $request->session()->get('user_code');
        }else{
            $provider_seq = "";
        }

//        $provider_seq = "1";
//        $subpage = $request->input("subpage") ?? 1;


        $get = DB::table("post")
            ->select( DB::raw('count(`post`.`id`) as cnt' ),  'post.co_code', 'company.co_name', DB::raw("min(`post`.`work_date`) as start_date"), DB::raw('max(`post`.`work_date`) as end_date'),
                DB::raw("DATE_FORMAT(`post`.`work_date`,'%Y-%m') as months ") )
            ->leftjoin('workers','post.user_code','=','workers.id')
            ->leftjoin('company','post.co_code','=','company.id')

//default
//            ->when($from_date, function ($query, $from_date) {
//                return $query->where('post.work_date', ">=", $from_date." 00:00:00");
//            }, function ($query) {
//                $defaultDate = date('Y-m-d h:i:s', strtotime('-1 month'));
//                return $query->where('post.work_date', ">=", $defaultDate);
//            })

            ->when($from_date, function ($query, $from_date) {
                return $query->where('post.work_date', ">=", $from_date." 00:00:00");
            })
            ->when($to_date, function ($query, $to_date) {
                return $query->where('post.work_date', "<=", $to_date." 23:59:59");
            })
            ->when($term, function ($query, $term) {
                return $query->where('company.co_name', "like", "%{$term}%");
            })
            ->where("post.provider_seq", "=", $provider_seq)
            ->groupBy('post.co_code', 'company.co_name', DB::raw("DATE_FORMAT(`post`.`work_date`,'%Y%m') ") )
            ->orderBy('company.id', 'desc');

        $lists = $get;
        $min = $lists->min('post.co_code');
//        $start_date = $lists->min('post.work_date');
//        $end_date = $lists->max('post.work_date');
        $paging = $lists->count();
        $lists = $lists->paginate(15);
        $id = ($request->input("id")) ? $request->input("id") : $min;
        $start_date = $request->input("month")."-01";
        $end_date = $request->input("month").'-01 00:00:00';
        $end_date = date('Y-m-t', strtotime($end_date));
        $co_info = (object)['co_code'=>$id,'month'=>$request->input("month"),'start_date'=>$start_date,'end_date'=>$end_date];

        if($lists){
            $get_view = DB::table("post")
                ->distinct("workers.id","workers.rsNo","workers.name")
                ->select("workers.id","workers.rsNo","workers.name","workers.address","workers.bank","workers.bank_num","company.id as com_id")
                ->leftjoin('workers','post.user_code','=','workers.id')
                ->leftjoin('company','post.co_code','=','company.id')
                ->when($from_date, function ($query, $from_date) {
                    return $query->where('post.work_date', ">=", $from_date." 00:00:00");
//                }, function ($query) {
//                    $defaultDate = date('Y-m-d h:i:s', strtotime('-7 day'));
//                    return $query->where('post.work_date', ">=", $defaultDate);
                })
                ->when($to_date, function ($query, $to_date) {
                    return $query->where('post.work_date', "<=", $to_date." 23:59:59");
//                }, function ($query) {
//                    $defaultDate = date('Y-m-d h:i:s' );
//                    return $query->where('post.work_date', "<=", $defaultDate);
                })
                ->where("post.provider_seq", "=", $provider_seq)
                ->where("company.id", "=", $id)
                ->where('post.work_date', ">=", $start_date)
                ->where('post.work_date', "<=", $end_date)
                ->get();
            $sub_data = (object)$get_view;
        }else{
            $sub_data = "";
        }

        return view("post.account_mandator", [ "page" => $page, "lists"=>$lists, "paging"=>$paging, "sub_data"=>$sub_data, "co_info"=>$co_info ]);
    }

    /**
     * Display a view of the resource.
     *
     */
    public function view($id)
    {
        $get = DB::table("post")
            ->select('post.*', 'workers.category1', 'workers.category2', 'workers.percent', 'workers.percent','company.memo')
            ->leftjoin('workers','post.user_code','=','workers.id')
            ->leftjoin('company','post.co_code','=','company.id')
            ->where("post.id", "=", $id)
            ->first();
        return view('post.view', [ "lists" => $get ]);
    }

    /**
     * Display a view of the resource.
     *
     */
    public function view_pop($id)
    {
        $get = DB::table("post")
            ->where("id", "=", $id)
            ->first();
        return view('post.view_pop', [ "lists" => $get ]);
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
        $get = DB::table("post")
            ->select('post.*', 'company.id')
            ->leftjoin('workers','post.user_code','=','workers.id')
            ->leftjoin('company','post.co_code','=','company.id')
            ->where("post.id", "=", $id)
            ->first();

        $lists = $get;

        $tel_arr = explode("-", $lists->tel);
        $tel_cnt = count($tel_arr);



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


        return view('post.update', [ "lists" => $get, "tel_info" => $tel_info, "phone_info" => $phone_info ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("post.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $add = Post::add($request);
//        $add2 = Post::user_add($request);
        session()->flash("msg", "이용자를 추가하거나 수정했습니다.");
        return redirect("/post/list");
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
        $add = Post::edit($request);
        session()->flash("msg", "이용자를 추가하거나 수정했습니다.");
        return redirect("/post/list");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function test(Request $request)
    {
        $check_data = $request->input("check_data");
        var_dump($check_data);
//        var_dump($request);
//        exit;
//        $add = Post::edit($request);
//        session()->flash("msg", "이용자를 추가하거나 수정했습니다.");
//        return redirect("/post/list");
        return view("popup.war_document");
    }

    /**
     * Display a view of the resource.
     *
     */
    public function war_document(Request $request)
    {
        $user_id = Auths::get_user_id();
        if($request->session()->has('user_token')){
            $user_id = $request->session()->get('user_id');
            $user_code = $request->session()->get('user_code');
        }else{

        }

        $page = $request->input("page") ?? 1;
        $chk_company = $request->input("checkcom");
        $start_date = $request->input("checkmonth")."-01";
        $end_date = $request->input("checkmonth").'-01';
        $end_date = date('Y-m-t', strtotime($end_date));
        $date_info = (object)['start_date'=>$start_date,'end_date'=>$end_date];
        $checked = json_encode($request->input('checkBoxArr'));

        $data = Str::of( $checked )->split('/[\s,]+/');

        $mem_info = DB::table("member")
            ->where("id", "=", $user_code)
            ->first();

        $co_info = DB::table("company")
            ->where("provider_seq", "=", $user_code)
            ->where("id", "=", $chk_company)
            ->first();

//        $get = DB::table("workers")
//            ->where("provider_seq", "=", $user_code)
//            ->wherein("id", $data)
//            ->get();

        $get = DB::table("post")
            ->select( DB::raw('count(`post`.`id`) as cnt' ), DB::raw('sum(`post`.`day_price`) as day_price' ),
                 'post.co_code', 'workers.name', 'workers.rsNo', 'workers.tel', 'workers.address' )
            ->leftjoin('workers','post.user_code','=','workers.id')
            ->leftjoin('company','post.co_code','=','company.id')

            ->where("post.provider_seq", "=", $user_code)
            ->where("post.work_date", ">=", $start_date)
            ->where("post.work_date", "<=", $end_date)
            ->wherein("workers.id", $data)
            ->groupBy('post.co_code', 'workers.name', 'workers.rsNo', 'workers.tel', 'workers.address' )
            ->orderBy('company.id', 'desc');
        $lists = $get;
        $paging = $lists->count();
        $lists = $lists->paginate(15);

        return view("popup.war_document",[ "page" => $page, "paging"=>$paging,  "mem_info" => $mem_info, "co_info" => $co_info, "lists" => $lists, "date_info"=>$date_info ] );
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
            $delete = DB::table('post')->where("id", '=', $id)->delete();
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
