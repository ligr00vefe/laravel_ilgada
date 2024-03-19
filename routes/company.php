<?php
use App\Http\Controllers\CompanyController;



Route::get('/company', [ CompanyController::class, 'index' ])->name("company.list.index" );
Route::get('/company/list', [ CompanyController::class, 'index' ])->name("company.list.index" );
//Route::get('/company/view', [ CompanyController::class, 'view' ])->name("company.list.view" );
Route::get('/company/add', [ CompanyController::class, 'create' ])->name("company.list.create" );
Route::post('/company/register', [ CompanyController::class, 'store' ])->name("company.store" );

//Route::post('/company/view/{post}', 'CompanyController@view');
//Route::get('/company/view/{id}', [CompanyController::class, 'view'])->name('company.list.index');
//route::get('/company/view/{id}', 'CompanyController@view')->name('company.view');
//route::get('/company/view/{id}', 'CompanyController@view');
Route::get('/company/view/{id}', [ CompanyController::class, 'view' ]);
//route::get('/company/view_pop/{id}', 'CompanyController@view_pop');
Route::get('/company/modify/{id}', [ CompanyController::class, 'update' ]);
Route::post('/company/update_proc', [ CompanyController::class, 'edit' ])->name("company.edit" );
Route::post('/company/select_del', [ CompanyController::class, 'delete' ])->name("company.select_del" );
