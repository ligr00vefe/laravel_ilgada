<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class PopupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function user_index(Request $request)
    {
        $page = $request->input("page") ?? 1;
        $from_date = $request->input("from_date");
        $to_date = $request->input("to_date");
        $term = $request->input("term");

        $get = DB::table("workers")
            ->select( 'id','rsNo', 'name', 'address', 'phone', 'category1', 'percent', 'gender','chk_days', 'credit','memo', 'created_at' )
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

        return view("popup.user_list", [ "page" => $page, "lists"=>$lists, "paging"=>$paging ]);
    }

    public function co_index(Request $request)
    {
        $page = $request->input("page") ?? 1;
        $from_date = $request->input("from_date");
        $to_date = $request->input("to_date");
        $term = $request->input("term");

        $get = DB::table("company")
            ->select( 'id', 'co_name', 'co_num', 'name', 'address', 'tel', 'phone', 'zip_code', 'address','address_detail', 'payment_type', 'credit', 'memo', 'created_at' )
            ->when($from_date, function ($query, $from_date) {
                return $query->where("created_at", ">=", $from_date);
            })
            ->when($to_date, function ($query, $to_date) {
                return $query->where("created_at", "<=", $to_date);
            })
            ->when($term, function ($query, $term) {
                return $query->where("co_name", "like", "%{$term}%");
            });

        $paging = $get->count();
        $lists = $get->paginate(15);

        return view("popup.co_list", [ "page" => $page, "lists"=>$lists, "paging"=>$paging ]);
    }

    public function wages_document(Request $request)
    {

        return view("popup.wages_document");
    }

    public function warrant_document(Request $request)
    {

        return view("popup.warrant_document");
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
        return view('company.update', [ "lists" => $get ]);
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

}
