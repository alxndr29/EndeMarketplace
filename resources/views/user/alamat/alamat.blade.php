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
                    <button type="button" class="btn btn-block btn-default" data-toggle="modal" data-target="#modal-tambahalamat" id="modal-alamat">Tambah</button>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table id="example1" class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th style="width:15%">Simpan Sebagai</th>
                        <th>Alamat</th>
                        <th style="width:5%">Detail</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($alamatpembeli as $key => $value )
                    <tr>
                        <td>
                            {{$value->simpan_sebagai}}
                        </td>
                        <td>
                            {{$value->nama_penerima}}
                            <br>
                            {{$value->alamatlengkap}}
                            <br>
                            {{$value->telepon}}
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-success" data-toggle="modal"> <i class="fas fa-edit"></i> </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal untuk tambah -->
    <div class="modal fade" id="modal-tambahalamat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
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
                                    <input type="text" class="form-control" name="simpan_sebagai" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Provinsi:</label>
                                    <select class="form-control" name="provinsi" id="provinsi">
                                        <option selected>Silahkan pilih provinsi</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Nama Penerima:</label>
                                    <input type="text" class="form-control" name="nama_penerima" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Kabupaten/Kota:</label>
                                    <select class="form-control" name="kotakabupaten" id="kotakabupaten">
                                        <option selected>Silahkan pilih kota</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Telepon:</label>
                                    <input type="text" class="form-control" name="telepon" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Textarea</label>
                                    <textarea class="form-control" rows="3" name="alamatlengkap" placeholder="Enter ..."></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="hidden" id="inputlatitude" name="latitude">
                                <input type="hidden" id="inputlongitude" name="longitude">
                                <div id="mapid" style="height:200px;">

                                </div>
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> -->
            </div>
        </div>
    </div>



    <!-- Modal untuk tambah -->
    <!-- <div class="modal fade" id="modal-tambahalamat">
        <div class="modal-dialog">
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
                        <br>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Modal End -->

    <!-- <button id="getLocation">Get Lokasi</button>
    <p>Click the button to get your coordinates.</p>
    <button onclick="getLocation()">Try It</button>
    <p id="demo"></p> -->

</div>
@section('js')
<script type="text/javascript">
    var lat = "";
    var lot = "";


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
    }

    $(document).ready(function() {

        $('#example1').DataTable({
            //responsive: true
        });

        getLocation();
        loadProvinsi();

        $("#forminput").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(), // serializes the form's elements.
                success: function(data) {
                    console.log(data); // show response from the php script.
                    alert(data);
                    location.reload();
                }
            });
        });
        $("#modal-alamat").click(function() {
            // Swal.fire(
            //     'Good job!',
            //     'You clicked the button!',
            //     'warning'
            // )
            loadMapParam(lat, lot);
            $('#inputlatitude').val(lat);
            $('#inputlongitude').val(lot);
        });

        function loadMapParam(a, b) {
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
                .bindPopup("<b>Lokasi Anda!</b><br />").openPopup();

            // L.circle([51.508, -0.11], 500, {
            //     color: 'red',
            //     fillColor: '#f03',
            //     fillOpacity: 0.5
            // }).addTo(mymap).bindPopup("I am a circle.");

            // L.polygon([
            //     [51.509, -0.08],
            //     [51.503, -0.06],
            //     [51.51, -0.047]
            // ]).addTo(mymap).bindPopup("I am a polygon.");

            var popup = L.popup();

            function onMapClick(e) {
                popup
                    .setLatLng(e.latlng)
                    .setContent("You clicked the map at " + e.latlng.toString())
                    .openOn(mymap);

            }
            mymap.on('click', onMapClick);
            mymap.invalidateSize();
        }

        $('#provinsi').change(function() {
            $('#kotakabupaten').empty();
            loadKota(this.value);
        });


        function loadProvinsi() {
            $.ajax({
                url: "{{url('getprovinsi/')}}",
                method: "GET",
                contentType: false,
                dataType: "json",
                success: function(data) {
                    //$('#spinnerloading').hide();
                    // for (i = 0; i < data['rajaongkir']['results'].length; i++) {
                    //     //alert(data['rajaongkir']['results'][i]['province_id']);
                    //     $('#provinsi').append('<option value="' + data['rajaongkir']['results'][i]['province_id'] + '">' + data['rajaongkir']['results'][i]['province'] + '</option>');
                    // }
                    for (i = 0; i < data.length; i++) {
                        $('#provinsi').append('<option value="' + data[i]['idprovinsi'] + '">' + data[i]['nama'] + '</option>');
                    }
                    //console.log(data);
                },
                error: function(response) {
                    console.log(response);
                }
            });
        }

        function loadKota(id) {
            // Swal.fire(
            //     'Good job!',
            //     'You clicked the button!',
            //     'warning'
            // )
            $.ajax({
                url: "{{url('getkota')}}" + "/" + id,
                method: "GET",
                contentType: false,
                dataType: "json",
                success: function(data) {
                    Swal.close();
                    //$('#spinnerloading').hide();
                    // for (i = 0; i < data['rajaongkir']['results'].length; i++) {
                    //     $('#kotakabupaten').append('<option value="' + data['rajaongkir']['results'][i]['city_id'] + '">' + data['rajaongkir']['results'][i]['city_name'] + '</option>');
                    //     // $('#origin').append('<option value="' + data['rajaongkir']['results'][i]['city_id'] + '">' + data['rajaongkir']['results'][i]['city_name'] + '</option>');
                    //     // $('#destination').append('<option value="' + data['rajaongkir']['results'][i]['city_id'] + '">' + data['rajaongkir']['results'][i]['city_name'] + '</option>');
                    // }
                    for (i = 0; i < data.length; i++) {
                        $('#kotakabupaten').append('<option value="' + data[i]['idkabupatenkota'] + '">' + data[i]['nama'] + '</option>');
                    }
                },
                error: function(response) {
                    console.log(response);
                }
            });
        }

    });
</script>
@endsection
@endsection