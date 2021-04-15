<?php

namespace App\Http\Controllers;
use DB;
use App\User;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    //
    public function index()
    {
        $user = new User();
        //$user->userid()
        $keranjang = DB::table('wishlist')->where('users_iduser', $user->userid())->get();
        return $keranjang;
    }
    public function store(Request $request)
    {
        $user = new User();
        //$iduser = $user->userid()
        $iduser = $request->get('iduser');
        $idproduk = $request->get('idproduk');
       
        try {
            DB::table('wishlist')
                ->updateOrInsert(
                    [
                        'users_iduser' => $iduser,
                        'produk_idproduk' => $idproduk
                    ]
                );
            return "berhasil";
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
   
    public function destroy($id)
    {
        try {
            //$user = new User();
            DB::table('wishlist')->where('produk_idproduk', $id)->delete();
            return "berhasil";
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
