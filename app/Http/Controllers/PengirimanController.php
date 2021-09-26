<?php

namespace App\Http\Controllers;

use DB;
use App\Merchant;
use App\Pengiriman;
use App\Transaksi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Petugaspengantaran;
use Intervention\Image\ImageManagerStatic as Image;

class PengirimanController extends Controller
{
    //
    public function indexMerchant()
    {
        $merchant = new Merchant();
        $data = DB::table('pengiriman')
            ->leftJoin('datapengiriman', 'datapengiriman.pengiriman_idpengiriman', '=', 'pengiriman.idpengiriman')
            ->join('transaksi', 'transaksi.idtransaksi', '=', 'pengiriman.transaksi_idtransaksi')
            ->join('tipepembayaran', 'tipepembayaran.idtipepembayaran', '=', 'transaksi.tipepembayaran_idtipepembayaran')
            ->join('kurir', 'kurir.idkurir', '=', 'pengiriman.kurir_idkurir')
            ->where('transaksi.merchant_users_iduser', '=', $merchant->idmerchant())
            ->where('kurir.idkurir', '=', 2)
            ->where('pengiriman.nomor_resi', '!=', null)
            ->select('pengiriman.*', 'datapengiriman.*', 'tipepembayaran.nama as tipepembayaran')
            ->get();
        return view('seller.pengiriman.pengiriman', compact('data'));
    }
    public function indexPengantar(Request $request)
    {
        $id = new Petugaspengantaran();
        $data = DB::table('pengiriman')
            ->leftJoin('datapengiriman', 'datapengiriman.pengiriman_idpengiriman', '=', 'pengiriman.idpengiriman')
            ->join('transaksi', 'transaksi.idtransaksi', '=', 'pengiriman.transaksi_idtransaksi')
            ->join('tipepembayaran', 'tipepembayaran.idtipepembayaran', '=', 'transaksi.tipepembayaran_idtipepembayaran')
            ->join('kurir', 'kurir.idkurir', '=', 'pengiriman.kurir_idkurir')
            ->where('datapengiriman.petugaspengantaran_idpetugaspengantaran', '=', $request->session()->get('pengantar-id'))
            ->where('kurir.idkurir', '=', 2)
            ->where('pengiriman.nomor_resi', '!=', null)
            ->select('pengiriman.*', 'datapengiriman.*', 'tipepembayaran.nama as tipepembayaran')
            ->get();
        return view('seller.petugaspengantaran.daftarpengantaran', compact('data'));
    }
    public function indexMerhcantParam($tglAwal, $tglAkhir)
    {
        $merchant = new Merchant();
        $data = DB::table('pengiriman')
            ->leftJoin('datapengiriman', 'datapengiriman.pengiriman_idpengiriman', '=', 'pengiriman.idpengiriman')
            ->join('transaksi', 'transaksi.idtransaksi', '=', 'pengiriman.transaksi_idtransaksi')
            ->join('tipepembayaran', 'tipepembayaran.idtipepembayaran', '=', 'transaksi.tipepembayaran_idtipepembayaran')
            ->join('kurir', 'kurir.idkurir', '=', 'pengiriman.kurir_idkurir')
            ->where('transaksi.merchant_users_iduser', '=', $merchant->idmerchant())
            ->where('kurir.idkurir', '=', 2)
            ->where('pengiriman.nomor_resi', '!=', null)
            ->whereBetween('pengiriman.tanggal_pengiriman', [$tglAwal, $tglAkhir])
            ->select('pengiriman.*', 'datapengiriman.*', 'tipepembayaran.nama as tipepembayaran')
            ->get();

        return view('seller.pengiriman.pengiriman', compact('data'));
    }
    public function detailPengirimanMerchant($id)
    {
        $merchant = new Merchant();
        $dataPengantar = Petugaspengantaran::where('merchant_users_iduser', $merchant->idmerchant())->get();
        $data = DB::table('pengiriman')
            ->leftJoin('datapengiriman', 'datapengiriman.pengiriman_idpengiriman', '=', 'pengiriman.idpengiriman')
            ->join('transaksi', 'transaksi.idtransaksi', '=', 'pengiriman.transaksi_idtransaksi')
            ->join('tipepembayaran', 'tipepembayaran.idtipepembayaran', '=', 'transaksi.tipepembayaran_idtipepembayaran')
            ->join('kurir', 'kurir.idkurir', '=', 'pengiriman.kurir_idkurir')
            ->where('transaksi.merchant_users_iduser', '=', $merchant->idmerchant())
            ->where('pengiriman.idpengiriman', '=', $id)
            ->select('pengiriman.*', 'datapengiriman.*', 'tipepembayaran.nama as tipepembayaran')
            ->first();
        //dd($data);
        return view('seller.pengiriman.detailpengiriman', compact('data', 'dataPengantar'));
    }
    //ajax - non ajax blm bikin
    public function updateStatus($id, $status, $jenis, $pengantar = null)
    {
        try {
            if ($pengantar != null) {
                DB::table('datapengiriman')->where('pengiriman_idpengiriman', $id)->update([
                    'petugaspengantaran_idpetugaspengantaran' => $pengantar
                ]);
            }
            if ($jenis == "ajax") {
                DB::table('datapengiriman')->where('pengiriman_idpengiriman', $id)->update(['status' => $status]);
                if ($status == "SelesaiAntar") {
                    DB::table('pengiriman')->where('idpengiriman', $id)->update(['status_pengiriman' => 'Selesai']);
                    DB::table('transaksi')
                        ->join('pengiriman', 'pengiriman.transaksi_idtransaksi', '=', 'transaksi.idtransaksi')
                        ->where('pengiriman.idpengiriman', $id)
                        ->update([
                            'transaksi.status_transaksi' => 'SampaiTujuan',
                            'transaksi.updated_at' =>  date('Y-m-d H:i:s'),
                            'transaksi.timeout_at' => date("Y-m-d H:i:s", strtotime("+ 1 day")),
                        ]);
                }
                return 'berhasil';
            } else {
                DB::table('datapengiriman')->where('pengiriman_idpengiriman', $id)->update(['status' => $status]);
                if ($status == "SelesaiAntar") {
                    DB::table('pengiriman')->where('idpengiriman', $id)->update(['status_pengiriman' => 'Selesai']);
                    DB::table('transaksi')
                        ->join('pengiriman', 'pengiriman.transaksi_idtransaksi', '=', 'transaksi.idtransaksi')
                        ->where('pengiriman.idpengiriman', $id)
                        ->update([
                            'transaksi.status_transaksi' => 'SampaiTujuan',
                            'transaksi.updated_at' =>  date('Y-m-d H:i:s'),
                            'transaksi.timeout_at ' => date("Y-m-d H:i:s", strtotime("+ 1 day")),
                        ]);
                }
                return redirect()->back()->with('berhasil', 'Berhasil mengubah status pengiriman');
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function uploadFotoSelesai(Request $request)
    {
        try {
            $id = $request->get('idpengiriman');
            $img = $request->get('img');
            $path = public_path('fotoTerima/' . $id . '.jpg');
            Image::make(file_get_contents($img))->encode('jpg', 85)->save($path);
            DB::table('pengiriman')->where('idpengiriman', $id)->update([
                'foto' => $id . '.jpg'
            ]);
            return 'upload foto berhasil';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function pengantaranMerchant()
    {
        $merchant = new Merchant();
        $data = DB::table('pengiriman')
            ->leftJoin('datapengiriman', 'datapengiriman.pengiriman_idpengiriman', '=', 'pengiriman.idpengiriman')
            ->join('transaksi', 'transaksi.idtransaksi', '=', 'pengiriman.transaksi_idtransaksi')
            ->join('tipepembayaran', 'tipepembayaran.idtipepembayaran', '=', 'transaksi.tipepembayaran_idtipepembayaran')
            ->join('kurir', 'kurir.idkurir', '=', 'pengiriman.kurir_idkurir')
            ->where('transaksi.merchant_users_iduser', '=', $merchant->idmerchant())
            ->where('kurir.idkurir', '=', 2)
            ->where('pengiriman.nomor_resi', '!=', null)
            ->where('datapengiriman.status', '!=', 'MenungguPengiriman')
            ->select('pengiriman.*', 'datapengiriman.*', 'tipepembayaran.nama as tipepembayaran')
            ->get();
        return view('seller.pengiriman.pengantaran', compact('data'));
    }
    //live tracking
    public function detailPengantaran($idpengiriman, $idtransaksi, $jenis)
    {
        $merchant = new Merchant();
        $data = DB::table('pengiriman')
            ->join('datapengiriman', 'datapengiriman.pengiriman_idpengiriman', '=', 'pengiriman.idpengiriman')
            ->join('transaksi', 'transaksi.idtransaksi', '=', 'pengiriman.transaksi_idtransaksi')
            ->join('tipepembayaran', 'tipepembayaran.idtipepembayaran', '=', 'transaksi.tipepembayaran_idtipepembayaran')
            ->join('kurir', 'kurir.idkurir', '=', 'pengiriman.kurir_idkurir')
            ->leftJoin('petugaspengantaran', 'petugaspengantaran.idpetugaspengantaran', '=', 'datapengiriman.petugaspengantaran_idpetugaspengantaran')
            ->where('pengiriman.idpengiriman', '=', $idpengiriman)
            ->select('pengiriman.*', 'datapengiriman.*', 'tipepembayaran.nama as tipepembayaran', 'petugaspengantaran.*')
            ->first();
        $alamatPengiriman = DB::table('transaksi')
            ->join('tipepembayaran', 'tipepembayaran.idtipepembayaran', '=', 'transaksi.tipepembayaran_idtipepembayaran')
            ->join('pengiriman', 'pengiriman.transaksi_idtransaksi', '=', 'transaksi.idtransaksi')
            ->join('alamatpembeli', 'alamatpembeli.idalamat', '=', 'transaksi.alamatpembeli_idalamat')
            ->join('kabupatenkota', 'alamatpembeli.kabupatenkota_idkabupatenkota', 'kabupatenkota.idkabupatenkota')
            ->join('provinsi', 'kabupatenkota.provinsi_idprovinsi', '=', 'provinsi.idprovinsi')
            ->where('transaksi.idtransaksi', $idtransaksi)
            ->select(
                'tipepembayaran.idtipepembayaran as idtipepembayaran',
                'tipepembayaran.nama as namatipepembayaran',
                'transaksi.nominal_pembayaran as nominal_pembayaran',
                'pengiriman.biaya_pengiriman as biaya_pengiriman',
                'alamatpembeli.*',
                'kabupatenkota.nama as nama_kota',
                'kabupatenkota.kodepos as kode_pos',
                'provinsi.nama as nama_provinsi'
            )
            ->first();
        if ($jenis == "merchant") {
            return view('seller.pengiriman.detailpengantaran', compact('data', 'alamatPengiriman', 'idpengiriman'));
        } else if ($jenis == "Pelanggan") {
            return view('user.transaksi.lacak', compact('data', 'alamatPengiriman', 'idpengiriman'));
        } else {
            return view('seller.petugaspengantaran.detailpengantaran', compact('data', 'alamatPengiriman', 'idpengiriman'));
        }
    }
    // tracking pembeli
    public function getLokasiKurir($idpengiriman)
    {
        try {
            $data = DB::table('datapengiriman')->where('pengiriman_idpengiriman', $idpengiriman)->get();
            return $data;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    //tracking pengantar
    public function updateLokasiKurir(Request $request)
    {
        try {
            DB::table('datapengiriman')->where('pengiriman_idpengiriman', $request->get('idpengiriman'))
                ->update([
                    'latitude_sekarang' => $request->get('latitude_sekarang'),
                    'longitude_sekarang' => $request->get('longitude_sekarang'),
                    'jarak_sekarang' => $request->get('jarak')
                ]);
            $dat = DB::table('datapengiriman')->where('pengiriman_idpengiriman', $request->get('idpengiriman'))->first();
            $res = [
                'status' => 'berhasil',
                'pengiriman' => $dat->status
            ];
            return $res;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
