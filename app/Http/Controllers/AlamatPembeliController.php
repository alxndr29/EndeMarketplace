<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Alamatpembeli;
use App\User;
use DB;
use App\Provinsi;
use App\Kabupatenkota;

class AlamatPembeliController extends Controller
{
    //
    public function index()
    {
        $user = new User();
        $alamatpembeli = Alamatpembeli::where('users_iduser','=', $user->userid())->get();
        return view('user.alamat.alamat', compact('alamatpembeli'));
        //return $alamatpembeli;
    }
    public function create()
    {

     }
    public function store(Request $request)
    {
        try {
            
            $user = new User();
            $alamatPembeli = new Alamatpembeli();
            $alamatPembeli->simpan_sebagai = $request->get('simpan_sebagai');
            $alamatPembeli->nama_penerima = $request->get('nama_penerima');
            $alamatPembeli->alamatlengkap = $request->get('alamatlengkap');
            $alamatPembeli->telepon = $request->get('telepon');
            //$alamatPembeli->kecamatan = $request->get('kecamatan');
            // $alamatPembeli->kota = $request->get('kota');
            // $alamatPembeli->provinsi = $request->get('provinsi');
            //$alamatPembeli->users_iduser = 4;
            $alamatPembeli->users_iduser = $user->userid();
            $alamatPembeli->latitude = $request->get('latitude');
            $alamatPembeli->longitude = $request->get('longitude');
            $alamatPembeli->kabupatenkota_idkabupatenkota = $request->get('kotakabupaten');
            $alamatPembeli->save();
            return "berhasil";
            
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function edit($id)
    { 
        
    }
    public function update(Request $request, $id)
    {
        try {
            $alamatPembeli = Alamatpembeli::findOrFail($id);
            $alamatPembeli->simpan_sebagai = $request->get('simpan_sebagai');
            $alamatPembeli->nama_penerima = $request->get('nama_penerima');
            $alamatPembeli->alamatlengkap = $request->get('alamatlengkap');
            $alamatPembeli->kota = $request->get('kota');
            $alamatPembeli->provinsi = $request->get('provinsi');
            $alamatPembeli->telepon = $request->get('telepon');
            $alamatPembeli->latitude = $request->get('latitude');
            $alamatPembeli->longitude = $request->get('longitude');
            $alamatPembeli->save();
            return "berhasil update";
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function destroy($id)
    {
        try {
            $alamatPembeli = Alamatpembeli::find($id);
            $alamatPembeli->delete();
            return "berhasil hapus";
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
