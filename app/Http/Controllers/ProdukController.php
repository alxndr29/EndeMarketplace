<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Merchant;
use App\Produk;
use App\User;
use DB;
use App\Kategori;
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
        $merchant = new Merchant();
        $kategori = Kategori::where('merchant_idmerchant','=',$merchant->idmerchant())->get();
        return view('seller.produk.tambahproduk', compact('kategori'));
    }
    public function store(Request $request)
    {
        
        try {
            $produk = new Produk();
            $produk->nama = $request->get('namaProduk');
            $produk->deskripsi = $request->get('deskripsiProduk');
            $produk->minimum_pemesanan = $request->get('minimumPemesananProduk');
            $produk->status = $request->get('statusProduk');
            $produk->stok = $request->get('stokProduk');
            $produk->berat = $request->get('beratProduk');
            $produk->preorder = $request->get('preorder');
            $produk->volume = $request->get('volume');
            $produk->merchant_idmerchant = "idmerchant";
            $produk->kategori_idkategori = "123";
            $produk->jenisproduk_idjenisproduk = 123;
            $produk->save();
            $produk->idproduk;
            /*
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
            */
        } catch (\Exception $e) {
            $response = ['status' => $e->getMessage()];
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
