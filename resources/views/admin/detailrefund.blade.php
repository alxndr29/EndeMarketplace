<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Administrator</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('adminlte/dist/css/adminlte.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/toastr/toastr.min.css')}}">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Utama</a>
                </li>
            </ul>


        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{route('home.admin')}}" class="brand-link">
                <img src="{{asset('adminlte/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Ende's Market</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{asset('adminlte/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Administrator</a>
                        <a class="d-block" href="{{route('admin.logout')}}">
                            Logout
                        </a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                        <li class="nav-item">
                            <a href="{{route('refund.admin')}}" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>
                                    Daftar Refund
                                </p>
                            </a>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Detail Penarikan Dana</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item">Starter Page</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <!-- Main content -->
                            <div class="invoice p-3 mb-3">
                                <!-- title row -->
                                <!-- <div class="row">
                                    <div class="col-12">
                                        <h4>
                                            <small class="float-left">Detail Penarikan Dana</small>
                                        </h4>
                                    </div>
                                </div> -->
                                <div class="row invoice-info">
                                    <div class="col-sm-4 invoice-col">
                                        ID Penarikan Dana: {{$detailPenarikan->idpenarikandana}}
                                        <br>
                                        Tanggal: <b> {{$detailPenarikan->created_at}} </b>
                                        <br>
                                        Bank Tujuan: <b>{{$detailPenarikan->bank_tujuan}}</b>
                                        <br>
                                        Nomor Rekening: <b>{{$detailPenarikan->nomor_rekening}}</b>
                                        <br>
                                        Nama Pemilik Rekening: <b>{{$detailPenarikan->nama_pemilik_rekening}}</b>
                                        <br>
                                        Status: <b>{{$detailPenarikan->status}}</b>
                                    </div>
                                    <div class="col-sm-4 invoice-col">
                                        <b>Data Pemohon: </b>
                                        <br>
                                        Nama: <b>{{$detailPenarikan->name}}</b>
                                        <br>
                                        Email: <b>{{$detailPenarikan->email}}</b>
                                        <br>
                                        Telp: <b>{{$detailPenarikan->telepon}}</b>
                                    </div>
                                    <div class="col-sm-4 invoice-col">
                                        <b> Bukti Transfer: </b>
                                        <br>
                                        @if(isset($detailPenarikan->bukti))
                                            <a href="{{asset('buktiTransfer/'.$detailPenarikan->bukti)}}">
                                                <img src="{{asset('buktiTransfer/'.$detailPenarikan->bukti)}}" class="img-thumbnail" alt="Responsive image" style="width:200px; height:200px;">
                                            </a>
                                        @else
                                        @endif

                                    </div>
                                </div>

                                <!-- Table row -->
                                <div class="row pt-3">
                                    <div class="col-12 table-responsive">
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
                                                @foreach ($daftarTransaksi as $key => $value)
                                                <tr>
                                                    <th scope="row">{{$key + 1}}</th>
                                                    <td>{{$value->tanggal}}</td>
                                                    <td>{{$value->idtransaksi}}</td>
                                                    <td> Rp. {{number_format($value->nominal_pembayaran)}}</td>
                                                </tr>
                                                @endforeach
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th style="width:50%">Total Belanja:</th>
                                                    <td>Rp.{{number_format($detailPenarikan->total)}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->


                                <!-- this row will not appear when printing -->

                                <div class="row">
                                    <div class="col-12">
                                        @if ($detailPenarikan->status == "Menunggu")
                                        <form method="post" action="{{route('refundstatus.admin',[$detailPenarikan->idpenarikandana,'Diproses'])}}">
                                            @csrf
                                            <button type="submit" class="btn btn-success" style="margin-right: 5px;">
                                                <i class="fas fa-download"></i>Proses
                                            </button>
                                        </form>
                                        @elseif ($detailPenarikan->status == "Diproses" || $detailPenarikan->status == "Gagal")
                                        <div class="row">
                                            <div class="col-2">
                                                <form method="post" action="{{route('refundstatus.admin',[$detailPenarikan->idpenarikandana,'Selesai'])}}" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label>Bukti Transfer</label>
                                                        <input type="file" class="form-control-file" name="buktiTransfer" required>
                                                    </div>
                                                    <button type="submit" class="btn btn-success" style="margin-right: 5px;">
                                                        <i class="fas fa-download"></i>Selesai
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="col-2">
                                                <form method="post" action="{{route('refundstatus.admin',[$detailPenarikan->idpenarikandana,'Gagal'])}}">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label>Catatan</label>
                                                        <input type="text" class="form-control-text" name="catatan" required>
                                                    </div>
                                                    <button type="submit" class="btn btn-danger" style="margin-right: 5px;">
                                                        <i class="fas fa-download"></i>Gagal
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- /.invoice -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Ende Marketplace
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2014-2020 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('adminlte/dist/js/adminlte.min.js')}}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{asset('adminlte/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('adminlte/plugins/jszip/jszip.min.js')}}"></script>
    <!-- Sweetalert -->
    <script src="{{asset('adminlte/plugins/sweetalert2/sweetalert2.min.js')}}"></script>


    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1MgLuZuyqR_OGY3ob3M52N46TDBRI_9k&callback=initMap&libraries=&v=weekly" async>
    </script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script> -->

    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({

            });
        });
        @if(session("berhasil"))
        Swal.fire(
            'Berhasil!',
            '{{session("berhasil")}}',
            'success'
        )
        @endif
    </script>

    @yield('js')

</body>

</html>