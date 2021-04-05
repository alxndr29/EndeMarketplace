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
                                <th style="width:5%">Ubah</th>
                                <th style="width:5%">Hapus</th>
                            </tr>
                        </thead>
                        <tbody style="vertical-align: top;">

                        
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
        toastr.success('{{session('berhasil')}}');
        @endif
    });
</script>
@endsection

@endsection