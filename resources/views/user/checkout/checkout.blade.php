@extends('layouts.userlte')
@section('content')
<div class="container">
    <form method="post" action="{{route('checkout.store')}}">
        @method("post")
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Checkout
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-lg-9">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row pb-3">
                                            <div class="col">
                                                Alamat Pengiriman
                                            </div>
                                            <div class="col-6">

                                            </div>
                                            <div class="col">
                                                <!-- <a href="#" class="btn btn-block btn-default">Pilih Alamat</a> -->
                                                <button type="button" class="btn btn-block btn-default" data-toggle="modal" data-target="#modal-alamat"> Pilih Alamat</button>
                                            </div>
                                        </div>
                                        <div class="row pb-3">
                                            <div class="col">
                                                <div class="border" id="alamatPengiriman">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 pb-3">
                                                Pengiriman
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <select class="form-control" id="dukunganPengiriman" name="kurir">
                                                        <option selected>Pilih Pengiriman</option>
                                                        @foreach ($dukunganpengiriman as $key => $value)
                                                        <option value="{{$value->idkurir}}">{{$value->nama}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <select class="form-control" id="biayaKurir" name="biayaKurir">
                                                        <option selected>Pilih Biaya Pengiriman</option>
                                                        <option value="CTC/1-2/10000"> JNE - CTC - 1-2 - 10000</option>
                                                        <option value="CTCYES/0-1/20000"> JNE - CTCYES - 0-2 - 20000</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 pb-3">
                                                Pembayaran
                                            </div>
                                            <div class="col-12">
                                                <select class="form-control" id="dukunganPembayaran" name="tipePembayaran">
                                                    <option selected>Pilih Pembayaran</option>
                                                    @foreach ($dukunganpembayaran as $key => $value)
                                                    <option value="{{$value->id}}">{{$value->nama}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row ">
                                            <div class="col-12 pb-3">
                                                Daftar Produk
                                            </div>
                                            <div class="col-12 border">
                                                @foreach ($keranjang as $key => $value )
                                                <div class="row">
                                                    <div class="col-3">
                                                        <img style="width:175px;height:200px;" class="rounded mx-auto d-block pt-3 img-fluid" alt="..." src="{{asset('gambar/'.$value->gambar.'.jpg')}}">
                                                    </div>
                                                    <div class="col-3">
                                                        <b>{{$value->nama}}</b>
                                                        <br> Rp. {{number_format($value->harga)}}-,
                                                        <!-- <br>Merchant Gaje -->
                                                        <br> Jumlah: {{$value->jumlah}} pcs
                                                        <br> Total: Rp. {{number_format($value->harga * $value->jumlah)}}-,
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Catatan</label>
                                                            <input type="text" class="form-control" name=catatanproduk[{{$value->idproduk}}]>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row pb-3">
                                            <div class="col" id="displayNominal">
                                                Total Pembayaran: Rp. {{number_format($total->jumlah)}}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <input type="hidden" name="idmerchant" value="{{$id}}">
                                                <input type="hidden" name="idalamat" id="idalamat">
                                                <input type="hidden" name="nominalpembayaran" id="nominalpembayaran">

                                                <input type="hidden" name="jarakPengiriman" id="jarakPengiriman">

                                                <input type="hidden" name="latitudeUser" id="latitudeUser">
                                                <input type="hidden" name="longitudeUser" id="longitudeUser">

                                                <input type="hidden" name="latitudeMerchant" id="latitudeMerchant">
                                                <input type="hidden" name="longitudeMerchant" id="longitudeMerchant">

                                                <button type="submit" class="btn btn-block btn-default" id="btnCheckout">Buat Transaksi</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal fade" id="modal-alamat">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pilih Alamat</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="daftarAlamat">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<div id="debug">
</div>
@section('js')
<script type="text/javascript">
    var dataAlamat;
    var dataKiriman;
    //var pilihAlamat = false;
    var jumlah = {{$total->jumlah}};
    // var berat = {{$total->berat}};
    // console.log(berat);
    var biayaKurir = 0;

    var idAlamatUser = 0;
    var latitudeUser = "";
    var longitudeUser = "";

    var latitudeMerchant = {{$alamatMerchant->latitude}};
    var longitudeMerchant = {{$alamatMerchant->longitude}};

    $(document).ready(function() {
        //hitungBiaya();
        $("#displayNominal").val(jumlah);
        $("#nominalpembayaran").val(jumlah);
        $("#dukunganPengiriman").attr("disabled", true);
        $("#biayaKurir").attr("disabled", true);
    });

    $.ajax({
        url: "{{route('alamatpembeli.checkout')}}",
        type: "GET",
        success: function(response) {
            console.log(response);
            for (i = 0; i < response.length; i++) {
                $("#daftarAlamat").append(
                    '<div class="row border p-3">' +
                    '<div class="col-9">' +
                    response[i].simpan_sebagai +
                    '<br>' +
                    response[i].nama_penerima +
                    '<br>' +
                    response[i].alamatlengkap +
                    '</div>' +
                    '<div class="col-3">' +
                    '<button type="button" class="btn btn-block btn-default" id="pilihALamat" data-id=' + response[i].idalamat + '> Pilih Alamat</button>' +
                    '</div>' +
                    '</div>'
                );
            }
            dataAlamat = response;
        },
        error: function(response) {
            console.log(response);
        }
    });
    $("body").on("click", "#pilihALamat", function(e) {
        var id = $(this).attr('data-id');
        loadAlamat(id);
        $("#dukunganPengiriman").attr("disabled", false);
    });


    function loadAlamat(id) {
        for (i = 0; i < dataAlamat.length; i++) {
            if (dataAlamat[i].idalamat == id) {
                $("#idalamat").val(id);
                $("#alamatPengiriman").html(dataAlamat[i].simpan_sebagai + '<br>' + dataAlamat[i].nama_penerima + '<br>' + dataAlamat[i].alamatlengkap);
                $('#modal-alamat').modal('toggle');
                idAlamatUser = dataAlamat[i].kabupatenkota_idkabupatenkota;
                latitudeUser = dataAlamat[i].latitude;
                longitudeUser = dataAlamat[i].longitude;
            }
        }
    }
    $("#biayaKurir").change(function() {
        var id = $(this).val();
        var split = id.split("/");
        var tot = jumlah + parseInt(split[2]);
        $("#displayNominal").html('Total Pembayaran: Rp.' + tot);
        $("#nominalpembayaran").val(jumlah + parseInt(split[2]));
    });

    function distance(lat1, lon1, lat2, lon2, unit) {
        var radlat1 = Math.PI * lat1 / 180
        var radlat2 = Math.PI * lat2 / 180
        var theta = lon1 - lon2
        var radtheta = Math.PI * theta / 180
        var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
        dist = Math.acos(dist)
        dist = dist * 180 / Math.PI
        dist = dist * 60 * 1.1515
        if (unit == "K") {
            dist = dist * 1.609344
        }
        if (unit == "N") {
            dist = dist * 0.8684
        }
        return dist;
    }
    $("#dukunganPengiriman").change(function() {
        $("#biayaKurir").attr("disabled", false);
        val = $(this).val();
        if (val == "2") {
            $("#debug").empty();
            $("#debug").append('user = ' + latitudeUser + "/" + longitudeUser + "<br>");
            $("#debug").append('merchant =' + latitudeMerchant + "/" + longitudeMerchant + "<br>");
            var result = distance(latitudeUser, longitudeUser, latitudeMerchant, longitudeMerchant, "K");
            $("#debug").append(
                'jarak =' + result
            );
            $("#latitudeUser").val(latitudeUser);
            $("#longitudeUser").val(longitudeMerchant);
            $("#latitudeMerchant").val(latitudeMerchant);
            $("#longitudeMerchant").val(longitudeMerchant);

            $("#jarakPengiriman").val(result);
        }
    });

    function hitungBiaya() {
        var origin = {{$alamatMerchant->kabupatenkota_idkabupatenkota}};
        var destination = idAlamatUser;
        //alert(origin + " - " + destination);
        var courier = "jne";
        var berat = {{$total->berat}};
        $.ajax({
            url: "{{url('cost')}}" + "/" + origin + "/" + destination + "/" + courier + "/" + berat,
            method: "GET",
            contentType: false,
            dataType: "json",
            success: function(data) {

                for (i = 0; i < data['rajaongkir']['results'].length; i++) {
                    for (j = 0; j < data['rajaongkir']['results'][i]['costs'].length; j++) {
                        // console.log(data['rajaongkir']['results'][i]['costs'][j]['service']);
                        // console.log(data['rajaongkir']['results'][i]['costs'][j]['description']);
                        // console.log(data['rajaongkir']['results'][i]['costs'][j]['cost'][0]['etd']);
                        // console.log(data['rajaongkir']['results'][i]['costs'][j]['cost'][0]['value']);
                        var a = data['rajaongkir']['results'][i]['costs'][j]['service'];
                        var b = data['rajaongkir']['results'][i]['costs'][j]['cost'][0]['etd'];
                        var c = data['rajaongkir']['results'][i]['costs'][j]['cost'][0]['value'];
                        var merge = a + "/" + b + "/" + c;
                        $("#biayaPengiriman").append('<option value="' + merge + '"> JNE - ' + a + '  - ' + b + '  - ' + c + '</option>')
                    }
                }
                dataKiriman = data;
                console.log('data');
                console.log(data);
            },
            error: function(response) {
                console.table(response);
            }
        });
    }
</script>
@endsection
@endsection