<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feature;

class FeatureController extends Controller
{
    public function addFeature(Request $request)
    {
    
        $icon = $request->icon->getClientOriginalName() . '-' . time()
                    . '.' . $request->icon->extension();
        $request->icon->move(public_path('image_uploaded/image_feature'), $icon);

        $feature = new Feature();
        $feature->name = $request->name_feature;
        $feature->description = $request->description;
        $feature->icon = $icon;
        $feature->status_feature = 'active';
        $feature->save();

        return redirect()->back();
    }

    public function updateStatus($id)
    {
        $feature = Feature::find($id);
        $feature->status_feature = 'inactive';
        $feature->save();

        return redirect()->back();
    }

    public function updateFeature(Request $request,$id)
    {
        $feature = Feature::find($id);
        if($request->hasFile('icon')){
            $icon = $request->icon->getClientOriginalName() . '-' . time()
            . '.' . $request->icon->extension();
            $request->icon->move(public_path('image_uploaded/image_feature'), $icon);

            $feature->name = $request->name_feature;
            $feature->description = $request->description;
            $feature->icon = $icon;
            $feature->save();
        }else{
            $feature->name = $request->name_feature;
            $feature->description = $request->description;
            $feature->save();
        }

        return redirect()->back();
    }
}
