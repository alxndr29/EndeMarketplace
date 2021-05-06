@extends('layouts.adminlte')
@section('content')
<div class="container-fluid">

    <div class="card">
        <div class="card-header">
            Daftar Transaksi
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true">Semua</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-content-below-messages-tab" data-toggle="pill" href="#custom-content-below-messages" role="tab" aria-controls="custom-content-below-messages" aria-selected="false">Messages</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-content-below-settings-tab" data-toggle="pill" href="#custom-content-below-settings" role="tab" aria-controls="custom-content-below-settings" aria-selected="false">Settings</a>
                </li>
            </ul>
            <div class="tab-content" id="custom-content-below-tabContent">
                <div class="tab-pane fade show active" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                    <div class="row pt-3">
                        <div class="col-6">

                        </div>
                        <div class="col-2">
                            <input class="form-control" type="date" value="2011-08-19" id="tanggalAwal">
                        </div>
                        <div class="col-2">
                            <input class="form-control" type="date" value="2011-08-19" id="tanggalAkhir">
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn btn-block btn-default" id="btnFilter">Filter Tanggal</button>
                        </div>
                    </div>
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
                <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                    Mauris tincidunt mi at erat gravida, eget tristique urna bibendum. Mauris pharetra purus ut ligula tempor, et vulputate metus facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas sollicitudin, nisi a luctus interdum, nisl ligula placerat mi, quis posuere purus ligula eu lectus. Donec nunc tellus, elementum sit amet ultricies at, posuere nec nunc. Nunc euismod pellentesque diam.
                </div>
                <div class="tab-pane fade" id="custom-content-below-messages" role="tabpanel" aria-labelledby="custom-content-below-messages-tab">
                    Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna.
                </div>
                <div class="tab-pane fade" id="custom-content-below-settings" role="tabpanel" aria-labelledby="custom-content-below-settings-tab">
                    Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
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

        var url = "{{route('merchant.transaksi.index.filter',['tanggalAwal' => 'first' ,'tanggalAkhir'=> 'second' ])}}";
        url = url.replace('first', tglawal);
        url = url.replace('second', tglakhir);
        location.href = url;
    });
</script>
@endsection

@endsection