<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Boolean;

class Auths extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [

    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [

    ];

    public static function get_user_id()
    {
//        return Auths::where("remember_token", "=", session()->get("user_token"))->first("user_id")->user_id;
        return DB::table("member")->where("remember_token", "=", session()->get("user_token"))->first("user_id")->user_id;

    }

    public static function login($request)
    {
        Cookie::queue("user_id", "", 1);
        Cookie::queue("user_level", "", 1);
        Cookie::queue("user_name", "", 1);
        Cookie::queue("user_code", "", 1);
        Cookie::queue("available_date", "", 1);

        $getUser = DB::table("member")
            ->where("user_id", "=", $request->input("mb_id"))
            ->first();

        if (!$getUser) {
//            echo"111";
            $request->session()->flash("msg", "아이디가 존재하지 않습니다.");
            $request->session()->flash("type", "warning");
            $request->session()->forget("user_token");
            return false;
        }

//         $hash = '$2y$07$BCryptRequires22Chrcte/VlQH0piJtjXl.0t1XkA8pw9dMXTpOq';
//        var_dump($request->input("mb_password"));

        $password = $getUser->password;
        if (!password_verify($request->input("mb_password"), $password)) {
//        if (!password_verify(rasmuslerdorf, $hash)) {
            $request->session()->flash("msg", "아이디가 존재하지 않거나 비밀번호가 틀렸습니다.");
            $request->session()->flash("type", "warning");
            $request->session()->forget("user_token");
            return false;
        }

//        if (!self::isExpire($getUser)) {
//            $request->session()->flash("msg", "사용기간이 만료되었습니다.");
//            $request->session()->flash("type", "warning");
//            $request->session()->forget("user_token");
//            return false;
//        }

        $token = bin2hex(random_bytes(32));

        DB::table("member")->where("user_id", $request->input("mb_id"))
            ->update([ "remember_token" => $token, "last_login_date" => now()]);

        $request->session()->put(["user_token" => $token,"user_id" => $getUser->user_id,"user_level" => $getUser->level,"user_name" => $getUser->name,"user_code" => $getUser->id]);

//        $user_data = array(
//            'provider_seq'		=> $getUser->id,
//            'user_id'		=> $getUser->user_id,
//            'level'				=> $getUser->level,
//            'name'				=> $getUser->name
//        );

        Cookie::queue("user_id", $getUser->user_id, 600); // 쿠키에 아이디 저장
        Cookie::queue("user_level", $getUser->level, 600); // 쿠키에 아이디 저장
        Cookie::queue("user_name", $getUser->name, 600); // 쿠키에 아이디 저장
        Cookie::queue("user_code", $getUser->id, 600); // 쿠키에 아이디 저장
//        Cookie::queue("user_data", $user_data, 600); // 쿠키에 아이디 저장

        return true;
    }

    public static function confirm($request)
    {
        $getUser = DB::table("member")
            ->where("user_id", "=", $request->session()->get('user_id'))
            ->first();

        if (!$getUser) {
//            echo"111";exit;
            return false;
        }

        $password = $getUser->password;
        if (!password_verify($request->input("mb_password"), $password)) {
//            echo"222";
//            exit;
            return false;
        }

        return true;
    }

    // 기간끝났는지 체크
//    public static function isExpire($user) : bool
//    {
//        if ($user->level >= 8) return true;
//
//        $last_payment = DB::table("user_goods_lists")
//                ->where("user_id", "=", $user->id)
//                ->orderByDesc("id")
//                ->first() ?? false;
//
//        if (!$last_payment) return false;
//
//        $now = new \DateTime(date("Y-m-d", strtotime(now())));
//        $end_date = new \DateTime($last_payment->end_date);
//
//        $isExpire =  $now < $end_date;
//        if (!$isExpire) return false;
//
//        Cookie::queue("available_date", $last_payment->end_date, 600); // 쿠키에 유효기간 저장
//        return true;
//
//    }

}
