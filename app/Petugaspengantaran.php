<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Petugaspengantaran extends Model
{
    //
    protected $table = 'petugaspengantaran';
    protected $primaryKey = 'idpetugaspengantaran';

    public function idmerchant($idpengantar){
        $data = DB::table('merchant')
        ->join('petugaspengantaran','petugaspengantaran.merchant_users_iduser','=','merchant.users_iduser')
        ->where('petugaspengantaran.idpetugaspengantaran', $idpengantar)
        ->select('merchant.users_iduser')
        ->first();
        return $data->users_iduser;
    }
}
