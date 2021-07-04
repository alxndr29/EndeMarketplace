@extends('layouts.userlte')
@section('content')

<div class="container">
  <div class="jumbotron text-center">
    <h1 class="display-4">Selamat Datng!</h1>
    <p class="lead">Ende's Market merupakan website marketplace khusus bagi penjual di kota Ende.</p>
    <hr class="my-4">
    <p class="lead">
      <a class="btn btn-primary btn-lg" href="#" role="button">Cari Produk</a>
    </p>
  </div>
  <div class="row">
    <div class="col">
      <h3> Baru Ditambahkan </h3>
    </div>
  </div>
  <div class="row">
    @foreach ($produkBaruTambah as $key => $value)
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
    <!-- <div class="col-6 col-lg-3">
      <div class="card">
        <div class="card-body text-center">
          <img style="width:150px;height:200px;" src="{{asset('gambar/7.jpg')}}" class="rounded mx-auto d-block pt-3 img-fluid" alt="...">
          <b class="text-truncate d-inline-block" style="max-width: 150px;">Iphone 7 32Gb</b>
          <br> Rp. 1.500.000-,
          <br>
          <small class="text-muted">Oleh: Anonymous Shop</small>
          <br>
          <a href="#" class="btn btn-primary">Lihat Produk</a>
        </div>
      </div>
    </div> -->
  </div>
</div>
@section('js')
<script type="text/javascript">
  $(document).ready(function() {
    //alert('hello world!');
  });
</script>
@endsection
@endsection

@section('breadcrumb')

@endsection