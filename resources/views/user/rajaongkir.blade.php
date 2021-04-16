<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <title>Hello, world!</title>
</head>

<body>
    <div class="container">
        <h1>Hello, world!</h1>
        <div class="spinner-border" role="status" id="spinnerloading">
            <span class="sr-only">Loading...</span>
        </div>

        <div class="form-group">
            <label for="provinsi">Daftar Provinsi</label>
            <select class="form-control" id="provinsi">
                <option>Pilih Provinsi</option>
            </select>
        </div>
        <div class="form-group">
            <label for="kotakabupaten">Daftar Kota/Kabupaten</label>
            <select class="form-control" id="kotakabupaten">
            </select>
        </div>

        <div class="form-group">
            <label for="provinsi">Kota Asal</label>
            <select class="form-control" id="origin">
                <option>Pilih Kota Asal</option>
            </select>
        </div>
        <div class="form-group">
            <label for="kotakabupaten">Kota Tujuan</label>
            <select class="form-control" id="destination">
                <option>Pilih Kota Tujuan</option>
            </select>
        </div>
        <div class="form-group">
            <label for="kotakabupaten">Berat (kg) </label>
            <input class="form-control" type="number" id="berat">
        </div>
        <div class="form-group">
            <label for="kotakabupaten">Kurir</label>
            <select class="form-control" id="courier">
                <option value="jne">JNE</option>
                <option value="jne">POS Indonesia</option>
                <option value="jne">TIKI</option>
            </select>
        </div>
        <div class="form-group">
            <label for="kotakabupaten">Submit</label>
            <button type="button" class="form-control" id="submit">Primary</button>
        </div>

    </div>
</body>

<script type="text/javascript">
    $(document).ready(function() {
        loadProvinsi();
    });
    $('#provinsi').change(function() {
        loadKota(this.value);
        $('#kotakabupaten').empty();
    });
    $('#submit').click(function() {
        hitungBiaya();
    });

    function hitungBiaya() {
        
        var origin = $("#origin").val();
        var destination = $("#destination").val();
        var courier = $("#courier").val();
        var berat = $("#berat").val();
        
       /*
        var origin = 501;
        var destination = 114;
        var courier = "jne";
        var berat = 1700;
        */
        $.ajax({
            url: "{{url('cost')}}" + "/" + origin + "/" + destination + "/" + courier + "/" + berat,
            method: "GET",
            contentType: false,
            dataType: "json",
            success: function(data) {
                //console.log(data);
                for (i = 0; i < data['rajaongkir']['results'].length; i++) {
                    for (j = 0; j < data['rajaongkir']['results'][i]['costs'].length; j++){
                        console.log(data['rajaongkir']['results'][i]['costs'][j]['service']);
                        console.log(data['rajaongkir']['results'][i]['costs'][j]['description']);
                        console.log(data['rajaongkir']['results'][i]['costs'][j]['cost'][0]['etd']);
                        console.log(data['rajaongkir']['results'][i]['costs'][j]['cost'][0]['value']);
                    }
                }

            },
            error: function(response) {
                console.table(response);
            }
        });

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
    
</script>

</html>