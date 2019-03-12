@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@section('content')

<div id="map"></div>
<div id="loading"><i class="fas fa-circle-notch fa-spin fa-4x"></i></div>

@endsection

@push('after-scripts')
<script>


    var sat = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
        attribution : 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
    });
    
    var osm = L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        attribution : '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
    });

    var baseMaps = {
        "Map" : osm,
        "Satelite" : sat
    };

    var map = L.map('map'
    , { center : [54.1381228, -6.640066],
        zoom : 8,
        layers :[sat]
    });

    L.control.layers(baseMaps, null, {
        collapsed : false
    }).addTo(map);

    var grottos = [];

    $.getJSON("/api/ringforts", function(data) {

        for (var i = 0; i < data.length; i++) {
            var location = data[i].latlng;
            
            //location.push(0.5);
            
            //console.dir(location);

            grottos.push(location);

        }

        // add to map
        var heat = L.heatLayer(grottos, {
            //minOpacity : .25,
            //radius : 25,
            radius : 50,
            minOpacity : .2,
            //max : 1
        }).addTo(map);
        
        $('#loading').hide();

    });

</script>
@endpush

@push('after-styles')
<style>
    #map {
        height: 600px;
        height: 100vh;
    }
</style>
@endpush
