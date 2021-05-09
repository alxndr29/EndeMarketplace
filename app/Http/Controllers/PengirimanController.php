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
        ->leftJoin('datapengiriman','datapengiriman.pengiriman_idpengiriman','=','pengiriman.idpengiriman')
        ->join('transaksi','transaksi.idtransaksi','=','pengiriman.transaksi_idtransaksi')
        ->join('tipepembayaran','tipepembayaran.idtipepembayaran','=','transaksi.tipepembayaran_idtipepembayaran')
        ->join('kurir','kurir.idkurir','=','pengiriman.kurir_idkurir')
        ->where('transaksi.merchant_users_iduser','=',$merchant->idmerchant())
        ->where('kurir.idkurir','=',2)
        ->where('pengiriman.nomor_resi','!=',null)
        ->select('pengiriman.*','datapengiriman.*','tipepembayaran.nama as tipepembayaran')
        ->get();
        //return $data;
        return view('seller.pengiriman.pengiriman',compact('data'));
    }
    public function indexMerhcantParam($tglAwal, $tglAkhir){
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
    public function detailPengirimanMerchant($id){

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
        //return 'hello world!';
    }
}
