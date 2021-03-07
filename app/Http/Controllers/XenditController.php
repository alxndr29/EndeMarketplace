<?php

namespace App\Http\Controllers;

use Xendit\Xendit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class XenditController extends Controller
{
    //
    private $key = 'xnd_development_N1lIhoON8dwzt7oDRMMeQ83DXJrerVpfutNtZFuQZr5NtVbPwWAchqHaj7pw';
    //Menampilkan Saldo
    public function balance()
    {
        Xendit::setApiKey($this->key);
        $getBalance = \Xendit\Balance::getBalance('CASH');
        return $getBalance;
    }
    //Menampilkan daftar bank yang support VA
    public function getListVA()
    {
        Xendit::setApiKey($this->key);
        $getVABanks = \Xendit\VirtualAccounts::getVABanks();
        return $getVABanks;
    }
    //Membuat Pembayaran
    public function createVA()
    {
        Xendit::setApiKey($this->key);
        $params = [
            "external_id" => "demo-1475804036622",
            "bank_code" => "BNI",
            "name" => "Alexander Evan"
        ];
        $createVA = \Xendit\VirtualAccounts::create($params);
        return $createVA;
    }
    //Melihat Pembayaran
    public function showPayment()
    {
        Xendit::setApiKey($this->key);
        $paymentID = 'demo-1475804036622';
        $getFVAPayment = \Xendit\VirtualAccounts::getFVAPayment($paymentID);
        return $getFVAPayment;
    }
}
