@extends('layouts.adminlte')
@section('content')
<div class="container-fluid">

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-4">
                    Daftar Transaksi
                </div>
                <div class="col-2">
                    <select class="form-control" id="status">
                        <option value="pilih">Pilih...</option>
                        <option value="MenungguPembayara">Menunggu Pembayaran</option>
                        <option value="MenungguKonfirmasi">Menunggu Konfirmasi</option>
                        <option value="PesananDiproses">Pesanan Diproses</option>
                        <option value="PesananDikirim">Pesanan Dikirim</option>
                        <option value="Selesai">Selesai</option>
                        <option value="Batal">Batal</option>
                    </select>
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
        </div>
        <div class="card-body">
            <!-- <div class="row pt-3">

            </div> -->
            <div class="row p-3">
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
                            @foreach ($transaksi as $key => $value)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>TRX-{{$value->idtransaksi}}</td>
                                <td>{{$value->status_transaksi}} </td>
                                <td>{{$value->jenis_transaksi}}</td>
                                <td>
                                    {{$value->tipe_pembayaran}}
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
        <div class="card-footer">

        </div>
    </div>

</div>

@section('js')
<script type="text/javascript">
    $(document).ready(function() {
        @if(session('berhasil'))
        //toastr.success('{{session('berhasil')}}');
        // alert('{{session('
        //     berhasil ')}}');
        // @endif

    });
    $("#btnFilter").click(function() {
        var tglawal = $('#tanggalAwal').val();
        var tglakhir = $('#tanggalAkhir').val();
        var status = $('#status').val();
        var url = "{{route('merchant.transaksi.index.filter',['tanggalAwal' => 'first' ,'tanggalAkhir'=> 'second', 'status' => 'third' ])}}";
        if ($('#tanggalAwal').val() == "") {
            url = url.replace('first', null);
        } else {
            url = url.replace('first', tglawal);
        }
        if ($('#tanggalAkhir').val() == "") {
            url = url.replace('second', null);
        } else {
            url = url.replace('second', tglakhir);
        }
        url = url.replace('third', status);
        location.href = url;
    });
</script>
@endsection

@endsection