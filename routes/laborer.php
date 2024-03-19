<?php
use App\Http\Controllers\LaborerListController;



Route::get('/laborer', [ LaborerListController::class, 'index' ])->name("laborer.list.index" );
Route::get('/laborer/list', [ LaborerListController::class, 'index' ])->name("laborer.list.index" );
Route::get('/laborer/add', [ LaborerListController::class, 'create' ])->name("laborer.list.create" );
Route::post('/laborer/register', [ LaborerListController::class, 'store' ])->name("laborer.store" );
