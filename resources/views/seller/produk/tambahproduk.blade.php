@extends('layouts.adminlte')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <h3 class="card-title">DataTable with default features</h3>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form runat="server">
                        <input type='file' id="imgInp" />
                    </form>
                    <br>
                    <div id="preview">

                    </div>
                    <br>
                    <button id="test">TEST</button>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">

                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <h3 class="card-title">DataTable with default features</h3>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <h3 class="card-title">DataTable with default features</h3>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                </div>
                <!-- /.card-body -->
                <div class="card-footer">

                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <h3 class="card-title">DataTable with default features</h3>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                </div>
                <!-- /.card-body -->
                <div class="card-footer">

                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <button type="submit" class="btn btn-primary" id="btnsubmit">Submit</button>
    </div>
</div>
@section('js')
<script type="text/javascript">
    $(document).ready(function() {

    });
    var gambar = Array();
    var namaProduk = $("namaProduk").val();
    var jenisProduk = $("jenisProduk").val();
    var kategoriProduk = $("kategoriProduk").val();
    var deskripsiProduk = $("deskripsiProduk").val();

    var beratProduk = $("beratProduk").val();
    var panjangProduk = "";
    var lebarProduk = "";
    var tinggiProduk = "";
    
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                /*$('#blah').attr('src', e.target.result);*/
                //$('#preview').append('<img src="' + e.target.result + '" id="' + e.target.result + '">')
                gambar.push(e.target.result);
                previewGambar();
            }
            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }
    $("#imgInp").change(function() {
        readURL(this);
    });

    function previewGambar() {
        $("#preview").empty();
        for (i = 0; i < gambar.length; i++) {
            $('#preview').append('<img src="' + gambar[i] + '" id="preview-gambar" data-id="' + gambar[i] + '">')
        }
    }
    $("body").on("click", "#preview-gambar", function(e) {

        var id = $(this).attr('data-id');
        if (confirm('Ingin menghapus?')) {
            for (i = 0; i < gambar.length; i++) {
                if (gambar[i] == id) {
                    gambar.splice(i, 1);
                    previewGambar();
                }
            }
            alert("Berhasil hapus");
        } else {

        }
        alert(id);
    });
    $("#test").click(function() {
        var myJson = JSON.stringify(gambar);
        $.ajax({
            url: "{{route('produk.store')}}",
            type: "POST",
            dataType: "JSON",
            data: {
                "_token": "{{ csrf_token() }}",
                "gambar": myJson
            },
            success: function(response) {
                console.log(response);
            }
        });
    });
    $("#btnsubmit").click(function(){
        
    });
</script>
@endsection
@endsection