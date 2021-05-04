<?php

namespace App\Http\Controllers;

use App\Merchant;
use App\User;
use App\Kategori;
use App\Tipepembayaran;
use App\Kurir;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class MerchantController extends Controller
{
    //
    public function index()
    { }
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
        $merchant = Merchant::where('users_iduser', $user->userid())->first();
        $kurir = Kurir::all();
        $tipePembayaran = Tipepembayaran::all();
        return view('seller.merchant.pengaturanmerchant', compact('merchant','kurir','tipePembayaran'));
    }
    public function show($id)
    {
        try {
            $merchant = Merchant::where('users_iduser', $id)->first();
            $data = DB::table('produk')
                ->join('merchant', 'merchant.users_iduser', '=', 'produk.merchant_users_iduser')
                ->join('gambarproduk', 'produk.idproduk', '=', 'gambarproduk.produk_idproduk')
                ->groupBy('produk.idproduk')
                ->where('produk.merchant_users_iduser', $id)
                ->select('produk.*', 'merchant.nama as nama_merchant', 'gambarproduk.idgambarproduk as idgambarproduk')
                ->get();
            $kategori = Kategori::where('merchant_users_iduser', $id)->get();
            return view('user.merchant.merchant', compact('merchant', 'data', 'kategori'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function etalase($id1, $id2)
    {
        try {
            $merchant = Merchant::where('users_iduser', $id1)->first();
            $data = DB::table('produk')
                ->join('merchant', 'merchant.users_iduser', '=', 'produk.merchant_users_iduser')
                ->join('gambarproduk', 'produk.idproduk', '=', 'gambarproduk.produk_idproduk')
                ->groupBy('produk.idproduk')
                ->where('produk.merchant_users_iduser', $id1)
                ->where('produk.kategori_idkategori', $id2)
                ->select('produk.*', 'merchant.nama as nama_merchant', 'gambarproduk.idgambarproduk as idgambarproduk')
                ->get();
            $kategori = Kategori::where('merchant_users_iduser', $id1)->get();
            return view('user.merchant.merchant', compact('merchant', 'data', 'kategori', 'id2'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function update(Request $request, $id)
    {
        try {
            if ($request->hasFile('fotoProfil')) {
                $extension = $request->fotoProfil->extension();
                $destinationPath = public_path('fotoProfil');
                $file = $request->file('fotoProfil');
                $file->move($destinationPath, 'merchant-fotoprofil-' . $id . "." . $extension);

                Merchant::where('users_iduser', $id)
                    ->update([
                        'foto_profil' => 'merchant-fotoprofil-' . $id .".". $extension
                ]);
            }
            if ($request->hasFile('fotoSampul')) {
                $extension = $request->fotoSampul->extension();
                $destinationPath = public_path('fotoSampul');
                $file = $request->file('fotoSampul');
                $file->move($destinationPath, 'merchant-fotosampul-' . $id . "." . $extension);

                Merchant::where('users_iduser', $id)
                    ->update([
                        'foto_sampul' => 'merchant-fotosampul-' . $id . "." . $extension
                ]);
            }
            Merchant::where('users_iduser',$id)
            ->update([
                'deskripsi' => $request->get('deskripsiMerchant'),
                'status_merchant' => $request->get('statusMerchant'),
                'jam_buka' => $request->get('jamBuka'),
                'jam_tutup' => $request->get('jamTutup'),
                'nama' => $request->get('namaMerchant')
            ]);
            DB::table('alamatmerchant')
                ->updateOrInsert(
                    ['merchant_users_iduser' => $id],
                    [
                        'alamat_lengkap' => $request->get('alamatLengkap'),
                        'telepon' => $request->get('telepon'),
                        'latitude' => $request->get('dataLatitude'),
                        'longitude' => $request->get('dataLongitude')
                    ]
                );
            //return $request->all();
            return redirect('seller/merchant/edit')->with('berhasil', 'berhasil ubh data merchant');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        return $request->all();
    }
    public function destroy($id)
    { 
        
    }
}
