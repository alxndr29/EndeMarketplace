<?php

namespace App\Http\Controllers;

use App\User;
use App\Diskusi;
use DB;
use App\Http\Controllers\Controller;
use App\Produk;
use Illuminate\Http\Request;

class DiskusiController extends Controller
{
    //
    public function storeDiskusi(Request $request, $id)
    {
        //return $id;
        try {
            $user = new User();
            $diskusi = new Diskusi();
            $diskusi->users_iduser = $user->userid();
            $diskusi->produk_idproduk = $id;
            $diskusi->pesandiskusi = $request->get('pertanyaan');
            $diskusi->save();
            return redirect()->back()->with('berhasil', 'your message,here');
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        //return $request->get('pertanyaan');
    }
    public function storeBalasanDiskusi(Request $request, $idproduk, $iddiskusi)
    {
        try {
            $user = new User();
            $diskusi = new Diskusi();
            $diskusi->users_iduser = $user->userid();
            $diskusi->produk_idproduk = $idproduk;
            $diskusi->pesandiskusi = $request->get('pertanyaan');
            $diskusi->balas_ke = $iddiskusi;
            $diskusi->save();
            return redirect()->back()->with('berhasil', 'your message,here');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function getDataDiskusi($id)
    {
        try {
            $diskusi = DB::table('diskusi')
                ->join('produk', 'produk.idproduk', '=', 'diskusi.produk_idproduk')
                ->join('users', 'users.iduser', '=', 'diskusi.users_iduser')
                ->select('diskusi.*', 'users.name as nama_user')
                ->where('diskusi.produk_idproduk', '=', $id)
                ->get();
            return $diskusi;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
