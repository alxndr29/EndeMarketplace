@extends('layouts.adminlte')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            id pengiriman = {{$data->idpengiriman}}
            <br>
            tanggal pengiriman = {{$data->tanggal_pengiriman}}
            <br>
            biaya pengiriman = {{$data->biaya_pengiriman}}
            <br>
            nomor resi = {{$data->nomor_resi}}
            <br>
            status pengiriman = {{$data->status_pengiriman}}
            <br>
            keterangan pengiriman = {{$data->idpengiriman}}
            <br>
            id pengiriman = {{$data->keterangan}}
            <br>
            kurir idkurir = {{$data->kurir_idkurir}}
            <br>
            transaksi idtransaksi = {{$data->transaksi_idtransaksi}}
            <br>
            id data pengiriman = {{$data->iddatapengiriman}}
            <br>
            koor asal = {{$data->koordinat_asal}}
            <br>
            koor tujuan = {{$data->koordinat_tujuan}}
            <br>
            status = {{$data->status}}
            <br>
            pengiriman id pengiriman = {{$data->pengiriman_idpengiriman}}
            <br>
            tipepembayaran = {{$data->tipepembayaran}}
            <br>

            <a href="https://www.google.com/maps/search/?api=1&query={{$data->koordinat_asal}}">Gmaps</a>
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

        /*
        var counter = 0;
        var timer = setInterval(function() {
            counter++;
            alert(counter);
            if (counter >= 10) {
                clearInterval(timer)
            }
        }, 3000);
        */
    });
</script>
@endsection

@endsection