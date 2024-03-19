<?php
use App\Http\Controllers\PostController;



Route::get('/post', [ PostController::class, 'index' ])->name("post.list.index" );
Route::get('/post/list', [ PostController::class, 'index' ])->name("post.list.index" );
Route::get('/post/add', [ PostController::class, 'create' ])->name("post.list.create" );
Route::post('/post/register', [ PostController::class, 'store' ])->name("post.store" );
Route::get('/post/view/{id}', [ PostController::class, 'view' ]);
//route::get('/post/view_pop/{id}', 'PostController@view_pop');
Route::get('/post/modify/{id}', [ PostController::class, 'update' ]);
Route::post('/post/update_proc', [ PostController::class, 'edit' ])->name("post.edit" );
Route::post('/post/select_del', [ PostController::class, 'delete' ])->name("post.select_del" );
Route::get('/post/account_list', [ PostController::class, 'account' ])->name("post.account_list.account" );
Route::get('/post/account_wageslist', [ PostController::class, 'wageslist' ])->name("post.account_list.wageslist" );
Route::get('/post/account_identity', [ PostController::class, 'identity' ])->name("post.account_list.identity" );
Route::get('/post/account_certificate', [ PostController::class, 'certificate' ])->name("post.account_list.certificate" );
Route::get('/post/account_mandator', [ PostController::class, 'mandator' ])->name("post.account_list.mandator" );
Route::post('/post/test_proc', [ PostController::class, 'test' ])->name("post.test" );

Route::get('/popup/war_document', [ PostController::class, 'war_document' ])->name("popup.war_document" );

//Route::get('/post/account_list/{id}', [ PostController::class, 'account' ])->name("post.account_list.account" );


/*노무자 일정보*/
Route::get('/post/worker_list', [ PostController::class, 'worker_index' ])->name("post.worker_list");
//Route::get('/post/worker_add', [ PostController::class, 'worker_create' ])->name("post.worker_create");
//Route::post('/post/worker_register', [ PostController::class, 'worker_store' ])->name("post.worker_register" );


/*거래처 일정보*/
Route::get('/post/company_list', [ PostController::class, 'company_index' ])->name("post.company_list");
//Route::get('/post/company_add', [ PostController::class, 'company_create' ])->name("post.company_create");
//Route::post('/post/company_register', [ PostController::class, 'company_store' ])->name("post.company_register" );
