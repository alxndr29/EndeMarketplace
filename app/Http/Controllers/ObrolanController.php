<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Obrolan;
use App\User;
use App\Merchant;
use DB;

class ObrolanController extends Controller
{
    //
    public function indexUser()
    {
        $user = new User();
        $userid = $user->userid();

        $data = DB::table('obrolan')->join('merchant', 'obrolan.merchant_users_iduser', 'merchant.users_iduser')
            ->join('users', 'obrolan.users_iduser', 'users.iduser')
            ->select('obrolan.*', 'users.name as nama_user', 'users.iduser as iduser', 'merchant.nama as nama_merchant', 'merchant.users_iduser as idmerchant', DB::raw('max(isi_pesan) as isi_pesan_max'))
            ->orderBy('obrolan.waktu', 'ASC')
            ->where('users.iduser', '=', $user->userid())
            ->groupBy('obrolan.merchant_users_iduser')
            ->where('obrolan.idobrolan','=',function($query) use ($userid) {$query->selectRaw('max(idobrolan)')->from('obrolan')->where('obrolan.users_iduser','=', $userid);})
            ->get();
            //return $data;
            return view('user.obrolan.obrolan', compact('data'));

            // SELECT *
            // from obrolan
            // where idobrolan in (SELECT max(idobrolan) from obrolan GROUP by users_iduser)
            
        // $d = Obrolan::select(DB::raw('*,max(created_at) as updatedAt'))
        //     ->where('users_iduser', $user->userid())
        //     ->orderBy('updatedAt', 'desc')
        //     ->groupBy('merchant_users_iduser')
        //     ->get();
        // return $d;
    }
    public function indexMerchant()
    {
        $merchant = new Merchant();
        $merchantid = $merchant->idmerchant();
        $data = DB::table('obrolan')->join('merchant', 'obrolan.merchant_users_iduser', 'merchant.users_iduser')
            ->join('users', 'obrolan.users_iduser', 'users.iduser')
            ->select('obrolan.*', 'users.name as nama_user', 'users.iduser as iduser', 'merchant.nama as nama_merchant', 'merchant.users_iduser as idmerchant', DB::raw('max(isi_pesan) as isi_pesan_max'))
            ->orderBy('obrolan.waktu', 'ASC')
            ->where('merchant.users_iduser', '=', $merchant->idmerchant())
            ->groupBy('obrolan.users_iduser')
            ->where('obrolan.idobrolan','=',function($query) use ($merchantid) {$query->selectRaw('max(idobrolan)')->from('obrolan')->where('obrolan.merchant_users_iduser','=',$merchantid);})
            ->get();
        // return $data;
        return view('seller.obrolan.obrolan', compact('data'));
    }
    public function inserObrolanUser(Request $request)
    {

        try {

            $obrolan = new Obrolan();
            $user = new User();
            $obrolan->subject = $request->get('subject');
            $obrolan->isi_pesan = $request->get('isipesan');
            $obrolan->pengirim = 'Pembeli';
            $obrolan->status_baca_user = 1;
            $obrolan->status_baca_merchant = 0;
            $obrolan->users_iduser = $user->userid();
            $obrolan->merchant_users_iduser = $request->get('idmerchant');
            $obrolan->save();
            $response = ['status' => 'berhasil'];
            return response()->json($response);

            //return $request->all();
        } catch (\Exception $e) {
            $response = ['status' => $e->getMessage()];
            return response()->json($response);
        }
    }
    public function insertObrolanMerchant(Request $request)
    {
        try {
            $obrolan = new Obrolan();
            $merchant = new Merchant();
            $obrolan->subject = $request->get('subject');
            $obrolan->isi_pesan = $request->get('isipesan');
            $obrolan->pengirim = 'Merchant';
            $obrolan->status_baca_user = 0;
            $obrolan->status_baca_merchant = 1;
            $obrolan->users_iduser = $request->get('iduser');
            $obrolan->merchant_users_iduser = $merchant->idmerchant();
            $obrolan->save();
            $response = ['status' => 'berhasil'];
            return response()->json($response);
        } catch (\Exception $e) {
            $response = ['status' => $e->getMessage()];
            return response()->json($response);
        }
    }
    public function getObrolanUser($id)
    {
        try {
            $user = new User();
            Obrolan::where('users_iduser', $user->userid())->where('merchant_users_iduser', $id)->update(['status_baca_user' => 1]);
            $data = DB::table('obrolan')->join('merchant', 'obrolan.merchant_users_iduser', 'merchant.users_iduser')
                ->join('users', 'obrolan.users_iduser', 'users.iduser')
                ->select('obrolan.*', 'users.name as nama_user', 'users.iduser as iduser', 'merchant.nama as nama_merchant', 'merchant.users_iduser as idmerchant')
                ->where('users.iduser', '=', $user->userid())
                ->where('obrolan.merchant_users_iduser', '=', $id)
                ->get();
            return $data;
        } catch (\Exception $e) {
            $response = ['status' => $e->getMessage()];
            return response()->json($response);
        }
    }
    public function getObrolanMerchant($id)
    {
        try {
            //$user = new User();
            $merchant = new Merchant();
            Obrolan::where('users_iduser', $id)->where('merchant_users_iduser', $merchant->idmerchant())->update(['status_baca_merchant' => 1]);
            $data = DB::table('obrolan')->join('merchant', 'obrolan.merchant_users_iduser', 'merchant.users_iduser')
                ->join('users', 'obrolan.users_iduser', 'users.iduser')
                ->select('obrolan.*', 'users.name as nama_user', 'users.iduser as iduser', 'merchant.nama as nama_merchant', 'merchant.users_iduser as idmerchant')
                ->where('users.iduser', '=', $id)
                ->where('obrolan.merchant_users_iduser', '=', $merchant->idmerchant())
                ->get();
            return $data;
        } catch (\Exception $e) {
            $response = ['status' => $e->getMessage()];
            return response()->json($response);
        }
    }
}
