<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Device;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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

        if (Auth::check()) {
            $user = new User();
            $data = User::where('iduser', $user->userid())->first();
            $email = $data->email;

            $value = $request->cookie('otp');
            $hasil = explode("/", $value);

            if ($hasil[0] != "") {
                if ($hasil[1] == "verified" && $hasil[0] == $email) {
                    return $next($request);
                }
            }
            // if ($hasil != null) {
            //     return $next($request);
            // }

            $otp = $request->session()->get('otp');
            return response()->view('auth.otp', compact('otp', 'value', 'email'));
        }else{
            return $next($request);
        }

        

        //return response()->view('user.rajaongkir',compact('test'));
    }
}
