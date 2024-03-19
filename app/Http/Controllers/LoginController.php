<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Auths;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function index()
    {
        return view("login");
    }

    public function login(Request $req)
    {
        $login = Auths::login($req);
        $admin_level = $req->session()->get('user_level');
        $admin_id = $req->session()->get('user_id');

        if (!$login) {
            return redirect("/login");
        }else{
            if($admin_level > 9 || ($admin_id == "admin" && $admin_level > 9)){
                return redirect("/admin");
            }else{
                return redirect("/");
            }
        }
    }

    public function logout(Request $request)
    {
        $request->session()->forget("user_token");

        Cookie::queue("user_id", "", 1);
        Cookie::queue("available_date", "", 1);
        Cookie::queue("user_level", "", 1);
        Cookie::queue("user_name", "", 1);
        Cookie::queue("user_code", "", 1);

        $request->session()->flash("msg", "로그아웃 되었습니다.");
        $request->session()->flash("type", "primary");
//        return redirect("/login");
        return redirect("/");

    }

    public function confirm()
    {
            return view('pass-confirm');
    }

    public function confirm_proc(Request $request)
    {
        $confirm = Auths::confirm($request);
//        $admin_level = $request->session()->get('user_level');
//        $admin_id = $request->session()->get('user_id');
        $user_code = $request->session()->get('user_code');


        if (!$confirm) {
            return redirect("/login");
        }else{
            return redirect("/user/modify/{$user_code}");
        }

    }
}
