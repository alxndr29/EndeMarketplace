@extends('layouts.userlte')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">CPU Traffic</span>
                    <span class="info-box-number">
                        10
                        <small>%</small>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Likes</span>
                    <span class="info-box-number">41,410</span>
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
                    <span class="info-box-text">Sales</span>
                    <span class="info-box-number">760</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">New Members</span>
                    <span class="info-box-number">2,000</span>
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
                    @if(count($transaksi) == 0)
                    <p class="text-center"> Belum ada data transaksi.</p>
                    @else
                    @foreach ($transaksi as $key => $value)
                    @if(isset($awal))
                    @endif
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
                                            <img style="width:75px;height:100px;" class="rounded" alt="..." src="{{asset('gambar/'.$value->gambar.'.jpg')}}">
                                        </div>
                                        <div class="col-6">
                                            <b> {{$value->nama_produk}} </b>
                                            <br>
                                            {{$value->jumlah}} barang Rp.{{number_format($value->total_harga)}}
                                            <br>
                                            + {{$value->totalbarang}} lainnya.
                                        </div>
                                        <div class="col-5">
                                            <b>
                                                @if($value->status_transaksi == "Batal")
                                                <span class="badge bg-danger">
                                                    {{$value->status_transaksi}}
                                                </span>
                                                @else
                                                <span class="badge bg-primary">
                                                    {{$value->status_transaksi}}
                                                </span>
                                                @endif
                                            </b>

                                            <br>
                                            Total Belanja:
                                            <br>
                                            <b> Rp. {{number_format($value->nominal_pembayaran)}} </b>
                                            <br>
                                            <!-- <button type="submit" class="btn btn-success" style="margin-right: 5px;" data-toggle="modal" data-target="#exampleModalCenter">
                                                Detail Transaksi
                                            </button> -->
                                            <button type="button" class="btn btn-success" style="margin-right: 5px;" onClick="test({{$value->idtransaksi}})">
                                                Detail Transaksi
                                            </button>

                                            @if($value->status_transaksi != "MenungguKonfirmasi" && $value->status_transaksi != "MenungguPembayaran" && $value->status_transaksi != "PesananDiproses" && $value->status_transaksi != "Batal" )
                                            @if($value->idkurir == "1")
                                            <a href="https://cekresi.com/?noresi={{$value->nomorresi}}" class="btn btn-success" style="margin-right: 5px;">
                                                Lacak
                                            </a>
                                            @else
                                            <a href="{{route('pelanggan.transaksi.tracking',[$value->idpengiriman,$value->idtransaksi,'Pelanggan'])}}" class="btn btn-success" style="margin-right: 5px;">
                                                Lacak
                                            </a>
                                            @endif
                                            @endif

                                            @if($value->status_transaksi == "SampaiTujuan")
                                            <a href="{{route('pelanggan.transaksi.selesai',$value->idtransaksi)}}" class="btn btn-success" style="margin-right: 5px;">
                                                Selesai
                                            </a>
                                            @endif

                                            @if($value->idkurir == "1" && $value->status_transaksi == "PesananDikirim")
                                            <a href="{{route('pelanggan.transaksi.selesai',$value->idtransaksi)}}" class="btn btn-success" style="margin-right: 5px;">
                                                Terima Paket
                                            </a>
                                            @endif

                                            @if($value->status_transaksi == "MenungguPembayaran")
                                            <button onClick="bayar({{$value->idtransaksi}})" class="btn btn-success" style="margin-right: 5px;">
                                                Bayar
                                            </button>
                                            @endif

                                            @if($value->status_transaksi == "MenungguKonfirmasi")
                                            <a href="{{route('pelanggan.transaksi.batal',$value->idtransaksi)}}" class="btn btn-danger" style="margin-right: 5px;">
                                                Batalkan Pesanan
                                            </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
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
<div class="modal fade" id="modaldetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Detail Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col" id="modal-transaksi">
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
                            <button type="submit" id="buttonReview" class="btn btn-success text-right" style="margin-right: 5px;">
                                Tulis Review
                            </button>
                        </div>

                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col" id="modal-daftarproduk">
                        Daftar Produk
                        <br>
                        <div class="row">
                            <div class="col-3">
                                <!-- <img style="width:75px;height:100px;" class="rounded pt-3" alt="..." src="http://localhost:8000/gambar/18.jpg"> -->
                            </div>
                            <div class="col">
                                <b> AVOMETER DIGITAL ZOTEK ZT98 / MULTITESTER DIGITAL ZT98ORIGINAL </b>
                                <br>
                                1 barang x Rp112.500
                            </div>
                        </div>
                    </div>
                    <div class="col border-left">
                        Total Belanja Produk:
                        <br>
                        <div id="modal-totalproduk">
                            Rp. 50,000
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-6 border-left" id="modal-pengiriman-alamat">
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
                        Total Harga:
                        <br>
                        Total Ongkos Kirim:
                        <br>
                        Total Bayar
                        <br>
                        Metode Pembayaran
                    </div>
                    <div class="col border-left" id="pembayaran">
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalreview">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Review Produk</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{route('pelanggan.transaksi.review')}}">
                @csrf
                <div class="modal-body" id="daftarProdukReview">
                    <!-- <div class="row">
                        <div class="col-3">
                            <img style="width:75px;height:100px;" class="rounded pt-3" alt="..." src="http://localhost:8000/gambar/18.jpg">
                        </div>
                        <div class="col">
                            <b> AVOMETER DIGITAL ZOTEK ZT98 / MULTITESTER DIGITAL ZT98ORIGINAL </b>
                        </div>
                    </div> -->
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>



@section('js')
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-ZXG2YBvaF0n8pvHq"></script>
<script type="text/javascript">
    $(document).ready(function() {
        // alert('hello world!');
        @if(session('berhasil'))
        //toastr.success('{{session('berhasil')}}');
        alert('{{session('berhasil')}}');
        @endif
    });
    $("#btnFilter").click(function() {
        var tglawal = $('#tanggalAwal').val();
        var tglakhir = $('#tanggalAkhir').val();
        var url = "{{route('pelanggan.transaksi.index.filter',['tanggalAwal' => 'first' ,'tanggalAkhir'=> 'second' ])}}";
        url = url.replace('first', tglawal);
        url = url.replace('second', tglakhir);
        location.href = url;
    });
    $("#buttonReview").click(function() {
        $("#modaldetail").modal('hide');
        $("#modalreview").modal('show');
    });

    function bayar(id) {
        $.ajax({
            url: "{{url('midtrans/getToken')}}/" + id,
            type: 'GET',
            success: function(response) {
                console.log(response);
                snap.pay(response, {
                    onSuccess: function(result) {
                        console.log('success');
                        console.log(result);
                    },
                    onPending: function(result) {
                        console.log('pending');
                        console.log(result);
                    },
                    onError: function(result) {
                        console.log('error');
                        console.log(result);
                    },
                    onClose: function() {
                        console.log('customer closed the popup without finishing the payment');
                    }
                })
            },
            error: function(response) {
                console.log(response);
            }
        });
    }

    function test(id) {
        // $('#myModal').modal('toggle');
        // $('#myModal').modal('show');
        // $('#myModal').modal('hide');
        //alert(id);
        $.ajax({
            url: "{{url('user/transaksi/detail')}}/" + id,
            type: 'GET',
            success: function(response) {
                console.log(response.produk);
                console.log(response.transaksi);
                console.log(response.alamat);
                console.log(response.pembayaran);
                console.log(response.hitungReview);

                $("#buttonReview").prop("disabled", true);
                if (response.hitungReview == 0 && response.transaksi[0].status_transaksi == "Selesai") {
                    $("#buttonReview").prop("disabled", false);
                }

                //alert(response.produk[0].idalamat);
                $("#modal-transaksi").html(
                    'Nomor Transaksi:' +
                    '<br>' +
                    '<b> TRX-' + response.transaksi[0].idtransaksi + '</b>' +
                    '<br>' +
                    'Status:' +
                    '<br>' +
                    '<b>' + response.transaksi[0].status_transaksi + '</b>' +
                    '<br>' +
                    'Nama Merchant:' +
                    '<br>' +
                    '<b>' + response.transaksi[0].nama_merchant + '</b>' +
                    '<br>' +
                    'Tanggal Pembelian:' +
                    '<br>' +
                    '<b>' + response.transaksi[0].tanggal + '</b>'
                );

                var tanggal = "";
                var noresi = "";
                if (response.alamat[0].tanggal_pengiriman == null) {
                    tanggal = " - ";
                } else {
                    tanggal = response.alamat[0].tanggal_pengiriman;
                }
                if (response.alamat[0].nomor_resi == null) {
                    noresi = " - ";
                } else {
                    noresi = response.alamat[0].nomor_resi;
                }
                $("#modal-pengiriman-alamat").html(
                    'Pengiriman:' +
                    '<br>' +
                    '<b>' + response.alamat[0].keterangan + '</b>' +
                    '<br> Estimasi: ' + response.alamat[0].estimasi +
                    ' Hari <br> Tanggal Pengiriman: ' + tanggal +
                    '<br>' +
                    'No. Resi: <b>' + noresi +
                    '</b>' +
                    '<br> Status Pengiriman: ' + response.alamat[0].status_pengiriman +
                    '<br> Dikirim kepada: <b>' + response.alamat[0].nama_penerima +
                    '</b> <br>' +
                    response.alamat[0].alamatlengkap +
                    '<br>' +
                    response.alamat[0].nama + ', ' + response.alamat[0].kodepos +
                    '<br>' +
                    response.alamat[0].nama_provinsi +
                    '<br>' +
                    'Telp: ' + response.alamat[0].telepon
                );

                $("#modal-daftarproduk").empty();
                $("#daftarProdukReview").empty();
                var totalBelanjaProduk = 0;
                for (i = 0; i < response.produk.length; i++) {
                    var src = "src=" + "{{asset('/')}}" + "gambar/" + response.produk[i].gambar_produk + '.jpg';
                    var url = "{{asset('/')}}" + "user/produk/show/" + response.produk[i].produk_idproduk;
                    var catatan = "";
                    if (response.produk[i].catatan == null) {
                        catatan = "-";
                    } else {
                        catatan = response.produk[i].catatan;
                    }
                    $("#modal-daftarproduk").append('<div class="row">' +
                        '<div class="col-3">' +
                        '<img style="width:75px;height:100px;" class="rounded" ' + src + '>' +
                        '</div>' +
                        '<div class="col">' +
                        '<b> ' + response.produk[i].nama_produk + ' </b>' +
                        '<br>' +
                        response.produk[i].jumlah + ' barang x Rp.' + response.produk[i].total_harga / response.produk[i].jumlah +
                        '<br> Sub Total: Rp. ' + response.produk[i].total_harga +
                        '<br> Catatan: ' + catatan +
                        '</div>' +
                        '</div>'
                    );
                    totalBelanjaProduk += response.produk[i].total_harga;
                    $("#daftarProdukReview").append(
                        '<div class="row">' +
                        '<div class="col-3">' +
                        '<img style="width:75px;height:100px;" class="rounded" ' + src + '>' +
                        '</div>' +
                        '<div class="col">' +
                        '<b> ' + response.produk[i].nama_produk + ' </b>' +
                        '<br>' +
                        'Catatan: ' + catatan +
                        '<div class="form-group"> <div class="row"> <div class="col-8"> ' + '<input type="text" placeholder="komentar produk"class="form-control" name=komentarproduk[' + response.produk[i].produk_idproduk + ']> </div>' + '<div class="col"> <input type="number" placeholder="rating" class="form-control" name=ratingproduk[' + response.produk[i].produk_idproduk + ']>' + '</div> </div> </div>' +

                        '</div>' +
                        '</div>' +
                        '<input type="hidden" name="idtransaksi" value=' + response.transaksi[0].idtransaksi + '>'
                    );
                }

                $("#pembayaran").html(
                    '<br> Rp. ' + (response.pembayaran[0].nominal_pembayaran - response.pembayaran[0].biaya_pengiriman) +
                    '<br> Rp. ' + response.pembayaran[0].biaya_pengiriman +
                    '<br> Rp. ' + response.pembayaran[0].nominal_pembayaran +
                    '<br> ' + response.pembayaran[0].namatipepembayaran
                );
                $("#modal-totalproduk").html('Rp. ' + totalBelanjaProduk)
                $("#modaldetail").modal('show');
            },
            error: function(response) {
                console.log(response);
            }
        });
    }
</script>
@endsection
@endsection

@section('breadcrumb')
<li class="breadcrumb-item active">Transaksi</li>
@endsection