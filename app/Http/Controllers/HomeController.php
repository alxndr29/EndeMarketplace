<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        //return view('seller.index');
        //return redirect('seller/merchant');
        return redirect('user/home');
    }
    public function homeUser(){
        return view('user.home.home');
    }
}
