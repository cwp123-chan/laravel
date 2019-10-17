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
    Route::post('/edit','UserController@editUser');
});
Route::get('/','Controller@index');

Route::view('/index','admin.app');
Route::view('/','admin.reg');
Route::view('/reg','admin.reg');

Route::view('/404','admin.not');
Route::view('/login','admin.login');

//
//Route::post('/add','Requests\\StoreRequest@addUser');
//Route::post('/edit','Requests\\StoreRequest@editUser');
Route::delete('/del/{id}','UserController@delUser');
Route::get('/show/{num}','UserController@showUser');
Route::post('/regadmin','AdminController@storeSecret');
Route::post('/tologin','AdminController@tologin');




