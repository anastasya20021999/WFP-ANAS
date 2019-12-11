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
Route::resource('submasters','SubmasterController');
Route::resource('transaksis','TransaksiController');
Route::resource('tabungans','TabunganController');

Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/submasters/{submaster}/create', 'SubmasterController@create');

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/laporan', 'TransaksiController@laporan');
Route::post('/tampil', 'TransaksiController@tampil');

Route::get('/laporan', 'TransaksiController@chartX');




Route::get('/rasiopemasukanpengeluaran', 'TransaksiController@grafikpemasukanpengeluaran');
Route::get('/rasiopemasukanpengeluaran/filter', 'TransaksiController@grafikpemasukanpengeluaranfilter');
Route::get('/trendpemasukan', 'TransaksiController@trendpemasukan');
Route::get('/trendpemasukan/filter', 'TransaksiController@trendpemasukanfilter');





































Route::post('/changeOption', 'SubmasterController@tampil');
