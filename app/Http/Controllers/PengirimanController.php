<?php

namespace App\Http\Controllers;

use DB;
use App\Merchant;
use App\Pengiriman;
use App\Transaksi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PengirimanController extends Controller
{
    //
    public function indexMerchant()
    {
        $merchant = new Merchant();
        $data = DB::table('pengiriman')
            ->leftJoin('datapengiriman', 'datapengiriman.pengiriman_idpengiriman', '=', 'pengiriman.idpengiriman')
            ->join('transaksi', 'transaksi.idtransaksi', '=', 'pengiriman.transaksi_idtransaksi')
            ->join('tipepembayaran', 'tipepembayaran.idtipepembayaran', '=', 'transaksi.tipepembayaran_idtipepembayaran')
            ->join('kurir', 'kurir.idkurir', '=', 'pengiriman.kurir_idkurir')
            ->where('transaksi.merchant_users_iduser', '=', $merchant->idmerchant())
            ->where('kurir.idkurir', '=', 2)
            ->where('pengiriman.nomor_resi', '!=', null)
            ->select('pengiriman.*', 'datapengiriman.*', 'tipepembayaran.nama as tipepembayaran')
            ->get();
        //return $data;
        return view('seller.pengiriman.pengiriman', compact('data'));
    }
    public function indexMerhcantParam($tglAwal, $tglAkhir)
    {
        $merchant = new Merchant();
        $data = DB::table('pengiriman')
            ->leftJoin('datapengiriman', 'datapengiriman.pengiriman_idpengiriman', '=', 'pengiriman.idpengiriman')
            ->join('transaksi', 'transaksi.idtransaksi', '=', 'pengiriman.transaksi_idtransaksi')
            ->join('tipepembayaran', 'tipepembayaran.idtipepembayaran', '=', 'transaksi.tipepembayaran_idtipepembayaran')
            ->join('kurir', 'kurir.idkurir', '=', 'pengiriman.kurir_idkurir')
            ->where('transaksi.merchant_users_iduser', '=', $merchant->idmerchant())
            ->where('kurir.idkurir', '=', 2)
            ->where('pengiriman.nomor_resi', '!=', null)
            ->whereBetween('pengiriman.tanggal_pengiriman', [$tglAwal, $tglAkhir])
            ->select('pengiriman.*', 'datapengiriman.*', 'tipepembayaran.nama as tipepembayaran')
            ->get();
        //return $data;
        return view('seller.pengiriman.pengiriman', compact('data'));
    }
    public function detailPengirimanMerchant($id)
    {
        $merchant = new Merchant();
        $data = DB::table('pengiriman')
            ->leftJoin('datapengiriman', 'datapengiriman.pengiriman_idpengiriman', '=', 'pengiriman.idpengiriman')
            ->join('transaksi', 'transaksi.idtransaksi', '=', 'pengiriman.transaksi_idtransaksi')
            ->join('tipepembayaran', 'tipepembayaran.idtipepembayaran', '=', 'transaksi.tipepembayaran_idtipepembayaran')
            ->join('kurir', 'kurir.idkurir', '=', 'pengiriman.kurir_idkurir')
            ->where('transaksi.merchant_users_iduser', '=', $merchant->idmerchant())
            ->where('pengiriman.idpengiriman', '=', $id)
            ->select('pengiriman.*', 'datapengiriman.*', 'tipepembayaran.nama as tipepembayaran')
            ->first();
        //dd($data);
        return view('seller.pengiriman.detailpengiriman', compact('data'));
        //dd($data);
    }
    public function updateStatus($id, $status)
    {
        try {
            DB::table('datapengiriman')->where('pengiriman_idpengiriman', $id)->update(['status' => $status]);
            return $id . $status;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function pengantaranMerchant()
    {
        $merchant = new Merchant();
        $data = DB::table('pengiriman')
            ->leftJoin('datapengiriman', 'datapengiriman.pengiriman_idpengiriman', '=', 'pengiriman.idpengiriman')
            ->join('transaksi', 'transaksi.idtransaksi', '=', 'pengiriman.transaksi_idtransaksi')
            ->join('tipepembayaran', 'tipepembayaran.idtipepembayaran', '=', 'transaksi.tipepembayaran_idtipepembayaran')
            ->join('kurir', 'kurir.idkurir', '=', 'pengiriman.kurir_idkurir')
            ->where('transaksi.merchant_users_iduser', '=', $merchant->idmerchant())
            ->where('kurir.idkurir', '=', 2)
            ->where('pengiriman.nomor_resi', '!=', null)
            ->where('datapengiriman.status', '!=', 'MenungguPengiriman')
            ->select('pengiriman.*', 'datapengiriman.*', 'tipepembayaran.nama as tipepembayaran')
            ->get();
        return view('seller.pengiriman.pengantaran', compact('data'));
    }
    public function detailPengantaran($id, $idtransaksi)
    {
        $merchant = new Merchant();
        $data = DB::table('pengiriman')
            ->leftJoin('datapengiriman', 'datapengiriman.pengiriman_idpengiriman', '=', 'pengiriman.idpengiriman')
            ->join('transaksi', 'transaksi.idtransaksi', '=', 'pengiriman.transaksi_idtransaksi')
            ->join('tipepembayaran', 'tipepembayaran.idtipepembayaran', '=', 'transaksi.tipepembayaran_idtipepembayaran')
            ->join('kurir', 'kurir.idkurir', '=', 'pengiriman.kurir_idkurir')
            ->where('transaksi.merchant_users_iduser', '=', $merchant->idmerchant())
            ->where('pengiriman.idpengiriman', '=', $id)
            ->select('pengiriman.*', 'datapengiriman.*', 'tipepembayaran.nama as tipepembayaran')
            ->first();
        $alamatPengiriman = DB::table('transaksi')
            ->join('tipepembayaran', 'tipepembayaran.idtipepembayaran', '=', 'transaksi.tipepembayaran_idtipepembayaran')
            ->join('pengiriman','pengiriman.transaksi_idtransaksi','=','transaksi.idtransaksi')
            ->join('alamatpembeli', 'alamatpembeli.idalamat', '=', 'transaksi.alamatpembeli_idalamat')
            ->join('kabupatenkota', 'alamatpembeli.kabupatenkota_idkabupatenkota', 'kabupatenkota.idkabupatenkota')
            ->join('provinsi', 'kabupatenkota.provinsi_idprovinsi', '=', 'provinsi.idprovinsi')
            ->where('transaksi.idtransaksi', $idtransaksi)
            ->select('tipepembayaran.idtipepembayaran as idtipepembayaran','tipepembayaran.nama as namatipepembayaran','transaksi.nominal_pembayaran as nominal_pembayaran','pengiriman.biaya_pengiriman as biaya_pengiriman',
            'alamatpembeli.*', 'kabupatenkota.nama as nama_kota', 'kabupatenkota.kodepos as kode_pos', 'provinsi.nama as nama_provinsi')
            ->first();

        // dd($alamatPengiriman);
        // return view('seller.pengiriman.detailpengiriman', compact('data'));
        return view('seller.pengiriman.detailpengantaran', compact('data', 'alamatPengiriman'));
    }
}
