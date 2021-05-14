@extends('layouts.userlte')
@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">

                <div class="card-body">
                    <div class="row">
                        <div class="col-2">
                            <img style="width:150px;height:150px;" src=" https://my.ubaya.ac.id/img/mhs/160417084_l.jpg" class="rounded mx-auto d-block p-1 img-fluid" alt="...">
                        </div>
                        <div class="col">
                            <p class="h5">{{$merchant->nama}}</p>
                            <p class="h5">{{$merchant->foto_profil}}</p>
                            <p class="h5">{{$merchant->foto_sampul}}</p>
                            <p class="h5">{{$merchant->deskripsi}}</p>
                            <p class="h5">{{$merchant->jam_buka}}</p>
                            <p class="h5">{{$merchant->jam_tutup}}</p>
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
                            <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-content-below-messages-tab" data-toggle="pill" href="#custom-content-below-messages" role="tab" aria-controls="custom-content-below-messages" aria-selected="false">Messages</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-content-below-settings-tab" data-toggle="pill" href="#custom-content-below-settings" role="tab" aria-controls="custom-content-below-settings" aria-selected="false">Settings</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="custom-content-below-tabContent">
                        <div class="tab-pane fade show active" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                            <br>
                            <div class="row">
                                <div class="col-3">
                                    <h5>Kategori Produk</h5>
                                    <br>
                                    <div class="list-group" id="listKategori">
                                        <!-- @foreach($kategori as $key => $value)
                                        <a href="javascript:void(0)" id="pilihKategori" data-id="{{$value->idkategori}}" class="list-group-item list-group-item-action">{{$value->nama_kategori}}</a>
                                        @endforeach -->

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
                                                <div class="col-6">
                                                    <h5>Daftar Produk</h5>
                                                </div>
                                                <div class="col-3">
                                                    <div class="input-group mb-3">
                                                        <input type="text" id="inputSearch" class="form-control">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <select class="form-control" id="comboboxFilter">
                                                            <option value="a">option 1</option>
                                                            <option value="b">option 2</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row" id="listProduk">
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
                            Mauris tincidunt mi at erat gravida, eget tristique urna bibendum. Mauris pharetra purus ut ligula tempor, et vulputate metus facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas sollicitudin, nisi a luctus interdum, nisl ligula placerat mi, quis posuere purus ligula eu lectus. Donec nunc tellus, elementum sit amet ultricies at, posuere nec nunc. Nunc euismod pellentesque diam.
                        </div>
                        <div class="tab-pane fade" id="custom-content-below-messages" role="tabpanel" aria-labelledby="custom-content-below-messages-tab">
                            Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna.
                        </div>
                        <div class="tab-pane fade" id="custom-content-below-settings" role="tabpanel" aria-labelledby="custom-content-below-settings-tab">
                            Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
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
    @if(session('berhasil'))
    //toastr.success('{{session('berhasil')}}');
    alert('{{session('
        berhasil ')}}');
    @endif

    $(document).ready(function() {
        //$("#listProduk").append('test');
    });
    $("#inputSearch").keyup(function(e) {
        if (e.keyCode == 13) {
            var data = $(this).val();
            alert(data);
        }
    });

    $("#comboboxFilter").change(function() {
        var data = $(this).val();
        alert(data);
    });
    var kat = "";
    $("body").on("click", "#pilihKategori", function(e) {
        var id = $(this).attr('data-id');
        kat = id;
        alert(id);
        // $(this).addClass('active');
        // $("#pilihKategori").removeClass('active');
    });
</script>
@endsection
@endsection