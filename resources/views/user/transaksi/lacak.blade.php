@extends('layouts.userlte')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            Detail Pengantaran
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    Data Alamat:
                    <br>
                    Nama Penerima: <b>{{$alamatPengiriman->nama_penerima}}</b>
                    <br>
                    Alamat Lengkap: <b>{{$alamatPengiriman->alamatlengkap}}</b>
                    <br>
                    Telp Penerima: <b>{{$alamatPengiriman->telepon}}</b>
                    <br>
                    Kota: <b>{{$alamatPengiriman->nama_kota}}</b>
                    <br>
                    Kode Pos: <b>{{$alamatPengiriman->kode_pos}}</b>
                    <br>
                    Provinsi: <b>{{$alamatPengiriman->nama_provinsi}}</b>
                    <br>
                </div>
                <div class="col">
                    Data Pembayaran:
                    <br>
                    Jenis Pembayaran: <b>{{$alamatPengiriman->namatipepembayaran}}</b>
                    <br>
                    Total Belanja: <b> Rp. {{number_format($alamatPengiriman->nominal_pembayaran - $alamatPengiriman->biaya_pengiriman)}}</b>
                    <br>
                    Biaya Pengiriman: <b>Rp. {{number_format($alamatPengiriman->biaya_pengiriman)}}</b>
                    <br>
                    Nominal Penagihan: <b>Rp. {{number_format($alamatPengiriman->nominal_pembayaran)}}</b>
                    <br>
                    Status: {{$data->status}}
                    <br>
                    <br>
                    @if($data->status == "ProsesKeKurir")
                        <br>Live Tracking Lokasi Kurir Belum Tersedia</br>
                    @endif
                    @if($data->status == "SedangDiantar")
                        <button id="selesaiAntar"class="btn btn-success" style="margin-right: 5px;">
                        <i class="fas fa-edit"></i>Selesai
                    </button>
                    @endif
                    
                    
                </div>
            </div>
            
        </div>
    </div>
    <div class="card">
        <div class="card-body">
        <div class="row">
                <div class="col">
                    <div id="map" style="height:300px;width100%;">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('js')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1MgLuZuyqR_OGY3ob3M52N46TDBRI_9k&callback=initMap&libraries=&v=weekly" async>
</script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

<script type="text/javascript">

    var latitude = "";
    var longitude = "";
    var jarak = 0;

    var latitude_origin = {{$data->latitude_merchant}};
    var longitude_origin = {{$data->longitude_merchant}};
    var latitude_destination = {{$data->latitude_user}};
    var longitude_destination = {{$data->longitude_user}};

    var map;
    var myLatlng;
    var lokasiKurir;
    var mapOptions;

    var marker;
    var marker2;
    var marker3;

    function iniatMap() {
        alert('sekali doang');
        myLatlng = new google.maps.LatLng(latitude_destination, longitude_destination);
        latlng = new google.maps.LatLng(latitude_origin, longitude_origin);
        lokasiKurir = new google.maps.LatLng(latitude, longitude);
        mapOptions = {
            zoom: 15,
            center: myLatlng
        }
        map = new google.maps.Map(document.getElementById("map"), mapOptions);
        //$("#demo").append('Jarak Kurir ke tujuan = ' + jarakKeTujuan(latitude, longitude, latitude_destination, longitude_destination, 'K') + ' Kilometer <br>');
        marker = new google.maps.Marker({
            position: myLatlng,
            title: "Hello World!",
            label: "Lokasi Pembeli (Tujuan)"
        });
        // To add the marker to the map, call setMap();
        marker2 = new google.maps.Marker({
            position: latlng,
            title: "Hello World!",
            label: "Lokasi Penjual (Awal)"
        });
        marker.setMap(map);
        marker2.setMap(map);

        if("{{$data->status}}" == "SedangDiantar"){
            setInterval(function(){ 
                loadKurir();
            }, 10000);
        }
        
    }
    function loadKurir(){
        $.ajax({
            url: "{{url('user/tracking/lokasi/kurir')}}/" + {{$idpengiriman}},
            type: "GET",
            success: function(response) {
               latitude = response[0].latitude_sekarang;
               longitude = response[0].longitude_sekarang;
               jarak = response[0].jarak_sekarang;
               alert(latitude+longitude+jarak);
               updateLokasiKurir();
            },
            error: function(response) {
                console.log(response);
            }
        });
    }
    function updateLokasiKurir() {
        if (marker3 != null) {
            marker3.setMap(null);
        }
        //marker3.setMap(null);
        lokasiKurir = new google.maps.LatLng(latitude, longitude);
        marker3 = new google.maps.Marker({
            position: lokasiKurir,
            title: "Hello World!",
            label: "Lokasi Kurir"
        });
        marker3.setMap(map);
    }

    $(document).ready(function() {
        iniatMap();
       
        
    });

    
</script>
@endsection
@endsection