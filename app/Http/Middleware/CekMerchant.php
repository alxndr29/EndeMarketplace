<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use App\User;
class CekMerchant
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
        $user = new User();
        $data = DB::table('merchant')->where('users_iduser',$user->userid())->count();
        if($data != 0){
            return $next($request);
        }else{

            return response()->view('seller.merchant.registrasimerchant');
        }
       
    }
}
