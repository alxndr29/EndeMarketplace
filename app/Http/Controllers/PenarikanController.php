<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Merchant;
class PenarikanController extends Controller
{
    //
    public function indexUser()
    {
        $user = new User();
        $daftarTransaksi = DB::table('transaksi')
            ->join('pembayaran', 'pembayaran.transaksi_idtransaksi', '=', 'transaksi.idtransaksi')
            ->where('pembayaran.status', '=', 'settlement')
            ->where('transaksi.refund_at', '=', null)
            ->where('transaksi.users_iduser', $user->userid())
            ->where('transaksi.status_transaksi', 'Batal')
            ->get();
        //return $daftarTransaksi;
        $total = 0;
        foreach ($daftarTransaksi as $value) {
            $total += $value->nominal_pembayaran;
        }
        $daftarPenarikan = DB::table('penarikandana')
        ->join('transaksi_has_penarikandana','penarikandana.idpenarikandana','=','transaksi_has_penarikandana.penarikandana_idpenarikandana')
        ->join('transaksi','transaksi.idtransaksi','=','transaksi_has_penarikandana.transaksi_idtransaksi')
        ->select('penarikandana.*', 'transaksi.*')
        ->groupBy('penarikandana.idpenarikandana')
        ->where('transaksi.users_iduser',$user->userid())
        ->where('penarikandana.jenis','=','refund')
        ->get();
        //return $daftarPenarikan;
        return view('user.penarikan.penarikan', compact('daftarTransaksi', 'total', 'daftarPenarikan'));
    }
    public function formulirPenarikanUser(Request $request)
    {
        try {
            $id = DB::table('penarikandana')->insertGetId([
                'bank_tujuan' => $request->get('namaBank'),
                'nomor_rekening' => $request->get('nomorRekening'),
                'nama_pemilik_rekening' => $request->get('namaPemilikRekening'),
                'status' => 'Menunggu',
                'total' => $request->get('total'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'jenis' => 'refund'
            ]);
            foreach($request->get('idtransaksi') as $value){
                DB::table('transaksi_has_penarikandana')->insert([
                    'transaksi_idtransaksi' => $value,
                    'penarikandana_idpenarikandana' => $id
                ]);
                DB::table('transaksi')->where('transaksi.idtransaksi', $value)->update(['transaksi.refund_at' => date('Y-m-d H:i:s')]);
            }
            return redirect()->back()->with('berhasil', 'Form Penarikan Anda berhasil.');
        } catch (\Exception $e) {
            return redirect()->back()->with('gagal', 'Form Penarikan Anda Gagal');
        }
    }
    public function detailPenarikanUser($id){
        try{
            $detailPenarikan = DB::table('penarikandana')->where('idpenarikandana','=',$id)->first();
            $daftarTransaksi = DB::table('transaksi')
            ->join('transaksi_has_penarikandana', 'transaksi.idtransaksi','=','transaksi_has_penarikandana.transaksi_idtransaksi')
            ->where('transaksi_has_penarikandana.penarikandana_idpenarikandana','=',$id)
            ->select('transaksi.*')
            ->get();
            $result = [
                'detailPenarikan' => $detailPenarikan,
                'daftarTransaksi' => $daftarTransaksi
            ];
            return $result;
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }
    public function indexMerchant(){
        $merchant = new Merchant();
        $daftarTransaksi = DB::table('transaksi')
            ->join('pembayaran', 'pembayaran.transaksi_idtransaksi', '=', 'transaksi.idtransaksi')
            ->where('pembayaran.status', '=', 'settlement')
            ->where('transaksi.withdraw_at', '=', null)
            ->where('transaksi.merchant_users_iduser', $merchant->idmerchant())
            ->where('transaksi.status_transaksi', 'Selesai')
            //->whereNotIn('transaksi.idtransaksi', DB::table('transaksi_has_penarikandana')->pluck('transaksi_idtransaksi'))
            ->get();
        $total = 0;
        foreach ($daftarTransaksi as $value) {
            $total += $value->nominal_pembayaran;
        }
        $daftarPenarikan = DB::table('penarikandana')
            ->join('transaksi_has_penarikandana', 'penarikandana.idpenarikandana', '=', 'transaksi_has_penarikandana.penarikandana_idpenarikandana')
            ->join('transaksi', 'transaksi.idtransaksi', '=', 'transaksi_has_penarikandana.transaksi_idtransaksi')
            ->select('penarikandana.*')
            ->groupBy('penarikandana.idpenarikandana')
            ->where('transaksi.merchant_users_iduser', $merchant->idmerchant())
            ->where('penarikandana.jenis', '=', 'withdraw')
            ->get();
        
        return view('seller.penarikan.penarikan',compact('daftarTransaksi', 'total', 'daftarPenarikan'));
    }
    public function formulirPenarikanMerchant(Request $request){
        try {
            $id = DB::table('penarikandana')->insertGetId([
                'bank_tujuan' => $request->get('namaBank'),
                'nomor_rekening' => $request->get('nomorRekening'),
                'nama_pemilik_rekening' => $request->get('namaPemilikRekening'),
                'status' => 'Menunggu',
                'total' => $request->get('total'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'jenis' => 'withdraw'
            ]);
            foreach ($request->get('idtransaksi') as $value) {
                DB::table('transaksi_has_penarikandana')->insert([
                    'transaksi_idtransaksi' => $value,
                    'penarikandana_idpenarikandana' => $id
                ]);
                DB::table('transaksi')->where('transaksi.idtransaksi',$value)->update(['transaksi.withdraw_at' => date('Y-m-d H:i:s')]);
            }
            return redirect()->back()->with('berhasil', 'Form Penarikan Anda berhasil.');
        } catch (\Exception $e) {
            return redirect()->back()->with('gagal', 'Form Penarikan Anda Gagal');
        }
    }
    public function detailPenarikanMerchant($id){
        try {
            $detailPenarikan = DB::table('penarikandana')->where('idpenarikandana', '=', $id)->first();
            $daftarTransaksi = DB::table('transaksi')
                ->join('transaksi_has_penarikandana', 'transaksi.idtransaksi', '=', 'transaksi_has_penarikandana.transaksi_idtransaksi')
                ->where('transaksi_has_penarikandana.penarikandana_idpenarikandana', '=', $id)
                ->select('transaksi.*')
                ->get();
            $result = [
                'detailPenarikan' => $detailPenarikan,
                'daftarTransaksi' => $daftarTransaksi
            ];
            return $result;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
