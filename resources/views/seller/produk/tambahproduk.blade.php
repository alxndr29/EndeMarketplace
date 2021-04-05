@extends('layouts.adminlte')
@section('content')
<div class="container-fluid">
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
                            <img id="blah" src="#" alt="your image" />
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
        </div>
    </div>

</div>
@section('js')
<script type="text/javascript">
    $(document).ready(function() {

    });

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
            $('#preview').append('<img src="' + gambar[i] + '" id="preview-gambar" data-id="' + gambar[i] + '">')
        }
    }
    $("body").on("click", "#preview-gambar", function(e) {

        var id = $(this).attr('data-id');
        if(confirm('Ingin menghapus?')){
            alert(id);
        }else{

        }
        alert(id);
    });
    $("#test").click(function() {
        //console.log(gambar);
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
</script>
@endsection
@endsection