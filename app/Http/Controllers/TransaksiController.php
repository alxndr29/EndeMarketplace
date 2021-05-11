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
    {
        $user = new User();
        $transaksi = DB::table('transaksi')
            ->join('merchant', 'merchant.users_iduser', '=', 'transaksi.merchant_users_iduser')
            ->join('pengiriman','pengiriman.transaksi_idtransaksi','transaksi.idtransaksi')
            ->join('detailtransaksi', 'detailtransaksi.transaksi_idtransaksi', '=', 'transaksi.idtransaksi')
            ->join('produk', 'produk.idproduk', '=', 'detailtransaksi.produk_idproduk')
            ->join('gambarproduk', 'gambarproduk.produk_idproduk', '=', 'produk.idproduk')
            ->groupBy('transaksi.idtransaksi')
            ->where('transaksi.users_iduser', $user->userid())
            ->select('pengiriman.idpengiriman as idpengiriman','transaksi.*', 'merchant.nama as nama_merchant', 'produk.nama as nama_produk', 'gambarproduk.idgambarproduk as gambar', 'detailtransaksi.*', DB::raw('COUNT(detailtransaksi.produk_idproduk) as totalbarang'))
            ->paginate(10);
        //return $transaksi;
        return view('user.transaksi.transaksi', compact('transaksi'));
    }
    public function indesPelangganFilter($tanggalAwal, $tanggalAkhir){
        $user = new User();
        $transaksi = DB::table('transaksi')
            ->join('merchant', 'merchant.users_iduser', '=', 'transaksi.merchant_users_iduser')
            ->join('detailtransaksi', 'detailtransaksi.transaksi_idtransaksi', '=', 'transaksi.idtransaksi')
            ->join('produk', 'produk.idproduk', '=', 'detailtransaksi.produk_idproduk')
            ->join('gambarproduk', 'gambarproduk.produk_idproduk', '=', 'produk.idproduk')
            ->groupBy('transaksi.idtransaksi')
            ->where('transaksi.users_iduser', $user->userid())
            ->whereBetween('transaksi.tanggal', [$tanggalAwal, $tanggalAkhir])
            ->select('transaksi.*', 'merchant.nama as nama_merchant', 'produk.nama as nama_produk', 'gambarproduk.idgambarproduk as gambar', 'detailtransaksi.*', DB::raw('COUNT(detailtransaksi.produk_idproduk) as totalbarang'))
            ->paginate(10);
        //return $transaksi;
        return view('user.transaksi.transaksi', compact('transaksi'));
    }
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
    public function indexMerchantFilter($tanggalAwal, $tanggalAkhir)
    {
        $merchant = new Merchant();
        //$transaksi = Transaksi::where('merchant_users_iduser',$merchant->idmerchant())->get();
        $transaksi = DB::table('transaksi')
            ->join('tipepembayaran', 'tipepembayaran.idtipepembayaran', '=', 'transaksi.tipepembayaran_idtipepembayaran')
            ->select('transaksi.*', 'tipepembayaran.nama as tipe_pembayaran')
            ->where('transaksi.merchant_users_iduser', $merchant->idmerchant())
            ->whereBetween('transaksi.tanggal', [$tanggalAwal, $tanggalAkhir])
            ->get();
        //   return 'masuk';
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
            ->where('transaksi.idtransaksi', $id)
            ->select('alamatpembeli.*', 'kabupatenkota.nama as nama_kota', 'kabupatenkota.kodepos as kode_pos', 'provinsi.nama as nama_provinsi')
            ->first();
        $transaksi = DB::table('transaksi')
            ->join('tipepembayaran', 'tipepembayaran.idtipepembayaran', '=', 'transaksi.tipepembayaran_idtipepembayaran')
            ->join('pengiriman', 'pengiriman.transaksi_idtransaksi', '=', 'transaksi.idtransaksi')
            ->join('kurir', 'kurir.idkurir', '=', 'pengiriman.kurir_idkurir')
            ->select('transaksi.*', 'tipepembayaran.nama as tipe_pembayaran', 'kurir.nama as nama_kurir', 'pengiriman.*')
            ->where('transaksi.idtransaksi', $id)
            ->first();
        //dd($transaksi);
        //dd($alamatPengiriman);
        //return $daftarProduk;
        //return $id;
        return view('seller.transaksi.detailtransaksi', compact('daftarProduk', 'alamatPengiriman', 'transaksi'));
    }
    public function detailPelanggan($id)
    {
        try {
            $user = new User();
            $transaksi = DB::table('transaksi')
                ->join('merchant', 'transaksi.merchant_users_iduser', '=', 'merchant.users_iduser')
                ->select('transaksi.*', 'merchant.nama as nama_merchant')
                ->where('transaksi.idtransaksi', $id)
                ->get();
            $produk = DB::table('detailtransaksi')
                ->join('transaksi', 'transaksi.idtransaksi', '=', 'detailtransaksi.transaksi_idtransaksi')
                ->join('produk', 'produk.idproduk', '=', 'detailtransaksi.produk_idproduk')
                ->join('gambarproduk', 'gambarproduk.produk_idproduk', '=', 'produk.idproduk')
                ->where('detailtransaksi.transaksi_idtransaksi', '=', $id)
                ->where('transaksi.users_iduser', $user->userid())
                ->select('detailtransaksi.*', 'produk.nama as nama_produk', 'produk.harga as harga_produk', 'gambarproduk.idgambarproduk as gambar_produk')
                ->get();
            $alamat = DB::table('transaksi')
                ->join('alamatpembeli', 'alamatpembeli.idalamat', '=', 'transaksi.alamatpembeli_idalamat')
                ->join('kabupatenkota','kabupatenkota.idkabupatenkota','=','alamatpembeli.kabupatenkota_idkabupatenkota')
                ->join('provinsi','provinsi.idprovinsi','=','kabupatenkota.provinsi_idprovinsi')
                ->where('transaksi.idtransaksi', $id)
                ->where('transaksi.users_iduser', $user->userid())
                ->select('alamatpembeli.*','kabupatenkota.*','provinsi.nama as nama_provinsi')
                ->get();
            $result = ['produk' => $produk, 'transaksi' => $transaksi,'alamat' => $alamat];
            return $result;
            //return response()->json($result);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
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
                $transaksi->status_transaksi = $action;
                $transaksi->save();
            } else if ($action == "UpdateResi") {
                Pengiriman::where('transaksi_idtransaksi', $id)->update(
                    [
                        'nomor_resi' => $request->get('updateResi')
                    ]
                );
                $transaksi->save();
            } else {
                $transaksi->status_transaksi = $action;
                $transaksi->save();
            }

            return "berhasil!";
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
