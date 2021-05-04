@extends('layouts.userlte')
@section('content')
<div class="container">
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
                                        <div class="col-12">
                                            Pengiriman

                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <select class="form-control" id="dukunganPengiriman">
                                                    <option selected>Pilih Pengiriman</option>
                                                    @foreach ($dukunganpengiriman as $key => $value)
                                                    <option value="{{$value->idkurir}}">{{$value->nama}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <select class="form-control" id="biayaPengiriman">
                                                    <option selected>Pilih Biaya Pengiriman</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            Pembayaran
                                        </div>
                                        <div class="col-12">
                                            <select class="form-control" id="jenisProduk">
                                                <option selected value="0">Cash On Delivery</option>
                                                <option value="1">Transfer</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            Daftar Produk
                                        </div>
                                        <div class="col-12">
                                            @foreach ($keranjang as $key => $value )
                                            <div class="row">
                                                <div class="col-3">
                                                    <img style="width:175px;height:200px;" class="rounded mx-auto d-block pt-3 img-fluid" alt="..." src="{{asset('gambar/'.$value->gambar.'.jpg')}}">
                                                </div>
                                                <div class="col-3">
                                                    <b>{{$value->nama}}</b>
                                                    <br> Rp. {{number_format($value->harga)}}-,
                                                    <!-- <br>Merchant Gaje -->
                                                    <br> Jumlah: <input type="number" class="form-control" data-id="25" placeholder="Qty" id="qty" value="{{$value->jumlah}}" disabled>
                                                    <br> Total: Rp. {{number_format($value->harga * $value->jumlah)}}-,
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
                                        <div class="col">
                                            Total Pembayaran: Rp. 70,000
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <a href="#" class="btn btn-block btn-default">Buat Transaksi</a>
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
@section('js')
<script type="text/javascript">
    $(document).ready(function() {
        @if(session('berhasil'))
        //toastr.success('{{session('berhasil')}}');
        // alert('{{session('
        //     berhasil ')}}');
        // @endif

        hitungBiaya();
    });
    var data;
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
            data = response;
        },
        error: function(response) {
            console.log(response);
        }
    });

    $("body").on("click", "#pilihALamat", function(e) {
        var id = $(this).attr('data-id');
        //alert(id);
        loadAlamat(id);
    });

    function loadAlamat(id) {
        for (i = 0; i < data.length; i++) {
            if (data[i].idalamat == id) {
                $("#alamatPengiriman").html(data[i].simpan_sebagai + '<br>' + data[i].nama_penerima + '<br>' + data[i].alamatlengkap);
                $('#modal-alamat').modal('toggle');
            }
        }
    }

    function hitungBiaya() {
        var origin = 122;
        var destination = 122;
        var courier = "jne";
        var berat = 500;
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
                console.log(data);
                for (i = 0; i < data['rajaongkir']['results'].length; i++) {
                    for (j = 0; j < data['rajaongkir']['results'][i]['costs'].length; j++) {
                        // console.log(data['rajaongkir']['results'][i]['costs'][j]['service']);
                        // console.log(data['rajaongkir']['results'][i]['costs'][j]['description']);
                        // console.log(data['rajaongkir']['results'][i]['costs'][j]['cost'][0]['etd']);
                        // console.log(data['rajaongkir']['results'][i]['costs'][j]['cost'][0]['value']);
                        $("#biayaPengiriman").append('<option> JNE - ' + data['rajaongkir']['results'][i]['costs'][j]['service'] + '  - ' + data['rajaongkir']['results'][i]['costs'][j]['cost'][0]['etd'] + '  - '  + data['rajaongkir']['results'][i]['costs'][j]['cost'][0]['value'] + '</option>')
                    }
                }
            },
            error: function(response) {
                console.table(response);
            }
        });

    }
</script>
@endsection
@endsection