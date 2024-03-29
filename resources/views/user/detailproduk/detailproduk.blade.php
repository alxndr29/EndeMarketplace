@extends('layouts.userlte')
@section('content')
<div class="container">

    <div class="card">
        <div class="card-header">
            Detail Produk
        </div>
        <div class="card-body">
            @if($data->status == "TidakAktif")
            <div class="alert alert-warning text-center" role="alert">
                Produk sedang tidak dapat dibeli.
            </div>
            @endif
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                @foreach($gambar as $key => $value)
                                <div class="col">
                                    <a href="{{asset('gambar/'.$value->idgambarproduk.'.jpg')}}">
                                        <img style="width:150px;height:150px;" src="{{asset('gambar/'.$value->idgambarproduk.'.jpg')}}" class="rounded mx-auto d-block p-1 img-fluid" alt="...">
                                    </a>
                                </div>
                                @endforeach
                            </div>
                            <div class="row">
                                <!-- <div class="col">
                                    <img style="width:150px;height:150px;" src=" https://my.ubaya.ac.id/img/mhs/160417084_l.jpg" class="rounded mx-auto d-block p-1 img-fluid" alt="...">
                                </div>
                                <div class="col">
                                    <img style="width:150px;height:150px;" src=" https://my.ubaya.ac.id/img/mhs/160417084_l.jpg" class="rounded mx-auto d-block p-1 img-fluid" alt="...">
                                </div>
                                <div class="col">
                                    <img style="width:150px;height:150px;" src=" https://my.ubaya.ac.id/img/mhs/160417084_l.jpg" class="rounded mx-auto d-block p-1 img-fluid" alt="...">
                                </div> -->
                                @if(isset($data->video))
                                <div class="col">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe width="560" height="315" src="{{$data->video}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <p class="h5">{{$data->nama}}</p>
                            <p class="h6">Terjual {{$jumlahTerjual}} Unit - {{$jumlahUlasan}} Ulasan - {{$jumlahDiskusi}} Diskusi</p>
                            <p class="h5">Rp. {{number_format($data->harga)}}</p>
                            <p class="h6">Penjual:
                                <a href="{{route('merchant.show',$data->merchant_users_iduser)}}">
                                    {{$data->nama_merchant}}
                                </a>
                            </p>
                            <p class="h6">Detail Produk: {{$data->deskripsi}}</p>
                            <p class="h6">Stok: {{$data->stok}} Unit</p>
                            <p class="h6">Minimum pemesanan: {{$data->minimum_pemesanan}} Unit</p>
                            @if ($data->preorder == "Aktif")
                            <p class="h6"> <b>Preorder {{$data->waktu_preorder}} Hari </b> </p>
                            @endif

                            <div class="row p-1">
                                @auth
                                <div class="col">
                                    <!-- <a href="{{route('obrolan.index.user')}}" class="btn btn-block btn-default">Chat Penjual</a> -->
                                    <button type="button" class="btn btn-block btn-default" id="chatpenjual">Chat Penjual</button>
                                </div>
                                <div class="col">
                                    <button type="button" class="btn btn-block btn-default" id="wishlist">Wishlist</button>
                                </div>
                                @else
                                <div class="col">
                                    <!-- <a href="{{route('obrolan.index.user')}}" class="btn btn-block btn-default">Chat Penjual</a> -->
                                    <button type="button" class="btn btn-block btn-default" id="chatpenjual" disabled>Chat Penjual</button>
                                </div>
                                <div class="col">
                                    <button type="button" class="btn btn-block btn-default" id="wishlist" disabled>Wishlist</button>
                                </div>
                                @endauth

                            </div>
                            <div class="row p-1">
                                @auth
                                <div class="col-9">
                                    @if($data->status == "TidakAktif")
                                    <button type="button" class="btn btn-block btn-default" id="keranjang" disabled>Tambah keranjang</button>
                                    @else
                                    <button type="button" class="btn btn-block btn-default" id="keranjang">Tambah keranjang</button>
                                    @endif

                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <input type="number" class="form-control" placeholder="Qty" id="qty" value={{$data->minimum_pemesanan}}>
                                    </div>
                                </div>
                                @else
                                <div class="col-9">
                                    @if($data->status == "TidakAktif")
                                    <button type="button" class="btn btn-block btn-default" id="keranjang" disabled>Tambah keranjang</button>
                                    @else
                                    <button type="button" class="btn btn-block btn-default" id="keranjang" disabled>Tambah keranjang</button>
                                    @endif

                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <input type="number" class="form-control disabled" placeholder="Qty" id="qty" value={{$data->minimum_pemesanan}}>
                                    </div>
                                </div>
                                @endauth
                            </div>
                            <div class="row p-1">
                                <div class="col">
                                    <!-- AddToAny BEGIN -->
                                    <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                                        <a class="a2a_dd" href="https://www.addtoany.com/share/"></a>
                                        <a class="a2a_button_facebook"></a>
                                        <a class="a2a_button_twitter"></a>
                                        <a class="a2a_button_email"></a>
                                        <a class="a2a_button_whatsapp"></a>
                                        <a class="a2a_button_line"></a>
                                        <a class="a2a_button_telegram"></a>
                                    </div>
                                    <script async src="https://static.addtoany.com/menu/page.js"></script>
                                    <!-- AddToAny END -->
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
                                            @if(count($reviewProduk) == 0)
                                            <p class="text-center"> Belum ada review produk.</p>
                                            @else
                                            @foreach($reviewProduk as $key => $value)
                                            <div class="row pb-1">
                                                <div class="col col-lg-1">
                                                    <img style="width:75px;height:100px;" src="{{asset('fotoProfil/default-user.png')}}">
                                                </div>
                                                <div class="col col-lg-11">
                                                    <b>{{$value->nama_user}}</b>
                                                    <br>{{$value->tanggal_waktu}}
                                                    <br>
                                                    {{$value->komentar}}
                                                    <br>
                                                    Jumlah bintang: {{$value->rating}}
                                                    <i class="fa fa-star"></i>
                                                </div>
                                            </div>
                                            @endforeach
                                            @endif
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
                                    @auth
                                    <button type="button" class="btn btn-block btn-default" data-toggle="modal" data-target="#modal-tambahdiskusi">Tulis Pertanyaan</button>
                                    @else
                                    <button type="button" class="btn btn-block btn-default" data-toggle="modal" data-target="#modal-tambahdiskusi" disabled>Tulis Pertanyaan</button>
                                    @endauth

                                </div>
                            </div>
                            <br>

                            <!-- Diskusi Produk -->
                            <!-- <div class="row">
                                <div class="col">
                                    <div class="card">
                                        <div class="card-footer card-comments">
                                            <div class="card-comment">
                                                <img class="img-circle img-sm" src="{{asset('adminlte/dist/img/user4-128x128.jpg')}}" alt="User Image">
                                                <div class="comment-text">
                                                    <span class="username">
                                                        Maria Gonzales
                                                        <span class="text-muted float-right">8:03 PM Today</span>
                                                    </span>
                                                    It is a long established fact that a reader will be distracted
                                                    by the readable content of a page when looking at its layout.
                                                </div>
                                            </div>
                                            <div class="card-comment">
                                                <img class="img-circle img-sm" src="{{asset('adminlte/dist/img/user4-128x128.jpg')}}" alt="User Image">
                                                <div class="comment-text">
                                                    <span class="username">
                                                        Luna Stark
                                                        <span class="text-muted float-right">8:03 PM Today</span>
                                                    </span>
                                                    It is a long established fact that a reader will be distracted
                                                    by the readable content of a page when looking at its layout.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <form action="#" method="post">
                                                <img class="img-fluid img-circle img-sm" src="{{asset('adminlte/dist/img/user4-128x128.jpg')}}" alt="Alt Text">
                                                
                                                <div class="img-push">
                                                    <input type="text" class="form-control form-control-sm" placeholder="Press enter to post comment">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div> -->



                            <!-- End Diskusi Produk -->
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-rekomendasiproduk" role="tabpanel">
                            <!-- Rekomendasi Produk -->
                            <div class="row">
                                <!-- <div class="col-6 col-lg-3">
                                    <div class="card">
                                        <img style="width:150px;height:200px;" src="{{asset('fotoProfil/default-user.png')}}" class="rounded mx-auto d-block pt-3 img-fluid" alt="...">
                                        <div class="card-body text-center">
                                            <b>Produk XX</b> <br> Rp. 50,000-,
                                            <br>
                                            <a href="#" class="btn btn-primary">Lihat Produk</a>
                                        </div>
                                    </div>
                                </div> -->
                                @if(count($hasilAkhirRekomendasi) == 0)
                                <div class="col text-center">
                                    <p> Belum ada produk direkomendasi </p>
                                </div>
                                @else
                                @foreach ($hasilAkhirRekomendasi as $key => $value)
                                <div class="col-6 col-lg-3">
                                    <div class="card">
                                        <img style="width:150px;height:200px;" src="{{asset('gambar/'.$value->idgambarproduk.'.jpg')}}" class="rounded mx-auto d-block pt-3 img-fluid" alt="...">
                                        <div class="card-body text-center">
                                            <b>{{$value->nama}}</b> <br> Rp. {{number_format($value->harga)}}-,
                                            <br>
                                            <a href="{{route('produk.show',$value->idproduk)}}" class="btn btn-primary">Lihat Produk</a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @endif

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


<!-- Modal -->
<div class="modal fade" id="modal-chatpenjual" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pesan ke Penjual</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <p>Kirim ke: <span class="badge badge-secondary"> {{$data->nama_merchant}}</span></p>
                <div class="form-group">
                    <textarea class="form-control" name="pesan" id="txtpesan" rows="3" required>Link Produk: {{ Request::fullUrl() }}</textarea>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" id="kirimPesan" class="btn btn-primary">Kirim</button>
            </div>

        </div>
    </div>
</div>
@section('js')
<script type="text/javascript">
    var idproduk = "{{$data->idproduk}}";
    var parentBalasan = [];
    var balasan = [];

    var login = false;

    $(document).ready(function() {
        @if(session('berhasil'))
        //toastr.success('{{session('berhasil')}}');
        //alert("{{session('berhasil')}}");
        Swal.fire(
            'Berhasil!',
            "{{session('berhasil')}}",
            'success'
        )
        @endif

        loadKomentar(idproduk);
    });

    function loadKomentar($id) {
        $.ajax({
            url: "{{url('diskusi/data')}}" + "/" + idproduk,
            type: "GET",
            success: function(response) {
                for (i = 0; i < response.length; i++) {
                    balasan[i] = {};
                    balasan[i].balas_ke = response[i].balas_ke;
                    balasan[i].iddiskusi = response[i].iddiskusi;
                    balasan[i].nama_user = response[i].nama_user;
                    balasan[i].pesandiskusi = response[i].pesandiskusi;
                    balasan[i].tanggal = response[i].tanggal;
                    if (response[i].balas_ke == null) {
                        parentBalasan[i] = {};
                        parentBalasan[i].iddiskusi = response[i].iddiskusi;
                        parentBalasan[i].nama_user = response[i].nama_user;
                        parentBalasan[i].pesandiskusi = response[i].pesandiskusi;
                        parentBalasan[i].tanggal = response[i].tanggal;
                    }
                }

                console.log(balasan);
                parentBalasan = parentBalasan.filter(Boolean);
                console.log(parentBalasan);

                for (i = 0; i < parentBalasan.length; i++) {
                    var idddd = parentBalasan[i].iddiskusi;
                    //var action = "http://localhost:8000/diskusi/balasan/store/" + "{{$data->idproduk}}" + "/" + idddd;
                    //alert(action);
                    var action = "{{url('/')}}/" + "diskusi/balasan/store/" + "{{$data->idproduk}}" + "/" + idddd;
                    $("#custom-tabs-diskusi").append(
                        '<div class="row">' +
                        '<div class="col">' +
                        '<div class="card">' +
                        '<div class="card-header">' +
                        '<div class="user-block">' +
                        '<img class="img-circle" src="{{asset("adminlte/dist/img/user4-128x128.jpg")}}" alt="User Image">' +
                        '<span class="username"><a href="#">' + parentBalasan[i].nama_user + '</a></span>' +
                        '<span class="description">' + parentBalasan[i].tanggal + '</span>' +
                        '</div>' +
                        '</div>' +
                        '<div class="card-body">' +
                        '<b>' + parentBalasan[i].pesandiskusi + '</b>' +
                        '</div>' +
                        '<div class="card-footer card-comments" id="parentdiskusi-' + parentBalasan[i].iddiskusi + '">' +
                        '</div>' +
                        '<div class="card-footer">' +
                        '<form action="' + action + '" method="post"> @csrf' +
                        '<img class="img-fluid img-circle img-sm" src="{{asset("adminlte/dist/img/user4-128x128.jpg")}}" alt="Alt Text">' +
                        '<div class="img-push">' +
                        '<input type="text" name="pertanyaan" class="form-control form-control-sm" placeholder="Press enter to post comment" required>' +
                        '</div>' +
                        '</form>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>'
                    );
                    for (j = 0; j < balasan.length; j++) {
                        if (balasan[j].balas_ke == parentBalasan[i].iddiskusi) {
                            var id = parentBalasan[i].iddiskusi;
                            $("#parentdiskusi-" + id).append(
                                '<div class="card-comment">' +
                                '<img class="img-circle img-sm" src="{{asset("adminlte/dist/img/user4-128x128.jpg")}}" alt="User Image">' +
                                '<div class="comment-text">' +
                                '<span class="username">' +
                                balasan[j].nama_user +
                                '<span class="text-muted float-right">' + balasan[j].tanggal + '</span>' +
                                '</span>' +
                                balasan[j].pesandiskusi +
                                '</div>' +
                                '</div>'
                            );
                        }
                    }
                }
            },
            error: function(response) {
                console.log(response);
            }
        });
    }
    $("#keranjang").click(function() {
        $.ajax({
            url: "{{route('keranjang.store')}}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                "idproduk": idproduk,
                'jumlah': $("#qty").val()
            },
            success: function(response) {
                console.log(response);
                if (response.status == "berhasil") {
                    console.log(response.status);
                    loadKeranjang();
                    Swal.fire(
                        'Berhasil!',
                        'Tambah produk ke keranjang!',
                        'success'
                    )
                } else {
                    console.log(response.status);
                    Swal.fire(
                        'Gagal!',
                        'Tambah produk ke keranjang!',
                        'error'
                    )
                }
            },
            error: function(response) {
                console.log(response);
            }
        });
    });
    $("#wishlist").click(function() {
        $.ajax({
            url: "{{route('wishlist.store')}}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                "idproduk": idproduk
            },
            success: function(response) {
                console.log(response);
                if (response.status == "berhasil") {
                    console.log(response.status);
                    Swal.fire(
                        'Berhasil!',
                        'Tambah produk ke wishlist!',
                        'success'
                    )
                } else {
                    alert(response.status);
                }
            },
            error: function(response) {
                console.log(response);
            }
        });
    });
    $("#chatpenjual").click(function() {
        $("#modal-chatpenjual").modal('show');
    });
    $("#kirimPesan").click(function() {
        var pesan = $("#txtpesan").val();
        if (pesan == "") {
            alert("Pesan tidak boleh kosong.");
        } else {
            var idmerchant = "{{$data->merchant_users_iduser}}";
            $.ajax({
                url: "{{route('obrolan.user.store')}}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "subject": "cobasubject",
                    "isipesan": pesan,
                    "idmerchant": idmerchant
                },
                success: function(response) {
                    if (response.status == "berhasil") {
                        Swal.fire(
                            'Berhasil!',
                            'Pesan Berhasil Dikirim!',
                            'success'
                        )
                        $("#modal-chatpenjual").modal('hide');
                    }
                },
                error: function(response) {
                    console.log(response);
                }
            });
        }

    });
    $("#qty").change(function() {
        var qty = $(this).val();
        // alert(qty);
        // alert("{{$data->minimum_pemesanan}}");
        // alert("{{$data->stok}}");
        if (qty < parseInt("{{$data->minimum_pemesanan}}")) {
            Swal.fire(
                '',
                'Qty produk tidak boleh kurang!',
                'warning'
            )
            $("#qty").val("{{$data->minimum_pemesanan}}");
        }
        if (qty > parseInt("{{$data->stok}}")) {
            Swal.fire(
                '',
                'Qty produk tidak boleh lebih',
                'warning'
            )
            $("#qty").val("{{$data->stok}}");
        }
    });
</script>
@endsection
@endsection

@section('breadcrumb')
<li class="breadcrumb-item active">Detail Produk</li>
@endsection