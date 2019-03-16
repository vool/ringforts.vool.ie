@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@section('content')

@include('frontend.includes.sidebar')

<div id="map" class="sidebar-map"></div>
<div id="loading"><i class="fas fa-circle-notch fa-spin fa-4x"></i></div>

@endsection

@push('after-scripts')
<script>

    @isset($entityID)
    var  entityID = "{{$entityID}}";
    @endif

    var sat_arcgis = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
        attribution : 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
    });

    var sat_google = L.tileLayer('https://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}',{
        maxZoom: 20,
        subdomains:['mt0','mt1','mt2','mt3']
    });

    var sat_bing = L.tileLayer.bing('{{Config::get('services.bing.maps_api_key')}}');

    var sat_mapbox = L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox.satellite',
    accessToken: '{{Config::get('services.mapbox.maps_api_key')}}'
});

    var osm = L.tileLayer('https://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        attribution : '&copy; <a href="https://osm.org/copyright">OpenStreetMap</a> contributors'
    });

    var baseMaps = {
        "Map" : osm,
        "Satelite Google" : sat_google,
        "Satelite ArcGIS" : sat_arcgis,
        "Satelite Bing" : sat_bing,
        "Satelite MapBox" : sat_mapbox
    };

    var map = L.map('map', {
        center : [54.1381228, -6.640066],
        zoom : 8,
        maxZoom: 18,
        layers : [sat_arcgis, sat_google]
    });

    var parentGroup = L.markerClusterGroup();

    parentGroup.on("click", function(e){
        var marker = e.layer;

        history.pushState(null, '', marker.properties.entity_id);

        $('#entity_id').html(marker.properties.entity_id);

        ['googlelocMap', 'yandexlocMap', 'binglocMap', 'mapboxlocMap']
            .forEach(function(entry) {
                $('#'+entry).attr("src",'');
            });

        ['classcode', 'link', 'smrs', 'latlng', 'tland_names','status', 'amended']
            .forEach(function(entry) {
                $('#'+entry).attr("src",'');
            });

        $.getJSON("/api/ringforts/"+marker.properties.entity_id, function(data) {

            $('#googlelocMap').attr("src", "https://maps.googleapis.com/maps/api/staticmap?center="+data.lat+","+data.long+"&zoom=17&size=400x400&&maptype=satellite&markers=color:red|anchor:center|"+data.lat+","+data.long+"&key={{Config::get('services.google.maps_api_key')}}");

            $('#yandexlocMap').attr("src", "https://static-maps.yandex.ru/1.x/?lang=en-US&ll="+data.long+","+data.lat+"&z=17&l=sat&size=400,400");

            $('#binglocMap').attr("src", "https://dev.virtualearth.net/REST/V1/Imagery/Map/Aerial/"+data.lat+"%2C"+data.long+"/17?mapSize=400,400&pushpin="+data.lat+","+data.long+";45&format=png&key={{Config::get('services.bing.maps_api_key')}}");

            $('#mapboxlocMap').attr("src", "https://api.mapbox.com/styles/v1/mapbox/satellite-v9/static/"+data.long+","+data.lat+",16/400x400?access_token={{Config::get('services.mapbox.maps_api_key')}}");

            $('#entity_id').html(data.entity_id);

            $('#classcode').html(data.classcode);

            $('#classdesc').html(data.classdesc);

            $('#link').attr("href", data.link);

            $('#smrs').html(data.smrs);

            $('#latlng').html(data.latlng.join(','));

            $('#tland_names').html(data.tland_names);

            if(data.status){
                $('#status').html('<i class="fas fa-check"></i>');
            }else{
                $('#status').html('<i class="fas fa-times"></i>');
            }

            $('#amended').html(data.amended);

        });

        sidebar.open('profile');
    });

    var rejected = L.featureGroup.subGroup(parentGroup);
    //L.featureGroup();
    var pending = L.featureGroup.subGroup(parentGroup);
    //L.featureGroup();
    var confirmed = L.featureGroup.subGroup(parentGroup);
    //L.featureGroup();

    var sidebar = L.control.sidebar('sidebar').addTo(map);

    parentGroup.addTo(map);
    rejected.addTo(map);
    pending.addTo(map);
    confirmed.addTo(map);

    var overlayMaps = {
        "Rejected" : rejected,
        "Pending" : pending,
        "Confirmed" : confirmed
    };

    L.control.layers(baseMaps, overlayMaps, {
        collapsed : false
    }).addTo(map);


    var greenIcon = new L.Icon({
        iconUrl : '/img/leaflet/marker-icon-green.png',
        shadowUrl : '/img/leaflet/marker-shadow.png',
        iconSize : [25, 41],
        iconAnchor : [12, 41],
        popupAnchor : [1, -34],
        shadowSize : [41, 41]
    });

    var redIcon = new L.Icon({
        iconUrl : '/img/leaflet/marker-icon-red.png',
        shadowUrl : '/img/leaflet/marker-shadow.png',
        iconSize : [25, 41],
        iconAnchor : [12, 41],
        popupAnchor : [1, -34],
        shadowSize : [41, 41]
    });

    var yelloIcon = new L.Icon({
        iconUrl : '/img/leaflet/marker-icon-blue.png',
        shadowUrl : '/img/leaflet/marker-shadow.png',
        iconSize : [25, 41],
        iconAnchor : [12, 41],
        popupAnchor : [1, -34],
        shadowSize : [41, 41]
    });

    $.getJSON("/api/ringforts", function(data) {

        data.map(function(item) {

            //tip = item.smrs;

            var marker = L.marker(item.latlng, {
                icon : greenIcon
            });//.bindPopup(tip);

            marker.properties = {};
            marker.properties.entity_id = item.entity_id;

            switch (item.status) {
            case -1:
                marker.addTo(rejected);
                break;
            case 0:
                marker.addTo(pending);

                break;
            case 1:
                marker.addTo(confirmed);
                break;
            }

            // check if requested viewID
            if ( typeof entityID !== 'undefined' && item.entity_id == entityID) {
                // activate
                marker.fire('click');

            }

            $('#loading').hide();

        });

    });

</script>
@endpush

@push('after-styles')
<style>
    #map {
        height: 600px;
        height: 100vh;
    }

    #loading{
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        transform: -webkit-translate(-50%, -50%);
        transform: -moz-translate(-50%, -50%);
        transform: -ms-translate(-50%, -50%);
        color:#000;
    }
</style>
@endpush
