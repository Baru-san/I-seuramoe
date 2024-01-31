<?php

namespace App\Http\Controllers;

use App\Models\Sosials;
use App\Models\Tanahs;
use App\Models\Buahs;
use Illuminate\Http\Request;
use Exception;


class UploadController extends Controller
{
    public function index()
    {
        return view('map.upload');
    }
    public function import(Request $request)
    {
        if ($request->hasFile('geojson_file')) {
            $file = $request->file('geojson_file');
    
            // Check if the uploaded file has a JSON or GeoJSON file extension
            if ($file->getClientOriginalExtension() !== 'json' && $file->getClientOriginalExtension() !== 'geojson') {
                return redirect()->back()->with('error', 'Invalid file format. Please upload a valid GeoJSON file.');
            }
    
            $geojsonData = $file->get();
            $decodedData = json_decode($geojsonData);
            // dd($decodedData);
    
            if ($decodedData === null || json_last_error() !== JSON_ERROR_NONE) {
                return redirect()->back()->with('error', 'Invalid or malformed JSON data. Please upload a valid GeoJSON file.');
            }
    
            if ($request->tipe_file == "Buah"){
                foreach ($decodedData as $feature) {
                $newRecord = new Buahs();
                if ($newRecord !== null) {
                    $newRecord->data = json_encode($feature);
                    $newRecord->save();
                }
                }
            
            }
            // Check if the GeoJSON data has the expected structure
                elseif (isset($decodedData->type) && $decodedData->type === 'FeatureCollection' && isset($decodedData->features)) {
                foreach ($decodedData->features as $feature) {
                    
                    // Access the properties and geometry for each feature
                    $properties = $feature->properties;
                    $geometry = $feature->geometry;

                    // dd($properties);
    
                    // Create a new GeojsonData record with the properties
                    if ($request->tipe_file == "Sosial"){
                        // Decode the "sosial" column for comparison
                        $existingRecord = Sosials::whereJsonContains('data', $properties)
                        ->whereJsonContains('geometry', $geometry)
                            ->first();
                        // dd($existingRecord);
                            try {
                                if ($existingRecord || ($properties && $properties->Surveyor == null)) {
                                    throw new Exception('Data already exists in the table.');
                                }
                             } catch (Exception $e) {
                                return redirect()->back()->with('error', $e->getMessage());
                             }
                            
                        $newRecord = new Sosials();
                    } elseif ($request->tipe_file == "Tanah"){

                        // Decode the "sosial" column for comparison
                        $existingRecord = Tanahs::whereJsonContains('data', $properties)
                        ->whereJsonContains('geometry', $geometry)
                            ->first();
                            if ($existingRecord ||  (!isset($properties->Lereng)) ) {
                                return redirect()->back()->with('error', 'Data already exists in the table.');
                            }                        
                        $newRecord = new Tanahs();
                    } 

                    // Now $newRecord is guaranteed to be defined
                    if ($newRecord !== null) {
                        $newRecord->data = json_encode($properties);
                        $newRecord->geometry = json_encode($geometry);
                        $newRecord->save();
                    }

                }
            } else {
                return redirect()->back()->with('error', 'Invalid GeoJSON structure. Please upload a valid GeoJSON file.');
            }
        } else {
            return redirect()->back()->with('error', 'No file uploaded.');
        }
        return view('map.upload')->with('success', 'GeoJSON data has been successfully imported.');
    }
    
    
}
