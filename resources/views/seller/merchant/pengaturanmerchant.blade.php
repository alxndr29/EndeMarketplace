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
    <form method="post" action="{{route('merchant.update',$merchant->users_iduser)}}" enctype="multipart/form-data">
        @csrf
        @method("put")
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
                            <input type="text" class="form-control" id="namaProduk" placeholder="Nama Merchant" value="{{$merchant->nama}}" name="namaMerchant">
                        </div>
                        <div class="form-group">
                            <label for="deskripsiMerchant">Deskripsi Merchant</label>
                            <textarea class="form-control" rows="3" placeholder="Deskripsi" id="deskripsiMerchant" name="deskripsiMerchant">
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
                            <select class="form-control" id="statusMerchant" name="statusMerchant">
                                <option value="Aktif" selected>Aktif</option>
                                <option value="NonAktif" selected>Non Aktif</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="namaProduk">Jam Buka</label>
                            <input type="time" class="form-control"  name="jamBuka" value="07:30:00">
                        </div>
                        <div class="form-group">
                            <label for="namaProduk">Jam Tutup</label>
                            <input type="time" class="form-control"  name="jamTutup" value="13:30">
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
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Foto Profil</label>
                            <input type="file" class="form-control-file" id="exampleFormControlFile1" name="fotoProfil">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Foto Sampul</label>
                            <input type="file" class="form-control-file" id="exampleFormControlFile1" name="fotoSampul">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <div class="card-header">
                        <div class="row">
                            <h3 class="card-title">Dukungan Pengiriman & Pembayaran</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Dukungan Pengiriman</label>
                            <select class="form-control" name="dukunganPengiriman">
                                <option>Pilih pengiriman</option>
                                <option value="KM">Kurir Merchant</option>
                                <option value="KP">Kurir Pihak 3</option>
                                <option value="KM-KP">Kurir Merchant & Kurir Pihak 3</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Dukungan Pembayaran</label>
                            <select class="form-control" name="dukunganPembayaran">
                                <option>Pilih pembayaran</option>
                                <option value="TF">Transfer Bank</option>
                                <option value="COD">Cash On Delivery</option>
                                <option value="TF-COD">Transfer Bank & Cash On Delivery</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center p-3">
            <button type="submit" class="btn btn-primary" id="btnsubmit">Simpan</button>
        </div>
    </form>
</div>

@section('js')
<script type="text/javascript">
    $(document).ready(function() {
        @if(session('berhasil'))
        //toastr.success('{{session('berhasil')}}');
        alert('{{session('berhasil')}}');
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