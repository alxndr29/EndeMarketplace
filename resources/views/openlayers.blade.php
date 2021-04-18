<!DOCTYPE HTML>
<html>

<head>
    <title>OpenLayers Simplest Example</title>
</head>

<body>
    <div id="Map" style="height:500px;">
        <div id="menu">
            <button id="zoom-out">Click to zoom out</button>
            <button id="zoom-in">Click to enlarge</button>
            <button id="zoom-panto">Pan to Wuhan</button>
            <button id="zoom-restore">reset</button>
        </div>
    </div>

</body>
<script src="{{asset('osm/OpenLayers.js')}}"></script>
<script>

    var lat = -8.1926667;
    var lon = 113.6526918;
    var zoom = 18;
    var fromProjection = new OpenLayers.Projection("EPSG:4326"); // Transform from WGS 1984
    var toProjection = new OpenLayers.Projection("EPSG:900913"); // to Spherical Mercator Projection
    var position = new OpenLayers.LonLat(lon, lat).transform(fromProjection, toProjection);

    var map = new OpenLayers.Map("Map");
    var mapnik = new OpenLayers.Layer.OSM();
    map.addLayer(mapnik);

    var markers = new OpenLayers.Layer.Markers("Markers");
    map.addLayer(markers);
    markers.addMarker(new OpenLayers.Marker(position));
    map.setCenter(position, zoom);

    var view = map.getView();
    var zoom = view.getZoom();
    var center = view.getCenter();
    var rotation = view.getRotation();
    document.getElementById('zoom-out').onclick = function() {
        alert('hello world!');
        var view = map.getView();
        var zoom = view.getZoom();
        view.setZoom(zoom - 1);
    };
    document.getElementById('zoom-in').onclick = function() {
        var view = map.getView();
        var zoom = view.getZoom();
        view.setZoom(zoom + 1);
    };
    document.getElementById('zoom-panto').onclick = function() {
        var view = map.getView();
        var wh = ol.proj.fromLonLat([114.31667, 30.51667]);
        view.setCenter(wh);
    };
    document.getElementById('zoom-restore').onclick = function() {
        view.setCenter(center);
        view.setRotation(rotation);
        view.setZoom(zoom);
    };
    $('.ol-zoom-in, .ol-zoom-out').tooltip({
        placement: 'right'
    });
    $('.ol-rotate-reset, .ol-attribution button[title]').tooltip({
        placement: 'left'
    });
</script>

</html>