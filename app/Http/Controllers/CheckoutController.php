<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use DB;
use App\Alamatpembeli;
use Illuminate\Support\Carbon;
class CheckoutController extends Controller
{
    //
    public function index($id){
        $user = new User();
        $dukunganpengiriman = DB::table('dukunganpengiriman')
            ->join('kurir', 'kurir.idkurir', 'dukunganpengiriman.kurir_idkurir')
            ->join('merchant', 'merchant.users_iduser', '=', 'dukunganpengiriman.merchant_users_iduser')
            ->where('dukunganpengiriman.merchant_users_iduser','=',$id)
            ->select('kurir.idkurir','kurir.nama')
            ->get();
        $keranjang = DB::table('keranjang')
        ->join('produk','produk.idproduk','=','keranjang.produk_idproduk')
        ->join('users','users.iduser','=','keranjang.users_iduser')
        ->join('gambarproduk','gambarproduk.produk_idproduk','=','produk.idproduk')
        ->select('keranjang.jumlah as jumlah','produk.nama as nama','produk.harga as harga','gambarproduk.idgambarproduk as gambar')
        ->where('produk.merchant_users_iduser','=',$id)
        ->where('keranjang.users_iduser','=',$user->userid())
        ->groupBy('keranjang.produk_idproduk')
        ->get();
        //return $dukunganpengiriman;'
        //return Carbon::now()
        return view('user.checkout.checkout',compact('keranjang','dukunganpengiriman'));
        
    }
}
