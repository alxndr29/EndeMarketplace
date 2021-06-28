<?php

namespace App\Http\Middleware;

use Closure;
use App\Merchant;
use App\User;
use Illuminate\Support\Facades\DB;

class CekKonfigurasiMerchant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $status = false;
        $user = new User();
        $pesan = "";
        //$merchant = Merchant::where('users_iduser', $user->userid())->first();
        $merchant = DB::table('merchant')->where('deskripsi','!=',null)->where('jam_buka','!=',null)->where('jam_tutup','!=',null)->where('deskripsi','!=',null)->where('users_iduser', $user->userid())->count();
        $pembayaran = DB::table('dukunganpembayaran')->where('merchant_users_iduser','=', $user->userid())->count();
        $pengiriman = DB::table('dukunganpengiriman')->where('merchant_users_iduser','=', $user->userid())->count();
        if($merchant == 0){
            $status = true;
            $pesan = $pesan."Mohon lengkapi data dan status operasional.";
        }
        if($pembayaran == 0){
            $status = true;
            $pesan = $pesan . " Mohon lengkapi data dukunganpembayaran.";
        }
        if($pengiriman == 0){
            $status = true;
            $pesan = $pesan . " Mohon lengkapi data dukungan pengiriman.";
        }

        if ($status == true) {
            return redirect('seller/merchant/edit')->with('pesan', $pesan);
        }
        return $next($request);
    }
}
