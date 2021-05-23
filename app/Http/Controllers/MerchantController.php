<?php

namespace App\Http\Controllers;

use App\Merchant;
use App\User;
use App\Kategori;
use App\Tipepembayaran;
use App\Kurir;
use App\Tarifpengiriman;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class MerchantController extends Controller
{
    //
    public function __construct()
    {
        //$this->middleware(['auth', 'verified']);
        $this->middleware(['auth']);
        $this->middleware(['cekdevice']);
        $this->middleware(['cekmerchant']);
    }
    
    public function index()
    { 
       return view('seller.index');
    }
    public function create()
    {

        return view('seller.merchant.registrasimerchant');
    }
    public function store(Request $request)
    {
        try {
            /*
            $user = new User();
            $merchantid = DB::table('merchant')->where('users_iduser', '=', $user->userid())->get();
            return $merchantid[0]->idmerchant;
            */
            $merchant = new Merchant();
            $user = new User();
            $merchant->nama = $request->get('namamerchant');
            $merchant->users_iduser = $user->userid();
            $merchant->save();
            return "berhasil";
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function edit()
    {
        $user = new User();
        $merchant = new Merchant();
        $merchant = Merchant::where('users_iduser', $user->userid())->first();

        $kurir = Kurir::all();
        $tipePembayaran = Tipepembayaran::all();
        $tarifPengiriman = Tarifpengiriman::all();

        $dukunganCOD = DB::table('dukunganpembayaran')
            ->join('tipepembayaran', 'tipepembayaran.idtipepembayaran', '=', 'dukunganpembayaran.tipepembayaran_idtipepembayaran')
            ->where('tipepembayaran.idtipepembayaran', 1)
            ->where('dukunganpembayaran.merchant_users_iduser', $merchant->idmerchant())
            ->first();
        $dukunganBank = DB::table('dukunganpembayaran')
            ->join('tipepembayaran', 'tipepembayaran.idtipepembayaran', '=', 'dukunganpembayaran.tipepembayaran_idtipepembayaran')
            ->where('tipepembayaran.idtipepembayaran', 2)
            ->where('dukunganpembayaran.merchant_users_iduser', $merchant->idmerchant())
            ->first();

        $dukunganJNE = DB::table('dukunganpengiriman')
            ->join('kurir', 'kurir.idkurir', '=', 'dukunganpengiriman.kurir_idkurir')
            ->where('kurir.idkurir', 1)
            ->where('dukunganpengiriman.merchant_users_iduser', $merchant->idmerchant())
            ->first();
        $dukunganKurirMerchant = DB::table('dukunganpengiriman')
            ->join('kurir', 'kurir.idkurir', '=', 'dukunganpengiriman.kurir_idkurir')
            ->where('kurir.idkurir', 2)
            ->where('dukunganpengiriman.merchant_users_iduser', $merchant->idmerchant())
            ->first();

        $dukunganBebas = DB::table('tarifpengiriman')
            ->join('dukungantarifpengiriman', 'tarifpengiriman.idtarifpengiriman', '=', 'dukungantarifpengiriman.tarifpengiriman_idtarifpengiriman')
            ->where('dukungantarifpengiriman.tarifpengiriman_idtarifpengiriman', 1)
            ->where('dukungantarifpengiriman.merchant_users_iduser', $merchant->idmerchant())
            ->first();

        $dukunganFlat = DB::table('tarifpengiriman')
            ->join('dukungantarifpengiriman', 'tarifpengiriman.idtarifpengiriman', '=', 'dukungantarifpengiriman.tarifpengiriman_idtarifpengiriman')
            ->where('dukungantarifpengiriman.tarifpengiriman_idtarifpengiriman', 2)
            ->where('dukungantarifpengiriman.merchant_users_iduser', $merchant->idmerchant())
            ->first();
        $dukunganNormal = DB::table('tarifpengiriman')
            ->join('dukungantarifpengiriman', 'tarifpengiriman.idtarifpengiriman', '=', 'dukungantarifpengiriman.tarifpengiriman_idtarifpengiriman')
            ->where('dukungantarifpengiriman.tarifpengiriman_idtarifpengiriman', 3)
            ->where('dukungantarifpengiriman.merchant_users_iduser', $merchant->idmerchant())
            ->first();

        $alamat = DB::table('alamatmerchant')->where('merchant_users_iduser', '=', $merchant->idmerchant())->first();


        return view('seller.merchant.pengaturanmerchant', compact(
            'merchant',
            'kurir',
            'tipePembayaran',
            'alamat',
            'tarifPengiriman',
            'dukunganBebas',
            'dukunganFlat',
            'dukunganNormal',
            'dukunganKurirMerchant',
            'dukunganJNE',
            'dukunganCOD',
            'dukunganBank'
        ));
    }
    public function show($id)
    {
        $id2 = null;
        try {
            $merchant = Merchant::where('users_iduser', $id)->first();

            $alamat = DB::table('alamatmerchant')
            ->join('kabupatenkota','kabupatenkota.idkabupatenkota','=','alamatmerchant.kabupatenkota_idkabupatenkota')
            ->join('provinsi','provinsi.idprovinsi','kabupatenkota.provinsi_idprovinsi')
            ->where('alamatmerchant.merchant_users_iduser','=',$id)
            ->select('alamatmerchant.*','kabupatenkota.nama as nama_kabupaten','kabupatenkota.kodepos as kode_pos','provinsi.nama as nama_provinsi')
            ->first();
            $pembayaran = DB::table('dukunganpembayaran')
                ->join('tipepembayaran', 'tipepembayaran.idtipepembayaran', '=', 'dukunganpembayaran.tipepembayaran_idtipepembayaran')
                ->where('dukunganpembayaran.merchant_users_iduser', $id)
                ->select('tipepembayaran.nama as nama_pembayaran')
                ->get();

            $pengiriman = DB::table('dukunganpengiriman')
                ->join('kurir', 'kurir.idkurir', '=', 'dukunganpengiriman.kurir_idkurir')
                ->where('dukunganpengiriman.merchant_users_iduser', $id)
                ->select('kurir.nama as nama_kurir')
                ->get();

            $data = DB::table('produk')
                ->join('merchant', 'merchant.users_iduser', '=', 'produk.merchant_users_iduser')
                ->join('gambarproduk', 'produk.idproduk', '=', 'gambarproduk.produk_idproduk')
                ->groupBy('produk.idproduk')
                ->where('produk.merchant_users_iduser', $id)
                ->select('produk.*', 'merchant.nama as nama_merchant', 'gambarproduk.idgambarproduk as idgambarproduk')
                ->paginate(10);
            $kategori = Kategori::where('merchant_users_iduser', $id)->get();
            return view('user.merchant.merchant', compact('merchant','id2','data', 'kategori','alamat', 'pembayaran', 'pengiriman'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function etalase($id1, $id2=null, $id3 = null)
    {
        try {
            $merchant = Merchant::where('users_iduser', $id1)->first();

            $alamat = DB::table('alamatmerchant')
                ->join('kabupatenkota', 'kabupatenkota.idkabupatenkota', '=', 'alamatmerchant.kabupatenkota_idkabupatenkota')
                ->join('provinsi', 'provinsi.idprovinsi', 'kabupatenkota.provinsi_idprovinsi')
                ->where('alamatmerchant.merchant_users_iduser', '=', $id1)
                ->select('alamatmerchant.*', 'kabupatenkota.nama as nama_kabupaten', 'kabupatenkota.kodepos as kode_pos', 'provinsi.nama as nama_provinsi')
                ->first();
            $pembayaran = DB::table('dukunganpembayaran')
                ->join('tipepembayaran', 'tipepembayaran.idtipepembayaran', '=', 'dukunganpembayaran.tipepembayaran_idtipepembayaran')
                ->where('dukunganpembayaran.merchant_users_iduser', $id1)
                ->select('tipepembayaran.nama as nama_pembayaran')
                ->get();

            $pengiriman = DB::table('dukunganpengiriman')
                ->join('kurir', 'kurir.idkurir', '=', 'dukunganpengiriman.kurir_idkurir')
                ->where('dukunganpengiriman.merchant_users_iduser', $id1)
                ->select('kurir.nama as nama_kurir')
                ->get();
            $kategori = Kategori::where('merchant_users_iduser', $id1)->get();

            if($id3 == null){
                $data = DB::table('produk')
                    ->join('merchant', 'merchant.users_iduser', '=', 'produk.merchant_users_iduser')
                    ->join('gambarproduk', 'produk.idproduk', '=', 'gambarproduk.produk_idproduk')
                    ->groupBy('produk.idproduk')
                    ->where('produk.merchant_users_iduser', $id1)
                    ->where('produk.kategori_idkategori', $id2)
                    ->select('produk.*', 'merchant.nama as nama_merchant', 'gambarproduk.idgambarproduk as idgambarproduk')
                    ->paginate(10);
            }else{
                $data = DB::table('produk')
                    ->join('merchant', 'merchant.users_iduser', '=', 'produk.merchant_users_iduser')
                    ->join('gambarproduk', 'produk.idproduk', '=', 'gambarproduk.produk_idproduk')
                    ->groupBy('produk.idproduk')
                    ->where('produk.merchant_users_iduser', $id1)
                    ->where('produk.kategori_idkategori', $id2)
                    ->where('produk.nama', 'like', '%' . $id3 . '%')
                    ->select('produk.*', 'merchant.nama as nama_merchant', 'gambarproduk.idgambarproduk as idgambarproduk')
                    ->paginate(10);
            }

            return view('user.merchant.merchant', compact('merchant', 'data', 'kategori', 'id2','alamat', 'pembayaran', 'pengiriman'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function update(Request $request, $id)
    {
        try {

            // if ($request->hasFile('fotoProfil')) {
            //     $extension = $request->fotoProfil->extension();
            //     $destinationPath = public_path('fotoProfil');
            //     $file = $request->file('fotoProfil');
            //     $file->move($destinationPath, 'merchant-fotoprofil-' . $id . "." . $extension);

            //     Merchant::where('users_iduser', $id)
            //         ->update([
            //             'foto_profil' => 'merchant-fotoprofil-' . $id .".". $extension
            //     ]);
            // }
            // if ($request->hasFile('fotoSampul')) {
            //     $extension = $request->fotoSampul->extension();
            //     $destinationPath = public_path('fotoSampul');
            //     $file = $request->file('fotoSampul');
            //     $file->move($destinationPath, 'merchant-fotosampul-' . $id . "." . $extension);

            //     Merchant::where('users_iduser', $id)
            //         ->update([
            //             'foto_sampul' => 'merchant-fotosampul-' . $id . "." . $extension
            //     ]);
            // }
            // Merchant::where('users_iduser',$id)
            // ->update([
            //     'deskripsi' => $request->get('deskripsiMerchant'),
            //     'status_merchant' => $request->get('statusMerchant'),
            //     'jam_buka' => $request->get('jamBuka'),
            //     'jam_tutup' => $request->get('jamTutup'),
            //     'nama' => $request->get('namaMerchant')
            // ]);
            // DB::table('alamatmerchant')
            //     ->updateOrInsert(
            //         ['merchant_users_iduser' => $id],
            //         [
            //             'alamat_lengkap' => $request->get('alamatLengkap'),
            //             'telepon' => $request->get('telepon'),
            //             'latitude' => $request->get('dataLatitude'),
            //             'longitude' => $request->get('dataLongitude')
            //         ]
            //     );
            // return redirect('seller/merchant/edit')->with('berhasil', 'berhasil ubh data merchant');

            // if ($request->has('checkboxBebasOngkir')) {
            //     DB::table('dukungantarifpengiriman')->updateOrInsert(
            //         ['merchant_users_iduser' => $id, 'tarifpengiriman_idtarifpengiriman' => $request->get('checkboxBebasOngkir')],
            //         ['minimum_belanja' => $request->get('minimumBebasOngkir'), 'etd' => $request->get('estimasiBebasOngkir')]
            //     );
            // } else {
            //     DB::table('dukungantarifpengiriman')->where('merchant_users_iduser', '=', $id)->where('tarifpengiriman_idtarifpengiriman', '=', 1)->delete();
            // }
            // if ($request->has('checkboxTarifFlat')) {
            //     DB::table('dukungantarifpengiriman')->updateOrInsert(
            //         ['merchant_users_iduser' => $id, 'tarifpengiriman_idtarifpengiriman' => $request->get('checkboxTarifFlat')],
            //         ['minimum_belanja' => $request->get('minimumTarifFlat'), 'etd' => $request->get('estimasiTarifFlat'), 'tarif_berat' => $request->get('tarifTarifFlat'), 'tarif_volume' => $request->get('tarifTarifFlat'), 'tarif_jarak' => $request->get('tarifTarifFlat')]
            //     );
            // } else {
            //     DB::table('dukungantarifpengiriman')->where('merchant_users_iduser', '=', $id)->where('tarifpengiriman_idtarifpengiriman', '=', 2)->delete();
            // }
            // if ($request->has('checkboxTarifStandar')) {
            //     DB::table('dukungantarifpengiriman')->updateOrInsert(
            //         ['merchant_users_iduser' => $id, 'tarifpengiriman_idtarifpengiriman' => $request->get('checkboxTarifStandar')],
            //         ['minimum_belanja' => $request->get('minimumTarifStandar'), 'etd' => $request->get('estimasiTarifStandar'), 'tarif_berat' => $request->get('tarifBerat'), 'tarif_volume' => $request->get('tarifVolume'), 'tarif_jarak' => $request->get('tarifJarak')]
            //     );
            // } else {
            //     DB::table('dukungantarifpengiriman')->where('merchant_users_iduser', '=', $id)->where('tarifpengiriman_idtarifpengiriman', '=', 3)->delete();
            // }

            // if($request->has('checkboxJNE')){
            //     DB::table('dukunganpengiriman')->updateOrInsert([
            //         'merchant_users_iduser' => $id,
            //         'kurir_idkurir' => 1
            //     ]);
            // }else{
            //     DB::table('dukunganpengiriman')->where('merchant_users_iduser',$id)->where('kurir_idkurir',1)->delete();
            // }
            // if ($request->has('checkboxKurirMerchant')) {
            //     DB::table('dukunganpengiriman')->updateOrInsert([
            //         'merchant_users_iduser' => $id,
            //         'kurir_idkurir' => 2
            //     ]);
            // } else {
            //     DB::table('dukunganpengiriman')->where('merchant_users_iduser', $id)->where('kurir_idkurir', 2)->delete();
            // }
 
            if ($request->has('checkboxCOD')) {
                DB::table('dukunganpembayaran')->updateOrInsert([
                    'merchant_users_iduser' => $id,
                    'tipepembayaran_idtipepembayaran' => 1
                ]);
            } else {
                DB::table('dukunganpembayaran')->where('merchant_users_iduser', $id)->where('tipepembayaran_idtipepembayaran', 1)->delete();
            }
            if ($request->has('checkboxBank')) {
                DB::table('dukunganpembayaran')->updateOrInsert([
                    'merchant_users_iduser' => $id,
                    'tipepembayaran_idtipepembayaran' => 2
                ]);
            } else {
                DB::table('dukunganpembayaran')->where('merchant_users_iduser', $id)->where('tipepembayaran_idtipepembayaran', 2)->delete();
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        //return $request->all();
    }
    public function destroy($id)
    { }
}
