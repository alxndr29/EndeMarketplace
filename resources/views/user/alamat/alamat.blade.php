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
                        <th style="width:5%">Hapus</th>
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
                            <button type="button" class="btn btn-sm btn-success" id="edit-alamat" data-id="{{$value->idalamat}}"> <i class="fas fa-edit"></i> </button>
                            <!-- <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-editalamat-{{$value->idalamat}}"> <i class="fas fa-edit"></i> </button> -->
                        </td>
                        <td>
                            <form method="post" action="{{route('alamatpembeli.destroy',$value->idalamat)}}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"> <i class="fas fa-trash"></i> </button>
                            </form>
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
                                <input type="hidden" id="idalamat" name="idalamat">
                                <input type="hidden" id="inputlongitude" name="longitude">
                                <div id="mapid" style="height:200px; width100%">

                                </div>
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk Edit -->
    <div class="modal fade" id="modal-editalamat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- <form id="forminput-edit" method="post" action="{{route('alamatpembeli.store')}}">
                    @csrf
                    @method('put') -->
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Simpan Sebagai:</label>
                                <input type="text" class="form-control" name="simpan_sebagai_edit" id="simpan_sebagai_edit" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Provinsi:</label>
                                <select class="form-control" name="provinsi_edit" id="provinsi_edit">
                                    <option selected>Silahkan pilih provinsi</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Nama Penerima:</label>
                                <input type="text" class="form-control" name="nama_penerima_edit" id="nama_penerima_edit" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Kabupaten/Kota:</label>
                                <select class="form-control" name="kotakabupaten_edit" id="kotakabupaten_edit">
                                    <option selected>Silahkan pilih kota</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Telepon:</label>
                                <input type="text" class="form-control" name="telepon_edit" id="telepon_edit" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Textarea</label>
                                <textarea class="form-control" rows="3" name="alamatlengkap_edit" id="alamatlengkap_edit" placeholder="Enter ..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="hidden" id="inputlatitude_edit" name="latitude_edit">
                            <input type="hidden" id="inputlongitude_edit" name="longitude_edit">
                            <div id="mapidedit" style="height:200px; width100%">

                            </div>
                        </div>
                    </div>
                    <br>
                    <button type="submit" id="submit-edit" class="btn btn-primary">Simpan</button>

                    <!-- </form> -->
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
        $('#inputlatitude').val(lat),
        $('#inputlongitude').val(lot)
    }

    $(document).ready(function() {
        @if(session("berhasil"))
        Swal.fire(
            'Berhasil!',
            '{{session("berhasil")}}',
            'success'
        )
        @endif
        @if(session("gagal"))
        Swal.fire(
            'Gagal!',
            '{{session("gagal")}}',
            'error'
        )
        @endif
        $('#example1').DataTable({});
        getLocation();
        loadProvinsi();
        $("body").on("click", "#edit-alamat", function(e) {
            var id = $(this).attr('data-id');
            $.ajax({
                url: "{{url('user/alamat/edit')}}" + "/" + id,
                method: "GET",
                contentType: false,
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    $("#simpan_sebagai_edit").val(data[0].simpan_sebagai);
                    $("#nama_penerima_edit").val(data[0].nama_penerima);
                    $("#telepon_edit").val(data[0].telepon);
                    $("#alamatlengkap_edit").val(data[0].alamatlengkap);
                    $('#provinsi_edit').val(data[0].idprovinsi);
                    loadKota(data[0].idprovinsi);
                    $('#kotakabupaten_edit').append('<option selected value="' + data[0].idkabupatenkota + '">' + data[0].namakabupatenkota + '</option>');
                    $('#inputlatitude_edit').val(data[0].latitude);
                    $('#inputlongitude_edit').val(data[0].longitude);
                    $('#idalamat').val(data[0].idalamat);
                    //loadMapParam(data[0].latitude, data[0].longitude, 'edit');
                    loadParam(data[0].latitude, data[0].longitude, 'edit');
                    $('#modal-editalamat').modal('show');
                },
                error: function(response) {
                    console.log(response);
                }
            });
        });

        $("#forminput").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            var url = form.attr('action');
            $("#inputlatitude_edit").val(lat);
            $("#inputlongitude_edit").val(lot);
            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(), // serializes the form's elements.
                success: function(data) {
                    //alert(data);
                    Swal.fire(
                        'Berhasil!',
                         data,
                        'success'
                    ).then((result) => {
                        location.reload();
                    });
                    
                }
            });
        });
        $("#forminput-edit").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            var url = form.attr('action');
            $.ajax({
                type: "PUT",
                url: url,
                data: form.serialize(), // serializes the form's elements.
                success: function(data) {
                    // console.log(data); // show response from the php script.
                    // alert(data);
                    //location.reload();
                }
            });
        });
        $("#modal-alamat").click(function() {
            loadParam(lat, lot, 'load');
        });

        $("#submit-edit").click(function() {
            $.ajax({
                url: "{{route('alamatpembeli.update')}}",
                type: 'POST',
                data: {
                    idalamat: $('#idalamat').val(),
                    latitude: $('#inputlatitude_edit').val(),
                    longitude: $('#inputlongitude_edit').val(),
                    simpan_sebagai: $("#simpan_sebagai_edit").val(),
                    nama_penerima: $("#nama_penerima_edit").val(),
                    telepon: $("#telepon_edit").val(),
                    kotakabupaten: $('#kotakabupaten_edit').val(),
                    alamatlengkap: $("#alamatlengkap_edit").val()
                },
                success: function(response) {
                    console.log(response);
                    // Swal.fire(
                    //     'Berhasil!',
                    //     response,
                    //     'success'
                    // )
                    location.reload();
                }
            });
        });

        function loadParam(a, b, c) {
            if (c == "edit") {
                var myLatlng = new google.maps.LatLng(a, b);
                var mapOptions = {
                    zoom: 15,
                    center: myLatlng
                }
                var map = new google.maps.Map(document.getElementById("mapidedit"), mapOptions);

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
                        $("#inputlatitude_edit").val(mapsMouseEvent.latLng.lat().toString()),
                        $("#inputlongitude_edit").val(mapsMouseEvent.latLng.lng().toString())
                    );
                    infoWindow.open(map);
                });
            } else {
                var myLatlng = new google.maps.LatLng(lat, lot);
                var mapOptions = {
                    zoom: 15,
                    center: myLatlng
                }
                var map = new google.maps.Map(document.getElementById("mapid"), mapOptions);

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
                        //JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2)
                        'Lokasi Anda',
                        lat = mapsMouseEvent.latLng.lat().toString(),
                        lot = mapsMouseEvent.latLng.lng().toString(),
                        $('#inputlatitude').val(lat),
                        $('#inputlongitude').val(lot)
                    );
                    infoWindow.open(map);
                });
            }
        }
        
        $('#provinsi').change(function() {
            $('#kotakabupaten').empty();
            loadKota(this.value);
        });
        $('#provinsi_edit').change(function() {
            $('#kotakabupaten_edit').empty();
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
                        $('#provinsi_edit').append('<option value="' + data[i]['idprovinsi'] + '">' + data[i]['nama'] + '</option>');
                    }
                    //console.log(data);
                },
                error: function(response) {
                    console.log(response);
                }
            });
        }

        function loadKota(id) {
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
                        $('#kotakabupaten_edit').append('<option value="' + data[i]['idkabupatenkota'] + '">' + data[i]['nama'] + '</option>');
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

@section('breadcrumb')
<li class="breadcrumb-item active">Alamat</li>
@endsection