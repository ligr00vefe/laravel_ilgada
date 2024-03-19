<?php
use App\Http\Controllers\PopupController;

Route::get('/popup/user_list', [ PopupController::class, 'user_index' ])->name("popup.list.user_index" );
Route::get('/popup/co_list', [ PopupController::class, 'co_index' ])->name("popup.list.co_index" );

Route::get('/popup/wages_document', [ PopupController::class, 'wages_document' ])->name("popup.wages_document" );
Route::get('/popup/warrant_document', [ PopupController::class, 'warrant_document' ])->name("popup.warrant_document" );
