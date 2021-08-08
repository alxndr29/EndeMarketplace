<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Merchant</title>
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
            <a href="{{route('merchant.index')}}" class="brand-link">
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
                        <a href="#" class="d-block">{{Session::get('pengantar-nama')}}</a>
                        <a class="d-block" href="{{route('merchant.petugas.logout')}}">
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
                            <a href="{{route('merchant.petugas.daftar')}}" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>
                                    Daftar Pengantaran
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
                            @yield('name')
                            <h1 class="m-0">Starter Page</h1>
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
                    <div class="card">
                        <div class="card-header">
                            Detail Pengantaran
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    Data Alamat:
                                    <br>
                                    Nama Penerima: <b>{{$alamatPengiriman->nama_penerima}}</b>
                                    <br>
                                    Alamat Lengkap: <b>{{$alamatPengiriman->alamatlengkap}}</b>
                                    <br>
                                    Telp Penerima: <b>{{$alamatPengiriman->telepon}}</b>
                                    <br>
                                    Kota: <b>{{$alamatPengiriman->nama_kota}}</b>
                                    <br>
                                    Kode Pos: <b>{{$alamatPengiriman->kode_pos}}</b>
                                    <br>
                                    Provinsi: <b>{{$alamatPengiriman->nama_provinsi}}</b>
                                    <br>
                                </div>
                                <div class="col">
                                    Data Pembayaran:
                                    <br>
                                    Jenis Pembayaran: <b>{{$alamatPengiriman->namatipepembayaran}}</b>
                                    <br>
                                    Total Belanja: <b> Rp. {{number_format($alamatPengiriman->nominal_pembayaran - $alamatPengiriman->biaya_pengiriman)}}</b>
                                    <br>
                                    Biaya Pengiriman: <b>Rp. {{number_format($alamatPengiriman->biaya_pengiriman)}}</b>
                                    <br>
                                    Nominal Penagihan: <b>Rp. {{number_format($alamatPengiriman->nominal_pembayaran)}}</b>
                                    <br>
                                    Status: <b>{{$data->status}}</b>
                                    <br>
                                    @if($data->status == "ProsesKeKurir")
                                    <button type="button" class="btn btn-success" id="antarSekarang" style="margin-right: 5px;">
                                        <i class="fas fa-edit"></i>Antar Sekarang
                                    </button>
                                    @endif
                                    @if($data->status != "SelesaiAntar")
                                    <button id="selesaiAntar" class="btn btn-success" style="margin-right: 5px;" disabled>
                                        <i class="fas fa-edit"></i>Selesai Pengantaran
                                    </button>
                                    @endif


                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div id="map" style="height:300px;width100%;">

                                    </div>
                                </div>
                            </div>
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
    <script src="{{asset('adminlte/plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('adminlte/plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('adminlte/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
    <!-- Sweetalert -->
    <script src="{{asset('adminlte/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
    <!-- Toastr -->
    <script src="{{asset('adminlte/plugins/toastr/toastr.min.js')}}"></script>

    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1MgLuZuyqR_OGY3ob3M52N46TDBRI_9k&callback=initMap&libraries=&v=weekly" async>
    </script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script> -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1MgLuZuyqR_OGY3ob3M52N46TDBRI_9k&callback=initMap&libraries=&v=weekly" async>
    </script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

    <script type="text/javascript">
        var latitude = "";
        var longitude = "";
        var jarak = 0;
        var latitude_origin = "{{$data->latitude_merchant}}";
        var longitude_origin = "{{$data->longitude_merchant}}";
        var latitude_destination = "{{$data->latitude_user}}";
        var longitude_destination = "{{$data->longitude_user}}";

        var loc = true;
        var second = 0;
        var timer;

        $(document).ready(function() {
            if ("{{$data->status}}" == "SedangDiantar") {
                getLocation();
            } else {
                $("#map").html('Map Non Aktif karena tidak ada aktivitas pengantaran');
            }
        });

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.watchPosition(
                    function(position) {
                        //alert(position.coords.latitude +"x"+ position.coords.longitude);
                        latitude = position.coords.latitude;
                        longitude = position.coords.longitude;
                        if (loc = true) {
                            updateLokasiKurir();
                        }
                    },
                    function() {
                        alert("Geocoder failed");
                    }, {
                        timeout: 100000,
                        enableHighAccuracy: true
                    });
                timer = setInterval(function() {
                    second++;
                    if (second == 10) {
                        loc = true;
                        second = 0;
                    } else {
                        loc = false;
                    }
                }, 1000);
                iniatMap();

            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        var map;
        var myLatlng;
        var lokasiKurir;
        var mapOptions;

        var marker;
        var marker2;
        var marker3;

        function iniatMap() {
            //alert('sekali doang');
            myLatlng = new google.maps.LatLng(latitude_destination, longitude_destination);
            latlng = new google.maps.LatLng(latitude_origin, longitude_origin);
            lokasiKurir = new google.maps.LatLng(latitude, longitude);
            mapOptions = {
                zoom: 15,
                center: myLatlng
            }
            map = new google.maps.Map(document.getElementById("map"), mapOptions);
            $("#demo").append('Jarak Kurir ke tujuan = ' + jarakKeTujuan(latitude, longitude, latitude_destination, longitude_destination, 'K') + ' Kilometer <br>');
            test();
        }

        function test() {
            marker = new google.maps.Marker({
                position: myLatlng,
                title: "Hello World!",
                label: "Lokasi Pembeli (Tujuan)"
            });
            // To add the marker to the map, call setMap();
            marker2 = new google.maps.Marker({
                position: latlng,
                title: "Hello World!",
                label: "Lokasi Penjual (Awal)"
            });
            //kurir
            marker3 = new google.maps.Marker({
                position: lokasiKurir,
                title: "Hello World!",
                label: "Lokasi Kurir"
            });
            marker.setMap(map);
            marker2.setMap(map);
            marker3.setMap(map);
        }
        $("#pindahKurir").click(function() {
            //-8.845654574032876, 121.66723135955436
            latitude = "-8.845654574032876";
            longitude = "121.66723135955436";
            updateLokasiKurir();
        });
        $("#pindahKurir1").click(function() {
            //-8.844583843790094, 121.67058948594482
            latitude = "-8.844583843790094";
            longitude = "121.67058948594482";
            updateLokasiKurir();
        });
        $("#pindahKurir2").click(function() {
            //-8.838742514074765, 121.67476505158152
            latitude = "-8.838742514074765";
            longitude = "121.67476505158152";
            updateLokasiKurir();
        });
        $("#pindahKurir3").click(function() {
            //-8.834226217513532, 121.67779055355581
            latitude = "-8.834226217513532";
            longitude = "121.67779055355581";
            updateLokasiKurir();
        });

        function updateLokasiKurir() {
            if (marker3 != null) {
                marker3.setMap(null);
            }
            //marker3.setMap(null);
            lokasiKurir = new google.maps.LatLng(latitude, longitude);
            marker3 = new google.maps.Marker({
                position: lokasiKurir,
                title: "Hello World!",
                label: "Lokasi Kurir"
            });
            marker3.setMap(map);
            $("#demo").html('Jarak Kurir ke tujuan = ' + jarakKeTujuan(latitude, longitude, latitude_destination, longitude_destination, 'K') + ' Kilometer <br>');
            $.ajax({
                url: "{{route('nerchant.lokasikurir.update')}}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "idpengiriman": "{{$idpengiriman}}",
                    "latitude_sekarang": latitude,
                    "longitude_sekarang": longitude,
                    "jarak": jarak
                },
                success: function(response) {
                    if (response.pengiriman == "SelesaiAntar") {
                        alert('Pengantaran sudah diselesaikan oleh pembeli');
                        location.reload();
                    }
                    console.log(response.pengiriman);
                },
                error: function(response) {
                    console.log(response);
                }
            });
        }

        function jarakKeTujuan(lat1, lon1, lat2, lon2, unit) {
            var radlat1 = Math.PI * lat1 / 180
            var radlat2 = Math.PI * lat2 / 180
            var theta = lon1 - lon2
            var radtheta = Math.PI * theta / 180
            var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
            dist = Math.acos(dist)
            dist = dist * 180 / Math.PI
            dist = dist * 60 * 1.1515
            if (unit == "K") {
                dist = dist * 1.609344
            }
            if (unit == "N") {
                dist = dist * 0.8684
            }
            if (dist < 0.2) {
                //$("#demo2").html('kirim notif kalau sdh dekat');
                $('#selesaiAntar').prop('disabled', false);
                console.log('kurir sdh dekat < 200 m');
                //alert(dist);
            } else {
                $("#demo2").html('masih jauh');
                console.log('kurir jauh > 200 m');
                $('#selesaiAntar').prop('disabled', true);
            }
            jarak = dist;
            return dist;
        }
        $("#antarSekarang").click(function() {
            $("#antarSekarang").prop('disabled', true);
            $.ajax({
                url: "{{url('seller/pengiriman/status')}}/" + "{{$idpengiriman}}" + "/" + "SedangDiantar" + "/" + "ajax",
                type: "GET",
                success: function(response) {
                    if (response == "berhasil") {
                        getLocation();
                    }
                },
                error: function(response) {
                    console.log(response);
                }
            });
        });
        $("#selesaiAntar").click(function() {
            $.ajax({
                url: "{{url('seller/pengiriman/status')}}/" + "{{$idpengiriman}}" + "/" + "SelesaiAntar" + "/" + "ajax",
                type: "GET",
                success: function(response) {
                    if (response == "berhasil") {
                        clearInterval(timer);
                        console.log('selesai antar');
                        alert("Selesai melakukan pengantaran");
                        location.reload();
                    }
                },
                error: function(response) {
                    console.log(response);
                }
            });
        });
    </script>

    @yield('js')

</body>

</html>