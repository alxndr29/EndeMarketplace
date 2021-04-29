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
        $user = User::find(1);
        if ($user->iduser) {
            return $next($request);
        } else {
            return $next($request);
        }
        */
        
        //Log::info('otp'); one string line
        $otp = $request->session()->get('otp');
        return response()->view('auth.otp',compact('otp'));
        //return response()->view('user.rajaongkir',compact('test'));
    }
}
