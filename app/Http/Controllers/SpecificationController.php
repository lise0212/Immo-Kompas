<?php

namespace App\Http\Controllers;

use App\Models\Specification;
use Illuminate\Http\Request;

class SpecificationController extends Controller
{
    //get
    public function list()
    {
        Specification::all();
        return Specification::paginate(16);
    }

    public function show($id)
    {
        return Specification::findOrFail($id);
    }

    //update
    public function update(Request $request, $id)
    {
        $specification = Specification::find($id);
        $specification->update($request->all());
        return $specification->save();
    }

    //delete
    public function delete($id){
        $specification = Specification::find($id);
        $result = $specification->delete();
        if($result)
        {
            return ["Success"];
        }
        else{
            return ["Fail"];
        }
    }

    //post
    public function addSpecification(Request $request)
    {
        $specification = new Specification();
        $specification->kitchen_equipment=$request->kitchen_equipment;
        $specification->furnished=$request->furnished;
        $specification->open_fire=$request->open_fire;
        $specification->terrace=$request->terrace;
        $specification->terrace_area=$request->terrace_area;
        $specification->garden=$request->garden;
        $specification->garden_area=$request->garden_area;
        $specification->surface_land=$request->surface_land;
        $specification->surface_plot_land=$request->surface_plot_land;        
        $specification->number_of_facades=$request->number_of_facades;       
        $specification->swimming_pool=$request->swimming_pool;
        $result = $specification->save();
        if($result)
        {
            return ["Success"];
        }
        else{
            return ["Fail"];
        }
    }
}
