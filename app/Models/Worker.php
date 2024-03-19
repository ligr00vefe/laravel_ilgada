<?php

namespace App\Models;

use App\Classes\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Worker extends Model
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

        $result = DB::table('workers')->insert(
            [
                "provider_seq" => $user_code,
                "name" => $request->input("name"),
                "rsNo" => $request->input("jumin_num"),
                "photo1" => $request->input("photo1"),
                "photo2" => $request->input("photo2"),
                "photo3" => $request->input("photo3"),
                "photo4" => $request->input("photo4"),
                "photo5" => $request->input("photo5"),
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
                "personal_information" => $request->input("personal_information"),
                "memo" => $request->input("memo")
            ]
        );

        return $result;
    }

    public static function edit($request)
    {
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

        $tel = $request->input("tel1")."-".$request->input("tel2")."-".$request->input("tel3");
        $phone = $request->input("phone1")."-".$request->input("phone2")."-".$request->input("phone3");

        if ($request->file("photo1")) {
            $upload1 = $request->file("photo1")->store("images/qna", "public");
            $file1Name = $request->file("photo1")->getClientOriginalName();
        }else{
            $upload1 = $request->input("ori_photo1");
            $file1Name = $request->input("file1name");
        }

        if ($request->file("photo2")) {
            $upload2 = $request->file("photo2")->store("images","public");
            $file2Name = $request->file("photo2")->getClientOriginalName();
        }else{
            $upload2 = $request->input("ori_photo2");
            $file2Name = $request->input("file2name");
        }

        if ($request->file("photo3")) {
            $upload3 = $request->file("photo3")->store("images","public");
            $file3Name = $request->file("photo3")->getClientOriginalName();
        }else{
            $upload3 = $request->input("ori_photo3");
            $file3Name = $request->input("file3name");
        }

        if ($request->file("photo4")) {
            $upload4 = $request->file("photo4")->store("images","public");
            $file4Name = $request->file("photo4")->getClientOriginalName();
        }else{
            $upload4 = $request->input("ori_photo4");
            $file4Name = $request->input("file4name");
        }

        if ($request->file("photo5")) {
            $upload5 = $request->file("photo5")->store("images","public");
            $file5Name = $request->file("photo5")->getClientOriginalName();
        }else{
            $upload5 = $request->input("ori_photo5");
            $file5Name = $request->input("file5name");
        }

        if ($request->file("personal_information")) {
            $upload6 = $request->file("personal_information")->store("images","public");
            $file6Name = $request->file("personal_information")->getClientOriginalName();
        }else{
            $upload6 = $request->input("ori_photo6");
            $file6Name = $request->input("file6name");
        }

        $result = DB::table('workers')->where("id", $request->input("id"))
            ->update([
                "provider_seq" => $request->input("provider_seq"),
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
                "chk_days" => $request->input("chk_day"),
                "credit" => $request->input("credit"),
                "percent" => $request->input("percent"),
                "gender" => $request->input("gender"),
                "bank" => $request->input("bank"),
                "bank_num" => $request->input("bank_num"),
                "car_yn" => $request->input("car_yn"),
                "personal_information" => $upload6,
                "ori_filename" => $file6Name,
                "memo" => $request->input("memo")
            ]);

        return $result;
    }

}
