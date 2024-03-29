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
        $wishlist = DB::table('wishlist')
        ->join('produk','wishlist.produk_idproduk','=','produk.idproduk')
        ->join('gambarproduk','produk.idproduk','=','gambarproduk.produk_idproduk')
        ->join('merchant','merchant.users_iduser','=','produk.merchant_users_iduser')
        ->groupBy('produk.idproduk')
        ->select('produk.*','gambarproduk.*','merchant.nama as nama_merchant')
        ->where('wishlist.users_iduser', $user->userid())
        ->get();
        
        return view('user.wishlist.wishlist',compact('wishlist'));
    }
    public function store(Request $request)
    {
        $user = new User();
        $iduser = $user->userid();
        //$iduser = $request->get('iduser');
        $idproduk = $request->get('idproduk');

        try {
            DB::table('wishlist')
                ->updateOrInsert(
                    [
                        'users_iduser' => $iduser,
                        'produk_idproduk' => $idproduk
                    ]
                );
            $response = ['status' => 'berhasil'];
            return response()->json($response);
        } catch (\Exception $e) {
            $response = ['status' => $e->getMessage()];
            return response()->json($response);
        }
    }

    public function destroy($id)
    {
        try {
            DB::table('wishlist')->where('produk_idproduk', $id)->delete();
            return redirect('user/wishlist')->with('berhasil', 'Berhasil hapus produk dari wishlist');
        } catch (\Exception $e) {
            //return $e->getMessage();
            return redirect('user/wishlist')->with('gagal', 'Gagal hapus produk dari wishlist');
        }
    }
}
