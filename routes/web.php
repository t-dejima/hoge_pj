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

Route::get('/', function () {
    return view('welcome');
});

// 以下を追加
Route::resource('articles', 'ArticlesController');

Route::resource('profiles', 'ProfilesController');

Route::get('/export_csv','ArticlesController@export_csv');

Route::post('/import_csv','ArticlesController@import_csv');

Route::get('/excel_temp','ArticlesController@excel_temp');

Route::get('/send_mail','ArticlesController@send_mail');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('articles/restore/{id}', 'ArticlesController@restore'  ); // 復旧用。追記
Route::get('articles/force-delete/{id}', 'ArticlesController@forceDelete'); // 完全削除用。追記
