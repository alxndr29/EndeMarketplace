@extends('layouts.userlte')
@section('content')
<div class="container">
    <div class="row">

        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="card-tittle">
                        Keranjang
                    </div>
                </div>
                <div class="card-body">

                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="card-tittle">
                        Checkout
                    </div>
                </div>
                <div class="card-body">

                    @foreach($data as $key => $value)
                    <div class="card">
                        <div class="card-body text-center">
                            <img style="width:150px;height:200px;" src="{{asset('gambar/'.$value->idgambarproduk.'.jpg')}}" class="rounded mx-auto d-block pt-3 img-fluid" alt="...">
                            <b>{{$value->nama}}</b> <br> Rp. {{number_format($value->harga)}}-,
                            <br>
                            <a href="{{route('produk.show',$value->idproduk)}}" class="btn btn-primary">Lihat Produk</a>
                        </div>
                    </div>
                    @endforeach

                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
    </div>
</div>
@section('js')
<script type="text/javascript">
    $(document).ready(function() {
        alert('hello world!');
    });
</script>
@endsection
@endsection