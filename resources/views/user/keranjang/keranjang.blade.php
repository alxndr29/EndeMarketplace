@extends('layouts.userlte')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-9">
            <div class="card">
                <div class="card-header">
                    <div class="card-tittle">
                        Keranjang
                    </div>
                </div>
                <div class="card-body">
                    <div class="card">
                        @foreach($keranjang as $key => $value)
                        <div class="row">
                            <div class="col">
                                <img style="width:150px;height:200px;" src="{{asset('gambar/'.$value->idgambarproduk.'.jpg')}}" class="rounded mx-auto d-block pt-3 img-fluid" alt="...">
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
                        </div>
                        @endforeach
                    </div>
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
                    Total Belanja:
                    <br>
                    Rp. 1,000,000
                    <br>
                    <a href="#" class="btn btn-block btn-default">Checkout</a>
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