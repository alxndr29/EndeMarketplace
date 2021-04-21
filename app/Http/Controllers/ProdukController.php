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
        $merchant = new Merchant();
        $produk = DB::table('produk')
            ->join('kategori', 'kategori.idkategori', '=', 'produk.kategori_idkategori')
            ->where('produk.merchant_users_iduser', $merchant->idmerchant())
            ->get();
        //return $data;
        return view('seller.produk.produk', compact('produk'));
    }
    public function create()
    {
        $merchant = new Merchant();
        $kategori = Kategori::where('merchant_users_iduser', '=', $merchant->idmerchant())->get();
        $jenisproduk = Jenisproduk::all();
        return view('seller.produk.tambahproduk', compact('kategori', 'jenisproduk'));
    }
    public function store(Request $request)
    {

        try {

            $merchant = new Merchant();
            $produk = new Produk();
            $produk->nama = $request->get('namaProduk');
            $produk->deskripsi = $request->get('deskripsiProduk');
            $produk->harga = $request->get('harga');
            $produk->minimum_pemesanan = $request->get('minimumPemesanan');
            $produk->status = $request->get('statusProduk');
            $produk->stok = $request->get('stokProduk');
            $produk->berat = $request->get('beratProduk');
            if ($request->get('preorder') == "true") {
                $produk->preorder = 'Aktif';
                $produk->waktu_preorder = $request->get('waktu_preorder');
            } else {
                $produk->preorder = 'TidakAktif';
                $produk->waktu_preorder = 0;
            }
            $produk->panjang = $request->get('panjang');
            $produk->lebar = $request->get('lebar');
            $produk->tinggi = $request->get('tinggi');

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
                $path = public_path('gambar/' . $gambarProduk->idgambarproduk . '.jpg');
                Image::make(file_get_contents($test))->encode('jpg', 85)->save($path);
            }

            $response = ['status' => 'berhasil'];
            return response()->json($response);
        } catch (\Exception $e) {
            $response = ['status' => $e->getMessage()];
            return response()->json($response);
        }
    }
    public function show($id)
    {
        $data = DB::table('produk')->join('gambarproduk', 'gambarproduk.produk_idproduk', 'produk.idproduk')
            ->join('kategori', 'kategori.idkategori', '=', 'produk.kategori_idkategori')
            ->join('jenisproduk', 'jenisproduk.idjenisproduk', 'produk.jenisproduk_idjenisproduk')
            ->where('produk.idproduk', $id)
            ->get();
        return $data[0]->idproduk;
    }
    public function edit($id)
    {
        $merchant = new Merchant();
        $kategori = Kategori::where('merchant_users_iduser', '=', $merchant->idmerchant())->get();
        $jenisproduk = Jenisproduk::all();

        $data = DB::table('produk')
            ->join('kategori', 'kategori.idkategori', '=', 'produk.kategori_idkategori')
            ->join('jenisproduk', 'jenisproduk.idjenisproduk', 'produk.jenisproduk_idjenisproduk')
            ->where('produk.idproduk', $id)
            ->select('produk.*', 'kategori.idkategori', 'kategori.nama_kategori', 'jenisproduk.idjenisproduk', 'jenisproduk.nama as nama_jenis')
            ->first();
        //dd($data);
        return view('seller.produk.ubahproduk', compact('data', 'kategori', 'jenisproduk'));
    }
    public function search($id)
    {
        $data = DB::table('produk')
        ->join('merchant','merchant.users_iduser','=','produk.merchant_users_iduser')
        ->join('gambarproduk','produk.idproduk','=','gambarproduk.produk_idproduk')
        ->groupBy('produk.idproduk')
        ->where('produk.nama','like','%'.$id.'%')
        ->select('produk.*','merchant.nama as nama_merchant','gambarproduk.idgambarproduk as idgambarproduk')
        ->get();
        //return $data;   
        return view('user.search.search', compact('data'));
    }
    public function picture($id)
    {
        try {
            $data = Gambarproduk::where('produk_idproduk', $id)->get();
            return $data;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function update(Request $request, $id)
    {
        try {
            
            $produk = Produk::find($id);
            $produk->nama = $request->get('namaProduk');
            $produk->deskripsi = $request->get('deskripsiProduk');
            $produk->harga = $request->get('harga');
            $produk->minimum_pemesanan = $request->get('minimumPemesanan');
            $produk->status = $request->get('statusProduk');
            $produk->stok = $request->get('stokProduk');
            $produk->berat = $request->get('beratProduk');
            if ($request->get('preorder') == "true") {
                $produk->preorder = 'Aktif';
                $produk->waktu_preorder = $request->get('waktu_preorder');
            } else {
                $produk->preorder = 'TidakAktif';
                $produk->waktu_preorder = 0;
            }
            $produk->panjang = $request->get('panjang');
            $produk->lebar = $request->get('lebar');
            $produk->tinggi = $request->get('tinggi');
            $produk->kategori_idkategori = $request->get('kategoriProduk');
            $produk->jenisproduk_idjenisproduk = $request->get('jenisProduk');
            $produk->save();
            
            if($request->has('hapusGambar')){
                
                $hapusGambar = $request->get('hapusGambar');
                $decode = json_decode($hapusGambar);
                $test = "";
                foreach ($decode as $value) {
                    $test = $value;
                    Gambarproduk::where('idgambarproduk', $test)->delete();
                    $this->removeImage($test);
                }
            }
            if($request->has('gambar')){
                $gambar = $request->get('gambar');
                $decode = json_decode($gambar);
                $test = "";
                foreach ($decode as $value) {
                    $test = $value;
                    $gambarProduk = new Gambarproduk();
                    $gambarProduk->produk_idproduk = $id;
                    $gambarProduk->save();
                    $path = public_path('gambar/' . $gambarProduk->idgambarproduk . '.jpg');
                    Image::make(file_get_contents($test))->encode('jpg', 85)->save($path);
                }
            }
            $response = ['status' => 'berhasil'];
            return response()->json($response);
        } catch (\Exception $e) {
            $response = ['status' => $e->getMessage()];
            return response()->json($response);
        }
    }
    public function destroy($id)
    {
        try {
            $data =  Gambarproduk::where('produk_idproduk', $id)->get();
            foreach ($data as $key => $value) {
                $this->removeImage($value->idgambarproduk);
            }
            Gambarproduk::where('produk_idproduk', $id)->delete();
            Produk::where('idproduk', $id)->delete();
            return redirect('seller/produk')->with('berhasil', 'Berhasil Hapus Produk');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function removeImage($id)
    {
        $name = 'gambar/' . $id . ".jpg";
        if (\File::exists(public_path($name))) {
            \File::delete(public_path($name));
        } else {
            return ('File does not exists.');
        }
    }
}
