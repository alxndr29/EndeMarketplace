<?php

namespace App\Http\Controllers;

use App\Kabupatenkota;
use Illuminate\Http\Request;
use DB;
use App\Provinsi;
use PhpParser\Node\Expr\Print_;

class RajaOngkirController extends Controller
{
    //
    public function provinsi()
    {
        return view('user.rajaongkir');
    }
    public function getKota($id)
    {

        // $curl = curl_init();

        // curl_setopt_array($curl, array(
        //     CURLOPT_URL => "https://api.rajaongkir.com/starter/city?",
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => "",
        //     CURLOPT_MAXREDIRS => 10,
        //     CURLOPT_TIMEOUT => 30,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => "GET",
        //     CURLOPT_HTTPHEADER => array(
        //         "key: a8b77b96d1644da7c4564341438c61c2"
        //     ),
        // ));

        // $response = curl_exec($curl);
        // $err = curl_error($curl);

        // curl_close($curl);

        // if ($err) {
        //     echo "cURL Error #:" . $err;
        // } else {
        //     echo $response;
        //     /*
        //     foreach(json_decode($response) as $value){
        //         foreach($value->results as $a){
        //            DB::table('kabupatenkota')->insert([
        //                'idkabupatenkota' => $a->city_id,
        //                'nama' => $a->city_name,
        //                'kodepos' => $a->postal_code,
        //                'provinsi_idprovinsi' => $a->province_id
        //            ]);
        //         }
        //     }
        //     */
        // }

        $kabupatenkota = Kabupatenkota::where('provinsi_idprovinsi','=',$id)->get();
        return $kabupatenkota;
    }
    public function getProvinsi()
    {
        /*
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: a8b77b96d1644da7c4564341438c61c2"
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {

            //    foreach(json_decode($response) as $value){
            //        foreach($value->results as $a){
            //            //echo $a->province;
            //             DB::table('provinsi')->insert([
            //                 'idprovinsi' => $a->province_id,
            //                 'nama' => $a->province
            //             ]);

            //        }
            //    }
            // return "succes <br>";
            return $response;
        }
        */
        $provinsi = Provinsi::all();
        return $provinsi;
    }
    public function cost($origin, $destination, $courier, $berat)
    {
        $param = "origin=" . $origin . "&destination=" . $destination . "&weight=" . $berat . "&courier=" . $courier;
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $param,
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: a8b77b96d1644da7c4564341438c61c2"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            return ($response);
        }
    }
}
