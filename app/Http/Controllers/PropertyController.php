<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    //update
    // public function update(Request $request, $id)
    // {
    //     $property = Property::find($id);
    //     $property->property_type=$request->property_type;
    //     $property->save();
    // }

    //delete
    public function delete($id){
        $property = Property::find($id);
        $result = $property->delete();
        if($result)
        {
            return ["Success"];
        }
        else{
            return ["Fail"];
        }
    }

    //post
    public function addProperty(Request $request)
    {
        $property = new Property();
        $property->property_type=$request->property_type;
        $result = $property->save();
        if($result)
        {
            return ["Success"];
        }
        else{
            return ["Fail"];
        }
    }

    public function list()
    {
        Property::all();
        return Property::paginate(16);
    }

    public function show($id)
    {
        return Property::findOrFail($id);
    }
}
