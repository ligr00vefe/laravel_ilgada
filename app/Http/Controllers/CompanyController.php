<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CompanyController extends Controller
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
        $term = $request->input("company");

        $get = DB::table("company")
            ->when($from_date, function ($query, $from_date) {
                return $query->where("created_at", ">=", $from_date." 00:00:00");
            })
            ->when($to_date, function ($query, $to_date) {
                return $query->where("created_at", "<=", $to_date." 23:59:59");
            })
            ->when($term, function ($query, $term) {
                return $query->where("co_name", "like", "%{$term}%");
            })
            ->where("provider_seq", "=", $user_code)
            ->orderBy('created_at', 'desc');

        $paging = $get->count();
        $lists = $get->paginate(15);

        return view("company.list", [ "page" => $page, "lists"=>$lists, "paging"=>$paging ]);
    }

    /**
     * Display a listing of the resource.
     *
     */
//    public function view(Request  $request)
//    {
//        var_dump($request);
//        $id = $request->input("id");
//
//        $get = DB::table("company")
//                ->where("id", "=", compact('id'))
//                ->first();
////        var_dump(DB::getQueryLog());
//        return view("company.view", [ "lists"=>$get ]);
////        return view("company.view", compact('id'));
//
//        //        return view("company.view",["lists"=>$lists]);
//    }

    /**
     * Display a view of the resource.
     *
     */
    public function view($id)
    {
//        DB::getQueryLog();
        $get = DB::table("company")
                ->where("id", "=", $id)
                ->first();
//        $queryLogs = DB::getQueryLog();
//        var_dump($queryLogs);
        return view('company.view', [ "lists" => $get ]);
    }

    /**
     * Display a view of the resource.
     *
     */
    public function view_pop($id)
    {
//        DB::getQueryLog();
        $get = DB::table("company")
            ->where("id", "=", $id)
            ->first();
//        $queryLogs = DB::getQueryLog();
//        var_dump($queryLogs);
        return view('company.view_pop', [ "lists" => $get ]);
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
        $get = DB::table("company")
            ->where("id", "=", $id)
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
        $phone_cnt = count($phone_arr);

        if($phone_cnt>2){
            $phone_info = (object)['phone1'=>$phone_arr[0],'phone2'=>$phone_arr[1],'phone3'=>$phone_arr[2]];
        }else{
            $phone_arr[0] = substr($lists->phone,0,3);
            $phone_arr[1] = substr($lists->phone,3,4);
            $phone_arr[2] = substr($lists->phone,6,4);
            $phone_info = (object)['phone1'=>$phone_arr[0],'phone2'=>$phone_arr[1],'phone3'=>$phone_arr[2]];
        }


        $fax_arr = explode("-", $lists->fax);
        $fax_cnt = count($fax_arr);

        if($fax_cnt>2){
            $fax_info = (object)['fax1'=>$fax_arr[0],'fax2'=>$fax_arr[1],'fax3'=>$fax_arr[2]];
        }else{
            $fax_arr[0] = substr($lists->fax,0,3);
            $fax_arr[1] = substr($lists->fax,3,4);
            $fax_arr[2] = substr($lists->fax,6,4);
            $fax_info = (object)['fax1'=>$fax_arr[0],'fax2'=>$fax_arr[1],'fax3'=>$fax_arr[2]];
        }

        $email_arr = explode("@", $lists->email);
        $email_info = (object)['email1'=>$email_arr[0],'email2'=>$email_arr[1]];

        $vat_email_arr = explode("@", $lists->vat_email);
        $vat_email_info = (object)['vat_email1'=>$vat_email_arr[0],'vat_email2'=>$vat_email_arr[1]];


        return view('company.update', [ "lists" => $get, "tel_info" => $tel_info, "phone_info" => $phone_info, "fax_info" => $fax_info, "email_info" => $email_info, "vat_email_info" => $vat_email_info ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("company.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $add = Company::add($request);
        session()->flash("msg", "이용자를 추가하거나 수정했습니다.");
        return redirect("/company/list");
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
        $add = Company::edit($request);
        session()->flash("msg", "이용자를 추가하거나 수정했습니다.");
        return redirect("/company/list");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
//    public function update(Request $request)
//    {
//        dd($request->input());
//        $ids = $request->input("id");
//
//        foreach ($ids as $i => $id) {
//
//        }
//    }

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

        $lists = Company::sort($type);
        $averageLists = Company::averageSort($type);


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


        $columns = Company::$disables_key;


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
//        $get = Company::getAll($request);
//
//        return view("member.serviceCheckList", ["page" => $page, "members" => $get['member']]);
//    }

    public static function service_list(Request $request)
    {
        $get = Company::get_service_using($request);

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
            $delete = DB::table('company')->where("id", '=', $id)->delete();
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
