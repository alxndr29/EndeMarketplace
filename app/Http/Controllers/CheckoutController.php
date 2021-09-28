<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Alamatpembeli;
use App\Transaksi;
use App\Pengiriman;
use Illuminate\Support\Carbon;
use App\Mail\CheckoutMail;
use App\Produk;

class CheckoutController extends Controller
{
    //
    public function config()
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-NQzZhOE4mVPzJPoeY5CIObIU';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
    }
    public function index($id, $status = null)
    {
        $user = new User();
        $dukunganpengiriman = DB::table('dukunganpengiriman')
            ->join('kurir', 'kurir.idkurir', 'dukunganpengiriman.kurir_idkurir')
            ->join('merchant', 'merchant.users_iduser', '=', 'dukunganpengiriman.merchant_users_iduser')
            ->where('dukunganpengiriman.merchant_users_iduser', '=', $id)
            ->select('kurir.idkurir', 'kurir.nama')
            ->get();
        $dukunganpembayaran = DB::table('dukunganpembayaran')
            ->join('tipepembayaran', 'tipepembayaran.idtipepembayaran', '=', 'dukunganpembayaran.tipepembayaran_idtipepembayaran')
            ->join('merchant', 'merchant.users_iduser', '=', 'dukunganpembayaran.merchant_users_iduser')
            ->where('dukunganpembayaran.merchant_users_iduser', '=', $id)
            ->select('tipepembayaran.idtipepembayaran as id', 'tipepembayaran.nama as nama')
            ->get();
        $dukunganTarifPengiriman = DB::table('dukungantarifpengiriman')
            ->join('tarifpengiriman', 'tarifpengiriman.idtarifpengiriman', '=', 'dukungantarifpengiriman.tarifpengiriman_idtarifpengiriman')
            ->where('dukungantarifpengiriman.merchant_users_iduser', $id)
            ->select('dukungantarifpengiriman.*', 'tarifpengiriman.*')
            ->get();
        if ($status == "po") {
            $keranjang = DB::table('keranjang')
                ->join('produk', 'produk.idproduk', '=', 'keranjang.produk_idproduk')
                ->join('users', 'users.iduser', '=', 'keranjang.users_iduser')
                ->join('gambarproduk', 'gambarproduk.produk_idproduk', '=', 'produk.idproduk')
                ->select('keranjang.jumlah as jumlah', 'keranjang.produk_idproduk as idproduk', 'produk.nama as nama', 'produk.harga as harga', 'gambarproduk.idgambarproduk as gambar')
                ->where('produk.merchant_users_iduser', '=', $id)
                ->where('keranjang.users_iduser', '=', $user->userid())
                ->where('produk.preorder', '=', 'Aktif')
                ->groupBy('keranjang.produk_idproduk')
                ->get();
            $total = DB::table('keranjang')
                ->join('produk', 'produk.idproduk', '=', 'keranjang.produk_idproduk')
                ->where('produk.merchant_users_iduser', '=', $id)
                ->where('keranjang.users_iduser', '=', $user->userid())
                ->where('produk.preorder', '=', 'Aktif')
                ->select(DB::raw('SUM(keranjang.jumlah * produk.harga) as jumlah, SUM(produk.berat * keranjang.jumlah) as berat, SUM(keranjang.jumlah*(produk.panjang * produk.lebar * produk.tinggi)) as volume'))
                ->first();
            //dd($total);
        } else {
            $keranjang = DB::table('keranjang')
                ->join('produk', 'produk.idproduk', '=', 'keranjang.produk_idproduk')
                ->join('users', 'users.iduser', '=', 'keranjang.users_iduser')
                ->join('gambarproduk', 'gambarproduk.produk_idproduk', '=', 'produk.idproduk')
                ->select('keranjang.jumlah as jumlah', 'keranjang.produk_idproduk as idproduk', 'produk.nama as nama', 'produk.harga as harga', 'gambarproduk.idgambarproduk as gambar')
                ->where('produk.merchant_users_iduser', '=', $id)
                ->where('keranjang.users_iduser', '=', $user->userid())
                ->where('produk.preorder', '=', 'TidakAktif')
                ->groupBy('keranjang.produk_idproduk')
                ->get();
            $total = DB::table('keranjang')
                ->join('produk', 'produk.idproduk', '=', 'keranjang.produk_idproduk')
                ->where('produk.merchant_users_iduser', '=', $id)
                ->where('keranjang.users_iduser', '=', $user->userid())
                ->where('produk.preorder', '=', 'TidakAktif')
                ->select(DB::raw('SUM(keranjang.jumlah * produk.harga) as jumlah, SUM(produk.berat * keranjang.jumlah) as berat, SUM(keranjang.jumlah*(produk.panjang * produk.lebar * produk.tinggi)) as volume'))
                ->first();
            //dd($total);
        }
        $alamatMerchant = DB::table('alamatmerchant')->where('merchant_users_iduser', '=', $id)->select('alamatmerchant.*')->first();
        return view('user.checkout.checkout', compact('id', 'keranjang', 'dukunganpengiriman', 'dukunganpembayaran', 'total', 'alamatMerchant', 'dukunganTarifPengiriman', 'status'));
    }
    // if (isset($request->po)) {
    //     return "hello world!";
    // }
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $user = new User();
            $dataUser = User::where('iduser', $user->userid())->first();
            if (isset($request->po)) {
                $keranjang = DB::table('keranjang')
                    ->join('produk', 'produk.idproduk', '=', 'keranjang.produk_idproduk')
                    ->join('users', 'users.iduser', '=', 'keranjang.users_iduser')
                    ->select('keranjang.*', 'produk.harga')
                    ->where('produk.merchant_users_iduser', '=', $request->get('idmerchant'))
                    ->where('keranjang.users_iduser', '=', $user->userid())
                    ->where('produk.preorder', '=', 'Aktif')
                    ->groupBy('keranjang.produk_idproduk')
                    ->get();
                foreach ($keranjang as $key => $value) {
                    $produk = Produk::find($value->produk_idproduk);
                    if ($produk->stok < $value->jumlah) {
                        return redirect()->back()->with('gagal', 'Qty produk tidak mencukupi!');
                    }
                }
            } else {
                $keranjang = DB::table('keranjang')
                    ->join('produk', 'produk.idproduk', '=', 'keranjang.produk_idproduk')
                    ->join('users', 'users.iduser', '=', 'keranjang.users_iduser')
                    ->select('keranjang.*', 'produk.harga')
                    ->where('produk.merchant_users_iduser', '=', $request->get('idmerchant'))
                    ->where('keranjang.users_iduser', '=', $user->userid())
                    ->where('produk.preorder', '=', 'TidakAktif')
                    ->groupBy('keranjang.produk_idproduk')
                    ->get();
                foreach ($keranjang as $key => $value) {
                    $produk = Produk::find($value->produk_idproduk);
                    if ($produk->stok < $value->jumlah) {
                        return redirect()->back()->with('gagal', 'Qty produk tidak mencukupi!');
                    }
                }
            }

            $lamaPO = 0;
            foreach ($keranjang as $key => $value) {
                $produk = Produk::find($value->produk_idproduk);
                if (($produk->stok - $value->jumlah) == 0) {
                    $produk->status = "TidakAktif";
                }
                if (isset($request->po)) {
                    if ($lamaPO < $produk->waktu_preorder) {
                        $lamaPO = $produk->waktu_preorder;
                    }
                }
                $produk->stok = $produk->stok - $value->jumlah;
                $produk->save();
                DB::table('keranjang')->where('users_iduser', $user->userid())->where('produk_idproduk', $value->produk_idproduk)->delete();
            }

            $transaksi = new Transaksi();
            if ($request->get('tipePembayaran') == "2") {
                $transaksi->status_transaksi = 'MenungguPembayaran';
            } else {
                $transaksi->status_transaksi = 'MenungguKonfirmasi';
                // if (isset($request->po)) {
                //     $transaksi->timeout_at = date("Y-m-d H:i:s", strtotime("+" . $lamaPO . "day"));
                // } else {
                $transaksi->timeout_at = date("Y-m-d H:i:s", strtotime("+ 1 day"));
                // }
            }
            if (isset($request->po)) {
                $transaksi->waktu_po = $lamaPO;
                $transaksi->jenis_transaksi = 'PreOrder';
            } else {
                $transaksi->jenis_transaksi = 'Langsung';
            }
            $transaksi->nominal_pembayaran = $request->get('nominalpembayaran') + $request->get('biaya_pengiriman');
            $transaksi->users_iduser = $user->userid();
            $transaksi->merchant_users_iduser = $request->get('idmerchant');
            $transaksi->alamatpembeli_idalamat = $request->get('idalamat');
            $transaksi->tipepembayaran_idtipepembayaran = $request->get('tipePembayaran');
            $transaksi->save();
            $id = $transaksi->idtransaksi;

            foreach ($keranjang as $key => $value) {
                DB::table('detailtransaksi')->insert(
                    [
                        'produk_idproduk' => $value->produk_idproduk,
                        'transaksi_idtransaksi' => $id,
                        'jumlah' => $value->jumlah,
                        'total_harga' => $value->jumlah * $value->harga
                    ]
                );
            }
            $catatanProduk = $request->get('catatanproduk');
            foreach ($catatanProduk as $key => $value) {
                // return $k.$v; //24catatan produk 2
                DB::table('detailtransaksi')
                    ->where('transaksi_idtransaksi', $id)
                    ->where('produk_idproduk', $key)
                    ->update(
                        [
                            'catatan' => $value
                        ]
                    );
            }
            $pengiriman = new Pengiriman();
            $pengiriman->kurir_idkurir = $request->get('kurir');
            $pengiriman->transaksi_idtransaksi = $id;
            $pengiriman->biaya_pengiriman = $request->get('biaya_pengiriman');
            $pengiriman->estimasi = $request->get('estimasi');
            $pengiriman->keterangan = $request->get('biayaKurir');
            $pengiriman->save();
            $idpengiriman = $pengiriman->idpengiriman;

            if ($request->get('kurir') == 2) {
                DB::table('datapengiriman')->insert(
                    [
                        'latitude_user' => $request->get('latitudeUser'),
                        'longitude_user' => $request->get('longitudeUser'),
                        'latitude_merchant' => $request->get('latitudeMerchant'),
                        'longitude_merchant' => $request->get('longitudeMerchant'),
                        'jarak' => $request->get('jarakPengiriman'),
                        'volume' => 0,
                        'berat' => 0,
                        'status' => 'MenungguPengiriman',
                        'pengiriman_idpengiriman' => $idpengiriman
                    ]
                );
            }

            if ($request->get('tipePembayaran') == "2") {
                $this->config();
                $user = Auth::user();
                $params = array(
                    'transaction_details' => array(
                        'order_id' => $id,
                        'gross_amount' => $request->get('nominalpembayaran') + $request->get('biaya_pengiriman'),
                    ),
                    'customer_details' => array(
                        'first_name' => $user->name,
                        'email' => $user->email,
                        'phone' => $user->telepon,
                    ),
                );
                $snapToken = \Midtrans\Snap::getSnapToken($params);
                DB::table('pembayaran')->insert([
                    'token' => $snapToken,
                    'transaksi_idtransaksi' => $id
                ]);
            }
            DB::commit();
            if (Auth::user()->notif_email == 1) {
                try {
                    $details = [
                        'title' => 'Checkout Pesanan Transaksi dengan ID -' . $transaksi->idtransaksi,
                        'body' => 'Hallo, ' . $dataUser->name . ' Checkout anda berhasil. klik link berikut untuk melihat status transaksi anda! ' . url('/user/transaksi/index')
                    ];
                    \Mail::to($user->useremail())->send(new \App\Mail\CheckoutMail($details));
                } catch (\Exception $b) { }
            }
            if (Auth::user()->notif_wa == 1) {
                try {
                    $result = file_get_contents("https://sambi.wablas.com/api/send-message?token=qTfb6jdlzQ9sWE50NM2p9kDIO7x4OjrTY3mIuusw3ec5ZCcPICJcgU8NfOzPdY6b&phone=" . $dataUser->telepon . "&message=" . 'Hallo ' . $dataUser->name . '. Checkout Pesanan Transaksi dengan ID - ' . $transaksi->idtransaksi . ' telah berhasil. Klik link berikut untuk melihat daftar transaksi. ' . url('/user/transaksi/index'));
                } catch (\Exception $a) { }
            }

            return redirect('user/transaksi/index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('gagal', 'Tidak dapat melakukan checkout');
        }
    }
}
