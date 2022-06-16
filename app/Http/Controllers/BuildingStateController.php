<?php

namespace App\Http\Controllers;

use App\Models\BuildingState;
use Illuminate\Http\Request;

class BuildingStateController extends Controller
{
    //update
    // public function update(Request $request, $id)
    // {
    //     $buildingState = BuildingState::find($id);
    //     $buildingState->update($request->all());
    //     return $buildingState->save();
    // }

    //delete
    public function delete($id){
        $buildingState = BuildingState::find($id);
        $result = $$buildingState->delete();
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
        BuildingState::all();
        return BuildingState::paginate(16);
    }

    public function show($id)
    {
        return BuildingState::findOrFail($id);
    }
}
