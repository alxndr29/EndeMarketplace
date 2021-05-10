<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <title>Hello, world!</title>
</head>

<body>
    <div class="container">
        <div class="text-center" id="demo">
            <h1>Hello, world!</h1>
        </div>
        <div class="text-center" id="demo2">

        </div>
        <div class="text-center" id="map" style="height:500px; width100%">

        </div>
        <button type="button" id="pindahKurir">pindah kurir</button>
        <button type="button" id="pindahKurir1">pindah kurir</button>
        <button type="button" id="pindahKurir2">pindah kurir</button>
        <button type="button" id="pindahKurir3">pindah kurir</button>
    </div>
</body>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1MgLuZuyqR_OGY3ob3M52N46TDBRI_9k&callback=initMap&libraries=&v=weekly" async>
</script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script type="text/javascript">
    var latitude = "";
    var longitude = "";
    var latitude_origin = "-8.844153207327944";
    var longitude_origin = "121.66772437271936";
    var latitude_destination = "-8.832875434471921";
    var longitude_destination = "121.67776419122903";

    var loc = false;
    var second = 0;

    $(document).ready(function() {
        getLocation();
        setInterval(function() {
            second++;
            if (second == 10) {
                loc = true;
                second = 0;
            } else {
                loc = false;
            }
        }, 1000);

    });

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.watchPosition(
                function(position) {
                    //alert(position.coords.latitude +"x"+ position.coords.longitude);
                    latitude = position.coords.latitude;
                    longitude = position.coords.longitude;
                    if (loc == true) {
                        updateLokasiKurir();
                        alert('detik');
                    }
                },
                function() {
                    alert("Geocoder failed");
                }, {
                    timeout: 10000,
                    enableHighAccuracy: true
                });
            iniatMap();
            
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    // function showPosition(position) {
    //     latitude = position.coords.latitude;
    //     longitude = position.coords.longitude;
    //     alert(latitude + longitude);
    //     iniatMap();
    // }

    var map;
    var myLatlng;
    var lokasiKurir;
    var mapOptions;

    var marker;
    var marker2;
    var marker3;

    function iniatMap() {
        alert('sekali doang');
        myLatlng = new google.maps.LatLng(latitude_destination, longitude_destination);
        latlng = new google.maps.LatLng(latitude_origin, longitude_origin);
        lokasiKurir = new google.maps.LatLng(latitude, longitude);
        mapOptions = {
            zoom: 15,
            center: myLatlng
        }
        map = new google.maps.Map(document.getElementById("map"), mapOptions);
        $("#demo").append('Jarak Kurir ke tujuan = ' + jarakKeTujuan(latitude, longitude, latitude_destination, longitude_destination, 'K') + ' Kilometer <br>');
        test();

    }

    function test() {
        marker = new google.maps.Marker({
            position: myLatlng,
            title: "Hello World!",
            label: "Lokasi Pembeli (Tujuan)"
        });
        // To add the marker to the map, call setMap();
        marker2 = new google.maps.Marker({
            position: latlng,
            title: "Hello World!",
            label: "Lokasi Penjual (Awal)"
        });
        //kurir
        marker3 = new google.maps.Marker({
            position: lokasiKurir,
            title: "Hello World!",
            label: "Lokasi Kurir"
        });
        marker.setMap(map);
        marker2.setMap(map);
        marker3.setMap(map);
    }
    $("#pindahKurir").click(function() {
        //-8.845654574032876, 121.66723135955436
        latitude = "-8.845654574032876";
        longitude = "121.66723135955436";
        updateLokasiKurir();
    });
    $("#pindahKurir1").click(function() {
        //-8.844583843790094, 121.67058948594482
        latitude = "-8.844583843790094";
        longitude = "121.67058948594482";
        updateLokasiKurir();
    });
    $("#pindahKurir2").click(function() {
        //-8.838742514074765, 121.67476505158152
        latitude = "-8.838742514074765";
        longitude = "121.67476505158152";
        updateLokasiKurir();
    });
    $("#pindahKurir3").click(function() {
        //-8.834226217513532, 121.67779055355581
        latitude = "-8.834226217513532";
        longitude = "121.67779055355581";
        updateLokasiKurir();
    });

    function updateLokasiKurir() {
        if (marker3 != null) {
            marker3.setMap(null);
        }
        //marker3.setMap(null);
        lokasiKurir = new google.maps.LatLng(latitude, longitude);
        marker3 = new google.maps.Marker({
            position: lokasiKurir,
            title: "Hello World!",
            label: "Lokasi Kurir"
        });
        marker3.setMap(map);
        $("#demo").html('Jarak Kurir ke tujuan = ' + jarakKeTujuan(latitude, longitude, latitude_destination, longitude_destination, 'K') + ' Kilometer <br>');
    }

    function jarakKeTujuan(lat1, lon1, lat2, lon2, unit) {
        var radlat1 = Math.PI * lat1 / 180
        var radlat2 = Math.PI * lat2 / 180
        var theta = lon1 - lon2
        var radtheta = Math.PI * theta / 180
        var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
        dist = Math.acos(dist)
        dist = dist * 180 / Math.PI
        dist = dist * 60 * 1.1515
        if (unit == "K") {
            dist = dist * 1.609344
        }
        if (unit == "N") {
            dist = dist * 0.8684
        }
        if (dist < 0.3) {
            $("#demo2").html('kirim notif kalau sdh dekat');
        } else {
            $("#demo2").html('masih jauh');
        }
        return dist;
    }
</script>

</html>