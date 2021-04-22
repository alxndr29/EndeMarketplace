<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;

class KeranjangController extends Controller
{
    //
    public function index()
    {
        $user = new User();
        //$user->userid()
        $keranjang = DB::table('keranjang')->where('users_iduser', $user->userid())->get();
        return view('user.keranjang.keranjang', compact('keranjang'));
    }
    public function store(Request $request)
    {
        $user = new User();
        $iduser = $user->userid();
        //$iduser = $request->get('iduser');
        $idproduk = $request->get('idproduk');
        $jumlah = $request->get('jumlah');
        try {
            DB::table('keranjang')
                ->updateOrInsert(
                    [
                        'users_iduser' => $iduser,
                        'produk_idproduk' => $idproduk,
                        'jumlah' => $jumlah
                    ]
                );
            $response = ['status' => 'berhasil'];
            return response()->json($response);
        } catch (\Exception $e) {
            $response = ['status' => $e->getMessage()];
            return response()->json($response);
        }
        //return $request->all();
    }
    public function update(Request $request, $id)
    {
        try {
            $user = new User();
            //$iduser = $user->userid()
            $iduser = $request->get('iduser');

            $keranjang = DB::table('keranjang')
                ->where('users_iduser', $iduser)
                ->where('produk_idproduk', $id)
                ->update(['jumlah' => 5]);

            return "berhasil";
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function destroy($id)
    {
        try {
            //$user = new User();
            DB::table('keranjang')->where('produk_idproduk', $id)->delete();
            return "berhasil";
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
