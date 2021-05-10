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
//Route::get('/email','OtpController@send');

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
Route::get('user/home', 'HomeController@homeUser')->name('user.home');

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
Route::get('seller/merchant/edit','MerchantController@edit')->name('merchant.edit');
Route::put('seller/merchant/update/{id}','MerchantController@update')->name('merchant.update');

Route::get('user/merchant/profile/{id}','MerchantController@show')->name('merchant.show');
Route::get('user/merchant/etalase/{id1}/{id2}', 'MerchantController@etalase')->name('merchant.etalase');

//Alamat pembeli
Route::get('user/alamat','AlamatPembeliController@index')->name('alamatpembeli.index');
Route::get('user/alamat/checkout', 'AlamatPembeliController@alamatCheckout')->name('alamatpembeli.checkout');
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
Route::get('user/keranjang/data','KeranjangController@loadKeranjang')->name('keranjang.data');
Route::get('user/keranjang/merchant','KeranjangController@loadMerchant')->name('keranjang.merchant.data');
Route::get('user/keranjang/notifikasi','KeranjangController@notifikasiKeranjangUser')->name('keranjang.notifikasi');

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
Route::put('seller/produk/update/{id}','ProdukController@update')->name('produk.update');
Route::delete('seller/produk/delete/{id}','ProdukController@destroy')->name('produk.destroy');

Route::get('user/produk/show/{id}', 'ProdukController@show')->name('produk.show');
Route::get('user/produk/cari/{id}','ProdukController@search')->name('produk.search');
//Route::get('hapus','ProdukController@removeImage');

//Obrolan User
Route::get('user/obrolan/index','ObrolanController@indexUser')->name('obrolan.index.user');
Route::get('user/obrolan/index/{id1}/{id2}', 'ObrolanController@indexUserParameter')->name('obrolan.index.param.user');
Route::post('user/obrolan/store','ObrolanController@inserObrolanUser')->name('obrolan.user.store');
Route::get('user/obrolan/get/{id}','ObrolanController@getObrolanUser')->name('obrolan.user.get');

//Obrolan Merchant
Route::get('seller/obrolan/index','ObrolanController@indexMerchant')->name('obrolan.index.seller');
Route::post('seller/obrolan/store', 'ObrolanController@insertObrolanMerchant')->name('obrolan.seller.store');
Route::get('seller/obrolan/get/{id}', 'ObrolanController@getObrolanMerchant')->name('obrolan.user.get');


//Diskusi
Route::post('diskusi/store/{id}','DiskusiController@storeDiskusi')->name('diskusi.store');
Route::post('diskusi/balasan/store/{id}/{id2}','DiskusiController@storeBalasanDiskusi')->name('diskusi.balasan.store');
Route::get('diskusi/data/{id}','DiskusiController@getDataDiskusi')->name('diskusi.data');

//OTP
Route::post('otp/email/send','OtpController@otpEmail')->name('otp.email.send');
Route::post('otp/whatsapp/send', 'OtpController@otpEmail')->name('otp.whatsapp.send');
Route::post('/otp/verifikasi','OtpController@verifikasi')->name('otp.verifikasi');

//Checkout
Route::get('user/checkout/{id}','CheckoutController@index')->name('checkout.index');
Route::post('user/checkout/store','CheckoutController@store')->name('checkout.store');

//Transaksi Merchant
Route::get('seller/transaksi/index','TransaksiController@indexMerchant')->name('merchant.transaksi.index');
Route::get('seller/transaksi/index/{tanggalAwal}/{tanggalAkhir}', 'TransaksiController@indexMerchantFilter')->name('merchant.transaksi.index.filter');
Route::get('seller/transaksi/detail/{id}','TransaksiController@detailMerchant')->name('merchant.transaksi.detail');
Route::put('seller/transaksi/update/{id}/{action}','TransaksiController@prosePesananMerchant')->name('merchant.transaksi.update');
//Transaksi User
Route::get('user/transaksi/index', 'TransaksiController@indexPelanggan')->name('pelanggan.transaksi.index');
Route::get('user/transaksi/index/{tanggalAwal}/{tanggalAkhir}', 'TransaksiController@indesPelangganFilter')->name('pelanggan.transaksi.index.filter');
Route::get('user/transaksi/detail/{id}','TransaksiController@detailPelanggan')->name('pelanggan.transaksi.detail');

//Pengiriman Merchant
Route::get('seller/pengiriman/index','PengirimanController@indexMerchant')->name('merchant.pengiriman.index');
Route::get('seller/pengiriman/{tanggalAwal}/{tanggalAkhir}', 'PengirimanController@indexMerhcantParam')->name('merchant.pengiriman.index.filter');
//Route::get('seller/pengiriman/detail/{id}', 'PengirimanController@detailPengirimanMerchant')->name('merchant.pengiriman.detail');
Route::get('seller/pengiriman/detail/pengiriman/{id}', 'PengirimanController@detailPengirimanMerchant')->name('merchant.pengiriman.detail');
Route::get('seller/pengiriman/status/{id}/{status}','PengirimanController@updateStatus')->name('merchant.status.ubah');
//Pengantaran Merchant
Route::get('seller/pengantaran/index','PengirimanController@pengantaranMerchant')->name('merchant.pengantaran.index');
Route::get('seller/pengantaran/detail/{id}/{idtransaksi}','PengirimanController@detailPengantaran')->name('merchant.pengantaran.detail');

//Tracking Coba
Route::get('tracking/index','TrackingController@index');