<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/token',function(){
    return csrf_token(); 
});
//RajaOngkir
Route::get('getprovinsi','RajaOngkirController@getProvinsi');
Route::get('getkota/{id}','RajaOngkirController@getkota');
Route::get('provinsi', 'RajaOngkirController@provinsi')->name('provinsi');
Route::get('cost/{origin}/{destination}/{courier}/{berat}','RajaOngkirController@cost');
//Route::get('provinsi','RajaOngkirController@provinsi')->name('provinsi')->middleware('verified');;

//Auth Bawaan Laravel
Auth::routes();
Auth::routes(['verify' => false]);
Route::get('/home', 'HomeController@index')->name('home');

//Xendit Payment Gateway
Route::get('/xendit/balance','XenditController@balance')->name('xendit.balance');
Route::get('/xendit/listva', 'XenditController@getListVA')->name('xendit.getListVA');
Route::get('/xendit/createva', 'XenditController@createVA')->name('xendit.createVA');
Route::get('/xendit/showpayment', 'XenditController@showPayment')->name('xendit.showPayment');

//Midtrans Payment Gateway
Route::get('/midtrans/index','MidtransController@index');
Route::get('/midtrans/status', 'MidtransController@getStatus');
Route::get('/midtrans/cancel', 'MidtransController@cancelPayment');
Route::post('/midtrans/notification', 'MidtransController@payment_handling');

//User Device
Route::get('/userdevice', 'UserDeviceController@getusersysteminfo')->name('userdevice.getusersysteminfo');
Route::post('/userdevice/store', 'UserDeviceController@store')->name('userdevice.store');

//Kategori
Route::get('seller/kategori','KategoriProdukController@index')->name('kategoriproduk.index');
Route::post('seller/kategori/store','KategoriProdukController@store')->name('kategoriproduk.store');
Route::put('seller/kategori/update/{id}','KategoriProdukController@update')->name('kategoriproduk.update');
Route::delete('seller/kategori/delete/{id}','KategoriProdukController@destroy')->name('kategoriproduk.destroy');

//Merchant
Route::get('seller/merchant/daftar','MerchantController@create')->name('merchant.create');
Route::post('seller/merchant/store','MerchantController@store')->name('merchant.store');



