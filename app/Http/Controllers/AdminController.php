<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Sosials;
use App\Models\Tanahs;
use App\Models\Buahs;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;



class AdminController extends Controller
{

    public function sosialData(){
        $data = Sosials::all()->toArray();
        $sampleData = [];
        $slug = [];
        $desaData = [];
        $kecData = [];
        $kabData = [];
      
        foreach ($data as $sosial) {
            $properties = json_decode($sosial['data'], true);
            $sampleData[] = ['Sample' => $properties['Sample'].', '.$properties['Desa'].', '.$properties['Kec'].', '.$properties['Kab']];

        }
      
        return datatables()->of($sampleData)
            ->addColumn('action', 'admin.action')
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
      }
      

    public function index(){
        return view('admin.index');
    }

    public function edit(Request $request){
        $data = explode(', ', $request->Sample);
        
        $slug = $data[0];
        $sample = $data[1];

     
        
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
     
        return view('admin.edit', [
            'spot' => $data2,
            'long' => $data3->coordinates[0],
            'lat' => $data3->coordinates[1],
            'tanah' => $tanah,
            'buah' => $buah,
        ]);
     }

    public function update_sosial(Request $request)
    {
        $slug = $request->sample.', '.$request->Desa;
        $data_old = Sosials::whereJsonContains('data->Sample', $request->sample_old)->first();
        

        if($data_old){
            $data_sosial = json_decode($data_old);
            $data = json_decode($data_sosial->data);
            
            $data->Sample = $request->sample;
            $data->Kab = $request->Kabupaten;
            $data->Kec = $request->Kecamatan;
            $data->Desa = $request->Desa;
            $data_old->update([
                'data'=> json_encode($data)
            ]);
        }

        return Redirect::route('Data.edit', ['Sample' => $slug])->with('status', 'sosial-updated');

    }

    public function update_tanah(Request $request)
    {
        $slug = $request->slug_sample.', '.$request->slug_Desa;
        $data_old = Tanahs::whereJsonContains('data->Kode_Sampe', $request->sample_old)->first();
        
        if($data_old){
            $data_tanah = json_decode($data_old);
            $data = json_decode($data_tanah->data);
            
            $data->Kode_Sampe = $request->sample;
            $data->Umur = $request->Umur;
            $data->Lereng = $request->Lereng;
            $data->Drainase = $request->Drainase;
            $data->Genangan = $request->Genangan;
            $data->Topografi = $request->Topografi;
            $data->Bahaya_Ero = $request->Bahaya_Ero;
            $data->Batuan_Per = $request->Batuan_Per;
            $data->Batuan_Sin = $request->Batuan_Sin;
            $data->Ketinggian = $request->Ketinggian;


            $data_old->update([
                'data'=> json_encode($data)
            ]);
        }

        return Redirect::route('Data.edit', ['Sample' => $slug])->with('status', 'tanah-updated');

    }

    public function update_buah(Request $request)
    {
        $slug = $request->slug_sample.', '.$request->slug_Desa;
        $data_old = Buahs::whereJsonContains('data->Sampel', $request->sample_old)->first();
        
        if($data_old){
            $data_bauh = json_decode($data_old);
            $data = json_decode($data_bauh->data);
            
            $data->Sampel = $request->sample;
            $data->ALB = $request->ALB;
            $data->RENDEMEN = $request->Rendemen;
            $data->DENSITAS = $request->Densitas;
            $data->min_transmittan = $request->min_transmittan;
            $data->max_transmittan = $request->max_transmittan;
            $data->min_gelombang = $request->min_gelombang;
            $data->max_gelombang = $request->max_gelombang;




            $data_old->update([
                'data'=> json_encode($data)
            ]);
        }

        return Redirect::route('Data.edit', ['Sample' => $slug])->with('status', 'buah-updated');

    }

    public function listUsers(){
        
        return view('admin.listUser');
    }

    public function userData(){
        $data = User::all()->toArray();
      
        foreach ($data as $data) {
            $sampleData[] = [
                'Sample' => $data['name'], 
                'Email' => $data['email']
            ];
        }
      
        return datatables()->of($sampleData)
            ->addColumn('action', 'admin.deleteUserBtn')
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }
    
    public function deleteUser(Request $request){
        $email = $request->Email;
        $user = User::where('email', $email)->first();
    
        if ($user) {
            User::destroy($user->id);
        }
        return redirect()->back();

    }

}
