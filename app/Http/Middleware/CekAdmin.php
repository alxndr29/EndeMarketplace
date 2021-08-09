<?php

namespace App\Http\Middleware;

use Closure;

class CekAdmin
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
        if($request->session()->has('administrator-login')){
            return $next($request);
        }else{
            return redirect('admin/login')->with('gagal','Login terlebih dahulu untuk masuk.');
        }
    }
}
