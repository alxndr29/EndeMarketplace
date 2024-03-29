<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Ende's Market</title>

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
    <!-- bootstrap slider -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/bootstrap-slider/css/bootstrap-slider.min.css')}}">


</head>

<body class="sidebar-collapse layout-top-nav">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">
                <a href="{{route('user.home')}}" class="navbar-brand">
                    <img src="{{asset('adminlte/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">Ende's Market</span>
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('user.home')}}" class="nav-link">Beranda</a>
                        </li>
                    </ul>
                    <!-- SEARCH FORM -->
                    <!-- <form class="form-inline ml-0 ml-md-3" method="get"> -->
                    <!-- <div class="input-group input-group-sm">
                        <select class="form-control" id="pilihKategori">
                            <option>option 1</option>
                            <option>option 2</option>
                            <option>option 3</option>
                            <option>option 4</option>
                            <option>option 5</option>
                        </select>
                    </div> -->
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search" id="txtSearchProduk">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit" id="btnSearchProduk">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <!-- </form> -->
                </div>

                <!-- Right navbar links -->
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">


                    <!-- Notifications Dropdown Menu -->
                    <li class="nav-item dropdown">
                        <!-- <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="far fa-bell"></i>
                          <span class="badge badge-warning navbar-badge" id="jumlahNotifikasi">15</span> 
                        </a> -->
                        
                        <!-- <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-header">15 Notifications</span>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-envelope mr-2"></i> 4 new messages
                                <span class="float-right text-muted text-sm">3 mins</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-users mr-2"></i> 8 friend requests
                                <span class="float-right text-muted text-sm">12 hours</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="{{route('merchant.index')}}" class="dropdown-item">
                                <i class="fas fa-file mr-2"></i> Merchant Anda
                                <span class="float-right text-muted text-sm">2 days</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                        </div> -->
                    </li>

                    <!-- notifikasi keranjang -->
                    <!-- Notifications Dropdown Menu -->
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="fa fa-shopping-cart"></i>
                            <span class="badge badge-warning navbar-badge" id="jumlahKeranjangNotifikasi">0</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-header" id="jumlahKeranjangDalam">15 Notifications</span>

                            <div class="list-keranjang" id="isiKeranjangNotifikasi">

                            </div>

                            <div class="dropdown-divider"></div>
                            @auth
                            <a href="{{route('keranjang.index')}}" class="dropdown-item dropdown-footer">Lihat Semua Keranjang</a>
                            @endauth

                        </div>
                    </li>

                    <!-- notifikasi user -->
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="far fa-user"></i>
                            <span class="badge badge-warning navbar-badge"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            @auth
                            <a href="#" class="dropdown-item">
                                <div class="media">
                                    <img src="{{asset('adminlte/dist/img/user1-128x128.jpg')}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                                    <div class="media-body">
                                        <h3 class="dropdown-item-title">
                                            {{ Auth::user()->name }}
                                            <p> {{ Auth::user()->email }} </p>
                                            <p> {{ Auth::user()->telepon }} </p>
                                        </h3>
                                    </div>
                                </div>
                            </a>
                            <a href="#exampleModal" class="dropdown-item" data-toggle="modal" data-target="#exampleModal">
                                <i class="fas fa-cog mr-2"></i> Akun
                                <!-- <span class="float-right text-muted text-sm">3 mins</span> -->
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="{{route('pelanggan.transaksi.index')}}" class="dropdown-item">
                                <i class="fas fa-list-alt mr-2"></i> Daftar Transaksi
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="{{route('penarikan.user')}}" class="dropdown-item">
                                <i class="fas fa-money-bill-wave-alt mr-2"></i> Penarikan Dana
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="{{route('obrolan.index.user')}}" class="dropdown-item">
                                <i class="fas fa-envelope mr-2"></i> Pesan
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="{{route('wishlist.index')}}" class="dropdown-item">
                                <i class="fas fa-heart mr-2"></i> Wishlist
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="{{route('alamatpembeli.index')}}" class="dropdown-item">
                                <i class="fas fa-location-arrow mr-2"></i> Daftar Alamat
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="{{route('merchant.index')}}" class="dropdown-item">
                                <i class="fas fa-store mr-2"></i> Merchant Anda
                            </a>
                            <div class="dropdown-divider"></div>
                            <!-- <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a> -->
                            <a class="dropdown-item dropdown-footer" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            @else
                            <a href="#" class="dropdown-item">
                                <div class="media">
                                    <img src="{{asset('adminlte/dist/img/user2-160x160.jpg')}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                                    <div class="media-body">
                                        <h3 class="dropdown-item-title">
                                            <p>Silahkan masuk ke akun yang terdaftar</p>
                                        </h3>
                                    </div>
                                </div>
                            </a>
                            <a class="dropdown-item dropdown-footer" href="{{ route('login') }}"> Login </a>
                            @endauth
                        </div>
                    </li>
                    <!--
                    <li class="nav-item">
                        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                            <i class="fas fa-th-large"></i>
                        </a>
                    </li>
                    -->
                </ul>
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="../../index3.html" class="brand-link">
                <img src="{{asset('adminlte/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">AdminLTE 3</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{asset('adminlte/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Alexander Pierce</a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="../../index.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Dashboard v1</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="../../index2.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Dashboard v2</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="../../index3.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Dashboard v3</p>
                                    </a>
                                </li>
                            </ul>
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
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <!-- <h3 class="m-0"> Top Navigation</h3> -->
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{route('user.home')}}">Home</a></li>
                                @yield('breadcrumb')

                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                @yield('content')
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
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('adminlte/dist/js/demo.js')}}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{asset('adminlte/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('adminlte/plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('adminlte/plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('adminlte/plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('adminlte/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
    <!-- Sweetalert -->
    <script src="{{asset('adminlte/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
    <!-- Toastr -->
    <script src="{{asset('adminlte/plugins/toastr/toastr.min.js')}}"></script>
    <!-- Make sure you put this AFTER Leaflet's CSS -->

    <!-- Notifikasi Pelanggan -->
    <!-- <script src="{{asset('js/notifikasiPelanggan.js')}}"></script> -->

    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1MgLuZuyqR_OGY3ob3M52N46TDBRI_9k&callback=initMap&libraries=&v=weekly" async>
    </script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script> -->



    <script type="text/javascript">
        $(document).ready(function() {
            $("#jumlahNotifikasi").html(100);
            loginstatus();
        });

        function loginstatus() {
            $.ajax({
                url: "{{route('loginstatus')}}",
                type: "GET",
                success: function(response) {
                    if (response == "1") {
                        loadKeranjang();
                    } else {
                        $("#jumlahKeranjangDalam").html('Silahkan Login Dahulu.');
                        $("#jumlahKeranjangNotifikasi").html(0);
                    }
                },
                error: function(response) {
                    console.log(response);
                }
            });
        }

        function loadKeranjang() {
            $("#isiKeranjangNotifikasi").empty();
            $.ajax({
                url: "{{route('keranjang.notifikasi')}}",
                type: "GET",
                success: function(response) {
                    var jumlahKeranjang = 0;
                    for (i = 0; i < response.length; i++) {
                        jumlahKeranjang += response[i].jumlah;
                        var src = "src=" + "{{asset('/')}}gambar/" + response[i].idgambarproduk + '.jpg';
                        var url = "{{asset('/')}}user/produk/show/" + response[i].idproduk;
                        $("#isiKeranjangNotifikasi").append(
                            '<a href="' + url + '" class="dropdown-item">' +
                            '<div class="media">' +
                            '<img alt="User Avatar" class="img-size-50 mr-3 img-circle"' + src + '>' +
                            '<div class="media-body">' +
                            '<h3 class="dropdown-item-title">' +
                            response[i].nama +
                            '</h3>' +
                            '<p class="text-sm">' +
                            "Harga: Rp. " + (response[i].harga) +
                            '</p>' +
                            '<p class="text-sm">' +
                            "Total: Rp. " + (response[i].harga * response[i].jumlah) + " " + response[i].jumlah + "(pcs)" +
                            '</p>' +
                            '</div>' +
                            '</div>' +
                            '</a>'
                        );
                    }
                    $("#jumlahKeranjangDalam").html('Total ' + jumlahKeranjang + ' Produk');
                    $("#jumlahKeranjangNotifikasi").html(jumlahKeranjang);
                },
                error: function(response) {
                    console.log(response);
                }
            });
        }
        $("#btnSearchProduk").click(function() {
            //var url = "{{url('user/produk/cari')}}/" + 
            window.location = "{{url('/')}}" + "/user/produk/cari?key=" + $("#txtSearchProduk").val();
            // window.location.href = url;
        });
    </script>
    @yield('js')


    <!-- Modal -->
    @auth
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Akun</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('user.profile.update')}}">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukan Nama" name="name" value="{{Auth::user()->name}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukan Email" name="email" value="{{Auth::user()->email}}">
                            <small id="emailHelp" class="form-text text-muted">Verifikasi email diperlukan jika mengubah email.</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Isi Jika Ingin Diubah" name="password">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Telepon</label>
                            <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Telepon" name="telepon" value="{{Auth::user()->telepon}}">
                        </div>
                        @if(Auth::user()->notif_wa == 1)
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="checkWhatsApp" checked>
                            <label class="form-check-label" for="exampleCheck1">Notifikasi WhatsApp</label>
                        </div>
                        @else
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="checkWhatsApp">
                            <label class="form-check-label" for="exampleCheck1">Notifikasi WhatsApp</label>
                        </div>
                        @endif

                        @if(Auth::user()->notif_email == 1)
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="checkEmail" checked>
                            <label class="form-check-label" for="exampleCheck1">Notifikasi Email</label>
                        </div>
                        @else
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="checkEmail">
                            <label class="form-check-label" for="exampleCheck1">Notifikasi Email</label>
                        </div>
                        @endif

                        <br>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    @endauth

</body>

</html>