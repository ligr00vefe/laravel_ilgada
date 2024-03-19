<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PasswordConfirmController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\NoticeBoardController;
use App\Http\Controllers\QnaBoardController;
use App\Http\Controllers\AjaxController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [MainController::class, "index"]);
Route::get('/main', [MainController::class, "index"]);
//if (session()->has('user_token')) {
//    return view('/login');
//}else {
//    return view('/login');
//}

//Route::get('/', function() {
//    if (session()->has('user_token')) {
//        Route::get('/', [MainController::class, "index"]);
//        return view('/index');
//    }else {
//        return view('/login');
//    }
//});

//Route::get('/', function() {
//    if (session()->has('user_token')) {
//        return redirect("/");
//    }else {
//        return redirect("/");
//    }
//})->name("user.index");

Route::get('/login', [LoginController::class, "index"]);
Route::post("/loginAction", [ LoginController::class, "login"])->name("login.action");
Route::get('/logout', [LoginController::class, "logout"]);
Route::get('/confirm', [LoginController::class, "confirm"]);
Route::post('/confirm_proc', [LoginController::class, "confirm_proc"])->name("confirm.action");
Route::get('/user/add', [UsersController::class, "create"])->name("user.add" );
Route::post('/user/register', [ UsersController::class, 'store' ])->name("user.store" );
Route::get('/user/modify/{id}', [ UsersController::class, 'update' ]);
Route::post('/user/update_proc', [ UsersController::class, 'edit' ])->name("user.edit" );

Route::get('/notice', [NoticeBoardController::class, "list"]);
Route::get('/notice/view/{id}', [ NoticeBoardController::class, 'views' ]);

Route::get('/qna', [QnaBoardController::class, "list"])->name("qna" );
Route::get('/qna/add', [ QnaBoardController::class, 'creates' ]);
Route::post('/qna/register', [ QnaBoardController::class, 'stores' ])->name("stores" );
Route::get('/qna/view/{id}', [ QnaBoardController::class, 'views' ]);
Route::get('/qna/modify/{id}', [ QnaBoardController::class, 'updates' ]);
Route::post('/qna/update_proc', [ QnaBoardController::class, 'edits' ]);
Route::post('/qna/del', [ QnaBoardController::class, 'qna_delete' ])->name("qna.del" );
Route::get('info', [MainController::class, "info"]);



include_once("laborer.php");
include_once("post.php");
include_once("worker.php");
include_once("company.php");
include_once("popup.php");
include_once("admin.php");

