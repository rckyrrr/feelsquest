<?php

namespace App\Http\Controllers;

use App\Models\package;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PackageController extends Controller
{

    public function index()
    {
        $packages = package::where('status_package','active')->get();
        return view('user.Paket',compact('packages'));
    }

    public function addPackage(Request $request)
    {
        $icon = $request->icon->getClientOriginalName() . '-' . time()
                    . '.' . $request->icon->extension();
        $request->icon->move(public_path('image_uploaded/image_package'), $icon);

        $package = new package();
        $package->packageUUID = str_replace('-', '', substr(Str::uuid(), 0, 16));
        $package->admin_id = Auth::user()->id;
        $package->name = $request->nama_paket;
        $package->description = $request->deskripsi;
        $package->total_sessions = $request->jumlah_sesi;
        $package->price = $request->harga_paket;
        $package->status_package = 'active';
        $package->save();

        $features = $request->input('fitur');
        foreach($features as $feature){
            $package->features()->attach($feature,['package_id' => $package->id]);
        }
        return redirect()->back();
    }

    public function updatePackage(Request $request, $id)
    {
        $package = package::find($id);
        if($request->hasFile('icon')){
            $icon = $request->icon->getClientOriginalName() . '-' . time()
                    . '.' . $request->icon->extension();
            $request->icon->move(public_path('image_uploaded/image_package'), $icon);
            $package->name = $request->nama_paket;
            $package->description = $request->deskripsi;
            $package->total_sessions = $request->jumlah_sesi;
            $package->price = $request->harga_paket;
            $package->status_package = 'active';
            $package->save();
            $features = $request->input('fitur');
            foreach($features as $feature){
                $package->features()->attach($feature,['package_id' => $package->id]);
            }
        }else{
            $package->name = $request->nama_paket;
            $package->description = $request->deskripsi;
            $package->total_sessions = $request->jumlah_sesi;
            $package->price = $request->harga_paket;
            $package->status_package = 'active';
            $package->save();
            $features = $request->input('fitur');
            $package->features()->detach();
            foreach($features as $feature){
                $package->features()->attach($feature,['package_id' => $package->id]);
            }
        }
        return redirect()->back();
    }

    public function updateStatus($id)
    {
        $package = package::find($id);
        $package->status_package = 'inactive';
        $package->save();

        return redirect()->back();
    }
}
