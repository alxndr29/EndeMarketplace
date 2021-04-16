@extends('layouts.userlte')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-10">
                    <h3 class="card-title">DataTable with default features</h3>
                </div>
                <div class="col">
                    <button type="button" class="btn btn-block btn-default" data-toggle="modal" data-target="#modal-tambahkategori">Tambah</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th style="width:10%">No</th>
                        <th>Nama</th>
                        <th style="width:5%">Ubah</th>
                        <th style="width:5%">Hapus</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal untuk tambah -->
    <div class="modal fade" id="modal-tambahkategori">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Kategori</h4>
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
                                    <label for="recipient-name" class="col-form-label">Nama Kategori:</label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Nama Kategori:</label>
                                    <input type="text" class="form-control" name="namakategori" required>
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

    <p>Click the button to get your coordinates.</p>
    <button onclick="getLocation()">Try It</button>
    <p id="demo"></p>

</div>
@section('js')
<script type="text/javascript">
    /*
    var x = document.getElementById("demo");

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
    }
*/
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
            alert(kon);
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
    });
</script>
@endsection
@endsection