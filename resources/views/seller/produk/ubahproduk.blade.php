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
                        <input type="text" class="form-control" id="namaProduk" placeholder="Nama Produk" value="{{$data->nama}}">
                    </div>
                    <div class="form-group">
                        <label for="namaProduk">Harga Produk</label>
                        <input type="number" class="form-control" id="harga" placeholder="Harga Produk" value="{{$data->harga}}">
                    </div>
                    <div class="form-group">
                        <label>Jenis Produk</label>
                        <select class="form-control" id="jenisProduk">
                            <option selected value="{{$data->idjenisproduk}}">{{$data->nama_jenis}}</option>
                            @foreach ($jenisproduk as $key => $value )
                            <option value="{{$value->idjenisproduk}}">{{$value->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kategori Produk</label>
                        <select class="form-control" id="kategoriProduk">
                            <option selected value="{{$data->idkategori}}">{{$data->nama_kategori}}</option>
                            @foreach($kategori as $key => $value)
                            <option value="{{$value->idkategori}}">{{$value->nama_kategori}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi Produk</label>
                        <textarea class="form-control" rows="3" placeholder="Deskripsi" id="deskripsiProduk">{{$data->deskripsi}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="namaProduk">URL Video</label>
                        <input type="text" class="form-control" id="video" placeholder="URL Video Produk" value="{{$data->video}}">
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
                        <input type="number" class="form-control" id="beratProduk" placeholder="Berat" value="{{$data->berat}}">
                    </div>
                    <div class="form-group">
                        <label for="panjangProduk">Panjang (cm)</label>
                        <input type="number" class="form-control" id="panjangProduk" placeholder="Panjang" value="{{$data->panjang}}">
                    </div>
                    <div class="form-group">
                        <label for="lebarProduk">Lebar (cm)</label>
                        <input type="number" class="form-control" id="lebarProduk" placeholder="Lebar" value="{{$data->lebar}}">
                    </div>
                    <div class="form-group">
                        <label for="tinggiProduk">Tinggi (cm)</label>
                        <input type="number" class="form-control" id="tinggiProduk" placeholder="Tinggi" value="{{$data->tinggi}}">
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
                        <h3 class="card-title">DataTable with default features</h3>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form runat="server">
                        <input type='file' id="imgInp" />
                    </form>
                    <br>
                    <b>Gambar Baru</b>
                    <div id="preview">
                        Belum ada gambar
                    </div>
                    <br>
                    <b>Gambar Sekarang. Untuk menghapus klik pada gambar.</b>
                    <div id="currentPicture">

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
                        <h3 class="card-title">Pengaturan Produk</h3>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="form-group">
                        <label for="stokProduk">Stok</label>
                        <input type="number" class="form-control" id="stokProduk" placeholder="Stok" value="{{$data->stok}}">
                    </div>
                    <div class="form-group">
                        <label for="minimumPembelian">Minimum Pemesanan</label>
                        <input type="number" class="form-control" id="minimumPemesanan" placeholder="Minimum Pembelian" value="{{$data->minimum_pemesanan}}">
                    </div>
                    <div class="form-group">
                        <label>Status Produk</label>
                        <select class="form-control" id="statusProduk">
                            <option value="{{$data->status}}" selected>{{$data->status}}</option>
                            <option value="Aktif">Aktif</option>
                            <option value="TidakAktif">Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="form-check">
                        @if($data->preorder == "Aktif")
                        <input type="checkbox" class="form-check-input" id="checkboxpreorder" checked>
                        @else
                        <input type="checkbox" class="form-check-input" id="checkboxpreorder">
                        @endif
                        <label class="form-check-label" for="exampleCheck1">Pre Order</label>
                    </div>
                    <div class="form-group">
                        <label for="minimumPembelian">Durasi Preorder</label>
                        @if($data->preorder == "Aktif")
                        <input type="number" class="form-control" id="durasiPreorder" placeholder="Durasi Preorder" value="{{$data->waktu_preorder}}">
                        @else
                        <input type="number" class="form-control" id="durasiPreorder" placeholder="Durasi Preorder" value="{{$data->waktu_preorder}}" disabled>
                        @endif


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
    var currentGambar = Array();
    var hapusGambar = Array();

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

    $(document).ready(function() {
        getCurrentPicture("{{$data->idproduk}}");
        //displayCurrentPicture();
    });
    $('#checkboxpreorder').change(function() {
        if (this.checked) {
            //alert(this.checked);

            $("#durasiPreorder").attr("disabled", false);
        } else {
            //alert(this.checked);

            $("#durasiPreorder").attr("disabled", true);
        }
    });
    $("body").on("click", "#preview-gambar", function(e) {
        var id = $(this).attr('data-id');
        if (confirm('Ingin menghapus?')) {
            for (i = 0; i < gambar.length; i++) {
                if (gambar[i] == id) {
                    gambar.splice(i, 1);
                    previewGambar();
                }
            }
        } else {

        }
    });
    $("body").on("click", "#current-gambar", function(e) {
        var id = $(this).attr('data-id');
        if (confirm('Ingin menghapus?')) {
            for (i = 0; i < currentGambar.length; i++) {
                if (currentGambar[i] == id) {
                    hapusGambar.push(currentGambar[i]);
                    currentGambar.splice(i, 1);
                    displayCurrentPicture();
                }
            }
        } else {

        }

    });

    function getCurrentPicture(id) {
        $.ajax({
            url: "{{url('seller/produk/gambar')}}" + "/" + id,
            type: "GET",
            dataType: "JSON",
            data: {

            },
            success: function(data) {
                //console.log(data);
                for (i = 0; i < data.length; i++) {
                    currentGambar.push(data[i]['idgambarproduk']);
                }
                displayCurrentPicture();
            },
            error: function(data) {
                console.log(data);
            }
        });

    }

    function displayCurrentPicture() {
        $("#currentPicture").empty();
        for (i = 0; i < currentGambar.length; i++) {
            var test = currentGambar[i];
            // alert(test);
            // var src = "{{asset('gambar/" + ${test} + ".jpg')}}";
            // alert(src);

            var src = "src=" + "{{asset('/')}}" + "gambar/" + test + '.jpg';
            $('#currentPicture').append('<img ' + src + ' id="current-gambar" style="max-width:100px; max-height:100px;" data-id="' + currentGambar[i] + '">');
        }
        console.log('gambar yang tampil');
        console.log(currentGambar);
        console.log('gambar yang dihapus');
        console.log(hapusGambar);
    }
    $('#btnsubmit').click(function() {
        uploadData();
    });

    function uploadData() {
        if (!$("#namaProduk").val() || !$("#jenisProduk").val() ||
            !$("#kategoriProduk").val() || !$("#deskripsiProduk").val() ||
            !$("#harga").val() || !$("#beratProduk").val() ||
            !$("#minimumPemesanan").val() || !$("#stokProduk").val() ||
            !$("#panjangProduk").val() || !$("#lebarProduk").val() || !$("#tinggiProduk").val()) {
            Swal.fire(
                'Gagal!',
                'Pastikan Semua Data Telah Diinput!',
                'error'
            )
        } else {
            $.ajax({
                url: "{{url('seller/produk/update')}}" + "/" + "{{$data->idproduk}}",
                type: "PUT",
                data: {
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
                    "gambar": JSON.stringify(gambar),
                    "video": $("#video").val(),
                    "hapusGambar": JSON.stringify(hapusGambar)
                },
                success: function(response) {
                    alert(response.status);
                    window.location.href = "{{URL::to('seller/produk')}}";
                },
                error: function(response) {
                    console.log(response);
                }
            });
        }

    }
</script>
@endsection
@endsection

@section('name')

@endsection