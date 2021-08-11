<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use App\User;
class PenarikanController extends Controller
{
    //
    public function indexUser(){
        $user = new User();
        $daftarTransaksi = DB::table('transaksi')
        ->join('pembayaran','pembayaran.transaksi_idtransaksi','=','transaksi.idtransaksi')
        ->where('pembayaran.status','=', 'settlement')
        ->where('transaksi.refund_at','=',null)
        ->where('transaksi.users_iduser',$user->userid())
        ->where('transaksi.status_transaksi','Batal')
        ->get();
        //return $daftarTransaksi;
        return view('user.penarikan.penarikan',compact('daftarTransaksi'));
    }
    public function formulirPenarikanUser(Request $request){
        try{
            return redirect()->back()->with('berhasil', 'Form Penarikan Anda berhasil.');
        }catch(\Exception $e){
            return redirect()->back()->with('gagal', 'Form Penarikan Anda Gagal');
        }
    }
}
