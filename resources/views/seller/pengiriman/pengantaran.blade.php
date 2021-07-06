@extends('layouts.adminlte')
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            Pengantaran Barang
        </div>
        <div class="card-body">
            <table id="example2" class="table table-bordered table-striped text-center table-responsive">
                <thead>
                    <tr>
                        <th style="width:10%">No</th>
                        <th>ID Transaksi</th>
                        <th>Nomor Resi</th>
                        <th>Tanggal Pengiriman</th>
                        <th>Status Pengiriman</th>
                        <th>Status</th>
                        <th>Tipe Pembayaran</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody style="vertical-align: top;">
                            @foreach($data as $key => $value)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>TRX-{{$value->transaksi_idtransaksi}}</td>
                                <td>{{$value->nomor_resi}}</td>
                                <td>{{$value->tanggal_pengiriman}}</td>
                                <td>
                                    {{$value->status_pengiriman}}
                                </td>
                                <td>
                                    {{$value->status}}
                                </td>
                                <td>
                                    <b> {{$value->tipepembayaran}} </b>
                                </td>
                                <td>
                                    <a href="{{route('merchant.pengantaran.detail',[$value->idpengiriman,$value->transaksi_idtransaksi,'merchant'])}}" class="btn btn-sm btn-success"> <i class="fas fa-edit"></i> </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

            </table>
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
    });
</script>
@endsection

@endsection