<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use DB;
use App\Alamatpembeli;
class CheckoutController extends Controller
{
    //
    public function index($id){
        $user = new User();
      
        return view('user.checkout.checkout');
    }
}
