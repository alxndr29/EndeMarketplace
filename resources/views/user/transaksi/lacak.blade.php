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
                    <b>Data Alamat:</b>
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
                    <b>Data Pembayaran:</b>
                    <br>
                    Jenis Pembayaran: <b>{{$alamatPengiriman->namatipepembayaran}}</b>
                    <br>
                    Total Belanja: <b> Rp. {{number_format($alamatPengiriman->nominal_pembayaran - $alamatPengiriman->biaya_pengiriman)}}</b>
                    <br>
                    Biaya Pengiriman: <b>Rp. {{number_format($alamatPengiriman->biaya_pengiriman)}}</b>
                    <br>
                    Nominal Penagihan: <b>Rp. {{number_format($alamatPengiriman->nominal_pembayaran)}}</b>
                    <br>
                    Status Pengiriman: <b>{{$data->status}}</b>
                    <br>
                    <br>
                    @if($data->status == "ProsesKeKurir")
                    <br>Live Tracking Lokasi Kurir Belum Tersedia</br>
                    @endif
                    @if($data->status == "SedangDiantar")
                    <button id="selesaiAntar" class="btn btn-success" style="margin-right: 5px;">
                        <i class="fas fa-edit"></i>Selesai
                    </button>
                    @endif
                </div>
                <div class="col">
                    <b>Data Petugas:</b>
                    <br>
                    Nama: {{$data->nama}}
                    <br>
                    Telepon: {{$data->telepon}}
                    <br>
                    Kendaraan: {{$data->nama_kendaraan}} ({{$data->nomor_polisi}})
                    <br>
                    @if(isset($data->foto))
                    Foto Pengantaran:
                        <a href="{{asset('fotoTerima/'.$data->foto)}}">
                            <img src="{{asset('fotoTerima/'.$data->foto)}}" class="rounded mx-auto d-block" style="width:50px; height:50px;">
                        </a>
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
<script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1MgLuZuyqR_OGY3ob3M52N46TDBRI_9k&callback=initMap&libraries=&v=weekly">
</script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

<script type="text/javascript">
    var latitude = "";
    var longitude = "";
    var jarak = 0;

    var latitude_origin = "{{$data->latitude_merchant}}";
    var longitude_origin = "{{$data->longitude_merchant}}";
    var latitude_destination = "{{$data->latitude_user}}";
    var longitude_destination = "{{$data->longitude_user}}";

    var map;
    var myLatlng;
    var lokasiKurir;
    var mapOptions;

    var marker;
    var marker2;
    var marker3;

    var timer;
    var status = "";

    function iniatMap() {
        //alert('sekali doang');
        myLatlng = new google.maps.LatLng(latitude_destination, longitude_destination);
        mapOptions = {
            zoom: 15,
            center: myLatlng
        }

        latlng = new google.maps.LatLng(latitude_origin, longitude_origin);
        lokasiKurir = new google.maps.LatLng(latitude, longitude);

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

        if ("{{$data->status}}" == "SedangDiantar") {
            timer = setInterval(function() {
                loadKurir();
            }, 10000);
        }
    }

    var notif_selesai = false;
    var notif_dekat = false;

    function loadKurir() {
        $.ajax({
            url: "{{url('user/tracking/lokasi/kurir')}}/" + "{{$idpengiriman}}",
            type: "GET",
            success: function(response) {
                latitude = response[0].latitude_sekarang;
                longitude = response[0].longitude_sekarang;
                jarak = response[0].jarak_sekarang;

                if (jarak < 0.2) {
                    if (notif_dekat == false) {
                        Swal.fire(
                            'Hore!',
                            'Kurir pengantar sudah dekat',
                            'success'
                        )
                    }
                    notif_dekat = true;
                    // alert('kurir sudah dekat');
                }
                if (response[0].status == "SelesaiAntar") {
                    if (notif_selesai == false) {
                        Swal.fire(
                            'Berhasil!',
                            'Pengiriman anda telah terselesaikan',
                            'success'
                        )
                    }
                    notif_selesai = true;
                    // alert("Kurir Anda sudah sampai tujuan");
                    clearInterval(timer);
                }
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
        lokasiKurir = new google.maps.LatLng(latitude, longitude);
        marker3 = new google.maps.Marker({
            position: lokasiKurir,
            title: "Hello World!",
            label: "Lokasi Kurir"
        });
        marker3.setMap(map);
        console.log('update kurir');
    }
    $("#selesaiAntar").click(function() {
        $.ajax({
            url: "{{url('seller/pengiriman/status')}}/" + "{{$idpengiriman}}" + "/" + "SelesaiAntar" + "/" + "ajax",
            type: "GET",
            success: function(response) {
                if (response == "berhasil") {
                    alert("Selesai melakukan pengantaran");
                    clearInterval(timer);
                    console.log('selesai antar');
                    location.reload();
                }
            },
            error: function(response) {
                console.log(response);
            }
        });
    });
    $(document).ready(function() {
        iniatMap();
    });
</script>
@endsection
@endsection