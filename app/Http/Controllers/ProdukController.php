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
use App\Jenisproduk;
use Illuminate\Support\Carbon;
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
        $kategori = Kategori::where('merchant_users_iduser','=',$merchant->idmerchant())->get();
        $jenisproduk = Jenisproduk::all();
        return view('seller.produk.tambahproduk', compact('kategori','jenisproduk'));
    }
    public function store(Request $request)
    {
        
        try {
            $merchant = new Merchant();

            $produk = new Produk();
            $produk->nama = $request->get('namaProduk');
            $produk->deskripsi = $request->get('deskripsiProduk');
            $produk->minimum_pemesanan = $request->get('minimumPemesanan');
            $produk->status = $request->get('statusProduk');
            $produk->stok = $request->get('stokProduk');
            $produk->berat = $request->get('beratProduk');
            if($request->get('preorder') == true){
                $produk->preorder = 'Aktif';
                $produk->waktu_preorder = $request->get('waktu_preorder');
            }else{
                $produk->preorder = 'TidakAktif';
                $produk->waktu_preorder = 0;
            }
            $produk->volume = $request->get('volume');
            $produk->merchant_users_iduser = $merchant->idmerchant();
            $produk->kategori_idkategori = $request->get('kategoriProduk');
            $produk->jenisproduk_idjenisproduk = $request->get('jenisProduk');
            $produk->save();
            $produk->idproduk;
            
            $gambar = $request->get('gambar');
            $decode = json_decode($gambar);
            $test = "";
            foreach ($decode as $value) {
                $test = $value;
                $gambarProduk = new Gambarproduk();
                $gambarProduk->produk_idproduk = $produk->idproduk;
                $gambarProduk->save();
                $path = public_path('gambar/' .$gambarProduk->idgambarproduk.'.jpg');
                Image::make(file_get_contents($test))->encode('jpg',85)->save($path);
            }

            $response = ['status' => $test];
            return response()->json($response);
            
            return $request->all();
        } catch (\Exception $e) {
            $response = ['status' => $e->getMessage()];
            return response()->json($response);
        }
        
    }
    public function show($id){
        $data = DB::table('produk')->join('gambarproduk','gambarproduk.produk_idproduk','produk.idproduk')
        ->join('kategori', 'kategori.idkategori','=','produk.kategori_idkategori')
        ->join('jenisproduk','jenisproduk.idjenisproduk','produk.jenisproduk_idjenisproduk')
        ->where('produk.idproduk', $id)
        ->get();
        return $data[0]->idproduk;
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
