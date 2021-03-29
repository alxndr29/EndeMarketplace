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
                            <button type="button" class="btn btn-block btn-default" data-toggle="modal" data-target="#modal-tambahkategori">Tambah</button>
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

    <!-- Modal Start -->
    <!-- Modal untuk Edit -->

    
    <!-- Modal End -->

    <!-- Modal Start -->
    <!-- Modal untuk tambah -->
    <div class="modal fade" id="modal-tambahkategori">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Kategori</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('kategoriproduk.store')}}">
                        @csrf
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Nama Kategori:</label>
                            <input type="text" class="form-control" name="namakategori" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal End -->

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