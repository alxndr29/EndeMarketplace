@extends('layouts.adminlte')
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    Petugas Pengantaran
                </div>
                <div class="col-3">
                    <button type="button" class="btn btn-block btn-default" data-toggle="modal" data-target="#modal-tambahkategori">Tambah</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="example2" class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th style="width:10%">No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <!-- <th>Password</th> -->
                        <th>Telepon</th>
                        <th>Kendaraan</th>
                        <th>No Polisi</th>
                        <th>Ubah</th>
                        <th>Hapus</th>
                    </tr>
                </thead>
                <tbody style="vertical-align: top;">
                    @foreach ($data as $key => $value)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$value->nama}}</td>
                        <td>{{$value->username}}</td>
                        <!-- <td>{{$value->password}}</td> -->
                        <td>{{$value->telepon}}</td>
                        <td>{{$value->nama_kendaraan}}</td>
                        <td>{{$value->nomor_polisi}}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-success" id="ubah" data-id="{{$value->idpetugaspengantaran}}"> <i class=" fas fa-edit"></i> </button>
                        </td>
                        <td>
                            <button type="submit" class="btn btn-sm btn-danger" id="hapus" data-id="{{$value->idpetugaspengantaran}}"> <i class="fas fa-trash"></i> </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>
<!-- Modal untuk tambah -->
<div class="modal fade" id="modal-tambahkategori">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Pegawai</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('merchant.petugas.store')}}">
                    @csrf
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nama:</label>
                        <input type="text" class="form-control" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Telepon:</label>
                        <input type="text" class="form-control" name="telepon" required>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Username:</label>
                        <input type="text" class="form-control" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Password:</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nama Kendaraan:</label>
                        <input type="text" class="form-control" name="nama_kendaraan" required>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nomor Polisi:</label>
                        <input type="text" class="form-control" name="nomor_polisi" required>
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
<!-- Modal untuk Edit -->
<div class="modal fade" id="modal-editpegawai">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edi Pegawai</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="form-edit" action="{{route('merchant.petugas.update',1)}}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nama:</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Telepon:</label>
                        <input type="text" class="form-control" id="telepon" name="telepon" required>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Username:</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nama Kendaraan:</label>
                        <input type="text" class="form-control" id="nama_kendaraan" name="nama_kendaraan" required>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nomor Polisi:</label>
                        <input type="text" class="form-control" id="nomor_polisi" name="nomor_polisi" required>
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
@section('js')
<script type="text/javascript">
    $(document).ready(function() {
        @if(session('berhasil'))
        Swal.fire(
            "Berhasil!",
            "{{session('berhasil')}}",
            "success"
        )
        @endif
        @if(session('gagal'))
        Swal.fire(
            "Gagal!",
            "{{session('gagal')}}",
            "error"
        )
        @endif
    });
    $("body").on("click", "#ubah", function(e) {
        var id = $(this).attr('data-id');
        $.ajax({
            url: "{{url('seller/petugas/edit')}}/" + id,
            type: "GET",
            success: function(response) {
                console.log(response);
                var url = "{{url('seller/petugas/update')}}/" + id;
                $('#form-edit').attr('action', url);
                $("#nama").val(response.nama);
                $("#telepon").val(response.telepon);
                $("#username").val(response.username);
                $("#password").val(response.password);
                $("#nama_kendaraan").val(response.nama_kendaraan);
                $("#nomor_polisi").val(response.nomor_polisi);
                $("#modal-editpegawai").modal('show');
            },
            error: function(response) {
                alert(response);
            }
        });
    });
    $("body").on("click", "#hapus", function(e) {
        var id = $(this).attr('data-id');
        Swal.fire({
            title: 'Anda ingin menghapus?',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{url('seller/petugas/delete')}}/" + id,
                    type: 'DELETE',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        console.log(response);
                        if (response == "berhasil") {
                            console.log(response);
                            Swal.fire(
                                'Berhasil!',
                                'Hapus Data Pegawai!',
                                'success'
                            ).then((result) => {
                                location.reload();
                            });
                        } else {
                            console.log(response);
                            Swal.fire(
                                'Gagal!',
                                'Hapus Data Pegawai!',
                                'error'
                            )
                        }
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            }
        })
    });
</script>
@endsection

@endsection