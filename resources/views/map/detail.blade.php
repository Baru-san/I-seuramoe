@extends('template.blank')

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet-search@3.0.9/dist/leaflet-search.src.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet.fullscreen@2.4.0/Control.FullScreen.min.css">

    <style>
        #map{height: 400px;
        },
        .min-w-0 {
  border-width: 3px;
  border-color: #000000;
  border-style: solid;
}
    </style>
@endsection


@section('content')
<div class="container bg-white px-5 mt-4 rounded-md pb-3">
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
    <div class="grid mt-16 gap-6 mb-8 md:grid-cols-2">
        <div
          class="border min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
        >
          <h4 class="mb-4 font-semibold text-black dark:text-gray-300">
            Data Sosial
          </h4>
          <p class="text-gray-600 dark:text-gray-400">
            <ul>
                <li><strong>sample :</strong> {{ $spot->Sample }}</li>
                <li><strong>Longitude :</strong> {{ $long }}</li>
                <li><strong>Latitude :</strong> {{ $lat }}</li>
                <li><strong>Kabupaten :</strong> {{ $spot->Kab }}</li>
                <li><strong>Desa :</strong> {{ $spot->Desa }}</li>
                <li><strong>Kecamatan :</strong> {{ $spot->Kec }}</li>
          </p>
        </div>
        @isset($tanah)

        <div
          class="border min-w-0 p-4 text-black  rounded-lg shadow-xs"
        >
        <h4 class="mb-4 font-semibold">
          Data Tanah
      </h4>
      <p>
          <li><strong>Umur :</strong> {{ $tanah->Umur }}</li>
          <li><strong>Lereng :</strong> {{ $tanah->Lereng }}</li>
          <li><strong>Drainase :</strong> {{ $tanah->Drainase }}</li>
          <li><strong>Genangan :</strong> {{ $tanah->Genangan }}</li>
          <li><strong>Topografi :</strong> {{ $tanah->Topografi }}</li>
          <li><strong>Bahaya Erosi :</strong> {{ $tanah->Bahaya_Ero }}</li>
          <li><strong>Batuan Per :</strong> {{ $tanah->Batuan_Per }}</li>
          <li><strong>Batuan Sin :</strong> {{ $tanah->Batuan_Sin }}</li>
          <li><strong>Ketinggian :</strong> {{ $tanah->Ketinggian }}</li>
      </p>
      </div>
      @endisset


        <div
          class="border min-w-0 p-4 text-black  rounded-lg shadow-xs"
        >
          <h4 class="mb-4 font-semibold">
            Data Buah
          </h4>
          <p>
            <li><strong>Sampel :</strong> {{ $buah->Sampel }}</li>
            <li><strong>ALB :</strong> {{ $buah->ALB }}</li>
            <li><strong>Rendemen :</strong> {{ $buah->RENDEMEN }}</li>
            <li><strong>Densitas :</strong> {{ $buah->DENSITAS }}</li>
          </p>
          <br>
          <h5 class="mb-4 font-semibold">
            persentase Transmittan (%)
          </h5>
          <p>
            <li><strong>Min :</strong> {{ $buah->min_transmittan }}</li>
            <li><strong>Max :</strong> {{ $buah->max_transmittan }}</li>
          </p>

          <br>
          <h5 class="mb-4 font-semibold">
            Bilangan Gelombang (cm^-1)
            </h5>
          <p>
            <li><strong>Min :</strong> {{ $buah->min_gelombang }}</li>
            <li><strong>Max :</strong> {{ $buah->max_gelombang }}</li>
          </p>
        </div>
      </div>
@endsection

@push('javascript')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script src="https://cdn.jsdelivr.net/npm/leaflet-search@3.0.9/dist/leaflet-search.src.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/leaflet.fullscreen@2.4.0/Control.FullScreen.min.js"></script>

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
            center: [{{ $lat }}, {{ $long }}],
            zoom: 13,
            layers: [googleSat],
            fullscreenControl: {
                pseudoFullscreen: false
            }
        })

        const baseLayers = {
            'Openstreetmap': osm,
            'GoogleStreet' : googleStreets,
            'googleSatelite' : googleSat,
        }

        var marker = L.marker([{{ $lat }}, {{ $long }}], {
        draggable: true,
    })
    .addTo(map);

        


        const layerControl = L.control.layers(baseLayers).addTo(map)
    </script>
@endpush