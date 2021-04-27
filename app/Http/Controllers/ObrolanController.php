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
    public function indexUser(){
        $user = new User();
        $userid = $user->iduser;
        $data = DB::table('obrolan')->join('merchant', 'obrolan.merchant_users_iduser', 'merchant.users_iduser')
            ->join('users', 'obrolan.users_iduser', 'users.iduser')
            ->select('obrolan.*', 'users.name as nama_user', 'users.iduser as iduser', 'merchant.nama as nama_merchant', 'merchant.users_iduser as idmerchant')
            ->orderBy('obrolan.waktu','DESC')
            ->where('users.iduser', '=', $user->userid())
            ->groupBy('obrolan.merchant_users_iduser')
            //->where('obrolan.idobrolan','=',function($query) use ($userid) {$query->selectRaw('max(idobrolan)')->from('obrolan')->where('obrolan.users_iduser','=', 'users.iduser');})
            ->get();
        //return $data;
        return view('user.obrolan.obrolan',compact('data'));
    }
    public function indexMerchant()
    {
        $merchant = new Merchant();
        $data = DB::table('obrolan')->join('merchant', 'obrolan.merchant_users_iduser', 'merchant.users_iduser')
            ->join('users', 'obrolan.users_iduser', 'users.iduser')
            ->select('obrolan.*', 'users.name as nama_user', 'users.iduser as iduser', 'merchant.nama as nama_merchant', 'merchant.users_iduser as idmerchant')
            ->orderBy('obrolan.waktu', 'DESC')
            ->where('merchant.users_iduser', '=', $merchant->idmerchant())
            ->groupBy('obrolan.merchant_users_iduser')
            //->where('obrolan.idobrolan','=',function($query) use ($userid) {$query->selectRaw('max(idobrolan)')->from('obrolan')->where('obrolan.users_iduser','=', 'users.iduser');})
            ->get();
        //return $data;
        return view('seller.obrolan.obrolan',compact('data'));
    }
    public function inserObrolanUser(Request $request){
        
        try{
            $obrolan = new Obrolan();
            $user = new User();
            $obrolan->subject = $request->get('subject');
            $obrolan->isi_pesan = $request->get('isipesan');
            $obrolan->pengirim = 'Pembeli';
            $obrolan->users_iduser = $user->userid();
            $obrolan->merchant_users_iduser = $request->get('idmerchant');
            $obrolan->save();
            $response = ['status' => 'berhasil'];
            return response()->json($response);
        }catch(\Exception $e){
            $response = ['status' => $e->getMessage()];
            return response()->json($response);
        }
       
    }
    public function insertObrolanMerchant(Request $request){
        try {
            $obrolan = new Obrolan();
            $merchant = new Merchant();
            $obrolan->subject = $request->get('subject');
            $obrolan->isi_pesan = $request->get('isipesan');
            $obrolan->pengirim = 'Merchant';
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
    public function getObrolanUser($id){
        try{
            $user = new User();
            $data = DB::table('obrolan')->join('merchant', 'obrolan.merchant_users_iduser', 'merchant.users_iduser')
            ->join('users','obrolan.users_iduser','users.iduser')
            ->select('obrolan.*','users.name as nama_user','users.iduser as iduser','merchant.nama as nama_merchant', 'merchant.users_iduser as idmerchant')
            ->where('users.iduser','=',$user->userid())
            ->where('obrolan.merchant_users_iduser','=',$id)
            ->get();
            return $data;
        }catch(\Exception $e){
            $response = ['status' => $e->getMessage()];
            return response()->json($response);
        }
    }
    
}
