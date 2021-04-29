<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\MailOTP;
use Illuminate\Support\Facades\Mail;
class OtpController extends Controller
{
    //
    public function otpWhatsapp(Request $request){
        
    }
    public function otpEmail(Request $request){
        return "masuk email";
    }
    public function send()
    {
        try{
            $details = [
                'title' => 'Evan PC',
                'body' => 'This is for testing email using smtp'
            ];
            \Mail::to('s160417052@student.ubaya.ac.id')->send(new \App\Mail\MailOTP($details));
            dd("Email is Sent.");
        }catch(\Exception $e){
            dd($e->getMessage());
        }
    }
    public function verifikasi(Request $request){
        $otp = $request->session()->get('otp');
        if($request->get('otp') == $otp){
            return "otp diterima";
        }else{
            return "otp ditolak";
        }
    }
}
