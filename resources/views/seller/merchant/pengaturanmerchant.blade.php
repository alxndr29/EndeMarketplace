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
                            <input type="text" class="form-control" id="namaProduk" placeholder="Nama Merchant" value="{{$merchant->nama}}" name="namaMerchant" required>
                        </div>
                        <div class="form-group">
                            <label for="deskripsiMerchant">Deskripsi Merchant</label>
                            <textarea class="form-control" rows="3" placeholder="Deskripsi" id="deskripsiMerchant" name="deskripsiMerchant" required>{{$merchant->deskripsi}}</textarea>
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
                            <h3 class="card-title">Foto Profil</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Foto Profil</label>
                            <input type="file" class="form-control-file" id="exampleFormControlFile1" name="fotoProfil">
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
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Dukungan Pengiriman</label>

                                    @if($dukunganJNE != null)
                                    <div class="form-check">
                                        <input class="form-check-input" name="checkboxJNE" type="checkbox" value="1" checked>
                                        <label class="form-check-label">
                                            JNE
                                        </label>
                                    </div>
                                    @else
                                    <div class="form-check">
                                        <input class="form-check-input" name="checkboxJNE" type="checkbox" value="1">
                                        <label class="form-check-label">
                                            JNE
                                        </label>
                                    </div>
                                    @endif

                                    @if($dukunganKurirMerchant != null)
                                    <div class="form-check">
                                        <input class="form-check-input" name="checkboxKurirMerchant" type="checkbox" value="2" checked>
                                        <label class="form-check-label">
                                            Kurir Merchant
                                        </label>
                                    </div>
                                    @else
                                    <div class="form-check">
                                        <input class="form-check-input" name="checkboxKurirMerchant" type="checkbox" value="2">
                                        <label class="form-check-label" for="defaultCheck1">
                                            Kurir Merchant
                                        </label>
                                    </div>
                                    @endif

                                </div>
                                <div class="form-group">
                                    <label>Dukungan Pembayaran</label>
                                    @if($dukunganCOD != null)
                                    <div class="form-check">
                                        <input class="form-check-input" name="checkboxCOD" type="checkbox" value="1" checked>
                                        <label class="form-check-label">
                                            Cash On Delivery
                                        </label>
                                    </div>
                                    @else
                                    <div class="form-check">
                                        <input class="form-check-input" name="checkboxCOD" type="checkbox" value="1">
                                        <label class="form-check-label">
                                            Cash On Delivery
                                        </label>
                                    </div>
                                    @endif

                                    @if($dukunganBank != null)
                                    <div class="form-check">
                                        <input class="form-check-input" name="checkboxBank" type="checkbox" value="2" checked>
                                        <label class="form-check-label">
                                            Bank Transfer
                                        </label>
                                    </div>
                                    @else
                                    <div class="form-check">
                                        <input class="form-check-input" name="checkboxBank" type="checkbox" value="2">
                                        <label class="form-check-label">
                                            Bank Transfer
                                        </label>
                                    </div>
                                    @endif
                                </div>
                            </div>

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
                            <label for="deskripsiMerchant">Alamat Lengkap</label>
                            <textarea class="form-control" rows="3" placeholder="Deskripsi" id="deskripsiMerchant" name="alamatLengkap" required>{{$alamat->alamat_lengkap ?? ""}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Telepon</label>
                            <input type="text" class="form-control" name="telepon" value="{{$alamat->telepon ?? ''}}" require>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Longitude</label>
                            <input type="text" class="form-control" name="dataLongitude" id="longitude" value="{{$alamat->longitude ?? ''}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Latitude</label>
                            <input type="text" class="form-control" name="dataLatitude" id="latitude" value="{{$alamat->latitude ?? ''}}" readonly>
                        </div>
                        <div id="map" style="height:500px;width100%;">

                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Tarif Pengiriman
                    </div>
                    <div class="card-body">
                        <label>Dukungan Tarif Pengiriman</label>
                        <!-- @foreach($tarifPengiriman as $key => $value)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" data-id="" value="{{$value->idtarifpengiriman}}" name="dukungan_tarif_pengiriman[]" id="checkboxDukunganTarif">
                            <label class="form-check-label" for="checkboxDukunganTarif">
                                {{$value->nama}}
                            </label>
                            <input type="text" class="form-control" name="minimum_belanja[]" placeholder="Masukan Minimum Pembelian (Rp)">
                            <input type="text" class="form-control" name="estimasi_pengiriman[]" placeholder="Masukan Estimasi Pengiriman (Hr)">
                        </div>
                        @endforeach -->

                        @if($dukunganBebas != null)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="checkboxBebasOngkir" id="checkboxDukunganTarif" checked>
                            <label class="form-check-label" for="checkboxDukunganTarif">
                                Bebas Ongkir
                            </label>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Minimum Pembelian</label>
                                <input type="number" class="form-control" value="{{$dukunganBebas->minimum_belanja}}" name="minimumBebasOngkir" id="minimumBebasOngkir" placeholder="Masukan Minimum Pembelian (Rp)" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Estimasi</label>
                                <input type="number" class="form-control" value="{{$dukunganBebas->etd}}" name="estimasiBebasOngkir" id="estimasiBebasOngkir" placeholder="Masukan Estimasi Pengiriman (Hr)" required>
                            </div>
                        </div>
                        @else
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="checkboxBebasOngkir" id="checkboxDukunganTarif">
                            <label class="form-check-label" for="checkboxDukunganTarif">
                                Bebas Ongkir
                            </label>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Minimum Pembelian</label>
                                <input type="number" class="form-control" name="minimumBebasOngkir" id="minimumBebasOngkir" placeholder="Masukan Minimum Pembelian (Rp)" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Estimasi</label>
                                <input type="number" class="form-control" name="estimasiBebasOngkir" id="estimasiBebasOngkir" placeholder="Masukan Estimasi Pengiriman (Hr)" required>
                            </div>

                        </div>
                        @endif

                        @if($dukunganFlat != null)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="2" name="checkboxTarifFlat" id="checkboxDukunganTarifFlat" checked>
                            <label class="form-check-label" for="checkboxDukunganTarif">
                                Tarif Flat
                            </label>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Minimum Pembelian</label>
                                <input type="number" class="form-control" value="{{$dukunganFlat->minimum_belanja}}" name="minimumTarifFlat" id="minimumTarifFlat" placeholder="Masukan Minimum Pembelian (Rp)" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Estimasi</label>
                                <input type="number" class="form-control" value="{{$dukunganFlat->etd}}" name="estimasiTarifFlat" id="estimasiTarifFlat" placeholder="Masukan Estimasi Pengiriman (Hr)" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tarif Pengiriman</label>
                                <input type="number" class="form-control" value="{{$dukunganFlat->tarif_berat}}" name="tarifTarifFlat" id="tarifTarifFlat" placeholder="Masukan Tarif Pengiriman (Rp)" required>
                            </div>

                        </div>
                        @else
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="2" name="checkboxTarifFlat" id="checkboxDukunganTarifFlat">
                            <label class="form-check-label" for="checkboxDukunganTarif">
                                Tarif Flat
                            </label>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Minimum Pembelian</label>
                                <input type="number" class="form-control" name="minimumTarifFlat" id="minimumTarifFlat" placeholder="Masukan Minimum Pembelian (Rp)" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Estimasi</label>
                                <input type="number" class="form-control" name="estimasiTarifFlat" id="estimasiTarifFlat" placeholder="Masukan Estimasi Pengiriman (Hr)" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tarif</label>
                                <input type="number" class="form-control" name="tarifTarifFlat" id="tarifTarifFlat" placeholder="Masukan Tarif Pengiriman (Rp)" required>
                            </div>
                        </div>
                        @endif

                        @if($dukunganNormal != null)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="3" name="checkboxTarifStandar" id="checkboxDukunganTarifStandar" checked>
                            <label class="form-check-label" for="checkboxDukunganTarif">
                                Tarif Standar
                            </label>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Minimum Pembelian</label>
                                <input type="number" class="form-control" value="{{$dukunganNormal->minimum_belanja}}" name="minimumTarifStandar" id="minimumTarifStandar" placeholder="Masukan Minimum Pembelian (Rp)" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Estimasi</label>
                                <input type="number" class="form-control" value="{{$dukunganNormal->etd}}" name="estimasiTarifStandar" id="estimasiTarifStandar" placeholder="Masukan Estimasi Pengiriman (Hr)" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tarif Berat</label>
                                <input type="number" class="form-control" value="{{$dukunganNormal->tarif_berat}}" name="tarifBerat" id="tarifBerat" placeholder="Masukan Tarif per Berat (kg)" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tarif Volume</label>
                                <input type="number" class="form-control" value="{{$dukunganNormal->tarif_volume}}" name="tarifVolume" id="tarifVolume" placeholder="Masukan Tarif per Volume (m3)" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tarif Jarak</label>
                                <input type="number" class="form-control" value="{{$dukunganNormal->tarif_jarak}}" name="tarifJarak" id="tarifJarak" placeholder="Masukan Tarif per Jarak (km)" required>
                            </div>
                        </div>
                        @else
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="3" name="checkboxTarifStandar" id="checkboxDukunganTarifStandar">
                            <label class="form-check-label" for="checkboxDukunganTarif">
                                Tarif Standar
                            </label>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Minimum Pembelian</label>
                                <input type="number" class="form-control" name="minimumTarifStandar" id="minimumTarifStandar" placeholder="Masukan Minimum Pembelian (Rp)" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Estimasi</label>
                                <input type="number" class="form-control" name="estimasiTarifStandar" id="estimasiTarifStandar" placeholder="Masukan Estimasi Pengiriman (Hr)" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tarif Berat</label>
                                <input type="number" class="form-control" name="tarifBerat" id="tarifBerat" placeholder="Masukan Tarif per Berat (kg)" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tarif Volume</label>
                                <input type="number" class="form-control" name="tarifVolume" id="tarifVolume" placeholder="Masukan Tarif per Volume (m3)" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tarif Jarak</label>
                                <input type="number" class="form-control" name="tarifJarak" id="tarifJarak" placeholder="Masukan Tarif per Jarak (km)" required>
                            </div>
                        </div>
                        @endif

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

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1MgLuZuyqR_OGY3ob3M52N46TDBRI_9k&callback=initMap&libraries=&v=weekly" async>
</script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

<script type="text/javascript">
    var lat = "";
    var lot = "";
    $(document).ready(function() {
        @if(session('berhasil'))
        //toastr.success('{{session('berhasil')}}');
        Swal.fire(
            'Berhasil!',
            "{{session('berhasil')}}",
            'success'
        )
        @endif

        getLocation();

        if ($('#checkboxDukunganTarif').is(':checked') == true) {

        } else {
            $("#minimumBebasOngkir").attr("disabled", true);
            $("#estimasiBebasOngkir").attr("disabled", true);
        }
        if ($('#checkboxDukunganTarifFlat').is(':checked') == true) {

        } else {
            $("#minimumTarifFlat").attr("disabled", true);
            $("#estimasiTarifFlat").attr("disabled", true);
            $("#tarifTarifFlat").attr("disabled", true);
        }
        if ($('#checkboxDukunganTarifStandar').is(':checked') == true) {

        } else {
            $("#minimumTarifStandar").attr("disabled", true);
            $("#estimasiTarifStandar").attr("disabled", true);
            $("#tarifBerat").attr("disabled", true);
            $("#tarifVolume").attr("disabled", true);
            $("#tarifJarak").attr("disabled", true);
        }
    });

    $('#checkboxDukunganTarif').change(function() {
        if (this.checked) {
            $("#minimumBebasOngkir").attr("disabled", false);
            $("#estimasiBebasOngkir").attr("disabled", false);
        } else {
            //alert(this.checked);
            $("#minimumBebasOngkir").attr("disabled", true);
            $("#estimasiBebasOngkir").attr("disabled", true);
        }
    });
    $('#checkboxDukunganTarifFlat').change(function() {
        if (this.checked) {
            $("#minimumTarifFlat").attr("disabled", false);
            $("#estimasiTarifFlat").attr("disabled", false);
            $("#tarifTarifFlat").attr("disabled", false);
        } else {
            //alert(this.checked);
            $("#minimumTarifFlat").attr("disabled", true);
            $("#estimasiTarifFlat").attr("disabled", true);
            $("#tarifTarifFlat").attr("disabled", true);
        }
    });
    $('#checkboxDukunganTarifStandar').change(function() {
        if (this.checked) {
            $("#minimumTarifStandar").attr("disabled", false);
            $("#estimasiTarifStandar").attr("disabled", false);
            $("#tarifBerat").attr("disabled", false);
            $("#tarifVolume").attr("disabled", false);
            $("#tarifJarak").attr("disabled", false);
        } else {
            //alert(this.checked);
            $("#minimumTarifStandar").attr("disabled", true);
            $("#estimasiTarifStandar").attr("disabled", true);
            $("#tarifBerat").attr("disabled", true);
            $("#tarifVolume").attr("disabled", true);
            $("#tarifJarak").attr("disabled", true);
        }
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


        var myLatlng = new google.maps.LatLng(lat, lot);
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
        let infoWindow = new google.maps.InfoWindow({
            content: "Lokasi Anda",
            position: myLatlng,
        });
        infoWindow.open(map);
        // Configure the click listener.
        map.addListener("click", (mapsMouseEvent) => {
            // Close the current InfoWindow.
            infoWindow.close();
            // Create a new InfoWindow.
            infoWindow = new google.maps.InfoWindow({
                position: mapsMouseEvent.latLng,
            });
            infoWindow.setContent(
                'Lokasi Baru',
                $("#longitude").val(mapsMouseEvent.latLng.lng().toString()),
                $("#latitude").val(mapsMouseEvent.latLng.lat().toString())
            );
            infoWindow.open(map);
        });

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
        initMap();
    }
</script>
@endsection

@endsection