<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\DB;
use App\Produk;
use Illuminate\Support\Facades\Log;
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
Route::get('/log', function () {
    // $hr = 1;
    // return date("Y-m-d H:i:s", strtotime("+".$hr."day"));
    // return date("Y-m-d H:i:s", strtotime("+ 15 minutes"));
    // SELECT hour( timediff(date_add(Now(),interval 8 hour),Now() ))+

    // $trk = DB::table('transaksi')->where('idtransaksi', 10)->first();
    // if($trk->jenis_transaksi == "PreOrder"){
    //     return date("Y-m-d H:i:s", strtotime("+" . $trk->waktu_po . "day"));
    // }else{
    //     return date("Y-m-d H:i:s", strtotime("+ 1 day"));
    // }
    //DB::raw('hour(timediff(date_add(Now(),interval 8 hour),transaksi.timeout_at)) as timeout')
    //DB::raw('HOUR(TIMEDIFF(transaksi.timeout_at, NOW() )) as timeout')
    $data = DB::table('transaksi')
        // ->where('status_transaksi', '=', 'MenungguPembayaran')
        ->where('status_transaksi', '=', 'MenungguKonfirmasi')
        ->orWhere('status_transaksi', '=', 'SampaiTujuan')
        ->orWhere('status_transaksi', '=', 'PesananDiproses')
        //->select('transaksi.idtransaksi', 'transaksi.status_transaksi', DB::raw('HOUR(TIMEDIFF(transaksi.timeout_at, NOW() )) as timeout'))
        ->select('transaksi.idtransaksi', 'transaksi.status_transaksi', DB::raw('hour(timediff(date_add(Now(),interval 8 hour),transaksi.timeout_at)) as timeout'))
        ->get();
    foreach ($data as $value) {
        if ($value->timeout === 0) {
            DB::beginTransaction();
            try {
                if ($value->status_transaksi == "SampaiTujuan") {
                    DB::table('transaksi')->where('idtransaksi', $value->idtransaksi)->update([
                        'status_transaksi' => "Selesai"
                    ]);
                    $intiPesan = "terselesaikan";
                } else {
                    DB::table('transaksi')->where('idtransaksi', $value->idtransaksi)->update([
                        'status_transaksi' => "Batal"
                    ]);
                    $detailTransaksi = DB::table('detailtransaksi')->where('transaksi_idtransaksi', $value->idtransaksi)->get();
                    foreach ($detailTransaksi as $value1) {
                        $produk = Produk::find($value1->produk_idproduk);
                        if ($produk->stok == 0) {
                            $produk->status = "Aktif";
                        }
                        $produk->stok = $produk->stok + $value1->jumlah;
                        $produk->save();
                    }
                    $intiPesan = "dibatalkan";
                }
                $user = DB::table('transaksi')
                    ->join('users', 'users.iduser', '=', 'transaksi.users_iduser')
                    ->where('transaksi.idtransaksi', '=', $value->idtransaksi)
                    ->select('users.*')
                    ->first();
                $pesan =  "Hallo " . $user->name . ". Pesanan anda dengan nomor transaksi " . $value->idtransaksi . " " . " Telah"  . $intiPesan . ' karena telah melewati batas waktu klik link berikut untuk melihat status transaksi anda! ' . url('/user/transaksi/index');
                DB::commit();
                if ($user->notif_email == 1) {
                    try {
                        $details = [
                            'title' => '',
                            'body' => $pesan
                        ];
                        \Mail::to($user->email)->send(new \App\Mail\CheckoutMail($details));
                    } catch (\Exception $b) { }
                }
                if ($user->notif_wa == 1) {
                    try {
                        $result = file_get_contents("https://sambi.wablas.com/api/send-message?token=NirUvUwRNAl1wbpCCnTsfg2fqLycFqmIel8ir6K5DpYJSVe6vExEgrL7IEeVqp4O&phone=" . $user->telepon . "&message=" . $pesan);
                    } catch (\Exception $a) { }
                }
                Log::info('Transaksi ' . $value->idtransaksi . 'Sisa waktu 0');
                echo ('Transaksi ' . $value->idtransaksi . 'Sisa waktu 0 '); echo ('<br>');
            } catch (\Exception $e) {
                DB::rollback();
                return $e->getMessage();
            }
        } else {
            Log::info('Transaksi ' . $value->idtransaksi . ' Sisa waktu ' . $value->timeout . ' Jam' . ' Status Saat ini ' . $value->status_transaksi);
            echo ('Transaksi ' . $value->idtransaksi . ' Sisa waktu ' . $value->timeout . ' Jam' . ' Status Saat ini ' . $value->status_transaksi); echo ('<br>');
        }
    }
    Log::info('Cronjob Berhasil Dijalankan'); echo ('Cronjob Berhasil Dijalankan');
    //echo date("Y-m-d H:i:s", strtotime("+ 1 day"));
});
Route::get('/p', function () {
    return view('seller.petugaspengantaran.detailpengantaran');
});
Route::get('/user', function () {
    $test = "Hallo";
    return view('user.detailproduk.detailproduk', compact('test'));
});
Route::get('/', function () {
    // $test = "Hallo";
    // return view('welcome',compact('test'));
    return redirect('user/home');
});
Route::get('/token', function () {
    return csrf_token();
});
Route::get('/map', function () {
    return view('leaflet');
});
Route::get('/review', function () {
    return view('user.review.review');
});
Route::get('/loginstatus', function () {
    if (Auth::check()) {
        return true;
    }
})->name('loginstatus');


//RajaOngkir
Route::get('getprovinsi', 'RajaOngkirController@getProvinsi');
Route::get('getkota/{id}', 'RajaOngkirController@getkota');
Route::get('provinsi', 'RajaOngkirController@provinsi')->name('provinsi');
Route::get('cost/{origin}/{destination}/{courier}/{berat}', 'RajaOngkirController@cost');
//Route::get('provinsi','RajaOngkirController@provinsi')->name('provinsi')->middleware('verified');;

//Auth Bawaan Laravel
//Auth::routes();

Auth::routes(['verify' => true]);
Route::get('/home', 'HomeController@index')->name('home');
Route::get('user/home', 'HomeController@homeUser')->name('user.home')->middleware('verified');

//Xendit Payment Gateway
Route::get('/xendit/balance', 'XenditController@balance')->name('xendit.balance');
Route::get('/xendit/listva', 'XenditController@getListVA')->name('xendit.getListVA');
Route::get('/xendit/createva', 'XenditController@createVA')->name('xendit.createVA');
Route::get('/xendit/showpayment', 'XenditController@showPayment')->name('xendit.showPayment');

//Midtrans Payment Gateway
Route::get('/midtrans/index', 'MidtransController@index');
Route::get('/midtrans/getToken/{id}', 'MidtransController@getToken');
Route::get('/midtrans/status', 'MidtransController@getStatus');
Route::get('/midtrans/cancel', 'MidtransController@cancelPayment');
Route::post('/midtrans/notification', 'MidtransController@payment_handling');
Route::get('/midtrans/refund', 'MidtransController@refundPayment');

//User Device
Route::get('/userdevice', 'UserDeviceController@getusersysteminfo')->name('userdevice.getusersysteminfo');
Route::post('/userdevice/store', 'UserDeviceController@store')->name('userdevice.store');

//Kategori
Route::get('seller/kategori', 'KategoriProdukController@index')->name('kategoriproduk.index');
Route::post('seller/kategori/store', 'KategoriProdukController@store')->name('kategoriproduk.store');
Route::put('seller/kategori/update/{id}', 'KategoriProdukController@update')->name('kategoriproduk.update');
Route::delete('seller/kategori/delete/{id}', 'KategoriProdukController@destroy')->name('kategoriproduk.destroy');

//Daftar Merchant
Route::post('seller/merchant/store', 'MerchantController@store')->name('merchant.store');
Route::get('user/merchant/profile/{id}', 'MerchantController@show')->name('merchant.show');
Route::get('user/merchant/etalase/{id1}/{id2}/{id3?}', 'MerchantController@etalase')->name('merchant.etalase');

Route::group(['middleware' => ['auth', 'cekmerchant', 'cekkonfigurasimerchant']], function () {
    //Merchant
    Route::get('seller/merchant', 'MerchantController@index')->name('merchant.index');
    Route::get('seller/merchant/daftar', 'MerchantController@create')->name('merchant.create');
});
Route::put('seller/merchant/update/{id}', 'MerchantController@update')->name('merchant.update');
Route::get('seller/merchant/edit', 'MerchantController@edit')->name('merchant.edit');

//Alamat pembeli
Route::get('user/alamat', 'AlamatPembeliController@index')->name('alamatpembeli.index');
Route::get('user/alamat/checkout', 'AlamatPembeliController@alamatCheckout')->name('alamatpembeli.checkout');
Route::get('user/alamat/edit/{id}', 'AlamatPembeliController@edit')->name('alamatpembeli.edit');
Route::post('user/alamat/store', 'AlamatPembeliController@store')->name('alamatpembeli.store');
//Route::put('user/alamat/update/{id}','AlamatPembeliController@update')->name('alamatpembeli.update');
Route::post('user/alamat/update', 'AlamatPembeliController@update')->name('alamatpembeli.update');
Route::delete('user/alamat/delete/{id}', 'AlamatPembeliController@destroy')->name('alamatpembeli.destroy');

//Keranjang
Route::get('user/keranjang', 'KeranjangController@index')->name('keranjang.index');
Route::post('user/keranjang/store', 'KeranjangController@store')->name('keranjang.store');
Route::put('user/keranjang/update/{id}', 'KeranjangController@update')->name('keranjang.update');
Route::delete('user/keranjang/delete/{id}', 'KeranjangController@destroy')->name('keranjang.destroy');
Route::get('user/keranjang/data', 'KeranjangController@loadKeranjang')->name('keranjang.data');
Route::get('user/keranjang/merchant', 'KeranjangController@loadMerchant')->name('keranjang.merchant.data');
Route::get('user/keranjang/data/po', 'KeranjangController@loadKeranjangPO')->name('keranjang.dataPO');
Route::get('user/keranjang/merchant/po', 'KeranjangController@loadMerchantPO')->name('keranjang.merchant.dataPO');
Route::get('user/keranjang/notifikasi', 'KeranjangController@notifikasiKeranjangUser')->name('keranjang.notifikasi');

//Wishlist
Route::get('user/wishlist', 'WishlistController@index')->name('wishlist.index');
Route::post('user/wishlist/store', 'WishlistController@store')->name('wishlist.store');
Route::delete('user/wishlist/delete/{id}', 'WishlistController@destroy')->name('wishlist.destroy');

//Produk
Route::get('seller/produk', 'ProdukController@index')->name('produk.index');
Route::get('seller/produk/edit/{id}', 'ProdukController@edit')->name('produk.edit');
Route::get('seller/produk/gambar/{id}', 'ProdukController@picture')->name('produk.picture');
Route::get('seller/produk/tambah', 'ProdukController@create')->name('produk.create');
Route::post('seller/produk/store', 'ProdukController@store')->name('produk.store');
Route::put('seller/produk/update/{id}', 'ProdukController@update')->name('produk.update');
Route::delete('seller/produk/delete/{id}', 'ProdukController@destroy')->name('produk.destroy');

Route::get('user/produk/show/{id}', 'ProdukController@show')->name('produk.show');
Route::get('user/produk/cari/', 'ProdukController@search')->name('produk.search');
//Route::get('hapus','ProdukController@removeImage');

//Obrolan User
Route::get('user/obrolan/index', 'ObrolanController@indexUser')->name('obrolan.index.user');
Route::get('user/obrolan/index/{id1}/{id2}', 'ObrolanController@indexUserParameter')->name('obrolan.index.param.user');
Route::post('user/obrolan/store', 'ObrolanController@inserObrolanUser')->name('obrolan.user.store');
Route::get('user/obrolan/get/{id}', 'ObrolanController@getObrolanUser')->name('obrolan.user.get');

//Obrolan Merchant
Route::get('seller/obrolan/index', 'ObrolanController@indexMerchant')->name('obrolan.index.seller');
Route::post('seller/obrolan/store', 'ObrolanController@insertObrolanMerchant')->name('obrolan.seller.store');
Route::get('seller/obrolan/get/{id}', 'ObrolanController@getObrolanMerchant')->name('obrolan.user.get');


//Diskusi
Route::post('diskusi/store/{id}', 'DiskusiController@storeDiskusi')->name('diskusi.store');
Route::post('diskusi/balasan/store/{id}/{id2}', 'DiskusiController@storeBalasanDiskusi')->name('diskusi.balasan.store');
Route::get('diskusi/data/{id}', 'DiskusiController@getDataDiskusi')->name('diskusi.data');

//OTP
Route::post('otp/email/send', 'OtpController@otpEmail')->name('otp.email.send');
Route::post('otp/whatsapp/send', 'OtpController@otpWhatsapp')->name('otp.whatsapp.send');
Route::post('/otp/verifikasi', 'OtpController@verifikasi')->name('otp.verifikasi');

//Checkout
Route::get('user/checkout/{id}/{status?}', 'CheckoutController@index')->name('checkout.index');
Route::post('user/checkout/store', 'CheckoutController@store')->name('checkout.store');

//Transaksi Merchant
Route::get('seller/transaksi/index', 'TransaksiController@indexMerchant')->name('merchant.transaksi.index');
Route::get('seller/transaksi/index/{tanggalAwal}/{tanggalAkhir}/{status}', 'TransaksiController@indexMerchantFilter')->name('merchant.transaksi.index.filter');
Route::get('seller/transaksi/detail/{id}', 'TransaksiController@detailMerchant')->name('merchant.transaksi.detail');
Route::put('seller/transaksi/update/{id}/{action}', 'TransaksiController@prosePesananMerchant')->name('merchant.transaksi.update');

//Transaksi User
Route::get('user/transaksi/index', 'TransaksiController@indexPelanggan')->name('pelanggan.transaksi.index');
Route::get('user/transaksi/index/{tanggalAwal}/{tanggalAkhir}/{status}', 'TransaksiController@indexPelangganFilter')->name('pelanggan.transaksi.index.filter');
Route::get('user/transaksi/detail/{id}', 'TransaksiController@detailPelanggan')->name('pelanggan.transaksi.detail');
Route::get('user/transaksi/tracking/{id}/{idtransaksi}/{jenis}', 'PengirimanController@detailPengantaran')->name('pelanggan.transaksi.tracking');
Route::get('user/tracking/lokasi/kurir/{id}', 'PengirimanController@getLokasiKurir')->name('pelanggan.tracking.lokasi.kurir');
Route::get('user/transaksi/selesai/{id}', 'TransaksiController@selesaiPesanan')->name('pelanggan.transaksi.selesai');
Route::get('user/transaksi/batal/{id}', 'TransaksiController@batalPesanan')->name('pelanggan.transaksi.batal');

//Penarikan Dana User
Route::get('user/penarikan', 'PenarikanController@indexUser')->name('penarikan.user');
Route::post('user/penarikan/form', 'PenarikanController@formulirPenarikanUser')->name('formrefund.user');
Route::get('user/penarikan/detail/{id}', 'PenarikanController@detailPenarikanUser')->name('detailpenarikan.user');
Route::put('user/penarikan/update/{id}', 'PenarikanController@updateFormulirPenarikanUser')->name('formrefundedit.user');

//Penarikan dana Merchant
Route::get('seller/penarikan', 'PenarikanController@indexMerchant')->name('penarikan.merchant');
Route::post('seller/penarikan/form', 'PenarikanController@formulirPenarikanMerchant')->name('formrefund.merchant');
Route::get('seller/penarikan/detail/{id}', 'PenarikanController@detailPenarikanMerchant')->name('detailpenarikan.merchant');
Route::put('seller/penarikan/update/{id}', 'PenarikanController@updateFormulirPenarikanMerchant')->name('formrefundedit.merchant');

//Review Produk
Route::post('user/transaksi/review/', 'TransaksiController@reviewProduk')->name('pelanggan.transaksi.review');
Route::get('seller/review', 'ProdukController@indexReview')->name('seller.review.index');
Route::get('seller/review/detail/{id}', 'ProdukController@detailReview')->name('seller.review.detail');

//Pengiriman Merchant
Route::get('seller/pengiriman/index', 'PengirimanController@indexMerchant')->name('merchant.pengiriman.index');
Route::get('seller/pengiriman/{tanggalAwal}/{tanggalAkhir}', 'PengirimanController@indexMerhcantParam')->name('merchant.pengiriman.index.filter');
//Route::get('seller/pengiriman/detail/{id}', 'PengirimanController@detailPengirimanMerchant')->name('merchant.pengiriman.detail');
Route::get('seller/pengiriman/detail/pengiriman/{id}', 'PengirimanController@detailPengirimanMerchant')->name('merchant.pengiriman.detail');
Route::get('seller/pengiriman/status/{id}/{status}/{jenis}/{pengantar?}', 'PengirimanController@updateStatus')->name('merchant.status.ubah');

//Pengantaran Merchant
Route::get('seller/pengantaran/index', 'PengirimanController@pengantaranMerchant')->name('merchant.pengantaran.index');
Route::get('seller/pengantaran/detail/{id}/{idtransaksi}/{jenis}', 'PengirimanController@detailPengantaran')->name('merchant.pengantaran.detail');
Route::post('seller/pengantaran/lokasi/update', 'PengirimanController@updateLokasiKurir')->name('nerchant.lokasikurir.update');

//Petugas Pengantaran
Route::get('seller/petugas', 'PetugasPengantaranController@index')->name('merchant.petugas.index');
Route::post('seller/petugas/store', 'PetugasPengantaranController@store')->name('merchant.petugas.store');
Route::get('seller/petugas/edit/{id}', 'PetugasPengantaranController@edit')->name('merchant.petugas.edit');
Route::put('seller/petugas/update/{id}', 'PetugasPengantaranController@update')->name('merchant.petugas.update');
Route::delete('seller/petugas/delete/{id}', 'PetugasPengantaranController@destroy')->name('merchant.petugas.destroy');

//Akun Petugas pengantaran
Route::get('login/pengantar', 'PetugasPengantaranController@login')->name('merchant.petugas.login');
Route::post('login/pengantar/store', 'PetugasPengantaranController@loginProses')->name('merchant.petugas.loginproses');
Route::group(['middleware' => ['cekpetugaspengantaran']], function () {
    Route::get('seller/petugas/daftarpengantaran', 'PengirimanController@indexPengantar')->name('merchant.petugas.daftar');
    Route::get('seller/petugas/detailpengantaran/{id}/{idtransaksi}/{jenis}', 'PengirimanController@detailPengantaran')->name('merchant.petugas.detail');
    Route::post('seller/petugas/foto', 'PengirimanController@uploadFotoSelesai')->name('merchant.petugas.fotoselesai');
    Route::get('logout/pengantar', 'PetugasPengantaranController@logout')->name('merchant.petugas.logout');
});

//Tracking Coba
Route::get('tracking/index', 'TrackingController@index');
//Update Profil Pelanggan
Route::post('user/profile/update', 'HomeController@updateUser')->name('user.profile.update');

//Admin
Route::get('admin/login', 'AdminController@login')->name('admin.login');
Route::post('admin/login/store', 'AdminController@loginProses')->name('admin.loginproses');
Route::get('admin/logout', 'AdminController@logout')->name('admin.logout');
Route::group(['middleware' => ['cekadmin']], function () {
    Route::get('admin/home', 'AdminController@home')->name('home.admin');
    Route::get('admin/refund', 'AdminController@refund')->name('refund.admin');
    Route::get('admin/refund/detail/{id}', 'AdminController@detailRefund')->name('refunddetail.admin');
    Route::post('admin/refund/update/status/{id}/{status}', 'AdminController@ubahStatusRefund')->name('refundstatus.admin');
});

//Komplain Pelanggan
Route::post('user/komplain/insert/','KomplainController@insertPelanggan')->name('user.komplain.insert');
Route::get('user/komplain/produk/{id}','KomplainController@daftarProdukKomplain');
// Komplain Penjual
