<?php

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
Route::middleware('checkNameSpace')->group(function () {
    Route::post('/add','UserController@addUser');
    Route::post('/edit','UserController@addUser');
});

    Route::get('/','UserController@index')->middleware("adminToken");

//Route::get('/','UserController@index');



Route::view('/index','admin.app')->middleware("adminToken");
Route::view('/reg','admin.reg');
Route::view('/404','admin.not');
Route::view('/login','admin.login');

Route::delete('/del/{id}','UserController@delUser')->middleware("adminToken");
Route::get('/show','UserController@showUser')->middleware("adminToken");
Route::get('/search','UserController@searchUser')->middleware("adminToken");

Route::post('/regadmin','AdminController@storeSecret');
Route::post('/tologin','AdminController@tologin');
Route::post('/out','AdminController@out');





