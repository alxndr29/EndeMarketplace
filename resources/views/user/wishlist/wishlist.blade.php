@extends('layouts.userlte')
@section('content')
<div class="container">

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="card-tittle">
                        Wishlist
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @if(count($wishlist) != 0)
                            @foreach($wishlist as $key => $value)
                                <div class="col-6 col-lg-3">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <img style="width:150px;height:200px;" src="{{asset('gambar/'.$value->idgambarproduk.'.jpg')}}" class="rounded mx-auto d-block pt-3 img-fluid">
                                            <b class="text-truncate d-inline-block" style="max-width: 150px;">{{$value->nama}}</b>
                                            <br> Rp. {{number_format($value->harga)}}-,
                                            <br>
                                            <small class="text-muted">Oleh: {{$value->nama_merchant}}</small>
                                            <br>
                                            <form method="post" action="{{route('wishlist.destroy',$value->idproduk)}}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-primary">Hapus</button>
                                            </form>
                                            <a href="{{route('produk.show',$value->idproduk)}}" class="btn btn-primary ">Lihat Produk</a>
                                            
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col">
                                <p class="text-center">Belum ada produk pada wishlist anda </p>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex">
                        <div class="mx-auto">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('js')
<script type="text/javascript">
    $(document).ready(function() {
        @if(session('berhasil'))
        alert("{{session('berhasil')}}");
        @endif

    });
</script>
@endsection
@endsection

@section('breadcrumb')
<li class="breadcrumb-item active">Wishlist</li>
@endsection