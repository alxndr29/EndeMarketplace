@extends('layouts.userlte')
@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">

                <div class="card-body">
                    <div class="row">
                        <div class="col-2">
                            <img style="width:150px;height:150px;" src=" https://my.ubaya.ac.id/img/mhs/160417084_l.jpg" class="rounded mx-auto d-block p-1 img-fluid" alt="...">
                        </div>
                        <div class="col">
                            <p class="h5">{{$merchant->nama}}</p>
                            <p class="h5">{{$merchant->foto_profil}}</p>
                            <p class="h5">{{$merchant->foto_sampul}}</p>
                            <p class="h5">{{$merchant->deskripsi}}</p>
                            <p class="h5">{{$merchant->jam_buka}}</p>
                            <p class="h5">{{$merchant->jam_tutup}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <select class="form-control">
                                    <option>option 1</option>
                                    <option>option 2</option>
                                    <option>option 3</option>
                                    <option>option 4</option>
                                    <option>option 5</option>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <select class="form-control">
                                    <option>option 1</option>
                                    <option>option 2</option>
                                    <option>option 3</option>
                                    <option>option 4</option>
                                    <option>option 5</option>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@section('js')
<script type="text/javascript">
    @if(session('berhasil'))
    //toastr.success('{{session('berhasil')}}');
    alert('{{session('
        berhasil ')}}');
    @endif
</script>
@endsection
@endsection