<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Device;
use DB;
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
        $user = User::find(1);
        if ($user->iduser) {
            return $next($request);
        } else {
            return $next($request);
        }
    }
}
