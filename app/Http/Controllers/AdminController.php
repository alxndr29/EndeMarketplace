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
    public function home()
    {
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
        return view('admin.refund', compact('data'));
    }
    public function detailRefund($id)
    {
        try {
            $cek = DB::table('penarikandana')
                ->where('idpenarikandana', '=', $id)
                ->select('jenis')
                ->first();
            
            if ($cek->jenis == "withdraw") {
                $detailPenarikan = DB::table('penarikandana')
                    ->where('idpenarikandana', '=', $id)
                    ->join('transaksi_has_penarikandana', 'penarikandana.idpenarikandana', '=', 'transaksi_has_penarikandana.penarikandana_idpenarikandana')
                    ->join('transaksi', 'transaksi.idtransaksi', '=', 'transaksi_has_penarikandana.transaksi_idtransaksi')
                    ->join('merchant', 'merchant.users_iduser', '=', 'transaksi.merchant_users_iduser')
                    ->join('users', 'users.iduser', 'merchant.users_iduser')
                    ->select('penarikandana.*', 'users.name', 'users.email', 'users.telepon')
                    ->first();
            } else {
                $detailPenarikan = DB::table('penarikandana')
                    ->where('idpenarikandana', '=', $id)
                    ->join('transaksi_has_penarikandana', 'penarikandana.idpenarikandana', '=', 'transaksi_has_penarikandana.penarikandana_idpenarikandana')
                    ->join('transaksi', 'transaksi.idtransaksi', '=', 'transaksi_has_penarikandana.transaksi_idtransaksi')
                    ->join('users', 'users.iduser', 'transaksi.users_iduser')
                    ->select('penarikandana.*', 'users.name', 'users.email', 'users.telepon')
                    ->first();
            }
            $daftarTransaksi = DB::table('transaksi')
                ->join('transaksi_has_penarikandana', 'transaksi.idtransaksi', '=', 'transaksi_has_penarikandana.transaksi_idtransaksi')
                ->where('transaksi_has_penarikandana.penarikandana_idpenarikandana', '=', $id)
                ->select('transaksi.*')
                ->get();
            //dd($detailPenarikan);
            return view('admin.detailrefund', compact('detailPenarikan', 'daftarTransaksi'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function ubahStatusRefund(Request $request, $id, $status)
    {
        try {
            if ($status == "Selesai") {
                if ($request->hasFile('buktiTransfer')) {

                    $extension = $request->buktiTransfer->extension();
                    $destinationPath = public_path('buktiTransfer');
                    $file = $request->file('buktiTransfer');
                    $file->move($destinationPath, 'buktiTransfer-' . $id . "." . $extension);

                    DB::table('penarikandana')->where('idpenarikandana', '=', $id)->update([
                        'status' => $status,
                        'bukti' => 'buktiTransfer-' . $id . "." . $extension
                    ]);
                }
            } else if ($status == "Diproses") {
                DB::table('penarikandana')->where('idpenarikandana', '=', $id)->update([
                    'status' => $status
                ]);
            } else if ($status == "Gagal") {
                DB::table('penarikandana')->where('idpenarikandana', '=', $id)->update([
                    'status' => $status,
                    'catatan' => $request->get('catatan')
                ]);
            } else { }
            return redirect()->back()->with('berhasil', 'Status Penarikan Form Berhasil Dirubah.');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        return $id . $status;
    }
}
