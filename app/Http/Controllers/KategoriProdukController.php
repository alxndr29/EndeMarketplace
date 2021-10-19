<?php

namespace App\Http\Controllers;

use App\Kategori;
use App\User;
use App\Merchant;
use DB;
use Illuminate\Http\Request;

class KategoriProdukController extends Controller
{

    public function index()
    {
        $merchant = new Merchant();
        $kategori = Kategori::where('merchant_users_iduser','=',$merchant->idmerchant())->get();
        return view('seller.kategori.kategoriproduk', compact('kategori'));
    }
    public function create()
    { 

    }
    public function store(Request $request)
    {
        try {
            $merchant = new Merchant();
            $kategori = new Kategori();
            $kategori->nama_kategori = $request->get('namakategori');
            $kategori->merchant_users_iduser = $merchant->idmerchant();
            $kategori->save();
            return redirect()->back()->with('berhasil', 'Berhasil Menambah Data Kategori');
        } catch (\Exception $e) {
            return redirect()->back()->with('gagal', 'Gagal Menambah Data Kategori');
        }
    }
    public function edit($id)
    { 

    }
    public function update(Request $request, $id)
    {
        try {
            $kategori = Kategori::findOrFail($id);
            $kategori->nama_kategori = $request->get('namakategori');
            $kategori->save();
            return redirect()->back()->with('berhasil', 'Berhasil mengubah data kategori');
        } catch (\Exception $e) {
            return redirect()->back()->with('gagal', 'Gagal Mengubah Data Kategori');
        }
    }
    public function destroy($id)
    {
        try {
            $kategori = Kategori::find($id);
            $kategori->delete();
            return redirect()->back()->with('berhasil', 'Berhasil menghapus data kategori');
        } catch (\Exception $e) {
            return redirect()->back()->with('gagal', 'Gagal Menghapus Data Kategori');
        }
    }
}
