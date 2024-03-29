OTP: {{$otp}}
IDUSER: {{$iduser}}
Value: {{$value}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ende's Market | OTP</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('adminlte/dist/css/adminlte.min.css')}}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>ENDE's</b>Market</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p id="pesan" class="login-box-msg">Terdeteksi masuk dari perangkat baru, Silahkan mengisi OTP yang dikirimkan.</p>
                <div class="d-flex flex-column align-items-center justify-content-center" id="spinnerLoading">

                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block" id="btnEmail">
                            <i class="far fa-envelope"></i>
                            Lewat Email
                        </button>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block" id="btnWhatsapp">
                            <i class="fab fa-whatsapp"></i>
                            Lewat whatsapp
                        </button>
                    </div>
                </div>
                <br>
                <div class="input-group" id="otpgroup">
                    <input type="text" class="form-control" placeholder="Kode OTP" id="inputotp">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block" id="btnSubmit">Masukan OTP</button>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block" id="btnKirimUlang" disabled>Kirim Ulang OTP</button>
                    </div>
                </div>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('adminlte/dist/js/adminlte.min.js')}}"></script>
    <!-- Sweetalert -->
    <script src="{{asset('adminlte/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
</body>

</html>

<script type="text/javascript">
    $(document).ready(function() {
        $("#btnSubmit").hide();
        $("#otpgroup").hide();
        $("#btnKirimUlang").hide();
    });
    var second = 5;

    function timerOTP() {
        second = 5;
        var x = setInterval(function() {
            if (second <= 0) {
                $("#btnKirimUlang").attr("disabled", false);
                $("#btnKirimUlang").text("Kirim Ulang OTP");
                clearInterval(x);
            } else {
                $("#btnKirimUlang").attr("disabled", true);
                second--;
                $("#btnKirimUlang").text("Tunggu " + second + " Detik");
            }
        }, 1000);
    }
    $("#btnKirimUlang").click(function() {
        $("#btnSubmit").hide();
        $("#otpgroup").hide();
        $("#btnKirimUlang").hide();
        $("#btnEmail").show();
        $("#btnWhatsapp").show();
    });
    $("#btnEmail").click(function() {
        $("#spinnerLoading").html('<div class="row"> <div class="spinner-border" role = "status">  </div> </div> <div class="row" id ="pesanLoading" ><strong> Meminta OTP </strong> </div>');
        $.ajax({
            url: "{{route('otp.email.send')}}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}"
            },
            success: function(response) {
                if (response == "berhasil") {
                    console.log(response);
                    $("#spinnerLoading").empty();
                    $("#btnEmail").hide();
                    $("#btnWhatsapp").hide();
                    $("#btnSubmit").show();
                    $("#otpgroup").show();
                    $("#btnKirimUlang").show();
                    timerOTP();
                } else {
                    console.log(response);
                    Swal.fire(
                        'Gagal!',
                        'Tidak dapat mengirim OTP',
                        'error'
                    )
                }
            },
            error: function(response) {
                console.log(response);
                Swal.fire(
                    'Gagal!',
                    'Tidak dapat mengirim OTP',
                    'error'
                )
            }
        });
    });
    $("#btnWhatsapp").click(function() {
        $("#spinnerLoading").html('<div class="row"> <div class="spinner-border" role = "status">  </div> </div> <div class="row" id ="pesanLoading" ><strong> Meminta OTP </strong> </div>');
        $.ajax({
            url: "{{route('otp.whatsapp.send')}}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}"
            },
            success: function(response) {
                console.log(response);
                var dat = JSON.parse(response);
                console.log(dat.status);
                if (dat.status == true) {
                    $("#spinnerLoading").empty();
                    $("#btnEmail").hide();
                    $("#btnWhatsapp").hide();
                    $("#btnSubmit").show();
                    $("#otpgroup").show();
                    $("#btnKirimUlang").show();
                    timerOTP();
                } else {
                    console.log(response);
                    Swal.fire(
                        'Gagal!',
                        'Tidak dapat mengirim OTP',
                        'error'
                    )
                }
            },
            error: function(response) {
                console.log(response);
                Swal.fire(
                    'Gagal!',
                    'Tidak dapat mengirim OTP',
                    'error'
                )
            }
        });
    });
    $("#btnSubmit").click(function() {
        var otp = $("#inputotp").val();
        $.ajax({
            url: "{{route('otp.verifikasi')}}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                "otp": otp,
                "email": "{{$email}}",
                "iduser": "{{Auth::user()->iduser}}"
            },
            success: function(response) {
                console.log(response);
                if (response != "gagal") {
                    window.location.href = "{{URL::to('/home')}}";
                } else {
                    console.log("Kode OTP Yang Dimasukan Salah");
                    Swal.fire(
                        'Gagal!',
                        'Kode OTP anda salah!',
                        'error'
                    )
                }
            },
            error: function(response) {
                alert(response);
            }
        });
    });
</script>