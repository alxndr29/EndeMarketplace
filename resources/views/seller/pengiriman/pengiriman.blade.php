@extends('layouts.adminlte')
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            Pengiriman
        </div>
        <div class="card-body">
            <div class="row pb-3">
                <div class="col-6">

                </div>
                <div class="col-2">
                    <input class="form-control" type="date" value="2011-08-19" id="example-date-input">
                </div>
                <div class="col-2">
                    <input class="form-control" type="date" value="2011-08-19" id="example-date-input">
                </div>
                <div class="col-2">
                    <button type="button" class="btn btn-block btn-default">Filter Tanggal</button>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <table id="example2" class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th style="width:10%">No</th>
                                <th>ID Transaksi</th>
                                <th>Status</th>
                                <th>Jenis Transaksi</th>
                                <th>Jenis Pembayaran</th>
                                <th>Nomimal</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody style="vertical-align: top;">

                            <tr>
                                <td></td>
                                <td></td>
                                <td> </td>
                                <td></td>
                                <td>

                                </td>
                                <td>

                                <td>
                                    <a href="#" class="btn btn-sm btn-success"> <i class="fas fa-edit"></i> </a>
                                </td>
                            </tr>


                        </tbody>

                    </table>
                </div>
            </div>

        </div>
        <div class="card-footer">

        </div>
    </div>
</div>

@section('js')
<script type="text/javascript">
    $(document).ready(function() {
                @if(session('berhasil'))
                //toastr.success('{{session('berhasil')}}');
                alert('{{session('
                    berhasil ')}}');
                @endif
            }
</script>
@endsection

@endsection