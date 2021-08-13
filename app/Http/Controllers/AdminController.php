<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class AdminController extends Controller
{
    //
    public function login()
    {
        return view('admin.login');
    }
    public function home(){
        return view('admin.home');
    }
    public function loginProses(Request $request)
    {
        try {
            if ($request->get('username') == "admin" && $request->get('password') == "admin") {
                $request->session()->put('administrator-login', true);
                return redirect('admin/home');
            } else {
                return redirect()->back()->with('gagal', 'Data Login Tidak Terdaftar');
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        return $request->all();
    }
    public function logout(Request $request)
    {
        $request->session()->forget('administrator-login');
        return redirect()->back();
    }
    public function refund()
    { 
        $data = DB::table('penarikandana')->get();
        return view('admin.refund',compact('data'));
    }
    public function detailRefund($id)
    {
        // try {
        //     $detailPenarikan = DB::table('penarikandana')->where('idpenarikandana', '=', $id)->first();
        //     $daftarTransaksi = DB::table('transaksi')
        //         ->join('transaksi_has_penarikandana', 'transaksi.idtransaksi', '=', 'transaksi_has_penarikandana.transaksi_idtransaksi')
        //         ->where('transaksi_has_penarikandana.penarikandana_idpenarikandana', '=', $id)
        //         ->select('transaksi.*')
        //         ->get();

        //     $result = [
        //         'detailPenarikan' => $detailPenarikan,
        //         'daftarTransaksi' => $daftarTransaksi
        //     ];

        //     return $result;
        // } catch (\Exception $e) {
        //     return $e->getMessage();
        // }
        $data1 = null;
        $data2 = null;
        return view('admin.detailrefund',compact('data1','data2'));
    }
}
