@extends('layouts.adminlte')
@section('content')
<div class="container-fluid">
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
                    Status: <b>{{$data->status}}</b>
                    <br>
                    @if($data->status == "ProsesKeKurir")
                    <button type="button" class="btn btn-success" id="antarSekarang" style="margin-right: 5px;">
                        <i class="fas fa-edit"></i>Antar Sekarang
                    </button>
                    @endif
                    @if($data->status != "SelesaiAntar")
                    <button id="selesaiAntar" class="btn btn-success" style="margin-right: 5px;" disabled>
                        <i class="fas fa-edit"></i>Selesai Pengantaran
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1MgLuZuyqR_OGY3ob3M52N46TDBRI_9k&callback=initMap&libraries=&v=weekly" async>
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

    var loc = true;
    var second = 0;
    var timer;

    $(document).ready(function() {
        if ("{{$data->status}}" == "SedangDiantar") {
            getLocation();
        } else {
            $("#map").html('Map Non Aktif karena tidak ada aktivitas pengantaran');
        }
    });

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.watchPosition(
                function(position) {
                    //alert(position.coords.latitude +"x"+ position.coords.longitude);
                    latitude = position.coords.latitude;
                    longitude = position.coords.longitude;
                    if (loc = true) {
                        updateLokasiKurir();
                    }
                },
                function() {
                    alert("Geocoder failed");
                }, {
                    timeout: 100000,
                    enableHighAccuracy: true
                });
            timer = setInterval(function() {
                second++;
                if (second == 10) {
                    loc = true;
                    second = 0;
                } else {
                    loc = false;
                }
            }, 1000);
            iniatMap();

        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    var map;
    var myLatlng;
    var lokasiKurir;
    var mapOptions;

    var marker;
    var marker2;
    var marker3;

    function iniatMap() {
        //alert('sekali doang');
        myLatlng = new google.maps.LatLng(latitude_destination, longitude_destination);
        latlng = new google.maps.LatLng(latitude_origin, longitude_origin);
        lokasiKurir = new google.maps.LatLng(latitude, longitude);
        mapOptions = {
            zoom: 15,
            center: myLatlng
        }
        map = new google.maps.Map(document.getElementById("map"), mapOptions);
        $("#demo").append('Jarak Kurir ke tujuan = ' + jarakKeTujuan(latitude, longitude, latitude_destination, longitude_destination, 'K') + ' Kilometer <br>');
        test();
    }

    function test() {
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
        //kurir
        marker3 = new google.maps.Marker({
            position: lokasiKurir,
            title: "Hello World!",
            label: "Lokasi Kurir"
        });
        marker.setMap(map);
        marker2.setMap(map);
        marker3.setMap(map);
    }
    $("#pindahKurir").click(function() {
        //-8.845654574032876, 121.66723135955436
        latitude = "-8.845654574032876";
        longitude = "121.66723135955436";
        updateLokasiKurir();
    });
    $("#pindahKurir1").click(function() {
        //-8.844583843790094, 121.67058948594482
        latitude = "-8.844583843790094";
        longitude = "121.67058948594482";
        updateLokasiKurir();
    });
    $("#pindahKurir2").click(function() {
        //-8.838742514074765, 121.67476505158152
        latitude = "-8.838742514074765";
        longitude = "121.67476505158152";
        updateLokasiKurir();
    });
    $("#pindahKurir3").click(function() {
        //-8.834226217513532, 121.67779055355581
        latitude = "-8.834226217513532";
        longitude = "121.67779055355581";
        updateLokasiKurir();
    });
    var notif_selesaipelanggan = false;

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
        $("#demo").html('Jarak Kurir ke tujuan = ' + jarakKeTujuan(latitude, longitude, latitude_destination, longitude_destination, 'K') + ' Kilometer <br>');
        $.ajax({
            url: "{{route('nerchant.lokasikurir.update')}}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                "idpengiriman": "{{$idpengiriman}}",
                "latitude_sekarang": latitude,
                "longitude_sekarang": longitude,
                "jarak": jarak
            },
            success: function(response) {
                if (response.pengiriman == "SelesaiAntar" && notif_selesaipelanggan == false) {
                    notif_selesaipelanggan = true;
                    alert('Pengantaran telah diselesaikan oleh pembeli');
                    location.reload();
                }
                console.log(response.pengiriman);
            },
            error: function(response) {
                console.log(response);
            }
        });
    }

    function jarakKeTujuan(lat1, lot1, lat2, lot2, unit) {
        // var radlat1 = Math.PI * lat1 / 180
        // var radlat2 = Math.PI * lat2 / 180
        // var theta = lon1 - lon2
        // var radtheta = Math.PI * theta / 180
        // var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
        // if (dist > 1) {
        //     dist = 1;
        // }
        // dist = Math.acos(dist)
        // dist = dist * 180 / Math.PI
        // dist = dist * 60 * 1.1515
        // if (unit == "K") {
        //     dist = dist * 1.609344
        // }
        // if (unit == "N") {
        //     dist = dist * 0.8684
        // }
        function toRad(x) {
            return x * Math.PI / 180;
        }
        var lon1 = lot1;
        var lat1 = lat1;
        var lon2 = lot2;
        var lat2 = lat2;
        var R = 6371; // km
        var x1 = lat2 - lat1;
        var dLat = toRad(x1);
        var x2 = lon2 - lon1;
        var dLon = toRad(x2)
        var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
            Math.cos(toRad(lat1)) * Math.cos(toRad(lat2)) *
            Math.sin(dLon / 2) * Math.sin(dLon / 2);
        var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        var d = R * c;

        if (d < 0.2) {
            $('#selesaiAntar').prop('disabled', false);
            console.log('kurir sdh dekat < 200 m');
        } else {
            console.log('kurir msh jauh > 200 m');
            $('#selesaiAntar').prop('disabled', true);
        }
        jarak = d;
        return d;
    }
    $("#antarSekarang").click(function() {
        $("#antarSekarang").prop('disabled', true);
        $.ajax({
            url: "{{url('seller/pengiriman/status')}}/" + "{{$idpengiriman}}" + "/" + "SedangDiantar" + "/" + "ajax",
            type: "GET",
            success: function(response) {
                if (response == "berhasil") {
                    getLocation();
                }
            },
            error: function(response) {
                console.log(response);
            }
        });
    });
    $("#selesaiAntar").click(function() {
        $.ajax({
            url: "{{url('seller/pengiriman/status')}}/" + "{{$idpengiriman}}" + "/" + "SelesaiAntar" + "/" + "ajax",
            type: "GET",
            success: function(response) {
                if (response == "berhasil") {
                    clearInterval(timer);
                    console.log('selesai antar');
                    alert("Selesai melakukan pengantaran");
                    location.reload();
                }
            },
            error: function(response) {
                console.log(response);
            }
        });
    });
</script>
@endsection

@endsection