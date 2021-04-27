@extends('layouts.adminlte')
@section('content')
<div class="container-fluid">

    <!-- <div class="card" style="width: 18rem;">
        <img src="..." class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">Card with stretched link</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary stretched-link">Go somewhere</a>
        </div>
    </div> -->

    <div class="row">
        <div class="col">
            <div class="card h-100">
                <div class="card-header">
                    <div class="row">
                        <h3 class="card-title">Data Toko</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="namaProduk">Nama Merchant</label>
                        <input type="text" class="form-control" id="namaProduk" placeholder="Nama Merchant" value="{{$merchant->nama}}">
                    </div>
                    <div class="form-group">
                        <label>Deskripsi Merchant</label>
                        <textarea class="form-control" rows="3" placeholder="Deskripsi" id="deskripsiProduk">
                        {{$merchant->deskripsi}}
                        </textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100">
                <div class="card-header">
                    <div class="row">
                        <h3 class="card-title">Status dan Waktu Operasional</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Status Toko</label>
                        <select class="form-control" id="kategoriProduk">
                            <option value="none" selected>Aktif</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="namaProduk">Jam Buka</label>
                        <input type="text" class="form-control" id="namaProduk" placeholder="Nama Merchant" value="{{$merchant->nama}}">
                    </div>
                    <div class="form-group">
                        <label for="namaProduk">Jam Tutup</label>
                        <input type="text" class="form-control" id="namaProduk" placeholder="Nama Merchant" value="{{$merchant->nama}}">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col">
            <div class="card h-100">
                <div class="card-header">
                    <div class="row">
                        <h3 class="card-title">Foto Profil dan Sampul</h3>
                    </div>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100">
                <div class="card-header">
                    <div class="row">
                        <h3 class="card-title">Dukungan Pengiriman</h3>
                    </div>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
</div>

@section('js')
<script type="text/javascript">
    $(document).ready(function() {
        @if(session('berhasil'))
        //toastr.success('{{session('berhasil')}}');
        alert('{{session('
            berhasil ')}}');
        @endif

        /*
        var counter = 0;
        var timer = setInterval(function() {
            counter++;
            alert(counter);
            if (counter >= 10) {
                clearInterval(timer)
            }
        }, 3000);
        */
    });
</script>
@endsection

@endsection