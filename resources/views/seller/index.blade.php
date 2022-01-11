@extends('layouts.adminlte')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Menunggu Konfirmasi</span>
                    <span class="info-box-number">{{count($jumlahMenungguKonfirmasi)}} Transaksi</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Menunggu Pengiriman</span>
                    <span class="info-box-number">{{count($jumlahPesananDiproses)}} Transaksi</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-shopping-cart"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Komplain</span>
                    <span class="info-box-number">{{count($jumlahPesananKomplain)}} Transaksi</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>


    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        Menunggu Konfirmasi
                    </div>
                </div>
                <div class="card-body">
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
                            @foreach ($jumlahMenungguKonfirmasi as $key => $value)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>TRX-{{$value->idtransaksi}}</td>
                                <td>{{$value->status_transaksi}} </td>
                                <td>{{$value->jenis_transaksi}}</td>
                                <td>
                                    {{$value->tipepembayaran_idtipepembayaran}}
                                </td>
                                <td>
                                    Rp. {{number_format($value->nominal_pembayaran)}}
                                </td>
                                <td>
                                    <a href="{{route('merchant.transaksi.detail',$value->idtransaksi)}}" class="btn btn-sm btn-success"> <i class="fas fa-edit"></i> </a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>

                    </table>
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        Menunggu Pengiriman
                    </div>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped text-center">
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
                            @foreach ($jumlahPesananDiproses as $key => $value)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>TRX-{{$value->idtransaksi}}</td>
                                <td>{{$value->status_transaksi}} </td>
                                <td>{{$value->jenis_transaksi}}</td>
                                <td>
                                    {{$value->tipepembayaran_idtipepembayaran}}
                                </td>
                                <td>
                                    Rp. {{number_format($value->nominal_pembayaran)}}
                                </td>
                                <td>
                                    <a href="{{route('merchant.transaksi.detail',$value->idtransaksi)}}" class="btn btn-sm btn-success"> <i class="fas fa-edit"></i> </a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>

                    </table>
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        Menunggu Pengiriman
                    </div>
                </div>
                <div class="card-body">
                    <table id="example3" class="table table-bordered table-striped text-center">
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
                            @foreach ($jumlahPesananKomplain as $key => $value)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>TRX-{{$value->idtransaksi}}</td>
                                <td>{{$value->status_transaksi}} </td>
                                <td>{{$value->jenis_transaksi}}</td>
                                <td>
                                    {{$value->tipepembayaran_idtipepembayaran}}
                                </td>
                                <td>
                                    Rp. {{number_format($value->nominal_pembayaran)}}
                                </td>
                                <td>
                                    <a href="{{route('merchant.transaksi.detail',$value->idtransaksi)}}" class="btn btn-sm btn-success"> <i class="fas fa-edit"></i> </a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>

                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection