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
                                    <a href="{{route('obrolan.index.user')}}" class="btn btn-block btn-default">Chat Penjual</a>
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
                            <div class="row">
                                <div class="col-6 col-lg-9">
                                </div>
                                <div class="col-6 col-lg-3">
                                    <button type="button" class="btn btn-block btn-default" data-toggle="modal" data-target="#modal-tambahdiskusi">Tulis Pertanyaan</button>
                                </div>
                            </div>
                            <br>
                            <!-- Diskusi Produk -->
                            <div class="row">
                                <div class="col">
                                    <div class="card">
                                        <div class="card-footer card-comments">
                                            <div class="card-comment">
                                                <!-- User image -->
                                                <img class="img-circle img-sm" src="{{asset('adminlte/dist/img/user4-128x128.jpg')}}" alt="User Image">

                                                <div class="comment-text">
                                                    <span class="username">
                                                        Maria Gonzales
                                                        <span class="text-muted float-right">8:03 PM Today</span>
                                                    </span><!-- /.username -->
                                                    It is a long established fact that a reader will be distracted
                                                    by the readable content of a page when looking at its layout.
                                                </div>
                                                <!-- /.comment-text -->
                                            </div>
                                            <!-- /.card-comment -->
                                            <div class="card-comment">
                                                <!-- User image -->
                                                <img class="img-circle img-sm" src="{{asset('adminlte/dist/img/user4-128x128.jpg')}}" alt="User Image">

                                                <div class="comment-text">
                                                    <span class="username">
                                                        Luna Stark
                                                        <span class="text-muted float-right">8:03 PM Today</span>
                                                    </span><!-- /.username -->
                                                    It is a long established fact that a reader will be distracted
                                                    by the readable content of a page when looking at its layout.
                                                </div>
                                                <!-- /.comment-text -->
                                            </div>
                                            <!-- /.card-comment -->
                                        </div>
                                        <div class="card-footer">
                                            <form action="#" method="post">
                                                <img class="img-fluid img-circle img-sm" src="{{asset('adminlte/dist/img/user4-128x128.jpg')}}" alt="Alt Text">
                                                <!-- .img-push is used to add margin to elements next to floating images -->
                                                <div class="img-push">
                                                    <input type="text" class="form-control form-control-sm" placeholder="Press enter to post comment">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @foreach ($diskusi as $key => $value)
                                @if($value->balas_ke == null)
                                <div class="row">
                                    <div class="col">
                                        <div class="card">
                                            <div class="card-footer card-comments">
                                                <div class="card-comment">
                                                    <!-- User image -->
                                                    <img class="img-circle img-sm" src="{{asset('adminlte/dist/img/user4-128x128.jpg')}}" alt="User Image">
                                                    <div class="comment-text">
                                                        <span class="username">
                                                            {{$value->nama_user}}
                                                            <span class="text-muted float-right">{{$value->tanggal}}</span>
                                                        </span><!-- /.username -->
                                                        {{$value->pesandiskusi}}
                                                    </div>
                                                    <!-- /.comment-text -->
                                                </div>
                                                <!-- /.card-comment -->
                                            </div>
                                            <div class="card-footer">
                                                <form action="{{route('diskusi.balasan.store',[$data->idproduk, $value->iddiskusi])}}" method="post">
                                                    @csrf
                                                    <img class="img-fluid img-circle img-sm" src="{{asset('adminlte/dist/img/user4-128x128.jpg')}}" alt="Alt Text">
                                                    <!-- .img-push is used to add margin to elements next to floating images -->
                                                    <div class="img-push">
                                                        <input type="text" name="pertanyaan" class="form-control form-control-sm" placeholder="Press enter to post comment">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endforeach
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

<!-- Modal untuk tambah -->
<div class="modal fade" id="modal-tambahdiskusi">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Diskusi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('diskusi.store',$data->idproduk)}}">
                    @csrf
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Tulis Pertanyaan:</label>
                        <input type="text" class="form-control" name="pertanyaan" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal End -->

@section('js')
<script type="text/javascript">
    $(document).ready(function() {

        @if(session('berhasil'))
        //toastr.success('{{session('berhasil')}}');
        alert('{{session('
            berhasil ')}}');
        @endif
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