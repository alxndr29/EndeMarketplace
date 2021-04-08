<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Merchant;
use App\Produk;
use App\Gambarproduk;
use Intervention\Image\ImageManagerStatic as Image;

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
        
        try {
            $gambar = $request->get('gambar');
            $decode = json_decode($gambar);
            $test = "";
            foreach ($decode as $value) {
                $test = $value;
                $path = public_path('gambar/' . 'test.jpg');
                Image::make(file_get_contents($test))->encode('jpg',85)->save($path);
            }
            $response = ['status' => $test];
            return response()->json($response);
        } catch (\Exception $e) {
            $response = ['status' => $test];
            return response()->json($response);
        }
        
    }
    public function edit($id)
    { }
    public function update(Request $request, $id)
    { }
    public function destroy($id)
    { }
    public function removeImage()
    {
        if (\File::exists(public_path('gambar/test.jpg'))) {

            \File::delete(public_path('gambar/test.jpg'));
        } else {
            dd('File does not exists.');
        }
    }
}
