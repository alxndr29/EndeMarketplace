@extends('layouts.userlte')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-10">
                    <h3 class="card-title">Daftar Alamat</h3>
                </div>
                <div class="col">
                    <button type="button" class="btn btn-block btn-default" data-toggle="modal" data-target="#modal-tambahalamat">Tambah</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th style="width:10%">Utama</th>
                        <th>Penerima</th>
                        <th>Alamat</th>
                        <th style="width:5%">Ubah</th>
                        <th style="width:5%">Hapus</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <button type="button" class="btn btn-sm btn-success" data-toggle="modal"> <i class="fas fa-edit"></i> </button>
                        </td>
                        <td>
                            Alexander Evan
                        </td>
                        <td>
                            Kokos Raya No. 34, Ende, Kecamatan Ende, NTT
                            <br>
                            Kokos Raya No. 34, Ende, Kecamatan Ende, NTT
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-success" data-toggle="modal"> <i class="fas fa-edit"></i> </button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"> <i class="fas fa-trash"></i> </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal untuk tambah -->
    <div class="modal fade" id="modal-tambahalamat">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Alamat</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="forminput" method="post" action="{{route('alamatpembeli.store')}}">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Simpan Sebagai:</label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Provinsi:</label>
                                    <input type="text" class="form-control" name="namakategori" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Nama Penerima:</label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Kabupaten/Kota:</label>
                                    <input type="text" class="form-control" name="namakategori" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Telepon:</label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Textarea</label>
                                    <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div id="mapid" style="height:100px;">

                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal End -->

    <button id="getLocation">Get Lokasi</button>
    <p>Click the button to get your coordinates.</p>
    <button onclick="getLocation()">Try It</button>
    <p id="demo"></p>

</div>
@section('js')
<script type="text/javascript">
    var x = document.getElementById("demo");

    var lat = "";
    var lot = "";

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function showPosition(position) {
        x.innerHTML = "Latitude: " + position.coords.latitude +
            "<br>Longitude: " + position.coords.longitude;
        lat = position.coords.latitude;
        lot = position.coords.longitude;
    }

    $(function() {
        $("#example2").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example1').DataTable({

        });
    });


    $(document).ready(function() {

        //loadMap();

        $("#forminput").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(), // serializes the form's elements.
                success: function(data) {
                    jancok(data); // show response from the php script.
                }
            });
        });

        function jancok(kon) {
            alert('ko');
        }

        function loadProvinsi() {
            $.ajax({
                url: "{{url('getprovinsi/')}}",
                method: "GET",
                contentType: false,
                dataType: "json",
                success: function(data) {
                    $('#spinnerloading').hide();
                    for (i = 0; i < data['rajaongkir']['results'].length; i++) {
                        //alert(data['rajaongkir']['results'][i]['province_id']);
                        $('#provinsi').append('<option value="' + data['rajaongkir']['results'][i]['province_id'] + '">' + data['rajaongkir']['results'][i]['province'] + '</option>');

                    }
                },
                error: function(response) {
                    console.log(response);
                }
            });
        }
        $("#getLocation").click(function() {
            getLocation();
            loadMapParam('-8.8441267','121.66771969999999');
        });

        function loadKota(id) {
            $('#spinnerloading').show();

            $.ajax({
                url: "{{url('getkota')}}" + "/" + id,
                method: "GET",
                contentType: false,
                dataType: "json",
                success: function(data) {
                    $('#spinnerloading').hide();
                    for (i = 0; i < data['rajaongkir']['results'].length; i++) {
                        $('#kotakabupaten').append('<option value="' + data['rajaongkir']['results'][i]['city_id'] + '">' + data['rajaongkir']['results'][i]['city_name'] + '</option>');
                        $('#origin').append('<option value="' + data['rajaongkir']['results'][i]['city_id'] + '">' + data['rajaongkir']['results'][i]['city_name'] + '</option>');
                        $('#destination').append('<option value="' + data['rajaongkir']['results'][i]['city_id'] + '">' + data['rajaongkir']['results'][i]['city_name'] + '</option>');
                    }
                },
                error: function(response) {
                    console.log(response);
                }
            });
        }

        /*
        function loadMap() {
            var mymap = L.map('mapid').setView([51.505, -0.09], 13);
            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                maxZoom: 18,
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
                    'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1
            }).addTo(mymap);

            L.marker([51.5, -0.09]).addTo(mymap)
                .bindPopup("<b>Hello world!</b><br />I am a popup.").openPopup();

            L.circle([51.508, -0.11], 500, {
                color: 'red',
                fillColor: '#f03',
                fillOpacity: 0.5
            }).addTo(mymap).bindPopup("I am a circle.");

            L.polygon([
                [51.509, -0.08],
                [51.503, -0.06],
                [51.51, -0.047]
            ]).addTo(mymap).bindPopup("I am a polygon.");
            var popup = L.popup();
            function onMapClick(e) {
                popup
                    .setLatLng(e.latlng)
                    .setContent("You clicked the map at " + e.latlng.toString())
                    .openOn(mymap);
            }
            mymap.on('click', onMapClick);
        }
        */
        function loadMapParam(a, b){
            var mymap = L.map('mapid').setView([a, b], 30);
            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                maxZoom: 18,
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
                    'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1
            }).addTo(mymap);

            L.marker([a, b]).addTo(mymap)
                .bindPopup("<b>Hello world!</b><br />I am a popup.").openPopup();

            L.circle([51.508, -0.11], 500, {
                color: 'red',
                fillColor: '#f03',
                fillOpacity: 0.5
            }).addTo(mymap).bindPopup("I am a circle.");

            L.polygon([
                [51.509, -0.08],
                [51.503, -0.06],
                [51.51, -0.047]
            ]).addTo(mymap).bindPopup("I am a polygon.");
            var popup = L.popup();
            function onMapClick(e) {
                popup
                    .setLatLng(e.latlng)
                    .setContent("You clicked the map at " + e.latlng.toString())
                    .openOn(mymap);
                    jancok();
            }
            mymap.on('click', onMapClick);
            
            mymap.invalidateSize();
        }
    });
</script>
@endsection
@endsection