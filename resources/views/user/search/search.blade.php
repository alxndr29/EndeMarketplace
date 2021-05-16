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
                        <label for="exampleInputEmail1">Range Harga</label>
                        <input type="text" id="sliderRangeHarga" value="" class="slider form-control" data-slider-min="0" data-slider-max="100000" data-slider-step="10000" data-slider-value="[0,1000000]" data-slider-orientation="horizontal" data-slider-selection="before" data-slider-tooltip="show">
                        <div class="row pt-2">
                            <div class="col">
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                            </div>
                            <div class="col">
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                            </div>
                        </div>
                    </div>

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
                                Hasil
                            </div>
                            <div class="col-3">
                                <select class="form-control" id="comboboxFilter">
                                    <option selected>Urutkan</option>
                                    <option value="hargatertinggi">Harga Tertinggi</option>
                                    <option value="hargaterendah">Harga Terendah</option>
                                    <option value="baruditambahkan">Baru ditambahkan</option>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($data as $key => $value)
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
@section('js')
<script src="{{asset('adminlte/plugins/bootstrap-slider/bootstrap-slider.min.js')}}"></script>
<script type="text/javascript">
    $(function() {
        $('.slider').bootstrapSlider()
    });
    $(document).ready(function() {

        alert('hello world!');
    });
    $("#comboboxFilter").change(function() {
        var val = $(this).val();
        alert(val);
    });
    $("#btnFilter").click(function() {
        var min = $('#sliderRangeHarga').data('sliderMin');
        var max = $('#sliderRangeHarga').data('sliderMax');
        //alert(min + " " + max);
        var data = $('#sliderRangeHarga').val();
        var split = data.split(",");
        alert(split[0] + " R " + split[1]);
    });
</script>
@endsection
@endsection

@section('breadcrumb')
<li class="breadcrumb-item active">Cari Produk</li>
@endsection