@extends('layouts.adminlte')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            id pengiriman = {{$data->idpengiriman}}
            <br>
            tanggal pengiriman = {{$data->tanggal_pengiriman}}
            <br>
            biaya pengiriman = {{$data->biaya_pengiriman}}
            <br>
            nomor resi = {{$data->nomor_resi}}
            <br>
            status pengiriman = {{$data->status_pengiriman}}
            <br>
            keterangan pengiriman = {{$data->idpengiriman}}
            <br>
            id pengiriman = {{$data->keterangan}}
            <br>
            kurir idkurir = {{$data->kurir_idkurir}}
            <br>
            transaksi idtransaksi = {{$data->transaksi_idtransaksi}}
            <br>
            id data pengiriman = {{$data->iddatapengiriman}}
            <br>
            koor asal = {{$data->koordinat_asal}}
            <br>
            koor tujuan = {{$data->koordinat_tujuan}}
            <br>
            status = {{$data->status}}
            <br>
            pengiriman id pengiriman = {{$data->pengiriman_idpengiriman}}
            <br>
            tipepembayaran = {{$data->tipepembayaran}}
            <br>

            <a href="https://www.google.com/maps/search/?api=1&query={{$data->koordinat_asal}}">Gmaps</a>
        </div>
        <div class="card-footer">

        </div>
    </div>
    <div class="card">
        <div class="card-header">
            Google Maps Pengiriman
        </div>
        <div class="card-body">
            <div id="map" style="height:500px;width100%;">
            </div>
        </div>
        <div class="card-footer">

        </div>
    </div>
</div>

@section('js')
<script type="text/javascript">
    $(document).ready(function() {
        @if(session('berhasil'))
        //toastr.success('{{session('berhasil')}}');
        alert('{{session('
            berhasil ')}}');
        @endif

        /*
        var counter = 0;
        var timer = setInterval(function() {
            counter++;
            alert(counter);
            if (counter >= 10) {
                clearInterval(timer)
            }
        }, 3000);
        */
        initMap();
    });

    function initMap() {
        // const myLatLng = {
        //     lat: -25.363,
        //     lng: 131.044
        // };
        // const map = new google.maps.Map(document.getElementById("map"), {
        //     zoom: 4,
        //     center: myLatLng,
        // });
        // new google.maps.Marker({
        //     position: myLatLng,
        //     map,
        //     title: "Hello World!",
        // });
        var myLatlng = new google.maps.LatLng(-8.8441821, 121.66775249999999);
        var latlng = new google.maps.LatLng(-8.83205411124062, 121.67755166994475);
     
        var mapOptions = {
            zoom: 15,
            center: myLatlng
        }
        var map = new google.maps.Map(document.getElementById("map"), mapOptions);

        var marker = new google.maps.Marker({
            position: myLatlng,
            title: "Hello World!",
            label: "Lokasi Penjual"
        });

        // To add the marker to the map, call setMap();
        marker.setMap(map);

        var marker2 = new google.maps.Marker({
            position: latlng,
            title: "Hello World!",
            label: "Lokasi Pembeli"
        });
        marker.setMap(map);
        marker2.setMap(map);
    }
</script>
@endsection

@endsection