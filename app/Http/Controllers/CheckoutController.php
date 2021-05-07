<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use DB;
use App\Alamatpembeli;
use App\Transaksi;
use App\Pengiriman;
use Illuminate\Support\Carbon;

class CheckoutController extends Controller
{
    //
    public function index($id)
    {
        $user = new User();
        $dukunganpengiriman = DB::table('dukunganpengiriman')
            ->join('kurir', 'kurir.idkurir', 'dukunganpengiriman.kurir_idkurir')
            ->join('merchant', 'merchant.users_iduser', '=', 'dukunganpengiriman.merchant_users_iduser')
            ->where('dukunganpengiriman.merchant_users_iduser', '=', $id)
            ->select('kurir.idkurir', 'kurir.nama')
            ->get();
        $dukunganpembayaran = DB::table('dukunganpembayaran')
            ->join('tipepembayaran', 'tipepembayaran.idtipepembayaran', '=', 'dukunganpembayaran.tipepembayaran_idtipepembayaran')
            ->join('merchant', 'merchant.users_iduser', '=', 'dukunganpembayaran.merchant_users_iduser')
            ->where('dukunganpembayaran.merchant_users_iduser', '=', $id)
            ->select('tipepembayaran.idtipepembayaran as id', 'tipepembayaran.nama as nama')
            ->get();
        $keranjang = DB::table('keranjang')
            ->join('produk', 'produk.idproduk', '=', 'keranjang.produk_idproduk')
            ->join('users', 'users.iduser', '=', 'keranjang.users_iduser')
            ->join('gambarproduk', 'gambarproduk.produk_idproduk', '=', 'produk.idproduk')
            ->select('keranjang.jumlah as jumlah', 'keranjang.produk_idproduk as idproduk', 'produk.nama as nama', 'produk.harga as harga', 'gambarproduk.idgambarproduk as gambar')
            ->where('produk.merchant_users_iduser', '=', $id)
            ->where('keranjang.users_iduser', '=', $user->userid())
            ->groupBy('keranjang.produk_idproduk')
            ->get();
        $total = DB::table('keranjang')
            ->join('produk', 'produk.idproduk', '=', 'keranjang.produk_idproduk')
            ->where('produk.merchant_users_iduser', '=', $id)
            ->where('keranjang.users_iduser', '=', $user->userid())
            ->select(DB::raw('SUM(keranjang.jumlah * produk.harga) as jumlah, SUM(produk.berat * keranjang.jumlah) as berat'))
            ->first();
        $alamatMerchant = DB::table('alamatmerchant')->where('merchant_users_iduser', '=', $id)->select('alamatmerchant.*')->first();
        //return $alamatMerchant->kabupatenkota_idkabupatenkota;
        //return $dukunganpembayaran;
        return view('user.checkout.checkout', compact('id', 'keranjang', 'dukunganpengiriman', 'dukunganpembayaran', 'total', 'alamatMerchant'));
    }
    public function store(Request $request)
    {
        try {

            $user = new User();
            $keranjang = DB::table('keranjang')
                ->join('produk', 'produk.idproduk', '=', 'keranjang.produk_idproduk')
                ->join('users', 'users.iduser', '=', 'keranjang.users_iduser')
                ->select('keranjang.*', 'produk.harga')
                ->where('produk.merchant_users_iduser', '=', $request->get('idmerchant'))
                ->where('keranjang.users_iduser', '=', $user->userid())
                ->groupBy('keranjang.produk_idproduk')
                ->get();

            $transaksi = new Transaksi();
            $transaksi->status_transaksi = 'MenungguKonfirmasi';
            $transaksi->jenis_transaksi = 'Langsung';
            $transaksi->nominal_pembayaran = $request->get('nominalpembayaran');
            $transaksi->users_iduser = $user->userid();
            $transaksi->merchant_users_iduser = $request->get('idmerchant');
            $transaksi->alamatpembeli_idalamat = $request->get('idalamat');
            $transaksi->tipepembayaran_idtipepembayaran = $request->get('tipePembayaran');
            $transaksi->save();
            $id = $transaksi->idtransaksi;

            //$id = 1;
            foreach ($keranjang as $key => $value) {
                DB::table('detailtransaksi')->insert(
                    [
                        'produk_idproduk' => $value->produk_idproduk,
                        'transaksi_idtransaksi' => $id,
                        'jumlah' => $value->jumlah,
                        'total_harga' => $value->jumlah * $value->harga
                    ]
                );
            }
            $catatanProduk = $request->get('catatanproduk');
            foreach ($catatanProduk as $key => $value) {
                // return $k.$v; //24catatan produk 2
                DB::table('detailtransaksi')
                    ->where('transaksi_idtransaksi', $id)
                    ->where('produk_idproduk', $key)
                    ->update(
                        [
                            'catatan' => $value
                        ]
                    );
            }
            $biaya = explode("/",$request->get('biayaKurir'));
            //return $biaya;
            $pengiriman = new Pengiriman();
            $pengiriman->kurir_idkurir = $request->get('kurir');
            $pengiriman->transaksi_idtransaksi = $id;
            $pengiriman->biaya_pengiriman = $biaya[2];
            $pengiriman->estimasi = $biaya[1];
            $pengiriman->keterangan = $biaya[0].$biaya[1];
            $pengiriman->save();
            $idpengiriman = $pengiriman->idpengiriman;

            if ($request->get('kurir') == 2) {
                DB::table('datapengiriman')->insert(
                    [
                        'latitude_user' => $request->get('latitudeUser'),
                        'longitude_user' => $request->get('longitudeUser'),
                        'latitude_merchant' => $request->get('latitudeMerchant'),
                        'longitude_merchant' => $request->get('longitudeMerchant'),
                        'jarak' => $request->get('jarakPengiriman'),
                        'volume' => 0,
                        'berat' => 0,
                        'status' => 'MenungguPengiriman',
                        'pengiriman_idpengiriman' => $idpengiriman
                    ]
                );
                return $request->all();
            }
           
            // return 'hello world!';

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
