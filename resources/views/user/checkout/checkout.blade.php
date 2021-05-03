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
                                    <div class="row">
                                        <div class="col">
                                            <div class="border">
                                                dasdasda
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            Pengiriman
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <select class="form-control" id="jenisProduk">
                                                    <option selected="">JNE</option>
                                                    <option value="1">Makanan</option>
                                                    <option value="2">Minuman</option>
                                                    <option value="3">Susu</option>
                                                    <option value="4">Beras</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <select class="form-control" id="jenisProduk">
                                                    <option selected="">Reguler, ETD 2-3 Har, Rp.35,000</option>
                                                    <option value="1">Makanan</option>
                                                    <option value="2">Minuman</option>
                                                    <option value="3">Susu</option>
                                                    <option value="4">Beras</option>
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
                                                <option selected="">Cash On Delivery</option>
                                                <option value="1">Makanan</option>
                                                <option value="2">Minuman</option>
                                                <option value="3">Susu</option>
                                                <option value="4">Beras</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            Daftar Produk
                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-3">
                                                    <img style="width:175px;height:200px;" class="rounded mx-auto d-block pt-3 img-fluid" alt="..." src="http://localhost:8000/gambar/21.jpg">
                                                </div>
                                                <div class="col-3">
                                                    <b>Nestle Milo</b>
                                                    <br> Rp. 25000-,
                                                    <br>Merchant Gaje
                                                    <br> Jumlah: <input type="number" class="form-control" data-id="25" placeholder="Qty" id="qty" value="2">
                                                </div>
                                            </div>
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
        alert('{{session('
            berhasil ')}}');
        @endif

    });
    $.ajax({
        url: "{{route('alamatpembeli.checkout')}}",
        type: "GET",
        success: function(response) {
            console.log(response);
            for (i = 0; i < response.length; i++) {
                $("#daftarAlamat").append(
                     '<div class="row border p-3">'  +
                    '<div class="col-9">' +
                        'Alamat 1' +
                        '<br>' + 
                        'Nama Penerima 1' +
                        '<br>' +
                        'Telepon 1' +
                    '</div>' +
                    '<div class="col-3">' +
                        '<button type="button" class="btn btn-block btn-default"> Pilih Alamat</button>' +
                    '</div>' +
                '</div>'
                );
            }
        },
        error: function(response) {
            console.log(response);
        }
    });
</script>
@endsection
@endsection