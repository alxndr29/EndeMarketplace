OTP: {{$otp}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Recover Password</title>

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
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="../../index2.html"><b>Admin</b>LTE</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p id="pesan" class="login-box-msg">Terdeteksi login dari perangkat baru, silahkan mengisi otp</p>


                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block" id="btnEmail">
                            <i class="far fa-envelope"></i>
                            Masukan OTP
                        </button>
                    </div>
                    <!-- /.col -->
                </div>
                <br>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block" id="btnWhatsapp">
                            <i class="fab fa-whatsapp"></i>
                            Lewat whatsapp
                        </button>
                    </div>
                    <!-- /.col -->
                </div>
                <br>
                <div class="input-group" id="otpgroup">
                    <input type="text" class="form-control" placeholder="Confirm Password" id="inputotp">
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
                    <!-- /.col -->
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
</body>

</html>

<script type="text/javascript">
    $(document).ready(function() {
        $("#btnSubmit").hide();
        $("#otpgroup").hide();
    });
    $("#btnEmail").click(function() {
        $.ajax({
            url: "{{route('otp.email.send')}}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}"
            },
            success: function(response) {
                alert(response);
                $("#btnEmail").hide();
                $("#btnWhatsapp").hide();
                $("#btnSubmit").show();
                $("#otpgroup").show();
            }
        });
    });
    $("#btnSubmit").click(function() {
        var otp = $("#inputotp").val();
        $.ajax({
            url: "{{route('otp.verifikasi')}}",
            type: "POST",
            data: {
                "_sstoken": "{{ csrf_token() }}",
                "otp": otp
            },
            success: function(response) {
                alert(response);
            },
            error: function(response) {
                alert(response);
            }
        });
    });
</script>