@extends('layouts.userlte')
@section('content')
<div class="container">

    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                @foreach($gambar as $key => $value)
                                <div class="col">
                                    <img style="width:150px;height:150px;" src="{{asset('gambar/'.$value->idgambarproduk.'.jpg')}}" class="rounded mx-auto d-block p-1 img-fluid" alt="...">
                                </div>
                                @endforeach
                            </div>
                            <div class="row">
                                <div class="col">
                                    <img style="width:150px;height:150px;" src=" https://my.ubaya.ac.id/img/mhs/160417084_l.jpg" class="rounded mx-auto d-block p-1 img-fluid" alt="...">
                                </div>
                                <div class="col">
                                    <img style="width:150px;height:150px;" src=" https://my.ubaya.ac.id/img/mhs/160417084_l.jpg" class="rounded mx-auto d-block p-1 img-fluid" alt="...">
                                </div>
                                <div class="col">
                                    <img style="width:150px;height:150px;" src=" https://my.ubaya.ac.id/img/mhs/160417084_l.jpg" class="rounded mx-auto d-block p-1 img-fluid" alt="...">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <p class="h5">{{$data->nama}}</p>
                            <p class="h6">Terjual 10 Unit - 13 Ulasan - 12 Diskusi</p>
                            <p class="h5">Rp. {{number_format($data->harga)}}</p>
                            <p class="h6">Penjual: {{$data->nama_merchant}}</p>
                            <p class="h6">Detail Produk: {{$data->deskripsi}}</p>
                            <p class="h6">Stok: {{$data->stok}} Unit</p>
                            <div class="row p-1">
                                <div class="col">
                                    <button type="button" class="btn btn-block btn-default">Chat Penjual</button>
                                </div>
                                <div class="col">
                                    <button type="button" class="btn btn-block btn-default" id="wishlist">Wishlist</button>
                                </div>
                            </div>
                            <div class="row p-1">
                                <div class="col-10">
                                    <button type="button" class="btn btn-block btn-default" id="keranjang">Tambah keranjang</button>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <input type="number" class="form-control" placeholder="Qty" id="qty" value={{$data->minimum_pemesanan}}>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">

        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card card-primary card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-reviewproduk-tab" data-toggle="pill" href="#custom-tabs-reviewproduk" role="tab" aria-controls="custom-tabs-reviewproduk" aria-selected="true">Review</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-diskusi-tab" data-toggle="pill" href="#custom-tabs-diskusi" role="tab" aria-controls="custom-tabs-diskusi" aria-selected="false">Diskusi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-rekomendasiproduk-tab" data-toggle="pill" href="#custom-tabs-rekomendasiproduk" role="tab" aria-controls="custom-tabs-rekomendasiproduk" aria-selected="false">Rekomendasi</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-tabContent">
                        <div class="tab-pane fade active show" id="custom-tabs-reviewproduk" role="tabpanel">
                            <!-- Review Produk -->
                            <div class="row">
                                <div class="col">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col col-lg-1">
                                                    <img style="width:75px;height:100px;" src=" https://my.ubaya.ac.id/img/mhs/160417084_l.jpg">
                                                </div>
                                                <div class="col col-lg-11">
                                                    <b>Gusti Bagus</b>
                                                    <br>
                                                    <b>Barang sudah diterima dan bagus</b>
                                                    <br>
                                                    <p>&#9733;&#9733;&#9733;&#9733;&#9733;</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Review Produk -->
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-diskusi" role="tabpanel">
                            <!-- Diskusi Produk -->

                            <!-- End Diskusi Produk -->
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-rekomendasiproduk" role="tabpanel">
                            <!-- Rekomendasi Produk -->
                            <div class="row">
                                <div class="col-6 col-lg-3">
                                    <div class="card">
                                        <img style="width:150px;height:200px;" src=" https://my.ubaya.ac.id/img/mhs/160417084_l.jpg" class="rounded mx-auto d-block pt-3 img-fluid" alt="...">
                                        <div class="card-body text-center">
                                            <b>Iphone 7 32Gb Garansi TAM</b> <br> Rp. 50,000-,
                                            <br>
                                            <a href="#" class="btn btn-primary">Lihat Produk</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-3">
                                    <div class="card">
                                        <img style="width:150px;height:200px;" src=" https://my.ubaya.ac.id/img/mhs/160417084_l.jpg" class="rounded mx-auto d-block pt-3 img-fluid" alt="...">
                                        <div class="card-body text-center">
                                            <b>Iphone 7 32Gb Garansi TAM</b> <br> Rp. 50,000-,
                                            <br>
                                            <a href="#" class="btn btn-primary">Lihat Produk</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-3">
                                    <div class="card">
                                        <img style="width:150px;height:200px;" src=" https://my.ubaya.ac.id/img/mhs/160417084_l.jpg" class="rounded mx-auto d-block pt-3 img-fluid" alt="...">
                                        <div class="card-body text-center">
                                            <b>Iphone 7 32Gb Garansi TAM</b> <br> Rp. 50,000-,
                                            <br>
                                            <a href="#" class="btn btn-primary">Lihat Produk</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-3">
                                    <div class="card">
                                        <img style="width:150px;height:200px;" src=" https://my.ubaya.ac.id/img/mhs/160417084_l.jpg" class="rounded mx-auto d-block pt-3 img-fluid" alt="...">
                                        <div class="card-body text-center">
                                            <b>Iphone 7 32Gb Garansi TAM</b> <br> Rp. 50,000-,
                                            <br>
                                            <a href="#" class="btn btn-primary">Lihat Produk</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Rekomendasi Produk -->
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</div>
@section('js')
<script type="text/javascript">
    $(document).ready(function() {
        //alert('hello world!');
    });
    $("#keranjang").click(function() {
        $.ajax({
            url: "{{route('keranjang.store')}}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                "idproduk": {
                    {
                        $data - > idproduk
                    }
                },
                'jumlah': $("#qty").val()
            },
            success: function(response) {
                console.log(response);
                if (response.status == "berhasil") {

                    alert(response.status);


                } else {
                    alert(response.status);
                }
            }
        });
    });
    $("#wishlist").click(function() {
        $.ajax({
            url: "{{route('wishlist.store')}}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                "idproduk": {
                    {
                        $data - > idproduk
                    }
                }
            },
            success: function(response) {
                console.log(response);
                if (response.status == "berhasil") {

                    alert(response.status);


                } else {
                    alert(response.status);
                }
            }
        });
    });
</script>
@endsection
@endsection