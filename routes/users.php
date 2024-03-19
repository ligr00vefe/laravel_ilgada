<?php
use App\Http\Controllers\UsersController;



Route::get('/users', [ UsersController::class, 'index' ])->name("users.list.index" );
Route::get('/users/list', [ UsersController::class, 'index' ])->name("users.list.index" );
Route::get('/users/add', [ UsersController::class, 'create' ])->name("users.list.create" );
Route::post('/users/register', [ UsersController::class, 'store' ])->name("users.store" );
