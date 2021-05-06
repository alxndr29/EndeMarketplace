<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Merchant;
use App\User;
use App\Pengiriman;
use App\Transaksi;

class TransaksiController extends Controller
{
    //
    public function indexPelanggan()
    { }
    public function indexMerchant()
    {
        $merchant = new Merchant();
        //$transaksi = Transaksi::where('merchant_users_iduser',$merchant->idmerchant())->get();
        $transaksi = DB::table('transaksi')
            ->join('tipepembayaran', 'tipepembayaran.idtipepembayaran', '=', 'transaksi.tipepembayaran_idtipepembayaran')
            ->select('transaksi.*', 'tipepembayaran.nama as tipe_pembayaran')
            ->where('transaksi.merchant_users_iduser', $merchant->idmerchant())
            ->get();
        //return $transaksi;
        return view('seller.transaksi.transaksi', compact('transaksi'));
    }
    public function detailMerchant($id)
    {
        $daftarProduk = DB::table('transaksi')
            ->join('detailtransaksi', 'detailtransaksi.transaksi_idtransaksi', '=', 'transaksi.idtransaksi')
            ->join('produk', 'produk.idproduk', 'detailtransaksi.produk_idproduk')
            ->leftJoin('gambarproduk', 'gambarproduk.produk_idproduk', 'produk.idproduk')
            ->where('transaksi.idtransaksi', $id)
            ->select('detailtransaksi.*', 'produk.nama as nama_produk', 'gambarproduk.idgambarproduk as gambar')
            ->groupBy('detailtransaksi.produk_idproduk')
            ->get();
        $alamatPengiriman = DB::table('transaksi')
            ->join('alamatpembeli', 'alamatpembeli.idalamat', '=', 'transaksi.alamatpembeli_idalamat')
            ->join('kabupatenkota', 'alamatpembeli.kabupatenkota_idkabupatenkota', 'kabupatenkota.idkabupatenkota')
            ->join('provinsi', 'kabupatenkota.provinsi_idprovinsi', '=', 'provinsi.idprovinsi')
            ->select('alamatpembeli.*', 'kabupatenkota.nama as nama_kota', 'kabupatenkota.kodepos as kode_pos', 'provinsi.nama as nama_provinsi')
            ->first();
        $transaksi = DB::table('transaksi')
            ->join('tipepembayaran', 'tipepembayaran.idtipepembayaran', '=', 'transaksi.tipepembayaran_idtipepembayaran')
            ->join('pengiriman', 'pengiriman.transaksi_idtransaksi', '=', 'transaksi.idtransaksi')
            ->join('kurir', 'kurir.idkurir', '=', 'pengiriman.kurir_idkurir')
            ->select('transaksi.*', 'tipepembayaran.nama as tipe_pembayaran', 'kurir.nama as nama_kurir', 'pengiriman.biaya_pengiriman')
            ->where('transaksi.idtransaksi', $id)
            ->first();
        //dd($transaksi);
        //dd($alamatPengiriman);
        //return $daftarProduk;
        //return $id;
        return view('seller.transaksi.detailtransaksi', compact('daftarProduk', 'alamatPengiriman', 'transaksi'));
    }
    public function prosePesananMerchant(Request $request, $id, $action)
    {
        try {
            $transaksi = Transaksi::find($id);
            if ($action == "PesananDikirim") {
                Pengiriman::where('transaksi_idtransaksi', $id)->update(
                    [
                        'nomor_resi' => $request->get('nomorResi'),
                        'tanggal_pengiriman' => $request->get('tanggalPengiriman')
                    ]
                );
            }
            $transaksi->status_transaksi = $action;
            $transaksi->save();
            return "berhasil!";
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
