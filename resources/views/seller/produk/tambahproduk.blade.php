@extends('layouts.adminlte')
@section('content')
<div class="container-fluid">
    <div class="row pb-3">
        <div class="col-6">
            <div class="card h-100">
                <div class="card-header">
                    <div class="row">
                        <h3 class="card-title">Data Produk</h3>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="form-group">
                        <label for="namaProduk">Nama Produk</label>
                        <input type="text" class="form-control" id="namaProduk" placeholder="Nama Produk" required>
                    </div>
                    <div class="form-group">
                        <label for="namaProduk">Harga Produk</label>
                        <input type="number" class="form-control" id="harga" placeholder="Harga Produk" required>
                    </div>
                    <div class="form-group">
                        <label>Jenis Produk</label>
                        <select class="form-control" id="jenisProduk">
                            <option selected>Pilih Jenis Produk</option>
                            @foreach ($jenisproduk as $key => $value )
                            <option value="{{$value->idjenisproduk}}">{{$value->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kategori Produk</label>
                        <select class="form-control" id="kategoriProduk">
                            <option value="none" selected>Pilih Kategori Produk</option>
                            @foreach($kategori as $key => $value)
                            <option value="{{$value->idkategori}}">{{$value->nama_kategori}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi Produk</label>
                        <textarea class="form-control" rows="3" placeholder="Deskripsi" id="deskripsiProduk" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="namaProduk">URL Video</label>
                        <input type="text" class="form-control" id="video" placeholder="URL Video Produk">
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">

                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card h-100">
                <div class="card-header">
                    <div class="row">
                        <h3 class="card-title">Dimensi dan Berat</h3>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="form-group">
                        <label for="beratProduk">Berat (gr)</label>
                        <input type="number" class="form-control" id="beratProduk" placeholder="Berat" required>
                    </div>
                    <div class="form-group">
                        <label for="panjangProduk">Panjang (cm)</label>
                        <input type="number" class="form-control" id="panjangProduk" placeholder="Panjang" required>
                    </div>
                    <div class="form-group">
                        <label for="lebarProduk">Lebar (cm)</label>
                        <input type="number" class="form-control" id="lebarProduk" placeholder="Lebar" required>
                    </div>
                    <div class="form-group">
                        <label for="tinggiProduk">Tinggi (cm)</label>
                        <input type="number" class="form-control" id="tinggiProduk" placeholder="Tinggi" required>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="card h-100">
                <div class="card-header">
                    <div class="row">
                        <h3 class="card-title">Gambar / Foto Produk</h3>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form runat="server">
                        <input type='file' id="imgInp" />
                    </form>
                    <br>
                    <div id="preview">
                        <img src="{{asset('adminlte/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    </div>
                    <br>
                    <!-- <button id="test">TEST</button> -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer">

                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card h-100">
                <div class="card-header">
                    <div class="row">
                        <h3 class="card-title">Pengaturan Produk</h3>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="form-group">
                        <label for="stokProduk">Stok</label>
                        <input type="number" class="form-control" id="stokProduk" placeholder="Stok" required>
                    </div>
                    <div class="form-group">
                        <label for="minimumPembelian">Minimum Pemesanan</label>
                        <input type="number" class="form-control" id="minimumPemesanan" placeholder="Minimum Pembelian" required>
                    </div>
                    <div class="form-group">
                        <label>Status Produk</label>
                        <select class="form-control" id="statusProduk">
                            <option value="Aktif">Aktif</option>
                            <option value="TidakAktif">Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="checkboxpreorder">
                        <label class="form-check-label" for="exampleCheck1">Pre Order</label>
                    </div>
                    <div class="form-group">
                        <label for="minimumPembelian">Durasi Preorder</label>
                        <input type="number" class="form-control" id="durasiPreorder" placeholder="Durasi Preorder">
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">

                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center p-3">
        <button type="submit" class="btn btn-primary" id="btnsubmit">Submit</button>
    </div>
</div>
@section('js')
<script type="text/javascript">
    var gambar = Array();

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
            $('#preview').append('<img src="' + gambar[i] + '" id="preview-gambar" style="max-width:100px; max-height:100px;" data-id="' + gambar[i] + '">')
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

    $(document).ready(function() {
        $('#checkboxpreorder').change(function() {
            if (this.checked) {
                //alert(this.checked);
                $("#durasiPreorder").attr("disabled", false);
            } else {
                //alert(this.checked);
                $("#durasiPreorder").attr("disabled", true);
            }
        });

        $("#btnsubmit").click(function() {
            if (!$("#namaProduk").val() || !$("#jenisProduk").val() ||
                !$("#kategoriProduk").val() || !$("#deskripsiProduk").val() ||
                !$("#harga").val() || !$("#beratProduk").val() ||
                !$("#minimumPemesanan").val() || !$("#stokProduk").val() ||
                !$("#panjangProduk").val() || !$("#lebarProduk").val() || !$("#tinggiProduk").val()) {
                // alert('kosong');
                Swal.fire(
                    'Gagal!',
                    'Pastikan Semua Data Telah Diinput!',
                    'error'
                )
            } else {
                var myJson = JSON.stringify(gambar);
                // rumus volume panjang x lebar x tinggi
                var panjangProduk = $("#panjangProduk").val();
                var lebarProduk = $("#lebarProduk").val();
                var tinggiProduk = $("#tinggiProduk").val();
                //var volume = panjangProduk * lebarProduk * tinggiProduk;
                $.ajax({
                    url: "{{route('produk.store')}}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "namaProduk": $("#namaProduk").val(),
                        "jenisProduk": $("#jenisProduk").val(),
                        "kategoriProduk": $("#kategoriProduk").val(),
                        "deskripsiProduk": $("#deskripsiProduk").val(),
                        "harga": $("#harga").val(),
                        "beratProduk": $("#beratProduk").val(),
                        "preorder": $("#checkboxpreorder").is(":checked"),
                        "minimumPemesanan": $("#minimumPemesanan").val(),
                        "statusProduk": $("#statusProduk").val(),
                        "stokProduk": $("#stokProduk").val(),
                        "panjang": $("#panjangProduk").val(),
                        "lebar": $("#lebarProduk").val(),
                        "tinggi": $("#tinggiProduk").val(),
                        "waktu_preorder": $("#durasiPreorder").val(),
                        "video": $("#video").val(),
                        "gambar": myJson
                    },
                    success: function(response) {
                        if (response.status == "berhasil") {
                            alert(response.status);
                            window.location.href = "{{URL::to('seller/produk')}}";

                        } else {
                            alert(response.status);
                        }
                    }
                });
            }
        });

    });
</script>
@endsection
@endsection

@section('name')

@endsection