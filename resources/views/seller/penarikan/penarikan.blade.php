@extends('layouts.adminlte')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="card-tittle">
                        Daftar Penarikan Dana
                    </div>
                </div>
                <div class="card-body">
                    <table id="example11" class="table table-bordered table-striped text-center">
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
                                <td>Rp.{{number_format($value->nominal_pembayaran)}}</td>
                                <td>{{$value->status_transaksi}}</td>
                                <td>Belum</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td style="width:5%"></td>
                                <td></td>
                                <td>Total Rp. {{number_format($total)}}</td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    @if($total != 0)
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-penarikan">Tarik Dana</button>
                    @else
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-penarikan" disabled>Tarik Dana</button>
                    @endif

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
                    <table id="example11" class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th style="width:5%">No</th>
                                <th>Tanggal</th>
                                <th>ID Penarikan</th>
                                <th>Total</th>
                                <th>Status Penarikan</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($daftarPenarikan as $key => $value)
                            <tr>
                                <td style="width:5%">{{$key+1}}</td>
                                <td>{{$value->created_at}}</td>
                                <td>{{$value->idpenarikandana}}</td>
                                <td>{{number_format($value->total)}}</td>
                                <td>{{$value->status}}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-success" onclick="loadDetailPenarikan({{$value->idpenarikandana}})"> <i class="fas fa-edit"></i> </button>
                                </td>
                            </tr>
                            @endforeach
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
                <form method="post" action="#">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Pilih Bank</label>
                        <select class="form-control" id="namaBank" name="namaBank" required>
                            <option value="002-PT BANK RAKYAT INDONESIA (PERSERO) Tbk">PT BANK RAKYAT INDONESIA (PERSERO) Tbk</option>
                            <option value="008-PT BANK MANDIRI (PERSERO) Tbk">PT BANK MANDIRI (PERSERO) Tbk</option>
                            <option value="009-PT BANK NEGARA INDONESIA (PERSERO) Tbk">PT BANK NEGARA INDONESIA (PERSERO) Tbk</option>
                            <option value="200-PT BANK TABUNGAN NEGARA (PERSERO) Tbk"> PT BANK TABUNGAN NEGARA (PERSERO) Tbk</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Nomor Rekening</label>
                        <input type="number" class="form-control" id="nomorRekening" name="nomorRekening" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Nama Pemilik Rekening</label>
                        <input type="text" class="form-control" id="namaPemilikRekening" name="namaPemilikRekening" required>
                    </div>
                    <button type="button" class="btn btn-success">Ubah</button>
                </form>
                <br>
                <div id="catatan">

                </div>
                <table class="table table-striped text-center">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">ID Transaksi</th>
                            <th scope="col">Nominal</th>
                        </tr>
                    </thead>
                    <tbody id="daftarTransaksi">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Form Penarikan -->
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
                <form method="post" action="{{route('formrefund.merchant')}}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Pilih Bank</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="namaBank" required>
                            <option value="002-PT BANK RAKYAT INDONESIA (PERSERO) Tbk">PT BANK RAKYAT INDONESIA (PERSERO) Tbk</option>
                            <option value="008-PT BANK MANDIRI (PERSERO) Tbk">PT BANK MANDIRI (PERSERO) Tbk</option>
                            <option value="009-PT BANK NEGARA INDONESIA (PERSERO) Tbk">PT BANK NEGARA INDONESIA (PERSERO) Tbk</option>
                            <option value="200-PT BANK TABUNGAN NEGARA (PERSERO) Tbk"> PT BANK TABUNGAN NEGARA (PERSERO) Tbk</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Nomor Rekening</label>
                        <input type="number" class="form-control" id="exampleFormControlInput1" name="nomorRekening" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Nama Pemilik Rekening</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" name="namaPemilikRekening" required>
                    </div>
                    @foreach ($daftarTransaksi as $value)
                    <input type="hidden" name="idtransaksi[]" value="{{$value->idtransaksi}}">
                    @endforeach
                    <input type="hidden" name="total" value="{{$total}}">

                    <p>Total Penarikan Rp. {{number_format($total)}}</p>
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

    function loadDetailPenarikan(id) {
        $.ajax({
            url: "{{url('seller/penarikan/detail')}}/" + id,
            type: "get",
            success: function(response) {
                $("#catatan").empty();
                $("#daftarTransaksi").empty();
                console.log(response);
                $("#nomorRekening").val(response.detailPenarikan.nomor_rekening);
                $("#namaPemilikRekening").val(response.detailPenarikan.nama_pemilik_rekening);
                $("#namaBank").val(response.detailPenarikan.bank_tujuan).change;
                for (i = 0; i < response.daftarTransaksi.length; i++) {
                    $("#daftarTransaksi").append(
                        '<tr>' +
                        '<th scope="row">' + (i + 1) + '</th>' +
                        '<td>' + response.daftarTransaksi[i].tanggal + '</td>' +
                        '<td>' + response.daftarTransaksi[i].idtransaksi + '</td>' +
                        '<td> Rp. ' + response.daftarTransaksi[i].nominal_pembayaran + '</td>' +
                        '</tr>');
                }
                $("#catatan").append(
                    'Status: <b>' + response.detailPenarikan.status + '</b> <br>'
                );
                $("#catatan").append(
                    'Catatan: <b>' + response.detailPenarikan.catatan + '</b> <br>'
                );
                var srcImage = "{{asset('buktiTransfer')}}/" + response.detailPenarikan.bukti;
                alert(srcImage);
                $("#catatan").append(
                    '<a href="#"> <img src="' + srcImage + '" class="img-thumbnail mx-auto d-block" style="max-width:200px; max-height:200px;"> </a>'
                );

                $("#exampleModal").modal('show');
            },
            error: function(response) {
                console.log(response);
            }
        });
    }
</script>
@endsection

@endsection


@section('name')

@endsection