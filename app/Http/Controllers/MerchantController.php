<?php

namespace App\Http\Controllers;
use App\Merchant;
use App\User;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MerchantController extends Controller
{
    //
    public function index(){

    }
    public function create(){

        return view('seller.merchant.registrasimerchant');
    }
    public function store(Request $request){
        try{
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
            
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }
    public function edit(){
        $user = new User();
        $merchant = Merchant::where('users_iduser', $user->userid())->first();
        //return $merchant;
        return view('seller.merchant.pengaturanmerchant',compact('merchant'));
    }
    public function show($id){
        return view('user.merchant.merchant');
    }
    public function update(Request $request, $id){
        //return $id;
        // if($request->hasFile('fotoProfil')){
        //     $fileName = $request->fotoProfil->getClientOriginalName();
        //     return $fileName;
        // }
        try{
            if($request->hasFile('fotoProfil')){

            }
            if($request->hasFile('fotoSampul')){

            }
            Merchant::where('users_iduser',$id)
            ->update([
                'foto_profil' => null,
                'foto_sampul' => null,
                'deskripsi' => $request->get('deskripsiMerchant'),
                'status_merchant' => $request->get('statusMerchant'),
                'jam_buka' => $request->get('jamBuka'),
                'jam_tutup' => $request->get('jamTutup'),
                'nama' => $request->get('namaMerchant')
            ]);
            return redirect('seller/merchant/edit')->with('berhasil','berhasil ubh data merchant');
        }catch(\Exception $e){
            return $e->getMessage();
        }
        return $request->all();
    }
    public function destroy($id){

    }
}
