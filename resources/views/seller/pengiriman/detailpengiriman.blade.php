@extends('layouts.adminlte')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            Detail Pengiriman
        </div>
        <div class="card-body">
            <div class="row">

                <div class="col-2">
                    ID Transaksi
                    <br>
                    Tanggal Pengiriman
                    <br>
                    Nomor Resi
                    <br>
                    Status Pengiriman
                    <br>
                    Biaya pengiriman
                    <br>
                    Keterangan Pengiriman
                    <br>
                    Tipe Pembayaran
                    <br>
                    Status Kurir
                </div>
                <div class="col-3">
                    <b><a href="{{route('merchant.transaksi.detail',$data->transaksi_idtransaksi)}}">TRX-{{$data->transaksi_idtransaksi}}</a></b>
                    <br>
                    <b>{{$data->tanggal_pengiriman}}</b>
                    <br>
                    <b> {{$data->nomor_resi}} </b>
                    <br>
                    <b>{{$data->status_pengiriman}}</b>
                    <br>
                    <b> Rp. {{number_format($data->biaya_pengiriman)}} </b>
                    <br>
                    <b>{{$data->keterangan}}</b>
                    <br>
                    <b>{{$data->tipepembayaran}}</b>
                    <br>
                    <b> {{$data->status}}
                </div>
                <div class="col">
                    @if($data->status == "MenungguPengiriman")
                    <div class="form-group">
                        <label for="inputpengantar">Pilih Pengantar</label>
                        <select id="inputpengantar" class="form-control">
                            <option selected>Pilih Pengantar...</option>
                            @foreach ($dataPengantar as $key => $value)
                            <option value="{{$value->idpetugaspengantaran}}">{{$value->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <button id="proseskurir" class="btn btn-success" style="margin-right: 5px;">
                            <i class="fas fa-edit"></i>Proses ke kurir
                        </button>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-footer">

        </div>
    </div>
    <div class="card">
        <div class="card-header">
            Google Maps Pengiriman
        </div>
        <div class="card-body">
            <div id="map" style="height:350px;width100%;">
            </div>
        </div>
        <div class="card-footer">

        </div>
    </div>
</div>

@section('js')


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1MgLuZuyqR_OGY3ob3M52N46TDBRI_9k&callback=initMap&libraries=&v=weekly" async>
</script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

<script type="text/javascript">
    $(document).ready(function() {
        @if(session('berhasil'))
        Swal.fire(
            'Berhasil!',
            '{{session("berhasil")}}',
            'success'
        )
        @endif
        initMap();
    });
    $("#proseskurir").click(function() {
        window.location.href = "{{url('seller/pengiriman/status')}}/" + "{{$data->idpengiriman}}" + "/" + "ProsesKeKurir" + "/" + "nonAjax" + "/" + $("#inputpengantar").val();
    });

    function initMap() {
        var myLatlng = new google.maps.LatLng("{{$data->latitude_user}}", "{{$data->longitude_user}}");
        var latlng = new google.maps.LatLng("{{$data->latitude_merchant}}", "{{$data->longitude_merchant}}");

        var mapOptions = {
            zoom: 15,
            center: myLatlng
        }
        var map = new google.maps.Map(document.getElementById("map"), mapOptions);
        var marker = new google.maps.Marker({
            position: myLatlng,
            title: "Hello World!",
            label: "Lokasi Pembeli"
        });
        // To add the marker to the map, call setMap();
        marker.setMap(map);
        var marker2 = new google.maps.Marker({
            position: latlng,
            title: "Hello World!",
            label: "Lokasi Penjual"
        });
        marker.setMap(map);
        marker2.setMap(map);
    }
</script>
@endsection

@endsection