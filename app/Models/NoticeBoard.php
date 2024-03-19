<?php

namespace App\Models;

use App\Classes\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class NoticeBoard extends Model
{
    use HasFactory;


    public static function add($request)
    {
        $result = DB::table('board_notice')->insert(
            [
                "user_id" => $request->input("user_id"),
                "subject" => $request->input("subject"),
                "contents" => $request->input("contents"),
            ]
        );

        return $result;
    }

//    public static function edit($request)
//    {
//        $result = DB::table('board_notice')->where("id", $request->input("id"))
//            ->update([
//                "provider_seq" => $request->input("provider_seq"),
//                "co_name" => $request->input("co_name"),
//                "co_num" => $request->input("co_num"),
//                "name" => $request->input("name"),
//                "tel" => $request->input("tel"),
//                "zip_code" => $request->input("zip_code"),
//                "address" => $request->input("address"),
//                "address_detail" => $request->input("detail"),
//                "phone" => $request->input("phone"),
//                "fax" => $request->input("fax"),
//                "email" => $request->input("email"),
//                "vat_email" => $request->input("vat_email"),
//                "payment_type" => $request->input("payment_type"),
//                "credit" => $request->input("credit"),
//                "memo" => $request->input("memo"),
//            ]);
//
//        return $result;
//    }

}
