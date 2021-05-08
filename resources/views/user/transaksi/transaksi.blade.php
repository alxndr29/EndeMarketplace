@extends('layouts.userlte')
@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            Daftar Transaksi
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
                    @foreach ($transaksi as $key => $value)
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <p>
                                            <b>{{$value->nama_merchant}}</b> || ID Transaksi: {{$value->idtransaksi}} || Tanggal: {{$value->tanggal}}
                                        </p>
                                    </div>
                                    <div class="row">
                                        <div class="col-1">
                                            <img style="width:75px;height:100px;" class="rounded pt-3" alt="..." src="{{asset('gambar/'.$value->gambar.'.jpg')}}">
                                        </div>
                                        <div class="col-6">
                                            <b> {{$value->nama_produk}} </b>
                                            <br>
                                            {{$value->jumlah}} barang Rp.{{number_format($value->total_harga)}}
                                            <br>
                                            + {{$value->totalbarang}} lainnya.
                                        </div>
                                        <div class="col-5">
                                            <b> <span class="badge bg-primary">{{$value->status_transaksi}}</span> </b>
                                            <br>
                                            Total Belanja:
                                            <br>
                                            <b> Rp. {{number_format($value->nominal_pembayaran)}} </b>
                                            <br>
                                            <button type="submit" class="btn btn-success" style="margin-right: 5px;" data-toggle="modal" data-target="#exampleModalCenter">
                                                Detail Transaksi
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach


                </div>
                <div class="card-footer">
                    <div class="d-flex">
                        <div class="mx-auto">
                            {{ $transaksi->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        Nomor Transaksi:
                        <br>
                        <b> TRX-00123981</b>
                        <br>
                        Status:
                        <br>
                        <b> Pesanan Selesai</b>
                        <br>
                        Nama Toko:
                        <br>
                        <b> Merchant Evant</b>
                        <br>
                        Tanggal Pembelian:
                        <br>
                        <b> 17 Apr 2021, 10:28</b>
                    </div>
                    <div class="col border-left ">
                        <div class="row p-1">
                            <button type="submit" class="btn btn-success text-right" style="margin-right: 5px;" data-toggle="modal" data-target="#exampleModalCenter">
                                Detail Transaksi
                            </button>
                        </div>
                        <div class="row p-1">
                            <button type="submit" class="btn btn-success" style="margin-right: 5px;" data-toggle="modal" data-target="#exampleModalCenter">
                                Detail Transaksi
                            </button>
                        </div>
                        <div class="row p-1">
                            <button type="submit" class="btn btn-success" style="margin-right: 5px;" data-toggle="modal" data-target="#exampleModalCenter">
                                Detail Transaksi
                            </button>
                        </div>

                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        Daftar Produk
                        <br>
                        <div class="row">
                            <div class="col-3">
                                <img style="width:75px;height:100px;" class="rounded pt-3" alt="..." src="http://localhost:8000/gambar/18.jpg">
                            </div>
                            <div class="col">
                                <b> AVOMETER DIGITAL ZOTEK ZT98 / MULTITESTER DIGITAL ZT98ORIGINAL </b>
                                <br>
                                1 barang x Rp112.500
                            </div>
                        </div>
                    </div>
                    <div class="col border-left">
                        Harga Barang
                        <br>
                        Rp. 270.000
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-6 border-left">
                        Pengiriman:
                        <br>
                        <b> AnterAja - Reguler (Estimasi tiba 19 - 21 Apr) </b>
                        <br>
                        No. Resi: 10001126706829
                        <br>
                        Dikirim kepada <b>SINJAI</b> ENDE (evan)
                        <br>
                        Ekspedisi Alam Jaya - Ruko Sulung Mas Blok A No 15 . Jln Sulung No. 89 Telp. 031 3524553
                        Krembangan Kota Surabaya, 60175
                        <br>
                        Jawa Timur
                        <br>
                        Telp: 62313524553
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <b> Pembayaran </b>
                        <br>
                        Total Harga (1 barang)
                        <br>
                        Total Ongkos Kirim (970 gr)
                        <br>
                        Total Bayar
                        <br>
                        Metode Pembayaran
                    </div>
                    <div class="col border-left">
                        <br>
                        Rp 270.000
                        <br>
                        Bebas Ongkir
                        <br>
                        Rp. 270.000
                        <br>
                        Jenius Pay
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

@section('js')
<script type="text/javascript">
    // $(document).ready(function() {
    //     alert('hello world!');
    // });
</script>
@endsection
@endsection