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

Route::get('/','pagesController@index');


Route::resource('files','FilesController');
Route::get('/download/{id}','FilesController@download')->name('download');
Route::get('/downloaden/{id}','FilesController@download_EN')->name('download');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
