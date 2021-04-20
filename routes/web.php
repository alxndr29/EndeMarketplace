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

Route::get('/user', function () {
    $test = "Hallo";
    return view('user.detailproduk.detailproduk',compact('test'));
});
Route::get('/', function () {
    $test = "Hallo";
    return view('welcome',compact('test'));
});
Route::get('/token',function(){
    return csrf_token(); 
});
Route::get('/map',function(){
    return view('leaflet');
});


//RajaOngkir
Route::get('getprovinsi','RajaOngkirController@getProvinsi');
Route::get('getkota/{id}','RajaOngkirController@getkota');
Route::get('provinsi', 'RajaOngkirController@provinsi')->name('provinsi');
Route::get('cost/{origin}/{destination}/{courier}/{berat}','RajaOngkirController@cost');
//Route::get('provinsi','RajaOngkirController@provinsi')->name('provinsi')->middleware('verified');;

//Auth Bawaan Laravel
Auth::routes();
Auth::routes(['verify' => true]);
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

//Alamat pembeli
Route::get('user/alamat','AlamatPembeliController@index')->name('alamatpembeli.index');
Route::get('user/alamat/edit/{id}', 'AlamatPembeliController@edit')->name('alamatpembeli.edit');
Route::post('user/alamat/store','AlamatPembeliController@store')->name('alamatpembeli.store');
//Route::put('user/alamat/update/{id}','AlamatPembeliController@update')->name('alamatpembeli.update');
Route::post('user/alamat/update', 'AlamatPembeliController@update')->name('alamatpembeli.update');
Route::delete('user/alamat/delete/{id}','AlamatPembeliController@destroy')->name('alamatpembeli.destroy');

//Keranjang
Route::get('user/keranjang','KeranjangController@index')->name('keranjang.index');
Route::post('user/keranjang/store','KeranjangController@store')->name('keranjang.store');
Route::put('user/keranjang/update/{id}','KeranjangController@update')->name('keranjang.update');
Route::delete('user/keranjang/delete/{id}','KeranjangController@destroy')->name('keranjang.destroy');

//Wishlist
Route::get('user/wishlist', 'WishlistController@index')->name('wishlist.index');
Route::post('user/wishlist/store', 'WishlistController@store')->name('wishlist.store');
Route::delete('user/wishlist/delete/{id}', 'WishlistController@destroy')->name('wishlist.destroy');

//Produk
Route::get('seller/produk','ProdukController@index')->name('produk.index');
Route::get('seller/produk/edit/{id}', 'ProdukController@edit')->name('produk.edit');
Route::get('seller/produk/gambar/{id}', 'ProdukController@picture')->name('produk.picture');
Route::get('seller/produk/tambah','ProdukController@create')->name('produk.create');
Route::post('seller/produk/store','ProdukController@store')->name('produk.store');
Route::delete('seller/produk/delete/{id}','ProdukController@destroy')->name('produk.destroy');

Route::get('user/produk/show/{id}', 'ProdukController@show')->name('produk.show');
//Route::get('hapus','ProdukController@removeImage');




