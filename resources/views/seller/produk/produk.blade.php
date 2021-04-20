@extends('layouts.adminlte')


@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-10">
                            <h3 class="card-title">DataTable with default features</h3>
                        </div>
                        <div class="col">
                            <a type="button" href="{{route('produk.create')}}" class="btn btn-block btn-default">Tambah</a>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th style="width:10%">No</th>
                                <th>Nama</th>
                                <th>Kategori Produk</th>
                                <th>Stok</th>
                                <th>Status</th>
                                <th style="width:5%">Ubah</th>
                                <th style="width:5%">Hapus</th>
                            </tr>
                        </thead>
                        <tbody style="vertical-align: top;">
                            @foreach ($produk as $key => $value )
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$value->nama}}</td>
                                <td>{{$value->nama_kategori}}</td>
                                <td>{{$value->stok}}</td>
                                <td>{{$value->status}}</td>
                                <td>
                                    nan
                                </td>
                                <td>
                                    <form method="post" action="{{route('produk.destroy',$value->idproduk)}}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"> <i class="fas fa-trash"></i> </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
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
        toastr.success('{{session('
            berhasil ')}}');
        @endif
    });
</script>
@endsection

@endsection

@section('name')

@endsection