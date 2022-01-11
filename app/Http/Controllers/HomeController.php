<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
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
        return redirect('user/home');
    }
    public function homeUser()
    {
        $produkBaruTambah = DB::table('produk')
            ->join('merchant', 'merchant.users_iduser', '=', 'produk.merchant_users_iduser')
            ->join('gambarproduk', 'produk.idproduk', '=', 'gambarproduk.produk_idproduk')
            ->where('merchant.status_merchant', '!=', 'NonAktif')
            ->where('produk.status', '!=', 'TidakAktif')
            ->groupBy('produk.idproduk')
            ->select('produk.*', 'merchant.nama as nama_merchant', 'gambarproduk.idgambarproduk as idgambarproduk')
            ->orderBy('produk.created_at','desc')
            ->limit(5)
            ->get();
        return view('user.home.home',compact('produkBaruTambah'));
        // $user = Auth::user();
        // return $user->name;
    }
    public function updateUser(Request $request){
        $user = Auth::user();
        $profile = User::find($user->iduser);
        $profile->name = $request->get('name');
        if($profile->email !=  $request->get('email')){
            $profile->email = $request->get('email');
            $profile->email_verified_at = null;
        }
        $profile->telepon = $request->get('telepon');
        if($request->get('password') != null){
            $profile->password = Hash::make($request->get('password'));
        }
        if($request->has('checkWhatsApp')){
            $profile->notif_wa = 1;
        }else{
            $profile->notif_wa = 0;
        }
        if($request->has('checkEmail')){
            $profile->notif_email = 1;
        }else{
            $profile->notif_email = 0;
        }
        $profile->save();
        
        return redirect()->back()->with('pesan','berhasil mengubah profil pengguna');
        // return Hash::make($request->get('password'));
        // return $request->all();
    }
}
