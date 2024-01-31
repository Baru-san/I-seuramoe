<?php

namespace App\Http\Controllers;

use App\Models\Buahs;
use App\Models\Sosials;
use App\Models\Tanahs;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index()
    {
        $data = Sosials::all();
        $data_sosials = json_decode($data);

        return view('map.map', ['data' => $data_sosials]);
    }

    public function detail($slug)
    {
        $data = Sosials::whereJsonContains('data->Sample', $slug)->first();
        $data_sosials = json_decode($data);
        $data2 = json_decode($data_sosials->data);
        $data3 = json_decode($data_sosials->geometry);
    
        $sample = explode("_", $data2->Sample)[0];
        $newString = preg_replace('/(\d+)/', ' $1', $sample);

        
        $tanah = Tanahs::whereJsonContains('data->Kode_Sampe', $sample)->first();

        $buah = Buahs::whereJsonContains('data->Sampel', $newString)->first();
        // $dataTanah = Tanahs::all();
        $tanah = optional($tanah)->data ? json_decode($tanah->data) : null;
        $buah = optional($buah)->data ? json_decode($buah->data) : null;
    

        return view('map.detail', [
            'spot' => $data2,
            'long' => $data3->coordinates[0],
            'lat' => $data3->coordinates[1],
            'tanah' => $tanah,
            'buah' => $buah,
        ]);
    }

    public function data()
    {
       $data = Sosials::all();
       $data = json_decode($data);
       
       
       return response()->json($data);
    }
}
