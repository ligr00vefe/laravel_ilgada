<?php

namespace App\Models;

use App\Classes\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Post extends Model
{
    use HasFactory;

    public static function add($request)
    {
        if($request->session()->has('user_token')){
            $user_id = $request->session()->get('user_id');
            $user_code = $request->session()->get('user_code');
        }else{
            return view('/login');
        }

        $tel = $request->input("tel1")."-".$request->input("tel2")."-".$request->input("tel3");
        $phone = $request->input("phone1")."-".$request->input("phone2")."-".$request->input("phone3");
//        $email = $request->input("email1")."@".$request->input("email2");

        $result = DB::table('post')->insert(
            [
                "provider_seq" => $user_code,
                "target_key" => $request->input("provider_seq"),
                "work_date" => $request->input("work_date"),
                "category1" => $request->input("category1"),
                "name" => $request->input("name"),
                "user_code" => $request->input("user_code"),
                "worker_memo" => $request->input("worker_memo"),
                "percent" => $request->input("percent"),
                "chk_day" => $request->input("chk_date"),
                "co_name" => $request->input("co_name"),
                "co_code" => $request->input("co_code"),
                "work_memo" => $request->input("work_memo"),
                "work_field" => $request->input("work_field"),
                "day_price" => str_replace(",", "",$request->input("day_price")),
                "work_day" => $request->input("work_day"),
                "company_price" => str_replace(",", "",$request->input("company_price")),
                "deposit_price" => str_replace(",", "",$request->input("deposit_price")),
                "add_price" => str_replace(",", "",$request->input("add_price")),
                "tel" => $tel,
                "phone" => $phone,
                "zip_code" => $request->input("zip_code"),
                "address" => $request->input("address"),
                "address_detail" => $request->input("address_detail"),
            ]
        );

        $result = DB::table('workers')->where("id", $request->input("user_code"))
            ->increment('chk_days',1);

        return $result;
    }


    public static function edit($request)
    {
        $tel = $request->input("tel1")."-".$request->input("tel2")."-".$request->input("tel3");
        $phone = $request->input("phone1")."-".$request->input("phone2")."-".$request->input("phone3");

        $result = DB::table('post')->where("id", $request->input("id"))
            ->update([
                "provider_seq" => $request->input("provider_seq"),
                "target_key" => $request->input("provider_seq"),
                "user_code" => $request->input("user_code"),
                "worker_memo" => $request->input("worker_memo"),
                "percent" => $request->input("percent"),
                "chk_day" => $request->input("chk_day"),
                "category1" => $request->input("category1"),
                "co_code" => $request->input("co_code"),
                "work_memo" => $request->input("work_memo"),
                "work_field" => $request->input("work_field"),
                "day_price" => str_replace(",", "",$request->input("day_price")),
                "work_day" => $request->input("work_day"),
                "deposit_price" => str_replace(",", "",$request->input("deposit_price")),
                "add_price" => str_replace(",", "",$request->input("add_price")),
                "tel" => $tel,
                "phone" => $phone,
                "zip_code" => $request->input("zip_code"),
                "address" => $request->input("address"),
                "address_detail" => $request->input("address_detail")
            ]);

        return $result;
    }


    public static function test($request)
    {
        var_dump($request);

        $result = DB::table('post')->where("id", $request->input("id"));
//            ->update([
//                "provider_seq" => $request->input("provider_seq"),
//                "target_key" => $request->input("provider_seq"),
//                "user_code" => $request->input("user_code"),
//                "worker_memo" => $request->input("worker_memo"),
//                "percent" => $request->input("percent"),
//                "chk_day" => $request->input("chk_day"),
//                "category1" => $request->input("category1"),
//                "co_code" => $request->input("co_code"),
//                "work_memo" => $request->input("work_memo"),
//                "work_field" => $request->input("work_field"),
//                "day_price" => str_replace(",", "",$request->input("day_price")),
//                "work_day" => $request->input("work_day"),
//                "deposit_price" => str_replace(",", "",$request->input("deposit_price")),
//                "add_price" => str_replace(",", "",$request->input("add_price")),
//                "tel" => $tel,
//                "phone" => $phone,
//                "zip_code" => $request->input("zip_code"),
//                "address" => $request->input("address"),
//                "address_detail" => $request->input("address_detail")
//            ]);

        return $result;
    }


}
