<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\MailOTP;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Response;

class OtpController extends Controller
{
    //
    public function otpWhatsapp(Request $request)
    {
        $user = Auth::user();
        $id =  $user->iduser;
        $dataUser = User::where('iduser', $id)->first();
        $otp = $request->session()->get('otp');
        try{
            $result = file_get_contents("https://sambi.wablas.com/api/send-message?token=qTfb6jdlzQ9sWE50NM2p9kDIO7x4OjrTY3mIuusw3ec5ZCcPICJcgU8NfOzPdY6b&phone=".$dataUser->telepon."&message=".'Hallo, ' . $dataUser->name . ' Berikut merupakan kode OTP untuk login pada website. ' . $otp . ' Terimakasih!');
            return $result;
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }
    public function otpEmail(Request $request)
    {
        $user = Auth::user();
        $id =  $user->iduser;
        $dataUser = User::where('iduser', $id)->first();
        $otp = $request->session()->get('otp');
        try {
            $details = [
                'title' => 'OTP Untuk Login pada Website',
                'body' => 'Hallo, '.$dataUser->name.' Berikut merupakan kode OTP untuk login pada website. '.$otp.' Terimakasih!'
            ];
            \Mail::to($dataUser->email)->send(new \App\Mail\MailOTP($details));
            //return $dataUser->email;
            return "berhasil";
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function send()
    {
        try {
            $details = [
                'title' => 'Evan PC',
                'body' => 'This is for testing email using smtp'
            ];
            \Mail::to('s160417052@student.ubaya.ac.id')->send(new \App\Mail\MailOTP($details));
            dd("Email is Sent.");
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
    public function verifikasi(Request $request)
    {
        // $minutes = 60;
        // $response = new Response('Set Cookie');
        // $response->withCookie(cookie('name', 'MyValue', $minutes));
        // return $response;

        $otp = $request->session()->get('otp');
        if ($request->get('otp') == $otp) {
            $response = new Response('MyCookie');
            //$namaCookie = 'chizurumizuhara464@gmail.com';
            $response->withCookie(cookie()->forever('otp', $request->get('iduser').'/verified'));
            //$response->withCookie(cookie()->forever($request->get('email'), $request->get('email').'/verified'));
            return $response;
        } else {
            return "gagal";
        }
    }
}
