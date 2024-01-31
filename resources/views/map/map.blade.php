@extends('template.blank')


@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
    crossorigin=""/>

    <style>
        #map{height: 600px;
            z-index: 1;
        }
    </style>
@endsection

@section('search')
    <div class="search-box">
      <div class="search-row">
          <input type="text" id="input-box" placeholder="cari tempat" autocomplete="off">
          <button id="magnifying"><i class="fa-solid fa-magnifying-glass"></i></button>
      </div>
      <div class="result-box">
      </div>
    </div>
    @endsection

@section('content')

<div class="container bg-white px-5 mt-16 rounded-md pb-16">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="margin-top:2rem"></div>
                <div class="card-body">
                    <div id="map" class="rounded-md"></div>
                </div>
            </div>
        </div>
    </div>

@php
    $featureCollection = [
        "type" => "FeatureCollection",
        "features" => []
    ];

    foreach ($data as $item) {
        $feature = [
            "type" => "Feature",
            "properties" => [
                "name" => json_decode($item->data), // Adjust the property name as needed
                // Add other properties here
            ],
            "geometry" => json_decode($item->geometry) // Assuming "geometry" is a JSON string
        ];
        $featureCollection["features"][] = $feature;
    }
@endphp

</div>
@endsection

    
@push('javascript')

            <!-- Make sure you put this AFTER Leaflet's CSS -->
            <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
            crossorigin="">
            </script>
            <script src="https://unpkg.com/leaflet-search@2.3.6/dist/leaflet-search.min.js"></script>

        
            <script>
            var osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            });
            
                var googleStreets = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
                maxZoom: 20,
                subdomains:['mt0','mt1','mt2','mt3']
            });
            

            // Satelite Layer
            var googleSat = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}',{
            maxZoom: 20,
            subdomains:['mt0','mt1','mt2','mt3']
            });

        var map = L.map('map', {
            center: [3.8696531456968746, 96.9375534285252],
            zoom: 8,
            layers: [googleSat],
            fullscreenControl: {
                pseudoFullscreen: false
            }
        })        
                const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                }).addTo(map);
        
        var featureCollection = @json($featureCollection);
    
        var combinedFeatureCollection = {
            "type": "FeatureCollection",
            "features": [
                
                ...featureCollection.features
            ]
        };

        const baseLayers = {
            'Openstreetmap': osm,
            'GoogleStreet' : googleStreets,
            'googleSatelite' : googleSat,
        }
    
                // L.geoJSON(combinedFeatureCollection).addTo(map);
                var i = 1;

                let geojsonLayer = L.geoJSON(featureCollection, {
                    onEachFeature: function (feature, layer) {
                        // Extract the "Surveyor" property from the feature's properties
                        var sample = feature.properties.name.Sample;
                        var kab = feature.properties.name.Kab;
                        var desa = feature.properties.name.Desa;
                        // Create the popup content with the "Surveyor" value                        

                        // Bind the popup to the feature
                        layer.bindPopup("<div class='my-2'><span style='font-weight: bold;'>Sample</span><br>" + sample + "</div>" +
                            "<div class='my-2'><span style='font-weight: bold;'>Lokasi</span><br>" + kab + ", " + desa + "</div>" +
                            "<div style='display: flex; justify-content: center;'>" +
                                "<a href='/map-detail/"+ sample +"'><button class='mt-4 bg-blue-500 hover:bg-gray-700 text-white font-bold py-2 px-4 border border-blue-700 rounded'>Detail Spot</button></a>" +
                            "</div>");
                    }
                }).addTo(map);



                const layerControl = L.control.layers(baseLayers).addTo(map)

                // L.Control.geocoder().addTo(map);

                

            </script>
            <script>
                
            </script>
@endpush

