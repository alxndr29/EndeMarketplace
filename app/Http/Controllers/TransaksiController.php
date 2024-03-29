<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Merchant;
use App\User;
use App\Pengiriman;
use App\Transaksi;
use App\Produk;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    //
    public function indexPelanggan()
    {
        //DB::raw('hour(timediff(date_add(Now(),interval 8 hour),transaksi.timeout_at)) as timeout')
        $user = new User();
        $transaksi = DB::table('transaksi')
            ->join('merchant', 'merchant.users_iduser', '=', 'transaksi.merchant_users_iduser')
            ->join('pengiriman', 'pengiriman.transaksi_idtransaksi', 'transaksi.idtransaksi')
            ->join('detailtransaksi', 'detailtransaksi.transaksi_idtransaksi', '=', 'transaksi.idtransaksi')
            ->join('produk', 'produk.idproduk', '=', 'detailtransaksi.produk_idproduk')
            ->join('gambarproduk', 'gambarproduk.produk_idproduk', '=', 'produk.idproduk')
            ->orderBy('transaksi.idtransaksi', 'desc')
            ->groupBy('transaksi.idtransaksi')
            ->where('transaksi.users_iduser', $user->userid())
            ->select(
                'pengiriman.nomor_resi as nomorresi',
                'pengiriman.kurir_idkurir as idkurir',
                'pengiriman.idpengiriman as idpengiriman',
                'pengiriman.keterangan as keteranganpengiriman',
                'transaksi.*',
                'merchant.nama as nama_merchant',
                'produk.nama as nama_produk',
                'gambarproduk.idgambarproduk as gambar',
                'detailtransaksi.*',
                DB::raw('COUNT(detailtransaksi.produk_idproduk) as totalbarang'),
                //DB::raw('HOUR(TIMEDIFF(transaksi.timeout_at, NOW() )) as timeout')
                DB::raw('hour(timediff(date_add(Now(),interval 8 hour),transaksi.timeout_at)) as timeout')
            )
            ->paginate(10);
        return view('user.transaksi.transaksi', compact('transaksi'));
    }
    public function indexPelangganFilter($tanggalAwal, $tanggalAkhir, $status)
    {
        $user = new User();
        $syntax = DB::table('transaksi')
            ->join('merchant', 'merchant.users_iduser', '=', 'transaksi.merchant_users_iduser')
            ->join('pengiriman', 'pengiriman.transaksi_idtransaksi', 'transaksi.idtransaksi')
            ->join('detailtransaksi', 'detailtransaksi.transaksi_idtransaksi', '=', 'transaksi.idtransaksi')
            ->join('produk', 'produk.idproduk', '=', 'detailtransaksi.produk_idproduk')
            ->join('gambarproduk', 'gambarproduk.produk_idproduk', '=', 'produk.idproduk')
            ->groupBy('transaksi.idtransaksi')
            ->orderBy('transaksi.idtransaksi', 'desc')
            ->where('transaksi.users_iduser', $user->userid())
            ->select(
                'pengiriman.nomor_resi as nomorresi',
                'pengiriman.kurir_idkurir as idkurir',
                'pengiriman.idpengiriman as idpengiriman',
                'pengiriman.keterangan as keteranganpengiriman',
                'transaksi.*',
                'merchant.nama as nama_merchant',
                'produk.nama as nama_produk',
                'gambarproduk.idgambarproduk as gambar',
                'detailtransaksi.*',
                DB::raw('COUNT(detailtransaksi.produk_idproduk) as totalbarang'),
                //DB::raw('HOUR(TIMEDIFF(transaksi.timeout_at, NOW() )) as timeout')
                DB::raw('hour(timediff(date_add(Now(),interval 8 hour),transaksi.timeout_at)) as timeout')
            );
        if ($tanggalAwal != "null" && $tanggalAkhir != "null") {
            $syntax->whereBetween('transaksi.tanggal', [$tanggalAwal, $tanggalAkhir]);
        }
        if ($status != "pilih") {
            $syntax->where('transaksi.status_transaksi', $status);
        }
        $transaksi = $syntax->paginate(10);
        return view('user.transaksi.transaksi', compact('transaksi'));
    }
    public function indexMerchant()
    {
        $merchant = new Merchant();
        $transaksi = DB::table('transaksi')
            ->join('tipepembayaran', 'tipepembayaran.idtipepembayaran', '=', 'transaksi.tipepembayaran_idtipepembayaran')
            ->select('transaksi.*', 'tipepembayaran.nama as tipe_pembayaran')
            ->where('transaksi.merchant_users_iduser', $merchant->idmerchant())
            //->where('transaksi.komplain' ,'=', 0)
            ->get();
        return view('seller.transaksi.transaksi', compact('transaksi'));
    }
    public function indexMerchantFilter($tanggalAwal, $tanggalAkhir, $status)
    {
        $merchant = new Merchant();
        $syntax = DB::table('transaksi')
            ->join('tipepembayaran', 'tipepembayaran.idtipepembayaran', '=', 'transaksi.tipepembayaran_idtipepembayaran')
            ->select('transaksi.*', 'tipepembayaran.nama as tipe_pembayaran')
            //->where('transaksi.komplain', '=', 0)
            ->where('transaksi.merchant_users_iduser', $merchant->idmerchant());
        if ($tanggalAwal != "null" && $tanggalAkhir != "null") {
            $syntax->whereBetween('transaksi.tanggal', [$tanggalAwal, $tanggalAkhir]);
        }
        if ($status != "pilih") {
            $syntax->where('transaksi.status_transaksi', $status);
        }
        $transaksi = $syntax->get();
        return view('seller.transaksi.transaksi', compact('transaksi'));
    }
    public function detailMerchant($id)
    {
        $daftarProduk = DB::table('transaksi')
            ->join('detailtransaksi', 'detailtransaksi.transaksi_idtransaksi', '=', 'transaksi.idtransaksi')
            ->join('produk', 'produk.idproduk', 'detailtransaksi.produk_idproduk')
            ->leftJoin('gambarproduk', 'gambarproduk.produk_idproduk', 'produk.idproduk')
            ->where('transaksi.idtransaksi', $id)
            ->select('detailtransaksi.*', 'produk.nama as nama_produk', 'gambarproduk.idgambarproduk as gambar')
            ->groupBy('detailtransaksi.produk_idproduk')
            ->get();
        $alamatPengiriman = DB::table('transaksi')
            ->join('alamatpembeli', 'alamatpembeli.idalamat', '=', 'transaksi.alamatpembeli_idalamat')
            ->join('kabupatenkota', 'alamatpembeli.kabupatenkota_idkabupatenkota', 'kabupatenkota.idkabupatenkota')
            ->join('provinsi', 'kabupatenkota.provinsi_idprovinsi', '=', 'provinsi.idprovinsi')
            ->where('transaksi.idtransaksi', $id)
            ->select('alamatpembeli.*', 'kabupatenkota.nama as nama_kota', 'kabupatenkota.kodepos as kode_pos', 'provinsi.nama as nama_provinsi')
            ->first();
        $transaksi = DB::table('transaksi')
            ->join('tipepembayaran', 'tipepembayaran.idtipepembayaran', '=', 'transaksi.tipepembayaran_idtipepembayaran')
            ->join('pengiriman', 'pengiriman.transaksi_idtransaksi', '=', 'transaksi.idtransaksi')
            ->join('kurir', 'kurir.idkurir', '=', 'pengiriman.kurir_idkurir')
            ->join('users', 'users.iduser', '=', 'transaksi.users_iduser')
            //->select('transaksi.*', 'tipepembayaran.nama as tipe_pembayaran', 'kurir.nama as nama_kurir', 'pengiriman.*', 'users.iduser as iduser', 'users.name as nama_user', DB::raw('HOUR(TIMEDIFF(transaksi.timeout_at, NOW() )) as timeout'))
            ->select(
                'transaksi.*',
                'tipepembayaran.nama as tipe_pembayaran',
                'kurir.nama as nama_kurir',
                'pengiriman.*',
                'users.iduser as iduser',
                'users.name as nama_user',
                //DB::raw('HOUR(TIMEDIFF(transaksi.timeout_at, NOW() )) as timeout')
                DB::raw('hour(timediff(date_add(Now(),interval 8 hour),transaksi.timeout_at)) as timeout')
            )
            ->where('transaksi.idtransaksi', $id)
            ->first();
        return view('seller.transaksi.detailtransaksi', compact('daftarProduk', 'alamatPengiriman', 'transaksi'));
    }
    public function detailPelanggan($id)
    {
        try {
            $user = new User();
            $transaksi = DB::table('transaksi')
                ->join('merchant', 'transaksi.merchant_users_iduser', '=', 'merchant.users_iduser')
                ->select('transaksi.*', 'merchant.nama as nama_merchant')
                ->where('transaksi.idtransaksi', $id)
                ->get();
            $produk = DB::table('detailtransaksi')
                ->join('transaksi', 'transaksi.idtransaksi', '=', 'detailtransaksi.transaksi_idtransaksi')
                ->join('produk', 'produk.idproduk', '=', 'detailtransaksi.produk_idproduk')
                ->join('gambarproduk', 'gambarproduk.produk_idproduk', '=', 'produk.idproduk')
                ->where('detailtransaksi.transaksi_idtransaksi', '=', $id)
                ->where('transaksi.users_iduser', $user->userid())
                ->select('detailtransaksi.*', 'produk.nama as nama_produk', 'produk.harga as harga_produk', 'gambarproduk.idgambarproduk as gambar_produk')
                ->groupBy('produk.idproduk')
                ->get();
            $alamat = DB::table('transaksi')
                ->join('alamatpembeli', 'alamatpembeli.idalamat', '=', 'transaksi.alamatpembeli_idalamat')
                ->join('kabupatenkota', 'kabupatenkota.idkabupatenkota', '=', 'alamatpembeli.kabupatenkota_idkabupatenkota')
                ->join('provinsi', 'provinsi.idprovinsi', '=', 'kabupatenkota.provinsi_idprovinsi')
                ->join('pengiriman', 'pengiriman.transaksi_idtransaksi', '=', 'transaksi.idtransaksi')
                ->where('transaksi.idtransaksi', $id)
                ->where('transaksi.users_iduser', $user->userid())
                ->select('pengiriman.*', 'alamatpembeli.*', 'kabupatenkota.*', 'provinsi.nama as nama_provinsi')
                ->get();
            $pembayaran = DB::table('transaksi')
                ->join('tipepembayaran', 'tipepembayaran.idtipepembayaran', '=', 'transaksi.tipepembayaran_idtipepembayaran')
                ->join('pengiriman', 'pengiriman.transaksi_idtransaksi', '=', 'transaksi.idtransaksi')
                ->leftJoin('pembayaran', 'pembayaran.transaksi_idtransaksi', '=', 'transaksi.idtransaksi')
                ->where('transaksi.idtransaksi', $id)
                ->where('transaksi.users_iduser', $user->userid())
                ->select('pengiriman.biaya_pengiriman as biaya_pengiriman', 'transaksi.nominal_pembayaran as nominal_pembayaran', 'tipepembayaran.nama as namatipepembayaran', 'pembayaran.status')
                ->get();
            $hitungReview = DB::table('reviewproduk')->where('transaksi_idtransaksi', $id)->count();

            $result = [
                'produk' => $produk,
                'transaksi' => $transaksi,
                'alamat' => $alamat,
                'pembayaran' => $pembayaran,
                'hitungReview' => $hitungReview
            ];
            return $result;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function selesaiPesanan($id)
    {
        try {
            DB::table('transaksi')->where('idtransaksi', $id)->update(['status_transaksi' => 'Selesai']);
            $user = DB::table('transaksi')->join('users', 'users.iduser', 'transaksi.users_iduser')->where('transaksi.idtransaksi', $id)->select('users.*')->first();
            $pesan =  "Hallo " . $user->name . " Pesanan anda dengan nomor transaksi " . $id . " Telah Terselesaikan. " . ' klik link berikut untuk melihat status transaksi anda! ' . url('/user/transaksi/index');
            if ($user->notif_email == 1) {
                try {
                    $details = [
                        'title' => '',
                        'body' => $pesan
                    ];
                    \Mail::to($user->email)->send(new \App\Mail\CheckoutMail($details));
                } catch (\Exception $b) { }
            }
            if ($user->notif_wa == 1) {
                try {
                    $result = file_get_contents("https://sambi.wablas.com/api/send-message?token=NirUvUwRNAl1wbpCCnTsfg2fqLycFqmIel8ir6K5DpYJSVe6vExEgrL7IEeVqp4O&phone=" . $user->telepon . "&message=" . $pesan);
                } catch (\Exception $a) { }
            }
            return redirect('user/transaksi/index')->with('berhasil', 'Transaksi Anda Telah Terselesaikan.');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function batalPesanan($id)
    {
        try {
            DB::table('transaksi')->where('idtransaksi', $id)->update(['status_transaksi' => 'Batal']);
            $detailTransaksi = DB::table('detailtransaksi')->where('transaksi_idtransaksi', $id)->get();
            foreach ($detailTransaksi as $key => $value) {
                $produk = Produk::find($value->produk_idproduk);
                if ($produk->stok == 0) {
                    $produk->status = "Aktif";
                }
                $produk->stok = $produk->stok + $value->jumlah;
                $produk->save();
            }
            $user = DB::table('transaksi')->join('users', 'users.iduser', 'transaksi.users_iduser')->where('transaksi.idtransaksi', $id)->select('users.*')->first();
            $pesan =  "Hallo " . $user->name . " Pesanan anda dengan nomor transaksi " . $id . " Telah Dibatalkan. " . ' klik link berikut untuk melihat status transaksi anda! ' . url('/user/transaksi/index');
            if ($user->notif_email == 1) {
                try {
                    $details = [
                        'title' => '',
                        'body' => $pesan
                    ];
                    \Mail::to($user->email)->send(new \App\Mail\CheckoutMail($details));
                } catch (\Exception $b) { }
            }
            if ($user->notif_wa == 1) {
                try {
                    $result = file_get_contents("https://sambi.wablas.com/api/send-message?token=NirUvUwRNAl1wbpCCnTsfg2fqLycFqmIel8ir6K5DpYJSVe6vExEgrL7IEeVqp4O&phone=" . $user->telepon . "&message=" . $pesan);
                } catch (\Exception $a) { }
            }
            return redirect('user/transaksi/index')->with('berhasil', 'Transaksi Anda Telah DiBatalkan');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function prosePesananMerchant(Request $request, $id, $action)
    {
        try {
            $pesan = " ";
            $transaksi = Transaksi::find($id);
            if ($action == "PesananDikirim") {
                Pengiriman::where('transaksi_idtransaksi', $id)->update(
                    [
                        'nomor_resi' => $request->get('nomorResi'),
                        'tanggal_pengiriman' => $request->get('tanggalPengiriman')
                    ]
                );
                $transaksi->status_transaksi = $action;
                $transaksi->save();
                $pesan = "Telah dikirim";
            } else if ($action == "UpdateResi") {
                Pengiriman::where('transaksi_idtransaksi', $id)->update(
                    [
                        'nomor_resi' => $request->get('updateResi')
                    ]
                );
                $transaksi->save();
            } else if ($action == "Batal") {
                $transaksi->status_transaksi = $action;
                $transaksi->save();
                $detailTransaksi = DB::table('detailtransaksi')->where('transaksi_idtransaksi', $id)->get();
                foreach ($detailTransaksi as $key => $value) {
                    $produk = Produk::find($value->produk_idproduk);
                    if ($produk->stok == 0) {
                        $produk->status = "Aktif";
                    }
                    $produk->stok = $produk->stok + $value->jumlah;
                    $produk->save();
                }
                $pesan = "Telah Dibatalkan";
            } else {
                if ($action == "PesananDiproses") {
                    $transaksi->status_transaksi = $action;
                    if ($transaksi->jenis_transaksi == "Langsung") {
                        $transaksi->timeout_at =  date("Y-m-d H:i:s", strtotime("+ 2 day"));
                    } else {
                        $transaksi->timeout_at = date("Y-m-d H:i:s", strtotime("+" . $transaksi->waktu_po . "day"));
                    }
                    $transaksi->save();
                    $pesan = $action;
                } else if ($action == "SampaiTujuan") {
                    $transaksi->status_transaksi = $action;
                    $transaksi->timeout_at =  date("Y-m-d H:i:s", strtotime("+ 1 day"));
                    $transaksi->save();
                    $pesan = $action;
                } else {
                    $transaksi->status_transaksi = $action;
                    $transaksi->timeout_at =  date("Y-m-d H:i:s", strtotime("+ 2 day"));
                    $transaksi->save();
                    $pesan = $action;
                }
            }
            $user = DB::table('transaksi')
                ->join('users', 'users.iduser', '=', 'transaksi.users_iduser')
                ->where('transaksi.idtransaksi', '=', $id)
                ->select('users.*')
                ->first();
            $pesan =  "Hallo " . $user->name . " Pesanan anda dengan nomor transaksi " . $id . " " . $pesan . ' klik link berikut untuk melihat status transaksi anda! ' . url('/user/transaksi/index');
            if ($user->notif_email == 1) {
                try {
                    $details = [
                        'title' => '',
                        'body' => $pesan
                    ];
                    \Mail::to($user->email)->send(new \App\Mail\CheckoutMail($details));
                } catch (\Exception $b) { }
            }
            if ($user->notif_wa == 1) {
                try {
                    $result = file_get_contents("https://sambi.wablas.com/api/send-message?token=NirUvUwRNAl1wbpCCnTsfg2fqLycFqmIel8ir6K5DpYJSVe6vExEgrL7IEeVqp4O&phone=" . $user->telepon . "&message=" . $pesan);
                } catch (\Exception $a) { }
            }
            return redirect()->back()->with('berhasil', 'Berhasil ubah status pesanan');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function reviewProduk(Request $request)
    {
        $komentarProduk = $request->get('komentarproduk');
        $ratingProduk = $request->get('ratingproduk');
        foreach ($komentarProduk as $key => $value) {
            //return $key.$value;
            DB::table('reviewproduk')->updateOrInsert(
                ['produk_idproduk' => $key, 'transaksi_idtransaksi' => $request->get('idtransaksi')],
                ['komentar' => $value, 'tanggal_waktu' => Carbon::now()]
            );
        }
        foreach ($ratingProduk as $key => $value) {
            //return $key.$value;
            DB::table('reviewproduk')->updateOrInsert(
                ['produk_idproduk' => $key, 'transaksi_idtransaksi' => $request->get('idtransaksi')],
                ['rating' => $value]
            );
        }
        return redirect()->back()->with('berhasil', 'Berhasil Menuliskan Review');
    }
}
