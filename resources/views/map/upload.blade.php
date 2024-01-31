@extends('template.blank')
    
@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
    crossorigin=""/>

    <style>
        #map {
            height: 400px;
        },
        
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                <div style="margin-top:50px">
                <span class="px-3 py-2 font-semibold leading-tight text-red-700 bg-red-100 rounded-md dark:text-red-100 dark:bg-red-700">
                    {{ session('error') }}
                  </span>
                </div>
            @endif

            <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800" style="margin-top: 50px">
                <div class="card-header">Jenis File</div>
                <div class="card-body">
                    <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="inline-block mr-5 w-64">
                            <select name="tipe_file" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                            <option value="Sosial">Sosial</option>
                            <option value="Tanah">Tanah</option>
                            <option value="Buah">Buah</option>
                            </select>
                        </div>
        
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" style="margin-top:2em" for="file_input">Upload file</label>
                        <input class="relative m-0 block w-full min-w-0 flex-auto rounded border border-solid border-neutral-300 bg-clip-padding py-[0.32rem] text-base font-normal text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-neutral-200 focus:border-primary focus:text-neutral-700 focus:shadow-te-primary focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:file:bg-neutral-700 dark:file:text-neutral-100 dark:focus:border-primary"
                        aria-describedby="file_input_help" id="file_input" type="file" name="geojson_file">
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">JSON FILE</p>
        
                        {{-- <input type="file" name="geojson_file"> --}}
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded" style="margin-top:2em"    >
                            Import
                        </button>
                    </form>
                    @if ($errors->any())
                        <div class="alert alert-danger mt-3">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
              </div>

            </div>
        </div>
    </div>


@endsection

@push('javascript')
    <!-- Inside your Blade view -->
    <script>
        // Access the variable passed from the controller
        var numColumns = {{ $numColumns ?? 'null' }}; // Default to 'null' if not set

        // Log to the console
        console.log(numColumns);
    </script>
@endpush

