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
                    <table id="example2" class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th style="width:5%">No</th>
                                <th>Nama</th>
                                <th>Gambar</th>
                                <th>Kategori Produk</th>
                                <th> AVG Rating </th>
                                <th style="width:5%">Detail</th>
                            </tr>
                        </thead>
                        <tbody style="vertical-align: top;">
                            @foreach ($produk as $key => $value)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$value->nama_produk}}</td>
                                <td>
                                    <img style="width:75px;height:75px;" src="{{asset('gambar/'.$value->idgambarproduk.'.jpg')}}" class="rounded mx-auto d-block p-1 img-fluid" alt="...">
                                </td>
                                <td>{{$value->kategori_produk}}</td>
                                <td>
                                    @if ($value->rating == null)
                                    Blm ada rating
                                    @else
                                    {{$value->rating}}
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-success" onCLick="loadData({{$value->idproduk}})">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDetail">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Review Produk</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <div class="row pb-1">
                            <div class="col">
                                <img style="width:75px;height:100px;" src="http://localhost:8000/fotoProfil/default-user.png">
                            </div>
                            <div class="col">
                                <b>alexander evan</b>
                                <br>2021-07-07 00:27:05
                                <br>
                                Bagus banget
                                <br>
                                Jumlah bintang: 4
                                <i class="fa fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row pb-1">
                            <div class="col">
                                <img style="width:75px;height:100px;" src="http://localhost:8000/fotoProfil/default-user.png">
                            </div>
                            <div class="col">
                                <b>alexander evan</b>
                                <br>2021-07-07 00:27:05
                                <br>
                                Bagus banget
                                <br>
                                Jumlah bintang: 4
                                <i class="fa fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row pb-1">
                            <div class="col">
                                <img style="width:75px;height:100px;" src="http://localhost:8000/fotoProfil/default-user.png">
                            </div>
                            <div class="col">
                                <b>alexander evan</b>
                                <br>2021-07-07 00:27:05
                                <br>
                                Bagus banget
                                <br>
                                Jumlah bintang: 4
                                <i class="fa fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row pb-1">
                            <div class="col">
                                <img style="width:75px;height:100px;" src="http://localhost:8000/fotoProfil/default-user.png">
                            </div>
                            <div class="col">
                                <b>alexander evan</b>
                                <br>2021-07-07 00:27:05
                                <br>
                                Bagus banget
                                <br>
                                Jumlah bintang: 4
                                <i class="fa fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row pb-1">
                            <div class="col">
                                <img style="width:75px;height:100px;" src="http://localhost:8000/fotoProfil/default-user.png">
                            </div>
                            <div class="col">
                                <b>alexander evan</b>
                                <br>2021-07-07 00:27:05
                                <br>
                                Bagus banget
                                <br>
                                Jumlah bintang: 4
                                <i class="fa fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row pb-1">
                            <div class="col">
                                <img style="width:75px;height:100px;" src="http://localhost:8000/fotoProfil/default-user.png">
                            </div>
                            <div class="col">
                                <b>alexander evan</b>
                                <br>2021-07-07 00:27:05
                                <br>
                                Bagus banget
                                <br>
                                Jumlah bintang: 4
                                <i class="fa fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row pb-1">
                            <div class="col">
                                <img style="width:75px;height:100px;" src="http://localhost:8000/fotoProfil/default-user.png">
                            </div>
                            <div class="col">
                                <b>alexander evan</b>
                                <br>2021-07-07 00:27:05
                                <br>
                                Bagus banget
                                <br>
                                Jumlah bintang: 4
                                <i class="fa fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row pb-1">
                            <div class="col">
                                <img style="width:75px;height:100px;" src="http://localhost:8000/fotoProfil/default-user.png">
                            </div>
                            <div class="col">
                                <b>alexander evan</b>
                                <br>2021-07-07 00:27:05
                                <br>
                                Bagus banget
                                <br>
                                Jumlah bintang: 4
                                <i class="fa fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row pb-1">
                            <div class="col">
                                <img style="width:75px;height:100px;" src="http://localhost:8000/fotoProfil/default-user.png">
                            </div>
                            <div class="col">
                                <b>alexander evan</b>
                                <br>2021-07-07 00:27:05
                                <br>
                                Bagus banget
                                <br>
                                Jumlah bintang: 4
                                <i class="fa fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row pb-1">
                            <div class="col">
                                <img style="width:75px;height:100px;" src="http://localhost:8000/fotoProfil/default-user.png">
                            </div>
                            <div class="col">
                                <b>alexander evan</b>
                                <br>2021-07-07 00:27:05
                                <br>
                                Bagus banget
                                <br>
                                Jumlah bintang: 4
                                <i class="fa fa-star"></i>
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
    $(document).ready(function() {
        @if(session('berhasil'))
        alert("{{session('berhasil')}}");
        @endif
    });

    function loadData(id) {
        $("#modalDetail").modal('show');
        // $.ajax({
        //     url: "{{url('')}}",
        //     method: "GET",
        //     success: function(data) {

        //     },
        //     error: function(response) {

        //     }
        // });
    }
</script>
@endsection

@endsection


@section('name')

@endsection