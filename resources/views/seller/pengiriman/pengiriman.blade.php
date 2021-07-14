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
                    <input class="form-control" type="date" id="tanggalAwal">
                </div>
                <div class="col-2">
                    <input class="form-control" type="date" id="tanggalAkhir">
                </div>
                <div class="col-2">
                    <button type="button" class="btn btn-block btn-default" id="btnFilter">Filter Tanggal</button>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <table id="example2" class="table table-bordered table-striped text-center">
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
                                    <a href="{{route('merchant.pengiriman.detail',$value->idpengiriman)}}" class="btn btn-sm btn-success"> <i class="fas fa-edit"></i> </a>
                                </td>
                            </tr>
                            @endforeach
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
    });
    $("#btnFilter").click(function() {
        var tglawal = $('#tanggalAwal').val();
        var tglakhir = $('#tanggalAkhir').val();
        var url = "{{route('merchant.pengiriman.index.filter',['tanggalAwal' => 'first' ,'tanggalAkhir'=> 'second' ])}}";
        url = url.replace('first', tglawal);
        url = url.replace('second', tglakhir);
        location.href = url;
    });
</script>
@endsection

@endsection