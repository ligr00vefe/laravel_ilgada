<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SurveyCategoryController;
use App\Http\Controllers\SettingMenuListController;
use App\Http\Controllers\NoticeBoardController;
use App\Http\Controllers\QnaBoardController;
use App\Http\Controllers\PaymentsController;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AjaxController;


Route::prefix("/admin")->group(function () {
    Route::get('/admin', [AdminController::class, "index"]);
    Route::get('/', [AdminController::class, "index"]);
    Route::get('/category', [SurveyCategoryController::class, "index"]);
    Route::get('/setting/menu', [SettingMenuListController::class, "index"]);
    Route::post('/setting/menu', [SettingMenuListController::class, "store"]);
    Route::get('/member', [AdminController::class, "member"])->name("admin.member.list" );
    Route::get('/member/list', [AdminController::class, "member"])->name("admin.member.list" );
    Route::get('/member/add', [ AdminController::class, 'create' ])->name("admin.member.add" );
    Route::post('/member/register', [ AdminController::class, 'store' ]);
    Route::get('/member/modify/{id}', [ AdminController::class, 'update' ]);
    Route::post('/member/update_proc', [ AdminController::class, 'edit' ]);
    Route::post('/member/delete', [ AdminController::class, 'delete' ])->name("admin.member.delete" );

    Route::get('/payments', [PaymentsController::class, "index"])->name("admin.payments.list" );
    Route::get('/payments/list', [PaymentsController::class, "index"])->name("admin.payments.list" );
    Route::get('/payments/add', [ PaymentsController::class, 'create' ])->name("admin.payments.add" );
    Route::post('/payments/register', [ PaymentsController::class, 'store' ]);
    Route::get('/payments/modify/{id}', [ PaymentsController::class, 'update' ]);
    Route::post('/payments/update_proc', [ PaymentsController::class, 'edit' ]);
    Route::post('/payments/delete', [ PaymentsController::class, 'delete' ])->name("admin.payments.delete" );
    Route::get('/payments/period/{id}', [ PaymentsController::class, 'period' ])->name("admin.payments.period" );
    Route::post('/payments/period_proc', [ PaymentsController::class, 'period_proc' ])->name("admin.payments.period_proc" );
});

Route::get('/admin/notice', [NoticeBoardController::class, "index"])->name("admin.notice" );
Route::get('/admin/notice/add', [ NoticeBoardController::class, 'create' ]);
Route::post('/admin/notice/register', [ NoticeBoardController::class, 'store' ])->name("notice.store" );
Route::get('/admin/notice/view/{id}', [ NoticeBoardController::class, 'view' ]);
Route::get('/admin/notice/modify/{id}', [ NoticeBoardController::class, 'update' ]);
Route::post('/admin/notice/update_proc', [ NoticeBoardController::class, 'edit' ]);
Route::post('/admin/notice/del/{id}', [ NoticeBoardController::class, 'del' ]);
Route::post('/admin/notice/delete', [ NoticeBoardController::class, 'notice_delete' ])->name("admin.notice.delete" );
Route::post('/member/delete', [ AdminController::class, 'delete' ])->name("admin.member.delete" );

Route::get('/admin/qna', [QnaBoardController::class, "index"])->name("admin.qna" );
Route::get('/admin/qna/add', [ QnaBoardController::class, 'create' ]);
Route::post('/admin/qna/register', [ QnaBoardController::class, 'store' ])->name("qna.store" );
Route::get('/admin/qna/view/{id}', [ QnaBoardController::class, 'view' ]);
Route::get('/admin/qna/modify/{id}', [ QnaBoardController::class, 'update' ]);
Route::post('/admin/qna/update_proc', [ QnaBoardController::class, 'edit' ]);
Route::post('/admin/qna/del', [ QnaBoardController::class, 'del' ]);
Route::post('/admin/qna/delete', [ QnaBoardController::class, 'qna_delete' ])->name("admin.qna.delete" );

Route::get('/task/alert', function() {
//    $task= ['name' => '라라벨 예제 작성',
//        'due_date' => '2015-06-01 11:22:33',
//        'comment' => '<script>alert("Welcome");</script>'];
    $task= ['comment' => '<script>alert("Welcome");</script>'];

    return view('task.alert',[ "task" => $task ]);
//        ->with('task', $task);
});
