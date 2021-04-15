<?php

namespace App;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    //
    protected $table = 'merchant';
    //protected $primaryKey = 'idmerchant';

    public function idmerchant(){
        $user = new User();
        $merchant = Merchant::where('users_iduser','=',$user->userid())->first();
        return $merchant->users_iduser;
    }
}
