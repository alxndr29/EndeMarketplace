<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;

class KeranjangController extends Controller
{
    //
    public function index()
    {
        $user = new User();
        $keranjang = DB::table('keranjang')
        ->join('produk','keranjang.produk_idproduk','=','produk.idproduk')
        ->join('gambarproduk','produk.idproduk','=','gambarproduk.produk_idproduk')
        ->join('merchant','merchant.users_iduser','=','produk.merchant_users_iduser')
        ->groupBy('produk.idproduk')
        ->select('produk.*','gambarproduk.*','merchant.nama as nama_merchant','keranjang.*')
        ->where('keranjang.users_iduser', $user->userid())
        ->get();
        return view('user.keranjang.keranjang',compact('keranjang'));
    }
    public function loadKeranjang(){
        $user = new User();
        $keranjang = DB::table('keranjang')
            ->join('produk', 'keranjang.produk_idproduk', '=', 'produk.idproduk')
            ->join('gambarproduk', 'produk.idproduk', '=', 'gambarproduk.produk_idproduk')
            ->join('merchant', 'merchant.users_iduser', '=', 'produk.merchant_users_iduser')
            ->groupBy('produk.idproduk')
            ->select('produk.*', 'gambarproduk.*', 'merchant.nama as nama_merchant', 'keranjang.*')
            ->where('keranjang.users_iduser', $user->userid())
            ->get();
        return $keranjang;
    }
    public function loadMerchant(){
        $user = new User();
        $merchant = DB::table('keranjang')
            ->join('produk', 'keranjang.produk_idproduk', '=', 'produk.idproduk')
            ->join('merchant', 'merchant.users_iduser', '=', 'produk.merchant_users_iduser')
            ->groupBy('merchant.users_iduser')
            ->select('merchant.users_iduser as idmerchant','merchant.nama as nama_merchant')
            ->where('keranjang.users_iduser', $user->userid())
            ->get();
        return $merchant;
    }
    public function store(Request $request)
    {
        $user = new User();
        $iduser = $user->userid();
        $idproduk = $request->get('idproduk');
        $jumlah = $request->get('jumlah');
        try {
            DB::table('keranjang')
                ->updateOrInsert(
                    [
                        'users_iduser' => $iduser,
                        'produk_idproduk' => $idproduk,
                        'jumlah' => $jumlah
                    ]
                );
            $response = ['status' => 'berhasil'];
            return response()->json($response);
        } catch (\Exception $e) {
            $response = ['status' => $e->getMessage()];
            return response()->json($response);
        }
        //return $request->all();
    }
    public function update(Request $request, $id)
    {
        try {
            $user = new User();
            $iduser = $request->get('iduser');
            $keranjang = DB::table('keranjang')
                ->where('users_iduser', $iduser)
                ->where('produk_idproduk', $id)
                ->update(['jumlah' => 5]);
            return "berhasil";
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function destroy($id)
    {
        try {
            $user = new User();
            DB::table('keranjang')->where('produk_idproduk', $id)->where('users_iduser', $user->userid())->delete();
            return "berhasil";
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        
    }
    public function notifikasiKeranjangUser(){
        $user = new User();
        $keranjang = DB::table('keranjang')
            ->join('produk', 'keranjang.produk_idproduk', '=', 'produk.idproduk')
            ->join('gambarproduk', 'produk.idproduk', '=', 'gambarproduk.produk_idproduk')
            ->join('merchant', 'merchant.users_iduser', '=', 'produk.merchant_users_iduser')
            ->groupBy('produk.idproduk')
            ->select('produk.*', 'gambarproduk.*', 'merchant.nama as nama_merchant', 'keranjang.*')
            ->where('keranjang.users_iduser', $user->userid())
            ->get();
        return $keranjang;
    }
}
