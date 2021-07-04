<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        //$this->middleware(['auth', 'verified']);
        //$this->middleware(['auth']);
        $this->middleware(['cekdevice']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //return view('seller.index');
        //return redirect('seller/merchant');
        return redirect('user/home');
    }
    public function homeUser()
    {
        $produkBaruTambah = DB::table('produk')
            ->join('merchant', 'merchant.users_iduser', '=', 'produk.merchant_users_iduser')
            ->join('gambarproduk', 'produk.idproduk', '=', 'gambarproduk.produk_idproduk')
            ->groupBy('produk.idproduk')
            ->select('produk.*', 'merchant.nama as nama_merchant', 'gambarproduk.idgambarproduk as idgambarproduk')
            ->orderBy('produk.created_at','desc')
            ->limit(5)
            ->get();
        
        //return $produkBaruTambah;
        return view('user.home.home',compact('produkBaruTambah'));
    }
}
