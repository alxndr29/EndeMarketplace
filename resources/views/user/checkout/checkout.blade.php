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
                                                Total Produk: Rp. {{number_format($total->jumlah)}}
                                            </div>
                                        </div>
                                        <div class="row pb-3">
                                            <div class="col" id="displayNominalPengiriman">
                                                Total Pengiriman: Rp. 0
                                            </div>
                                        </div>
                                        <div class="row pb-3">
                                            <div class="col" id="displayNominalTotal">
                                                Total Keseluruhan: Rp. 0
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

                                                <input type="hidden" name="biaya_pengiriman" id="biaya">
                                                <input type="hidden" name="estimasi" id="estimasi">

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
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
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

    var biayaKurir = 0;

    var idAlamatUser = 0;
    var latitudeUser = "";
    var longitudeUser = "";

    var latitudeMerchant = "{{$alamatMerchant->latitude}}";
    var longitudeMerchant = "{{$alamatMerchant->longitude}}";
    var jumlah = "{{$total->jumlah}}";
    var berat = "{{$total->berat}}";


    $(document).ready(function() {
        $("#displayNominal").val(jumlah);
        $("#nominalpembayaran").val(jumlah);
        $("#dukunganPengiriman").attr("disabled", true);
        $("#biayaKurir").attr("disabled", true);

        @if(session("gagal"))
        Swal.fire(
            'Gagal!',
            '{{session("gagal")}}',
            'error'
        )
        @endif
    });

    $.ajax({
        url: "{{route('alamatpembeli.checkout')}}",
        type: "GET",
        success: function(response) {
            console.log(response);
            console.log(response.length);
            if (response.length == 0) {
                $("#daftarAlamat").html('Anda belum memiliki alamat. Klik <a href="' + "{{route('alamatpembeli.index')}}" + '">Disini</a> untuk menambah alamat baru');
            }
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
            console.log(dataAlamat);
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

                $("#latitudeUser").val(latitudeUser);
                $("#longitudeUser").val(longitudeUser);
                $("#latitudeMerchant").val(latitudeMerchant);
                $("#longitudeMerchant").val(longitudeMerchant);
            }
        }
    }

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
    var dukunganPengiriman = "";
    $("#dukunganPengiriman").change(function() {
        $("#biayaKurir").attr("disabled", false);
        val = $(this).val();
        if (val == "2") {
            dukunganPengiriman = "2";
            $("#biayaKurir").empty();
            $("#biayaKurir").append('<option selected>Pilih Biaya Pengiriman</option>');
            @foreach($dukunganTarifPengiriman as $key => $value)
            $("#biayaKurir").append(
                '<option value="' + 'Kurir Merchant' + '-' + '{{$value->tarifpengiriman_idtarifpengiriman}}' + '-' + '{{$value->nama}}' + '-' + '{{$value->minimum_belanja}}' + '-' +
                '{{$value->etd}}' + '-' + '{{$value->tarif_berat}}' + '-' + '{{$value->tarif_volume}}' + '-' + '{{$value->tarif_jarak}}' + '">' +
                '{{$value->nama}}' + '- ETD: ' +
                '{{$value->etd}} Hari' + '</option>'
            );
            @endforeach
        }
        if (val == 1) {
            dukunganPengiriman = "1";
            $("#biayaKurir").empty();
            $("#biayaKurir").append('<option selected>Pilih Biaya Pengiriman</option>');
            hitungBiaya();
        }
    });
    $("#biayaKurir").change(function() {
        var id = $(this).val();
        if (dukunganPengiriman == "2") {
            var split = id.split("-");
            alert(split[0] +" / "+ split[1] +" / " + split[2] + " / " + split[3] + split[4] + " / " + split[5] + " / " + split[6] + " / " + split[7]);

            if (split[1] == "1") {
                if (parseInt(jumlah) < parseInt(split[3])) {
                    Swal.fire(
                        'Gagal!',
                        'Tidak memenuhi nominal pembelian!',
                        'error'
                    )
                } else {
                    //tarif bebas ongkor
                    $("#displayNominalPengiriman").html(' Biaya Pengiriman: Rp. ' + biayaKurir);
                    $("#displayNominalTotal").html('Total Keseluruhan Rp. ' + jumlah);
                    $("#biaya").val(0);
                    $("#estimasi").val(split[4]);
                    var result = distance(latitudeUser, longitudeUser, latitudeMerchant, longitudeMerchant, "K");
                    $("#debug").append(
                        'jarak =' + result
                    );
                    $("#jarakPengiriman").val(result);
                }

            } else if (split[1] == "2") {
                if (parseInt(jumlah) < parseInt(split[3])) {
                    Swal.fire(
                        'Gagal!',
                        'Tidak memenuhi nominal pembelian!',
                        'error'
                    )
                } else {
                    //tarif flat
                    biayaKurir = split[5];
                    $("#displayNominalPengiriman").html(' Biaya Pengiriman Rp. ' + (biayaKurir));
                    var te = parseInt(biayaKurir) + parseInt(jumlah);
                    $("#displayNominalTotal").html('Total Keseluruhan Rp. ' + te);
                    $("#biaya").val(biayaKurir);
                    $("#estimasi").val(split[4]);
                    var result = distance(latitudeUser, longitudeUser, latitudeMerchant, longitudeMerchant, "K");
                    $("#debug").append(
                        'jarak =' + result
                    );
                    $("#jarakPengiriman").val(result);
                }
            } else {
                if (parseInt(jumlah) < parseInt(split[3])) {
                    Swal.fire(
                        'Gagal!',
                        'Tidak memenuhi nominal pembelian!',
                        'error'
                    )
                } else {
                    //pake jarak
                    var result = distance(latitudeUser, longitudeUser, latitudeMerchant, longitudeMerchant, "K");
                    var t_berat = split[5];
                    var t_volume = split[6];
                    var t_jarak = split[7];
                    biayaKurir = Math.round(t_jarak * result);
                    alert('jarak' + result + " tarif jarak " + t_jarak + ' adalah: ' + biayaKurir + " note: dibulatkan keatas");
                    $("#displayNominalPengiriman").html(' Biaya Pengiriman Rp. ' + parseInt(biayaKurir));
                    var te = parseInt(biayaKurir) + parseInt(jumlah);
                    $("#displayNominalTotal").html('Total Keseluruhan Rp. ' + te);
                    $("#biaya").val(biayaKurir);
                    $("#estimasi").val(split[4]);
                    $("#debug").append(
                        'jarak =' + result
                    );
                    $("#jarakPengiriman").val(result);
                }
            }
        }
        if (dukunganPengiriman == "1") {
            var split2 = id.split("/");
            $("#biaya").val(split2[2]);
            $("#estimasi").val(split2[1]);
            var ta = parseInt(split2[2]) + parseInt(jumlah);
            $("#displayNominalPengiriman").html(' Biaya Pengiriman Rp. ' + split2[2]);
            $("#displayNominalTotal").html('Total Keseluruhan Rp. ' + ta);
        }
    });

    function hitungBiaya() {
        var origin = "{{$alamatMerchant->kabupatenkota_idkabupatenkota}}";
        var destination = idAlamatUser;
        var courier = "jne";
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
                        $("#biayaKurir").append('<option value="' + merge + '"> JNE - ' + a + '  - ' + b + '  - ' + c + '</option>')
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

@section('breadcrumb')
<li class="breadcrumb-item active">Checkout</li>
@endsection