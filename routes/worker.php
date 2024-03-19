<?php
use App\Http\Controllers\WorkerController;

Route::get('/worker', [ WorkerController::class, 'index' ])->name("worker.list.index" );
Route::get('/worker/list', [ WorkerController::class, 'index' ])->name("worker.list.index" );
Route::get('/worker/add', [ WorkerController::class, 'create' ])->name("worker.list.create" );
Route::post('/worker/register', [ WorkerController::class, 'store' ])->name("worker.store" );
Route::get('/worker/view/{id}', [ WorkerController::class, 'view' ]);
//route::get('/worker/view_pop/{id}', 'WorkerController@view_pop');
Route::get('/worker/modify/{id}', [ WorkerController::class, 'update' ]);
Route::post('/worker/update_proc', [ WorkerController::class, 'edit' ])->name("worker.edit" );
Route::post('/worker/select_del', [ WorkerController::class, 'delete' ])->name("worker.select_del" );

