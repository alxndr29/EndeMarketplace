@extends('layouts.adminlte')
@section('content')
<div class="container-fluid">

    <!-- <div class="card" style="width: 18rem;">
        <img src="..." class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">Card with stretched link</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary stretched-link">Go somewhere</a>
        </div>
    </div> -->
    <form method="post" action="{{route('merchant.update',$merchant->users_iduser)}}" enctype="multipart/form-data">
        @csrf
        @method("put")
        <div class="row">
            <div class="col">
                <div class="card h-100">
                    <div class="card-header">
                        <div class="row">
                            <h3 class="card-title">Data Toko</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="namaProduk">Nama Merchant</label>
                            <input type="text" class="form-control" id="namaProduk" placeholder="Nama Merchant" value="{{$merchant->nama}}" name="namaMerchant">
                        </div>
                        <div class="form-group">
                            <label for="deskripsiMerchant">Deskripsi Merchant</label>
                            <textarea class="form-control" rows="3" placeholder="Deskripsi" id="deskripsiMerchant" name="deskripsiMerchant">{{$merchant->deskripsi}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <div class="card-header">
                        <div class="row">
                            <h3 class="card-title">Status dan Waktu Operasional</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Status Toko</label>
                            <select class="form-control" id="statusMerchant" name="statusMerchant">
                                @if($merchant->status_merchant == "NonAktif")
                                <option value="NonAktif" selected>Non Aktif</option>
                                <option value="Aktif">Aktif</option>
                                @else
                                <option value="Aktif" selected>Aktif</option>
                                <option value="NonAktif">Non Aktif</option>
                                @endif

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="namaProduk">Jam Buka</label>
                            <input type="time" class="form-control" name="jamBuka" value="{{$merchant->jam_buka}}">
                        </div>
                        <div class="form-group">
                            <label for="namaProduk">Jam Tutup</label>
                            <input type="time" class="form-control" name="jamTutup" value="{{$merchant->jam_tutup}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <div class="card h-100">
                    <div class="card-header">
                        <div class="row">
                            <h3 class="card-title">Foto Profil dan Sampul</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Foto Profil</label>
                            <input type="file" class="form-control-file" id="exampleFormControlFile1" name="fotoProfil">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Foto Sampul</label>
                            <input type="file" class="form-control-file" id="exampleFormControlFile1" name="fotoSampul">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <div class="card-header">
                        <div class="row">
                            <h3 class="card-title">Dukungan Pengiriman & Pembayaran</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Dukungan Pengiriman</label>
                            @foreach($kurir as $key => $value)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                    {{$value->nama}}
                                </label>
                            </div>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <label>Dukungan Pembayaran</label>
                            @foreach($tipePembayaran as $key => $value)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                    {{$value->nama}}
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Alamat Merchant
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="deskripsiMerchant">Alamat Lengkapt</label>
                            <textarea class="form-control" rows="3" placeholder="Deskripsi" id="deskripsiMerchant" name="alamatLengkap">{{$alamat->alamat_lengkap}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Telepon</label>
                            <input type="text" class="form-control" name="telepon" value="{{$alamat->telepon}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Longitude</label>
                            <input type="text" class="form-control" name="dataLongitude" id="longitude" value="{{$alamat->longitude}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Latitude</label>
                            <input type="text" class="form-control" name="dataLatitude" id="latitude" value="{{$alamat->latitude}}" readonly>
                        </div>
                        <div id="map" style="height:500px;width100%;">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center p-3">
            <button type="submit" class="btn btn-primary" id="btnsubmit">Simpan</button>
        </div>
    </form>
</div>

@section('js')
<script type="text/javascript">
    var lat = "";
    var lot = "";
    $(document).ready(function() {
        @if(session('berhasil'))
        //toastr.success('{{session('berhasil')}}');
        alert('{{session('
            berhasil ')}}');
        @endif
        // getLocation();
        //initMap();
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

        /// DARI SINI
        // var myLatlng = new google.maps.LatLng({{$alamat->latitude}}, {{$alamat->longitude}});
        // var mapOptions = {
        //     zoom: 15,
        //     center: myLatlng
        // }
        // var map = new google.maps.Map(document.getElementById("map"), mapOptions);
        // var marker = new google.maps.Marker({
        //     position: myLatlng,
        //     title: "Hello World!",
        //     label: "Lokasi Pembeli"
        // });
        // let infoWindow = new google.maps.InfoWindow({
        //     content: "Lokasi Anda",
        //     position: myLatlng,
        // });
        // infoWindow.open(map);
        // // Configure the click listener.
        // map.addListener("click", (mapsMouseEvent) => {
        //     // Close the current InfoWindow.
        //     infoWindow.close();
        //     // Create a new InfoWindow.
        //     infoWindow = new google.maps.InfoWindow({
        //         position: mapsMouseEvent.latLng,
        //     });
        //     infoWindow.setContent(
        //         'Lokasi Baru',
        //         $("#longitude").val(mapsMouseEvent.latLng.lng().toString()),
        //         $("#latitude").val(mapsMouseEvent.latLng.lat().toString())
        //     );
        //     infoWindow.open(map);
        // });

        //SAMPE SINI

    }

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);

        } else {
            alert("Geolocation is not supported by this browser.");
        }
    }

    function showPosition(position) {
        alert("Latitude: " + position.coords.latitude +
            "<br>Longitude: " + position.coords.longitude);
        lat = position.coords.latitude;
        lot = position.coords.longitude;
        $("#longitude").val(position.coords.longitude);
        $("#latitude").val(position.coords.latitude);
        console.log(lat);
        console.log(lot);
    }
</script>
@endsection

@endsection