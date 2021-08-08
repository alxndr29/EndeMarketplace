<?php

namespace App\Http\Middleware;

use Closure;

class CekPetugasPengantaran
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
        if($request->session()->has('pengantar-id')){
            return $next($request);
        }else{
            return redirect('login/pengantar')->with('gagal','Login terlebih dahulu untuk masuk.');
        }
        
    }
}
