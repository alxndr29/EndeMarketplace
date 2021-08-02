@extends('layouts.adminlte')
@section('content')
<div class="container-fluid">

    <!-- <div class="card">
        <div class="card-header">
            Daftar Transaksi
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <b>Data Transaksi</b>
                    <br> ID Transaksi: TRX-{{$transaksi->idtransaksi}}
                    <br> Tanggal Transaksi:
                    <br> Status Transaksi: {{$transaksi->status_transaksi}}
                    <br> Jenis Transaksi: {{$transaksi->jenis_transaksi}}
                    <br> Nominal Pembayaran: {{$transaksi->nominal_pembayaran}}
                    <br> Tipe Pembayaran: {{$transaksi->tipe_pembayaran}}
                    <br> Tipe Pengiriman: {{$transaksi->nama_kurir}}
                </div>
                <div class="col">
                    <b>Alamat Pengiriman</b>
                    <br> Nama Penerima: {{$alamatPengiriman->nama_penerima}}
                    <br> Alamat Lengkap: {{$alamatPengiriman->alamatlengkap}}
                    <br> Telepon: {{$alamatPengiriman->telepon}}
                    <br> Kode Pos: {{$alamatPengiriman->kode_pos}}
                    <br> Kabupaten Kota: {{$alamatPengiriman->nama_kota}}
                    <br> Provinsi: {{$alamatPengiriman->nama_provinsi}}
                </div>
            </div>
            <br>
            <b>Daftar Produk</b>
            <div class="row">
                @foreach ($daftarProduk as $key => $value)
                <div class="col-4 border">
                    <div class="row">
                        <div class="col-4">
                            <img style="width:150px;height:150px;" class="rounded mx-auto d-block pt-3 img-fluid" alt="..." src="{{asset('gambar/'.$value->gambar.'.jpg')}}">
                        </div>
                        <div class="col-8">
                            <b>{{$value->nama_produk}}</b>
                            <br> Rp. {{number_format($value->total_harga/$value->jumlah)}}-,
                            <br> Jumlah: {{$value->jumlah}} pcs
                            <br> Total: Rp. {{number_format($value->total_harga)}}-,
                            <br> Catatan: {{$value->catatan}}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <br>
            <div class="row">
                <div class="col">
                    <button type="button" class="btn btn-block btn-danger">Batalkan Transaksi</button>
                </div>
                <div class="col">
                    <button type="button" class="btn btn-block btn-success">Proses Transaksi</button>
                </div>
            </div>
        </div>
        <div class="card-footer">

        </div>
    </div> -->

    <div class="row">
        <div class="col-12">
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
                <!-- title row -->
                <div class="row">
                    <div class="col-12">
                        <h4>
                            <i class="fas fa-globe"></i> Nama Merchant
                            <small class="float-right">Tanggal: {{$transaksi->tanggal}}</small>
                        </h4>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        Kepada
                        <address>
                            <strong>Penerima: {{$alamatPengiriman->nama_penerima}}</strong><br>
                            Alamat: {{$alamatPengiriman->alamatlengkap}}<br>
                            Telp: {{$alamatPengiriman->telepon}}<br>
                            Kode Pos: {{$alamatPengiriman->kode_pos}}<br>
                            {{$alamatPengiriman->nama_kota}} - {{$alamatPengiriman->nama_provinsi}}
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        <b>ID Transaksi: TRX-{{$transaksi->idtransaksi}}</b><br>
                        <br>
                        Status Transaksi: <b> {{$transaksi->status_transaksi}} </b>
                        <br>
                        Tipe Pembayaran: {{$transaksi->tipe_pembayaran}}
                        <br>
                        Tanggal Pembayaran:
                        <br>
                        <!-- <b>Account:</b> 968-34567 -->
                    </div>
                    <div class="col-sm-4 invoice-col">
                        @if($transaksi->status_transaksi != "MenungguKonfirmasi" && $transaksi->status_transaksi != "PesananDiproses" && $transaksi->status_transaksi != "MenungguPembayaran")
                        Nama Kurir: {{$transaksi->nama_kurir}}
                        <br>
                        Tanggal Pengiriman: {{$transaksi->tanggal_pengiriman}}
                        <br>
                        Nomor Resi:
                        <form method="post" action="{{route('merchant.transaksi.update',[$transaksi->idtransaksi,'UpdateResi'])}}">
                            @csrf
                            @method('put')
                            <div class="input-group mb-3">
                                <input type="text" class="form-control form-control-sm" value="{{$transaksi->nomor_resi}}" name="updateResi">
                                <button type="submit" class="btn btn-danger btn-sm" style="margin-right: 5px;">
                                    Ubah
                                </button>
                                <a href="https://cekresi.com/?noresi={{$transaksi->nomor_resi}}" class="btn btn-success btn-sm">Lacak</a>
                            </div>
                        </form>
                        @else
                        Nama Kurir: {{$transaksi->nama_kurir}}
                        <br>
                        Tanggal Pengiriman: {{$transaksi->tanggal_pengiriman}}
                        <br>
                        Nomor Resi:
                        <form method="post" action="{{route('merchant.transaksi.update',[$transaksi->idtransaksi,'UpdateResi'])}}">
                            @csrf
                            @method('put')
                            <div class="input-group mb-3">
                                <input type="text" class="form-control form-control-sm" value="{{$transaksi->nomor_resi}}" name="updateResi" disabled>
                                <button type="submit" class="btn btn-danger btn-sm" style="margin-right: 5px;" disabled>
                                    Ubah
                                </button>
                                <a href="https://cekresi.com/?noresi={{$transaksi->nomor_resi}}" class="btn btn-success btn-sm disabled">Lacak</a>
                            </div>
                        </form>
                        @endif
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- Table row -->
                <div class="row">
                    <div class="col-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Gambar</th>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Subtotal</th>
                                    <th>Catatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($daftarProduk as $key => $value)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>
                                        <img style="width:75px;height:75px;" class="rounded" src="{{asset('gambar/'.$value->gambar.'.jpg')}}">
                                    </td>
                                    <td>{{$value->nama_produk}}</td>
                                    <td>Rp. {{number_format($value->total_harga/$value->jumlah)}}-</td>
                                    <td>{{$value->jumlah}} pcs</td>
                                    <td>Rp. {{number_format($value->total_harga)}}-</td>
                                    <td>{{$value->catatan}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <div class="row">
                    <!-- accepted payments column -->
                    <div class="col-6">

                    </div>
                    <!-- /.col -->
                    <div class="col-6">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th style="width:50%">Total Belanja:</th>
                                    <td>Rp. {{number_format($transaksi->nominal_pembayaran - $transaksi->biaya_pengiriman)}}</td>
                                </tr>
                                <tr>
                                    <th>Biaya Pengiriman:</th>
                                    <td>Rp. {{number_format($transaksi->biaya_pengiriman)}} - <b> {{$transaksi->nama_kurir}} </b></td>
                                </tr>
                                <tr>
                                    <th>Total Pembayaran:</th>
                                    <td>Rp. {{number_format($transaksi->nominal_pembayaran)}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- this row will not appear when printing -->
                <div class="row no-print">
                    <div class="col-12">
                        @if($transaksi->status_transaksi == "MenungguKonfirmasi")
                        <form method="post" action="{{route('merchant.transaksi.update',[$transaksi->idtransaksi,'PesananDiproses'])}}">
                            @csrf
                            @method('put')
                            <button type="submit" class="btn btn-success float-right">
                                <i class="far fa-credit-card"></i>
                                Proses Transaksi
                            </button>
                        </form>
                        <form method="post" action="{{route('merchant.transaksi.update',[$transaksi->idtransaksi,'Batal'])}}">
                            @csrf
                            @method('put')
                            <button type="submit" class="btn btn-danger float-right" style="margin-right: 5px;">
                                <i class="fas fa-download"></i> Batalkan Transaksi
                            </button>
                        </form>
                        @elseif($transaksi->status_transaksi == "PesananDiproses")

                            @if($transaksi->nama_kurir == "JNE")
                            <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#modal-default-jne">
                                Masukan Nomor Resi Pengiriman
                            </button>
                            @else
                            <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#modal-default-kurir">
                                Plot Jadwal Pengiriman
                            </button>
                            @endif

                        @else

                        @endif
                        <button type="submit" class="btn btn-warning float-right" style="margin-right: 5px;" data-toggle="modal" data-target="#modal-chatpembeli">
                            <i class="fas fa-download"></i>Hubungi Pembeli
                        </button>
                    </div>
                </div>
            </div>
            <!-- /.invoice -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</div>

<div class="modal fade" id="modal-default-jne">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Kurir JNE</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('merchant.transaksi.update',[$transaksi->idtransaksi,'PesananDikirim'])}}">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nomor Resi</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan Resi" name="nomorResi" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tanggal Pengiriman</label>
                        <input class="form-control" type="date" id="example-date-input" name="tanggalPengiriman" required>
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="submit" class="btn btn-primary">Simpan Resi</button>
                </form>
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-default-kurir">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Kurir Merhcnat</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('merchant.transaksi.update',[$transaksi->idtransaksi,'PesananDikirim'])}}">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nomor Resi</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan Resi" name="nomorResi" required value="KM-{{ date('Ymd-His') }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tanggal Pengiriman</label>
                        <input class="form-control" type="date" id="example-date-input" name="tanggalPengiriman" required>
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="submit" class="btn btn-primary">Plot Jadwal</button>
                </form>
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-chatpembeli">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pesan ke Pembeli</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Kirim ke: <span class="badge badge-secondary">{{$transaksi->nama_user}}</span></p>
                <div class="form-group">
                    <textarea class="form-control" name="pesan" id="txtpesan" rows="3">Transaksi ID: </textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" id="kirimPesan" class="btn btn-primary">Kirim</button>
            </div>

        </div>
    </div>
</div>
@section('js')
<script type="text/javascript">
    $(document).ready(function() {
        @if(session('berhasil'))
        //toastr.success('{{session('berhasil')}}');
        //alert('{{session('berhasil')}}');
        Swal.fire(
            'Berhasil!',
            '{{session("berhasil")}}',
            'success'
        )
        @endif

    });
    $("#kirimPesan").click(function() {
        var pesan = $("#txtpesan").val();
        var iduser = "{{$transaksi->users_iduser}}";
        $.ajax({
            url: "{{route('obrolan.seller.store')}}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                "subject": "cobasubject",
                "isipesan": pesan,
                "iduser": iduser
            },
            success: function(response) {
                if (response.status == "berhasil") {
                    alert('Pesan berhasil dikirim');
                    $("#modal-chatpembeli").modal('hide');
                }
            },
            error: function(response) {
                console.log(response);
            }
        });
    });
</script>
@endsection

@endsection