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
                                                    <select class="form-control" id="biayaPengiriman" name="biayaKurir">
                                                        <option value="CTC/1-2/10000"> JNE - CTC - 1-2 - 10000</option>
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
                                                Total Pembayaran: Rp. {{number_format($total->jumlah)}}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <input type="hidden" name="idmerchant" value="{{$id}}">
                                                <input type="hidden" name="idalamat" id="idalamat">
                                                <input type="hidden" name="nominalpembayaran" id="nominalpembayaran">
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
<button id="test">Buat Transaksi</button>
@section('js')
<script type="text/javascript">
    var dataAlamat;
    var dataKiriman;

    var jumlah = {
        {
            $total - > jumlah
        }
    };
    var biayaKurir = 0;
    $(document).ready(function() {
        @if(session('berhasil'))
        //toastr.success('{{session('berhasil')}}');
        // alert('{{session('
        //     berhasil ')}}');
        // @endif

        //hitungBiaya();
        $("#displayNominal").val(jumlah);
        $("#nominalpembayaran").val(jumlah);
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
    });
    var idAlamatUser = 0;

    function loadAlamat(id) {
        for (i = 0; i < dataAlamat.length; i++) {
            if (dataAlamat[i].idalamat == id) {
                $("#idalamat").val(id);
                $("#alamatPengiriman").html(dataAlamat[i].simpan_sebagai + '<br>' + dataAlamat[i].nama_penerima + '<br>' + dataAlamat[i].alamatlengkap);
                $('#modal-alamat').modal('toggle');
                idAlamatUser = dataAlamat[i].kabupatenkota_idkabupatenkota;
            }
        }
    }
    $("#test").click(function() {
        hitungBiaya();
    });

    function hitungBiaya() {
        var origin = {
            {
                $alamatMerchant - > kabupatenkota_idkabupatenkota
            }
        };
        var destination = idAlamatUser;
        //alert(origin + " - " + destination);
        var courier = "jne";
        var berat = 500;
        // /*
        //  var origin = 501;
        //  var destination = 114;
        //  var courier = "jne";
        //  var berat = 1700;
        //  */
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