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
use Illuminate\Support\Facades\Auth;
use App\Alamatpembeli;
use App\Mail\CheckoutMail;


class KomplainController extends Controller
{
    //
    public function indexPembeli()
    { }
    public function indexPembeliFilter()
    { }
    public function daftarProdukKomplain($id)
    {
        $produk = DB::table('detailtransaksi')
            ->join('produk', 'produk.idproduk', '=', 'detailtransaksi.produk_idproduk')
            ->where('detailtransaksi.transaksi_idtransaksi', $id)
            ->select('produk.idproduk', 'produk.nama')
            ->get();
        return $produk;
    }
    public function insertPelanggan(Request $request)
    {
        try {
            $daftarProduk = $request->get('checkboxproduk');
            //return $daftarProduk;
            if (!empty($daftarProduk)) {
                DB::beginTransaction();
                $transaksi = Transaksi::find($request->get('id'));
                    $komplaint = new Transaksi();
                    $komplaint->status_transaksi = "MenungguKonfirmasi";
                    $komplaint->jenis_transaksi = "Langsung";
                    $komplaint->nominal_pembayaran = $transaksi->nominal_pembayaran;
                    $komplaint->users_iduser = $transaksi->users_iduser;
                    $komplaint->merchant_users_iduser = $transaksi->merchant_users_iduser;
                    $komplaint->alamatpembeli_idalamat = $transaksi->alamatpembeli_idalamat;
                    $komplaint->tipepembayaran_idtipepembayaran = $transaksi->tipepembayaran_idtipepembayaran;
                    $komplaint->komplain = 1;
                    $komplaint->save();
                $pengiriman = Pengiriman::where('transaksi_idtransaksi', $request->get('id'))->first();
                    $pengirimanKomplaint = new Pengiriman();
                    $pengirimanKomplaint->estimasi = $pengiriman->estimasi;
                    $pengirimanKomplaint->biaya_pengiriman = $pengiriman->biaya_pengiriman;
                    $pengirimanKomplaint->status_pengiriman = "BelumSelesai";
                    $pengirimanKomplaint->keterangan = $pengiriman->keterangan;
                    $pengirimanKomplaint->kurir_idkurir = $pengiriman->kurir_idkurir;
                    $pengirimanKomplaint->transaksi_idtransaksi = $komplaint->idtransaksi;
                    $pengirimanKomplaint->save();
                if ($pengiriman->kurir_idkurir == "2") {
                    $dataPengiriman = DB::table('datapengiriman')->where('pengiriman_idpengiriman', $pengiriman->idpengiriman)->first();
                    DB::table('datapengiriman')->insert(
                        [
                            'latitude_user' => $dataPengiriman->latitude_user,
                            'longitude_user' => $dataPengiriman->longitude_user,
                            'latitude_merchant' => $dataPengiriman->latitude_merchant,
                            'longitude_merchant' => $dataPengiriman->longitude_merchant,
                            'jarak' => $dataPengiriman->jarak,
                            'volume' => 0,
                            'berat' => 0,
                            'status' => 'MenungguPengiriman',
                            'pengiriman_idpengiriman' => $pengirimanKomplaint->idpengiriman
                        ]
                    );
                }
                $totalHargaProdukKomplain = 0;
                foreach ($daftarProduk as $value) {
                  $da = DB::table('detailtransaksi')->where('produk_idproduk',$value)->where('transaksi_idtransaksi',$request->get('id'))->first();
                  DB::table('detailtransaksi')->insert([
                        'produk_idproduk' => $value,
                        'transaksi_idtransaksi' => $komplaint->idtransaksi,
                        'jumlah' => $da->jumlah,
                        'total_harga' => $da->total_harga
                  ]);
                  $totalHargaProdukKomplain = $totalHargaProdukKomplain + $da->total_harga;
                }
                DB::table('transaksi')->where('transaksi.idtransaksi','=', $komplaint->idtransaksi)->update([
                    'nominal_pembayaran' => $totalHargaProdukKomplain
                ]);
                $daftarCatatan = $request->get('catatanProduk');
                foreach ($daftarCatatan as $key => $value1) {
                    DB::table('detailtransaksi')->where('produk_idproduk', $key)->where('transaksi_idtransaksi',$komplaint->idtransaksi)->update([
                        'catatan' => $value1
                    ]);
                }
                DB::commit();
                return redirect()->back();
            } else {
                return redirect()->back();
            }
            
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }
}
