@extends('layouts.userlte')
@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">

                <div class="card-body">
                    <div class="row">
                        <div class="col-2">
                            <img style="width:150px;height:150px;" src=" https://my.ubaya.ac.id/img/mhs/160417084_l.jpg" class="rounded-circle mx-auto d-block img-fluid" alt="...">
                        </div>
                        <div class="col">
                            <div class="align-middle">
                                <p class="h5">{{$merchant->nama}}</p>
                                <button type="submit" class="btn btn-success text-right" style="margin-right: 5px;" data-toggle="modal" data-target="#modaldetail">
                                    Chat Penjual
                                </button>
                                <button type="submit" class="btn btn-success text-right" style="margin-right: 5px;" data-toggle="modal" data-target="#modaldetail">
                                    Info Merchant
                                </button>
                                <!-- <p class="h5">{{$merchant->foto_profil}}</p>
                                <p class="h5">{{$merchant->foto_sampul}}</p>
                                <p class="h5">{{$merchant->deskripsi}}</p>
                                <p class="h5">{{$merchant->jam_buka}}</p>
                                <p class="h5">{{$merchant->jam_tutup}}</p> -->
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                Produk Terjual:
                            </div>
                            <div class="row">
                                9.7k
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <!-- <h4>Custom Content Below</h4> -->
                    <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true">Produk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">Ulasan</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="custom-content-below-tabContent">
                        <div class="tab-pane fade show active" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                            <br>
                            <div class="row">
                                <div class="col-3">
                                  
                                    <div class="list-group" id="listKategori">

                                        <a href="{{route('merchant.show',$merchant->users_iduser)}}" class="list-group-item list-group-item-action">
                                            Semua
                                        </a>
                                        @foreach($kategori as $key => $value)
                                        @if(isset($id2))
                                        @if($id2 == $value->idkategori)
                                        <a href="{{route('merchant.etalase',[$merchant->users_iduser,$value->idkategori])}}" class="list-group-item list-group-item-action active">{{$value->nama_kategori}}</a>
                                        @else
                                        <a href="{{route('merchant.etalase',[$merchant->users_iduser,$value->idkategori])}}" class="list-group-item list-group-item-action">{{$value->nama_kategori}}</a>
                                        @endif
                                        @else
                                        <a href="{{route('merchant.etalase',[$merchant->users_iduser,$value->idkategori])}}" class="list-group-item list-group-item-action">{{$value->nama_kategori}}</a>
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col-9">
                                                    <h5>Daftar Produk</h5>
                                                </div>
                                                <div class="col-3">
                                                    <div class="input-group">
                                                        <input type="text" id="inputSearch" class="form-control">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i id="btnSearch" class="fas fa-search"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row" id="listProduk">
                                                @if(count($data) > 0)
                                                @foreach ($data as $key => $value )
                                                <div class="col-6 col-lg-3">
                                                    <div class="card">
                                                        <div class="card-body text-center">
                                                            <img style="width:150px;height:200px;" src="{{asset('gambar/'.$value->idgambarproduk.'.jpg')}}" class="rounded mx-auto d-block pt-3 img-fluid" alt="...">
                                                            <b>{{$value->nama}}</b> <br> Rp. {{number_format($value->harga)}}-,
                                                            <br>
                                                            <a href="{{route('produk.show',$value->idproduk)}}" class="btn btn-primary">Lihat Produk</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                                @else
                                                <div class="col text-center">
                                                    Tidak ada produk dengan kata kunci tersebut
                                                </div>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="d-flex">
                                                <div class="mx-auto">
                                                    {{ $data->links() }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                            Ulasan Produk
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modaldetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <b>Deskripsi:</b>
                        <br>
                        {{$merchant->deskripsi}}
                        <br>
                        <b>Jam Operasional:</b>
                        <br>
                        Pukul {{$merchant->jam_buka}} sampai {{$merchant->jam_tutup}}
                        <br>
                        <b>Lokasi:</b>
                        <br>
                        {{$alamat->alamat_lengkap}}
                        <br>
                        {{$alamat->nama_kabupaten}}, {{$alamat->kode_pos}}
                        <br>
                        {{$alamat->nama_provinsi}}
                        <br>
                        <br>
                        <a href="https://www.google.com/maps/search/?api=1&query={{$alamat->latitude}},{{$alamat->longitude}}" class="btn btn-success">
                            Buka Peta
                        </a>
                    </div>
                    <div class="col border-left ">
                        <b>Dukungan Pengiriman:</b>
                        @foreach($pengiriman as $key => $value)
                        <br>
                        <i class="fa fa-check-circle"></i>
                        {{$value->nama_kurir}}
                        @endforeach
                    </div>
                    <div class="col border-left ">
                        <b>Dukungan Pembayaran:</b>
                        @foreach($pembayaran as $key => $value)
                        <br>
                        <i class="fa fa-check-circle"></i>
                        {{$value->nama_pembayaran}}
                        @endforeach
                    </div>
                </div>
                <br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@section('js')
<script type="text/javascript">
    $(document).ready(function() {

    });
    $("#inputSearch").keyup(function(e) {
        if (e.keyCode == 13) {
            var url = "{{url('user/merchant/etalase')}}/" + "{{$merchant->users_iduser}}" + "/" + "{{$id2}}" + "/" + $("#inputSearch").val();
            window.location = url;
        }
    });
    $("#btnSearch").click(function() {
        var url = "{{url('user/merchant/etalase')}}/" + "{{$merchant->users_iduser}}" + "/" + "{{$id2}}" + "/" + $("#inputSearch").val();
        window.location = url;
    });
</script>
@endsection
@endsection

@section('breadcrumb')
<li class="breadcrumb-item active">Cari Produk</li>
@endsection