@extends('layouts.adminlte')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <h3 class="card-title">DataTable with default features</h3>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th style="width:5%">No</th>
                                <th>Nama</th>
                                <th>Gambar</th>
                                <th>Kategori Produk</th>
                                <th> AVG Rating </th>
                                <th style="width:5%">Detail</th>
                            </tr>
                        </thead>
                        <tbody style="vertical-align: top;">
                            @foreach ($produk as $key => $value)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$value->nama_produk}}</td>
                                <td>
                                    <img style="width:75px;height:75px;" src="{{asset('gambar/'.$value->idgambarproduk.'.jpg')}}" class="rounded mx-auto d-block p-1 img-fluid" alt="...">
                                </td>
                                <td>{{$value->kategori_produk}}</td>
                                <td>
                                    @if ($value->rating == null)
                                    Blm ada rating
                                    @else
                                    {{$value->rating}}
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-success"> <i class="fas fa-edit"></i> </a>
                                </td>
                            <tr>
                            @endforeach
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</div>

@section('js')
<script type="text/javascript">
    $(document).ready(function() {
        @if(session('berhasil'))
        //toastr.success('{{session('berhasil')}}');
        alert("{{session('berhasil')}}");
        @endif
    });
</script>
@endsection

@endsection


@section('name')

@endsection