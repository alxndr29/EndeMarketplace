@extends('layouts.adminlte')
@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-12 col-lg-3">
            <div class="card h-100">
                <div class="card-header">
                    Obrolan
                </div>
                <div class="card-body">
                    <ul class="products-list product-list-in-card pl-2 pr-2">
                        @foreach($data as $key => $value)
                        <li class="item">
                            <div class="product-img">
                                <img src="{{asset('adminlte/dist/img/user1-128x128.jpg')}}" alt="Product Image" class="img-size-50">
                            </div>
                            <div class="product-info">
                                <a href="javascript:void(0)" id="pilihUser" data-id="{{$value->iduser}}" class="product-title">{{$value->nama_user}}
                                    <span class="badge badge-warning float-right">R</span></a>
                                <span class="product-description">
                                    {{$value->isi_pesan}}
                                </span>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>
        <div class="col-12 col-lg-9">
            <!-- DIRECT CHAT -->
            <div class="card h-100 direct-chat direct-chat-warning">
                <div class="card-header">
                    <h3 class="card-title">Direct Chat</h3>

                    <!-- <div class="card-tools">
                        <span title="3 New Messages" class="badge badge-warning">3</span>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" title="Contacts" data-widget="chat-pane-toggle">
                            <i class="fas fa-comments"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div> -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <!-- Conversations are loaded here -->
                    <div class="direct-chat-messages" id="kolomchat">



                    </div>
                    <!--/.direct-chat-messages-->

                    <!-- Contacts are loaded here -->
                    <div class="direct-chat-contacts">
                        <ul class="contacts-list">
                            <li>
                                <a href="#">
                                    <img class="contacts-list-img" src="{{asset('adminlte/dist/img/user1-128x128.jpg')}}" alt="User Avatar">

                                    <div class="contacts-list-info">
                                        <span class="contacts-list-name">
                                            Count Dracula
                                            <small class="contacts-list-date float-right">2/28/2015</small>
                                        </span>
                                        <span class="contacts-list-msg">How have you been? I was...</span>
                                    </div>
                                    <!-- /.contacts-list-info -->
                                </a>
                            </li>
                            <!-- End Contact Item -->
                            <li>
                                <a href="#">
                                    <img class="contacts-list-img" src="{{asset('adminlte/dist/img/user1-128x128.jpg')}}" alt="User Avatar">

                                    <div class="contacts-list-info">
                                        <span class="contacts-list-name">
                                            Sarah Doe
                                            <small class="contacts-list-date float-right">2/23/2015</small>
                                        </span>
                                        <span class="contacts-list-msg">I will be waiting for...</span>
                                    </div>
                                    <!-- /.contacts-list-info -->
                                </a>
                            </li>
                            <!-- End Contact Item -->
                            <li>
                                <a href="#">
                                    <img class="contacts-list-img" src="{{asset('adminlte/dist/img/user1-128x128.jpg')}}" alt="User Avatar">

                                    <div class="contacts-list-info">
                                        <span class="contacts-list-name">
                                            Nadia Jolie
                                            <small class="contacts-list-date float-right">2/20/2015</small>
                                        </span>
                                        <span class="contacts-list-msg">I'll call you back at...</span>
                                    </div>
                                    <!-- /.contacts-list-info -->
                                </a>
                            </li>
                            <!-- End Contact Item -->
                            <li>
                                <a href="#">
                                    <img class="contacts-list-img" src="{{asset('adminlte/dist/img/user1-128x128.jpg')}}" alt="User Avatar">

                                    <div class="contacts-list-info">
                                        <span class="contacts-list-name">
                                            Nora S. Vans
                                            <small class="contacts-list-date float-right">2/10/2015</small>
                                        </span>
                                        <span class="contacts-list-msg">Where is your new...</span>
                                    </div>
                                    <!-- /.contacts-list-info -->
                                </a>
                            </li>
                            <!-- End Contact Item -->
                            <li>
                                <a href="#">
                                    <img class="contacts-list-img" src="{{asset('adminlte/dist/img/user1-128x128.jpg')}}" alt="User Avatar">

                                    <div class="contacts-list-info">
                                        <span class="contacts-list-name">
                                            John K.
                                            <small class="contacts-list-date float-right">1/27/2015</small>
                                        </span>
                                        <span class="contacts-list-msg">Can I take a look at...</span>
                                    </div>
                                    <!-- /.contacts-list-info -->
                                </a>
                            </li>
                            <!-- End Contact Item -->
                            <li>
                                <a href="#">
                                    <img class="contacts-list-img" src="{{asset('adminlte/dist/img/user1-128x128.jpg')}}" alt="User Avatar">

                                    <div class="contacts-list-info">
                                        <span class="contacts-list-name">
                                            Kenneth M.
                                            <small class="contacts-list-date float-right">1/4/2015</small>
                                        </span>
                                        <span class="contacts-list-msg">Never mind I found...</span>
                                    </div>
                                    <!-- /.contacts-list-info -->
                                </a>
                            </li>
                            <!-- End Contact Item -->
                        </ul>
                        <!-- /.contacts-list -->
                    </div>
                    <!-- /.direct-chat-pane -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <form action="#" method="post">
                        <div class="input-group">
                            <input type="text" name="message" id="text" placeholder="Type Message ..." class="form-control">
                            <span class="input-group-append">
                                <button type="button" class="btn btn-warning" id="send">Send</button>
                            </span>
                        </div>
                    </form>
                </div>
                <!-- /.card-footer-->
            </div>
            <!--/.direct-chat -->
        </div>

    </div>

</div>

@section('js')
<script type="text/javascript">
    $(document).ready(function() {
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
        $("#kolomchat").empty();
        //loadObrolan();

        $("#send").click(function() {
            insertObrolan();
        });
        var iduser = 0;
        var interval = [];

        $("body").on("click", "#pilihUser", function(e) {
            interval.forEach(clearInterval);
            var id = $(this).attr('data-id');
            iduser = id;
            var counter = 0;
            var i = setInterval(function() {
                counter++;
                //alert(counter);
                loadObrolan(id);
            }, 100);
            interval.push(i);
        });

        function insertObrolan() {
            var pesan = $("#text").val();
            $.ajax({
                url: "{{route('obrolan.seller.store')}}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "subject": "cobasubject",
                    "isipesan": pesan,
                    "iduser": iduser
                },
                success: function(response) {
                    console.log(response);
                    if (response.status == "berhasil") {
                        $("#text").val("");
                    }
                }
            });
        }

        function loadObrolan(id) {
            $.ajax({
                url: "{{url('seller/obrolan/get')}}" + "/" + id,
                type: "GET",
                success: function(response) {
                    $("#judulChat").html(response[0].nama_user);
                    $("#kolomchat").empty();
                    for (i = 0; i < response.length; i++) {
                        if (response[i].pengirim == "Merchant") {
                            $("#kolomchat").append('<div class="direct-chat-msg right"> <div class = "direct-chat-infos clearfix" ><span class = "direct-chat-name float-right" >' + response[i].nama_merchant + '</span> <span class = "direct-chat-timestamp float-left" > ' + response[i].waktu + ' </span> </div> <!--/.direct-chat-infos --> <img class = "direct-chat-img" src ="{{asset("adminlte/dist/img/user1-128x128.jpg")}}" alt = "message user image" ><!--/.direct-chat-img --> <div class = "direct-chat-text" >' + response[i].isi_pesan + '</div> <!--/.direct-chat-text --> </div>');

                        } else {
                            $("#kolomchat").append('<div class="direct-chat-msg"> <div class = "direct-chat-infos clearfix" ><span class = "direct-chat-name float-left" >' + response[i].nama_user + '</span> <span class = "direct-chat-timestamp float-right" >' + response[i].waktu + '</span> </div> <!--/.direct-chat-infos --> <img class = "direct-chat-img" src ="{{asset("adminlte/dist/img/user1-128x128.jpg")}}" alt = "message user image" ><!--/.direct-chat-img --> <div class = "direct-chat-text" >' + response[i].isi_pesan + '</div> <!--/.direct-chat-text --> </div>');
                        }
                    }
                    console.log(response);
                }
            });
        }
    });
</script>
@endsection

@endsection