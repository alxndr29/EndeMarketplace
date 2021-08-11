@extends('layouts.userlte')
@section('content')
<div class="container">

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="card-tittle">
                        Daftar Penarikan Dana
                    </div>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th style="width:5%">No</th>
                                <th>ID Transaksi</th>
                                <th>Jumlah</th>
                                <th>Status Transaksi</th>
                                <th>Sudah dikembalikan? </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($daftarTransaksi as $key => $value)
                            <tr>
                                <td style="width:5%">{{$key+1}}</td>
                                <td>{{$value->idtransaksi}}</td>
                                <td>Rp. {{number_format($value->nominal_pembayaran)}}</td>
                                <td>{{$value->status_transaksi}}</td>
                                <td>Belum</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-penarikan">Tarik Dana</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="card-tittle">
                        Riwayat Pengembalian Dana
                    </div>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th style="width:5%">No</th>
                                <th>ID Penarikan</th>
                                <th>Total</th>
                                <th>Status Penarikan</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="width:5%">1</td>
                                <td>213123</td>
                                <td>Rp. 10000</td>
                                <td>Menunggu</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#exampleModal"> <i class="fas fa-edit"></i> </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Penarikan -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Penarikan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Detail Penarikan -->
<div class="modal fade" id="modal-penarikan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Penarikan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('formrefund.user')}}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Email address</label>
                        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Email address</label>
                        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Email address</label>
                        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                    </div>
                    <button type="submit" class="btn btn-sm btn-success">Submit</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@section('js')
<script type="text/javascript">
    $(document).ready(function() {
        // @if(session('berhasil'))
        // alert("{{session('berhasil')}}");
        // @endif

        @if(session("berhasil"))
        Swal.fire(
            'Berhasil!',
            '{{session("berhasil")}}',
            'success'
        )
        @endif
        @if(session("gagal"))
        Swal.fire(
            'Gagal!',
            '{{session("gagal")}}',
            'error'
        )
        @endif
    });
</script>
@endsection
@endsection

@section('breadcrumb')
<li class="breadcrumb-item active">Penarikan</li>
@endsection