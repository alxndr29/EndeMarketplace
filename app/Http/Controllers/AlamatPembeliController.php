<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Alamatpembeli;
use User;
class AlamatPembeliController extends Controller
{
    //
    public function index()
    { 
        return view('user.alamat.alamat');
    }
    public function create()
    { 
     
    }
    public function store(Request $request)
    { 
        try{
            $user = new User();
            $alamatPembeli = new Alamatpembeli();
            $alamatPembeli->simpan_sebagai = $request->get('simpan_sebagai');
            $alamatPembeli->nama_penerima = $request->get('nama_penerima');
            $alamatPembeli->alamatlengkap = $request->get('alamatlengkap');
            $alamatPembeli->kecamatan = $request->get('kecamatan');
            $alamatPembeli->kota = $request->get('kota');
            $alamatPembeli->provinsi = $request->get('provinsi');
            $alamatPembeli->telepon = $request->get('telepon');
            $alamatPembeli->users_iduser = $user->iduser();
            $alamatPembeli->save();
            return "berhasil";
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }
    public function edit($id)
    { 

    }
    public function update(Request $request, $id)
    {
        $alamatPembeli = Alamatpembeli::findOrFail($id);
        $alamatPembeli->simpan_sebagai = $request->get('simpan_sebagai');
        $alamatPembeli->nama_penerima = $request->get('nama_penerima');
        $alamatPembeli->alamatlengkap = $request->get('alamatlengkap');
        $alamatPembeli->kecamatan = $request->get('kecamatan');
        $alamatPembeli->kota = $request->get('kota');
        $alamatPembeli->provinsi = $request->get('provinsi');
        $alamatPembeli->telepon = $request->get('telepon');
        $alamatPembeli->save();
    }
    public function destroy($id)
    { 
        
    }
}
