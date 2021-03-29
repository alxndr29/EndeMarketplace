<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Merchant;
use App\Produk;
class ProdukController extends Controller
{
    //
    public function index()
    { 
        return view('seller.produk.produk');
    }
    public function create()
    {
        return view('seller.produk.tambahproduk');
    }
    public function store(Request $request)
    { 

    }
    public function edit($id)
    {

     }
    public function update(Request $request, $id)
    {

     }
    public function destroy($id)
    { 
        
    }
}
