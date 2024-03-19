<?php

namespace App\Models;

use App\Classes\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Users extends Model
{
    use HasFactory;


    public static function add($request)
    {
        $tel = $request->input("tel1")."-".$request->input("tel2")."-".$request->input("tel3");
        $phone = $request->input("phone1")."-".$request->input("phone2")."-".$request->input("phone3");
        $fax = $request->input("fax1")."-".$request->input("fax2")."-".$request->input("fax3");
        $email = $request->input("email1")."@".$request->input("email2");
        $vat_email = $request->input("vat_email1")."@".$request->input("vat_email2");

        $result = DB::table('member')->insert(
            [
                "provider_seq" => $request->input("provider_seq"),
                "co_name" => $request->input("co_name"),
                "co_num" => $request->input("co_num"),
                "name" => $request->input("name"),
                "tel" => $tel,
                "zip_code" => $request->input("zip_code"),
                "address" => $request->input("address"),
                "address_detail" => $request->input("detail"),
                "phone" => $phone,
                "fax" => $fax,
                "email" => $email,
                "vat_email" => $vat_email,
                "payment_type" => $request->input("payment_type"),
                "credit" => $request->input("credit"),
                "memo" => $request->input("memo"),
            ]
        );

        return $result;
    }

    public static function edit($request)
    {
        $result = DB::table('member')->where("id", $request->input("id"))
            ->update([
                "provider_seq" => $request->input("provider_seq"),
                "co_name" => $request->input("co_name"),
                "co_num" => $request->input("co_num"),
                "name" => $request->input("name"),
                "tel" => $request->input("tel"),
                "zip_code" => $request->input("zip_code"),
                "address" => $request->input("address"),
                "address_detail" => $request->input("detail"),
                "phone" => $request->input("phone"),
                "fax" => $request->input("fax"),
                "email" => $request->input("email"),
                "vat_email" => $request->input("vat_email"),
                "payment_type" => $request->input("payment_type"),
                "credit" => $request->input("credit"),
                "memo" => $request->input("memo"),
            ]);

        return $result;
    }


}
