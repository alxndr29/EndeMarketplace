<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function login()
    {
        return view('admin.login');
    }
    public function home(){
        return view('admin.home');
    }
    public function loginProses(Request $request)
    {
        try {
            if ($request->get('username') == "admin" && $request->get('password') == "admin") {
                $request->session()->put('administrator-login', true);
                return redirect('admin/home');
            } else {
                return redirect()->back()->with('gagal', 'Data Login Tidak Terdaftar');
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        return $request->all();
    }
    public function logout(Request $request)
    {
        $request->session()->forget('administrator-login');
        return redirect()->back();
    }
    public function refund()
    { }
    public function detailRefund($id)
    { }
}
