@extends('layouts.userlte')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-9 ">
            <div class="card">
                <div class="card-header">
                    <div class="card-tittle">
                        Keranjang
                    </div>
                </div>
                <div class="card-body" id="isikeranjang">

                    <!-- <div class="card"> -->
                    <!-- @foreach($keranjang as $key => $value) -->
                    <!-- <div class="row">
                            <div class="col">
                                <img style="width:175px;height:200px;" src="{{asset('gambar/'.$value->idgambarproduk.'.jpg')}}" class="rounded mx-auto d-block pt-3 img-fluid" alt="...">
                            </div>
                            <div class="col">
                                <b>{{$value->nama}}</b>
                                <br> Rp. {{number_format($value->harga)}}-,
                                <br> {{$value->nama_merchant}}
                                <br> Jumlah: <input type="number" class="form-control" placeholder="Qty" id="qty" value="{{$value->jumlah}}">
                            </div>
                            <div class="col">
                                <div class="row p-1">
                                    <div class="col">
                                        <form method="post" action="{{route('keranjang.destroy',$value->idproduk)}}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-block btn-default">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="row p-1">
                                    <div class="col">
                                        <a href="{{route('produk.show',$value->idproduk)}}" class="btn btn-block btn-default">Lihat</a>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    <!-- @endforeach -->
                    <!-- </div> -->
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
        <!-- <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="card-tittle">
                        Checkout
                    </div>
                </div>
                <div class="card-body">
                    Total Belanja:
                    <br>
                    <div id="totalBelanja">
                    </div>
                    <br>
                    <a href="#" class="btn btn-block btn-default">Checkout</a>
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div> -->
    </div>
</div>
@section('js')
<script type="text/javascript">
    var dataKeranjang = [];
    var dataMerchant = [];
    var totalBelanja = 0;
    //user/keranjang/merchant
    $(document).ready(function() {
        $.ajax({
            url: "{{url('user/keranjang/merchant')}}",
            method: "GET",
            success: function(data) {
                if (data.length == 0) {
                    $("#isikeranjang").html('<p class="text-center"> Belum ada produk didalam keranjang.</p>');
                } else {
                    for (i = 0; i < data.length; i++) {
                        dataMerchant[i] = {};
                        dataMerchant[i].idmerchant = data[i].idmerchant;
                        dataMerchant[i].nama_merchant = data[i].nama_merchant;
                    }
                    console.log(dataMerchant);
                    $.ajax({
                        url: "{{url('user/keranjang/data')}}",
                        method: "GET",
                        success: function(data) {
                            for (i = 0; i < data.length; i++) {
                                dataKeranjang[i] = {};
                                dataKeranjang[i].idproduk = data[i].idproduk;
                                dataKeranjang[i].nama_merchant = data[i].nama_merchant;
                                dataKeranjang[i].idgambarproduk = data[i].idgambarproduk;
                                dataKeranjang[i].jumlah = data[i].jumlah;
                                dataKeranjang[i].harga = data[i].harga;
                                dataKeranjang[i].nama = data[i].nama;
                            }
                            console.log(dataKeranjang);
                            tampil();
                        },
                        error: function(response) {
                            console.log(response);
                        }
                    });
                }
            },
            error: function(response) {
                console.log(response);
            }
        });


    });

    function tampil() {
        $("#isikeranjang").empty();
        for (j = 0; j < dataMerchant.length; j++) {
            var rout = "{{url('user/checkout')}}" + "/" + dataMerchant[j].idmerchant;

            $("#isikeranjang").append('<div class="card" id="' + dataMerchant[j].idmerchant + '"> <div class="card-header"> <div class="row"> <div class="col-9">' + dataMerchant[j].nama_merchant + ' </div> <div class="col-3"> <a href="' + rout + '" class="btn btn-block btn-default"> Checkout </a> </div>' + '</div></div>');
            for (i = 0; i < dataKeranjang.length; i++) {
                if (dataKeranjang[i].nama_merchant == dataMerchant[j].nama_merchant) {
                    var idproduk = dataKeranjang[i].idproduk;
                    var nama_merchant = dataKeranjang[i].nama_merchant;
                    var jumlah = dataKeranjang[i].jumlah;
                    var harga = dataKeranjang[i].harga;
                    var nama = dataKeranjang[i].nama;
                    var src = "src=" + "{{asset('/')}}" + "gambar/" + dataKeranjang[i].idgambarproduk + '.jpg';
                    var url = "{{asset('/')}}user/produk/show/" + idproduk;
                    totalBelanja += dataKeranjang[i].jumlah * dataKeranjang[i].harga;
                    var id = "#" + dataMerchant[j].idmerchant;
                    $(id).append(
                        //'<div class="card">' +
                        '<div class="row">' +
                        '<div class="col"> <img style="width:175px;height:200px;" class="rounded mx-auto d-block p-3 img-fluid" alt="..."' + src + '>' +
                        '</div>' +
                        '<div class="col">' +
                        '<b>' + nama + '</b>' +
                        '<br> Rp. ' + harga + '-,' +
                        '<br>' + nama_merchant +
                        '<br> Jumlah: <input type="number" class="form-control" data-id="' + idproduk + '" placeholder="Qty" id="qty" value=' + jumlah + '>' +
                        '</div>' +
                        '<div class="col">' +
                        '<div class="row p-1">' +
                        '<div class="col">' +
                        '<button type="submit" class="btn btn-block btn-default" id="btnHapusKeranjang" data-id="' + idproduk + '">Hapus</button>' +
                        '</div>' +
                        '</div>' +
                        '<div class="row p-1">' +
                        '<div class="col">' +
                        '<a href="' + url + '" class="btn btn-block btn-default">Lihat</a>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>'
                    );
                }

            }
        }
        var t = "#totalBelanja";
        $(t).html('Rp. ' + totalBelanja);
    }
    $("body").on("click", "#btnHapusKeranjang", function(e) {
        var id = $(this).attr('data-id');
        if (confirm('Ingin menghapus?')) {
            $.ajax({
                url: "{{url('user/keranjang/delete')}}/" + id,
                type: 'DELETE',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    console.log(response);
                    if (response == "berhasil") {
                        alert('masuk');
                        location.reload();
                    } else {
                        alert(response);
                    }
                },
                error: function(response) {
                    console.log(response);
                }
            });
        } else {

        }
    });
    $("body").on("change", "#qty", function(e) {
        var id = $(this).attr('data-id');
        var val = $(this).val();
        if (confirm('Ingin menghapus?')) {

        } else {

        }
    });
</script>
@endsection
@endsection

@section('breadcrumb')
<li class="breadcrumb-item active">Keranjang</li>
@endsection