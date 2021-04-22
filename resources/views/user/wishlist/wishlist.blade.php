@extends('layouts.userlte')
@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">

                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
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
                        @foreach($wishlist as $key => $value)
                        <div class="col-6 col-lg-3">
                            <div class="card">
                                <img style="width:150px;height:200px;" src="{{asset('gambar/'.$value->idgambarproduk.'.jpg')}}" class="rounded mx-auto d-block pt-3 img-fluid" alt="...">
                                <div class="card-body text-center">
                                    <b>{{$value->nama}}</b> <br> Rp. {{number_format($value->harga)}}-, <br> {{$value->nama_merchant}}
                                    <br>
                                    <div class="row p-1">
                                        <div class="col">
                                            <form method="post" action="{{route('wishlist.destroy',$value->idproduk)}}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-block btn-default" >Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="row p-1">
                                        <div class="col">
                                            <a href="{{route('produk.show',$value->idproduk)}}" class="btn btn-block btn-default" >Lihat</a>
                                        </div>
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
    </div>
</div>
@section('js')
<script type="text/javascript">
    @if(session('berhasil'))
    //toastr.success('{{session('berhasil')}}');
    alert('{{session('
        berhasil ')}}');
    @endif
</script>
@endsection
@endsection