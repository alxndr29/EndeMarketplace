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
use Phpml\Association\Apriori;


class ProdukController extends Controller
{
    //
    public function index()
    {
        $merchant = new Merchant();
        $produk = DB::table('produk')
            ->join('kategori', 'kategori.idkategori', '=', 'produk.kategori_idkategori')
            ->join('gambarproduk', 'gambarproduk.produk_idproduk', '=', 'produk.idproduk')
            ->where('produk.merchant_users_iduser', $merchant->idmerchant())
            ->groupBy('produk.idproduk')
            ->get();
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
            $produk->video = $request->get('video');
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
    
        // $diskusi = DB::table('diskusi')
        //     ->join('produk', 'produk.idproduk', '=', 'diskusi.produk_idproduk')
        //     ->join('users', 'users.iduser', '=', 'diskusi.users_iduser')
        //     ->select('diskusi.*', 'users.name as nama_user')
        //     ->orderBy('diskusi.iddiskusi', 'ASC')
        //     ->where('diskusi.produk_idproduk', '=', $id)
        //     ->get();
        $data = DB::table('produk')
            ->join('kategori', 'kategori.idkategori', '=', 'produk.kategori_idkategori')
            ->join('jenisproduk', 'jenisproduk.idjenisproduk', 'produk.jenisproduk_idjenisproduk')
            ->join('merchant', 'merchant.users_iduser', '=', 'produk.merchant_users_iduser')
            ->select('produk.*', 'kategori.nama_kategori as nama_kategori', 'jenisproduk.nama as nama_jenis', 'merchant.nama as nama_merchant')
            ->where('produk.idproduk', $id)
            ->first();
        $gambar = DB::table('produk')->join('gambarproduk', 'gambarproduk.produk_idproduk', 'produk.idproduk')
            ->where('produk.idproduk', $id)
            ->select('gambarproduk.*')
            ->get();
        $reviewProduk = DB::table('reviewproduk')
            ->join('transaksi', 'transaksi.idtransaksi', '=', 'reviewproduk.transaksi_idtransaksi')
            ->join('users', 'users.iduser', '=', 'transaksi.users_iduser')
            ->where('reviewproduk.produk_idproduk', $id)
            ->select('reviewproduk.*', 'users.name as nama_user')
            ->get();

        $jumlahTerjual = DB::table('transaksi')
        ->join('detailtransaksi','detailtransaksi.transaksi_idtransaksi','=','transaksi.idtransaksi')
        ->where('transaksi.status_transaksi','=','Selesai')
        ->where('detailtransaksi.produk_idproduk','=',$id)
        ->sum('detailtransaksi.jumlah');
        $jumlahUlasan = DB::table('reviewproduk')->where('produk_idproduk','=',$id)->count();
        $jumlahDiskusi = DB::table('diskusi')->where('produk_idproduk','=',$id)->count();
        

        return view('user.detailproduk.detailproduk', compact('data', 'gambar', 'reviewProduk', 'jumlahTerjual','jumlahUlasan','jumlahDiskusi'));
        // $da = DB::table('detailtransaksi')->orderBy('transaksi_idtransaksi')->get();
        
        // $array = [];
        // foreach ($da as $item) {
        //     if (!array_key_exists($item->transaksi_idtransaksi, $array)) {
        //         $array[$item->transaksi_idtransaksi] = [];
        //     }
        //     array_push($array[$item->transaksi_idtransaksi], $item->produk_idproduk);
        // }

        // $samples = [
        //     ['alpha', 'beta', 'epsilon'], 
        //     ['alpha', 'beta', 'theta'], 
        //     ['alpha', 'beta', 'epsilon'], 
        //     ['alpha', 'beta', 'theta']
        // ];

        // $samples = [
        //     10 => ['pena', 'roti', 'mentega'],
        //     12 => ['roti', 'mentega', 'telur'],
        //     16 => ['buncis', 'telur', 'susu'],
        //     17 => ['roti', 'mentega'],
        //     1 => ['roti', 'mentega', 'kecap', 'telur', 'susu']
        // ];

        // $labels  = [];
        // $support = 0.5;
        // $confidence = 0.5;
        // $associator = new Apriori($support, $confidence);
        // $associator->train($array, $labels);
        // $data =  $associator->getRules();
        // return $data;
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
    //$key = null, $filter = null, $range1 = null,$range2 = null, $order = null
    public function search(Request $request)
    {
        $minimum = 0;
        $maksimum = 10000000;
        $jenis = null;

        if (isset($request->maksimum)) {
            $maksimum = $request->maksimum;
        }
        if (isset($request->minimum)) {
            $minimum = $request->minimum;
        }
        if (isset($request->jenis)) {
            if ($request->jenis != "Pilih") {
                $jenis = $request->jenis;
            }
        }

        if (isset($request->key)) {
            if ($jenis != null) {
                $data = DB::table('produk')
                    ->join('merchant', 'merchant.users_iduser', '=', 'produk.merchant_users_iduser')
                    ->join('gambarproduk', 'produk.idproduk', '=', 'gambarproduk.produk_idproduk')
                    ->groupBy('produk.idproduk')
                    ->where('produk.nama', 'like', '%' . $request->key . '%')
                    ->whereBetween('harga', [$minimum, $maksimum])
                    ->where('jenisproduk_idjenisproduk',$jenis)
                    ->orderBy("status", "desc")
                    ->select('produk.*', 'merchant.nama as nama_merchant', 'gambarproduk.idgambarproduk as idgambarproduk')
                    ->paginate(10);
            } else {
                $data = DB::table('produk')
                    ->join('merchant', 'merchant.users_iduser', '=', 'produk.merchant_users_iduser')
                    ->join('gambarproduk', 'produk.idproduk', '=', 'gambarproduk.produk_idproduk')
                    ->groupBy('produk.idproduk')
                    ->where('produk.nama', 'like', '%' . $request->key . '%')
                    ->whereBetween('harga', [$minimum, $maksimum])
                    ->orderBy("status", "desc")
                    ->select('produk.*', 'merchant.nama as nama_merchant', 'gambarproduk.idgambarproduk as idgambarproduk')
                    ->paginate(10);
            }
            
        } else {
            if ($jenis != null) {
                $data = DB::table('produk')
                    ->join('merchant', 'merchant.users_iduser', '=', 'produk.merchant_users_iduser')
                    ->join('gambarproduk', 'produk.idproduk', '=', 'gambarproduk.produk_idproduk')
                    ->where('jenisproduk_idjenisproduk', $jenis)
                    ->whereBetween('harga', [$minimum, $maksimum])
                    ->groupBy('produk.idproduk')
                    ->select('produk.*', 'merchant.nama as nama_merchant', 'gambarproduk.idgambarproduk as idgambarproduk')
                    ->paginate(10);
            }else{
                $data = DB::table('produk')
                    ->join('merchant', 'merchant.users_iduser', '=', 'produk.merchant_users_iduser')
                    ->join('gambarproduk', 'produk.idproduk', '=', 'gambarproduk.produk_idproduk')
                    ->whereBetween('harga', [$minimum, $maksimum])
                    ->groupBy('produk.idproduk')
                    ->select('produk.*', 'merchant.nama as nama_merchant', 'gambarproduk.idgambarproduk as idgambarproduk')
                    ->paginate(10);
            }
            
        }
        $jenisproduk = DB::table('jenisproduk')->select('idjenisproduk', 'nama')->get();
        
        return view('user.search.search', compact('data', 'jenisproduk'));
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
            $produk->video = $request->get('video');
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

            if ($request->has('hapusGambar')) {

                $hapusGambar = $request->get('hapusGambar');
                $decode = json_decode($hapusGambar);
                $test = "";
                foreach ($decode as $value) {
                    $test = $value;
                    Gambarproduk::where('idgambarproduk', $test)->delete();
                    $this->removeImage($test);
                }
            }
            if ($request->has('gambar')) {
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
    public function indexReview()
    {
        $merchant = new Merchant();
        $produk = DB::table('produk')
            ->join('kategori', 'kategori.idkategori', '=', 'produk.kategori_idkategori')
            ->join('gambarproduk', 'gambarproduk.produk_idproduk', '=', 'produk.idproduk')
            ->leftJoin('reviewproduk', 'reviewproduk.produk_idproduk', '=', 'produk.idproduk')
            ->select('produk.idproduk as idproduk', 'gambarproduk.idgambarproduk as idgambarproduk', 'produk.nama as nama_produk', 'kategori.nama_kategori as kategori_produk', DB::raw('avg(rating) as rating'))
            ->groupBy('produk.idproduk')
            ->where('produk.merchant_users_iduser', $merchant->idmerchant())
            ->get();
        //return $produk;
        return view('seller.review.review', compact('produk'));
    }
    public function detailReview()
    { 
        
    }
}
