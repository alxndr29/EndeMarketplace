<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Device;
use Illuminate\Support\Facades\DB;

class CekDevice
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
        /*
       
        if ($user->iduser) {
            return $next($request);
        } else {
            return $next($request);
        }
        */

        //Log::info('otp'); one string line
        $user = new User();
        $data = User::where('iduser', $user->userid())->first();
        $email = $data->email;

        $value = $request->cookie('otp');
        $hasil = explode("/", $value);
        //dd($hasil);
        if ($hasil[0] != "") {
            if ($hasil[1] == "verified" && $hasil[0] == $email) {
                return $next($request);
            }
        }
        $otp = $request->session()->get('otp');
        return response()->view('auth.otp', compact('otp', 'value', 'email'));

        //return response()->view('user.rajaongkir',compact('test'));
    }
}
