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

                </div>
                <div class="card-footer">

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
                                <select class="form-control">
                                    <option>option 1</option>
                                    <option>option 2</option>
                                    <option>option 3</option>
                                    <option>option 4</option>
                                    <option>option 5</option>
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
<script type="text/javascript">
    $(document).ready(function() {
        alert('hello world!');
    });
</script>
@endsection
@endsection