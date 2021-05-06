<?php

namespace App\Http\Controllers;
use DB;
use App\Merchant;
use App\Pengiriman;
use App\Transaksi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PengirimanController extends Controller
{
    //
    public function index()
    {
        $merchant = new Merchant();
       
        return view('seller.pengiriman.pengiriman');
    }
}
