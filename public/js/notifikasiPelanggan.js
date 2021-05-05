$("#jumlahNotifikasi").html(100);
$("#jumlahKeranjang").html(100);

 $.ajax({
     url: "{{route('keranjang.notifikasi')}}",
     type: "GET",
     success: function (response) {
         console.log(response);
     },
     error: function (response) {
         console.log(response);
     }
 });