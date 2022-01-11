<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Petugaspengantaran;
use App\Merchant;

class PetugasPengantaranController extends Controller
{
    //
    public function index()
    {
        $merchant = new Merchant();
        $data = Petugaspengantaran::where('merchant_users_iduser', $merchant->idmerchant())->get();
        return view('seller.petugaspengantaran.petugaspengantaran', compact('data'));
    }
    public function edit($id)
    {
        try {
            $data = Petugaspengantaran::findOrfail($id);
            return $data;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function store(Request $request)
    {
        try {
            $merchant = new Merchant();
            $data = new Petugaspengantaran();
            $data->nama = $request->get('nama');
            $data->username = $request->get('username');
            $data->password = $request->get('password');
            $data->telepon = $request->get('telepon');
            $data->nama_kendaraan = $request->get('nama_kendaraan');
            $data->nomor_polisi = $request->get('nomor_polisi');
            $data->merchant_users_iduser = $merchant->idmerchant();
            $data->save();
            return redirect()->back()->with('berhasil', 'Berhasil tambah pegawai pengantaran');
        } catch (\Exception $e) {
            return redirect()->back()->with('gagal', 'Gagal menambahan data pegawai');
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $data = Petugaspengantaran::find($id);
            $data->nama = $request->get('nama');
            $data->username = $request->get('username');
            $data->password = $request->get('password');
            $data->telepon = $request->get('telepon');
            $data->nama_kendaraan = $request->get('nama_kendaraan');
            $data->nomor_polisi = $request->get('nomor_polisi');
            $data->save();
            return redirect()->back()->with('berhasil', 'Berhasil ubah pegawai pengantaran');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function destroy($id)
    {
        try {
            $data = Petugaspengantaran::find($id);
            $data->delete();
            return "berhasil";
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function login(Request $request)
    {
        // $d = new Petugaspengantaran();
        // return $d->idmerchant(1);
        if ($request->session()->has('pengantar-id')) {
            //echo $request->session()->get('pengantar');
            return redirect('seller/petugas/daftarpengantaran');
        } else {
            return view('seller.petugaspengantaran.login');
        }
        return view('seller.petugaspengantaran.login');
        //$request->session()->forget('pengantar');
    }
    public function loginProses(Request $request)
    {
        try {
            $data = Petugaspengantaran::where('username', $request->get('username'))->where('password', $request->get('password'))->get();
            if (count($data) == 1) {
                $request->session()->put('pengantar-id', $data[0]->idpetugaspengantaran);
                $request->session()->put('pengantar-nama', $data[0]->nama);
                return redirect('seller/petugas/daftarpengantaran');
                //return $data[0]->idpetugaspengantaran;
            } else {
                return redirect()->back()->with('gagal', 'Data login tidak ditemukan');
            }
        } catch (\Exception $e) {
            return $e->getMessage();
         }
    }
    public function logout(Request $request){
        $request->session()->forget('pengantar-id');
        $request->session()->forget('pengantar-nama');
        return redirect()->back();
    }
}
