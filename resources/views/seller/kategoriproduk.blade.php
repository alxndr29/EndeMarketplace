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
                            <button type="button" class="btn btn-block btn-default">Tambah</button>
                        </div>
                    </div>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No </th>
                                <th>Nama</th>
                                <th> Aksi </th>
                            </tr>
                        </thead>
                        <tbody style="vertical-align: top;">
                            <tr>
                                <td>1</td>
                                <td>Peralatan Rumah Tangga</td>
                                <td>
                                    <button type="button" class="btn btn-block btn-success" data-toggle="modal" data-target="#modal-default"> <i class="fas fa-edit"></i> </button>
                                    <button type="button" class="btn btn-block btn-danger" data-toggle="modal" data-target="#modal-default"> <i class="fas fa-trash"></i> </button>
                                </td>
                            </tr>
                        </tbody>
                        <!-- 
                        <tfoot>
                            <tr>
                                <th>Rendering engine</th>
                                <th>Browser</th>
                                <th>Platform(s)</th>
                                <th>Engine version</th>
                                <th>CSS grade</th>
                            </tr>
                        </tfoot>
                        -->
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>

    <!-- Modal Start -->
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Default Modal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Recipient:</label>
                            <input type="text" class="form-control" id="recipient-name">
                        </div>
                        <button type="button" class="btn btn-primary">Simpan</button>
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

@endsection