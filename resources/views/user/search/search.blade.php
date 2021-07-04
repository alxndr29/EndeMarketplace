@extends('layouts.userlte')
@section('content')
<div class="container">
    <div class="row">

        <div class="col-3">
            <div class="card">
                <div class="card-header">
                    <div class="card-tittle">
                        Filter
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Urutkan Berdasarkan</label>
                        <select class="form-control" id="comboboxFilter">
                            <option selected>Pilih</option>
                            <option value="hargatertinggi">Harga Tertinggi</option>
                            <option value="hargaterendah">Harga Terendah</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jenis Produk</label>
                        <select class="form-control" id="comboboxJenis">
                            <option selected>Pilih</option>
                            @foreach ($jenisproduk as $key => $value)
                            <option value="{{$value->idjenisproduk}}">{{$value->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Range Harga</label>
                        <input type="text" id="sliderRangeHarga" value="" class="slider form-control" data-slider-min="0" data-slider-max="1000000" data-slider-step="10000" data-slider-value="[0,1000000]" data-slider-orientation="horizontal" data-slider-selection="before" data-slider-tooltip="show">
                        <div class="row pt-2">
                            <div class="col">
                                <input type="number" class="form-control" id="rangeHargaMin" disabled>
                            </div>
                            <div class="col">
                                <input type="number" class="form-control" id="rangeHargaMax" disabled>
                            </div>
                        </div>
                    </div>
                    <!--
                    <div class="form-group">
                        <label for="exampleInputEmail1">Dukungan Pengiriman</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox">
                            <label class="form-check-label">Kurir Instant</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox">
                            <label class="form-check-label">Kurir JNE</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Dukungan Pembayaran</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox">
                            <label class="form-check-label">Cash On Delivery</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox">
                            <label class="form-check-label">Transfer Bank</label>
                        </div>
                    </div>
                    -->
                </div>
                <div class="card-footer">
                    <div class="d-flex">
                        <div class="mx-auto">
                            <button type="button" id="btnFilter" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-9">
            <div class="card">
                <div class="card-header">
                    <div class="card-tittle">
                        <div class="row">
                            <div class="col-9">
                                Hasil Pencarian
                            </div>
                            <div class="col-3">

                            </div>
                        </div>

                    </div>
                </div>
                <div class="card-body">
                    @if(count($data) == 0)
                    <p class="text-center"> Belum ada data produk </p>
                    @else
                    <div class="row">
                        @foreach($data as $key => $value)
                        <div class="col-6 col-lg-3">
                            <div class="card">
                                <div class="card-body text-center">
                                    <img style="width:150px;height:200px;" src="{{asset('gambar/'.$value->idgambarproduk.'.jpg')}}" class="rounded mx-auto d-block pt-3 img-fluid" alt="...">
                                    <b class="text-truncate d-inline-block" style="max-width: 150px;">{{$value->nama}}</b>
                                    <br> Rp. {{number_format($value->harga)}}-,
                                    <br>
                                    <small class="text-muted">Oleh: {{$value->nama_merchant}}</small>
                                    <br>
                                    <a href="{{route('produk.show',$value->idproduk)}}" class="btn btn-primary">Lihat Produk</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
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
@section('js')
<script src="{{asset('adminlte/plugins/bootstrap-slider/bootstrap-slider.min.js')}}"></script>
<script type="text/javascript">
    $(function() {
        $('.slider').bootstrapSlider()
    });
    var key = "";
    var jenis = "";
    $(document).ready(function() {
        var baseurl = window.location.href;
        var url = new URL(baseurl);
        key = url.searchParams.get('key');
        jenis = url.searchParams.get('jenis');
        $("#txtSearchProduk").val(key);
    });

    $("#btnFilter").click(function() {
        var data = $('#sliderRangeHarga').val();
        var split = data.split(",");
        if (jenis != null) {
            window.location = "{{url('/')}}" + "/user/produk/cari?key=" + key + "&minimum=" + split[0] + "&maksimum=" + (split[1]) + "&jenis=" + jenis + "&order=" + $("#comboboxFilter").val();
        } else {
            window.location = "{{url('/')}}" + "/user/produk/cari?key=" + key + "&minimum=" + split[0] + "&maksimum=" + (split[1]) + "&jenis=" + $("#comboboxJenis").val() + "&order=" + $("#comboboxFilter").val();
        }

    });
    $("#sliderRangeHarga").change(function() {
        var data = $('#sliderRangeHarga').val();
        var split = data.split(",");

        $("#rangeHargaMin").val(split[0]);
        $("#rangeHargaMax").val(split[1]);
    });

    // var min = $('#sliderRangeHarga').data('sliderMin');
    // var max = $('#sliderRangeHarga').data('sliderMax');
    //alert(min + " " + max);

    // var data = $('#sliderRangeHarga').val();
    // var split = data.split(",");
    // alert(split[0] + " R " + split[1]);
</script>
@endsection
@endsection

@section('breadcrumb')
<li class="breadcrumb-item active">Cari Produk</li>
@endsection