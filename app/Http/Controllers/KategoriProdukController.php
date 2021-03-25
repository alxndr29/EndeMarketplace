<?php

namespace App\Http\Controllers;

use App\Kategori;
use App\User;
use DB;
use Illuminate\Http\Request;

class KategoriProdukController extends Controller
{

    public function index()
    {
        $kategori = Kategori::all();
        return view('seller.kategoriproduk', compact('kategori'));
    }
    public function create(){

    }
    public function store(Request $request)
    {
        try {
            $user = new User();
            $merchantid = DB::table('merchant')->where('users_iduser','=',$user->userid())->get();
            $kategori = new Kategori();
            $kategori->nama_kategori = $request->get('namakategori');
            $kategori->merchant_idmerchant = $merchantid[0]->idmerchant;
            $kategori->save();
            return "berhasil";
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function edit($id){

    }
    public function update(Request $request, $id)
    {
        try {
            $kategori = Kategori::findOrFail($id);
            $kategori->nama_kategori = $request->get('namakategori');
            $kategori->save();
            return redirect('seller/kategori')->with('berhasil','Berhasil mengubah data kategori');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function destroy($id){
        try{
            $kategori = Kategori::find($id);
            $kategori->delete();
            return redirect('seller/kategori')->with('berhasil', 'Berhasil menghapus data kategori');
        }catch(\Exception $e){
            return $e->getMessage();
        }
        
    }
}
