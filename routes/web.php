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
    return view('index');
});

Auth::routes();
//untuk registrasi
Route::post('/regis', 'Auth\RegisterController@store');
Route::resource('saldos','SaldoController');
Route::resource('masters','MasterController');
//halo
Route::resource('transaksis','TransaksiController');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/laporan', 'TransaksiController@laporan');
Route::post('/tampil', 'TransaksiController@tampil');