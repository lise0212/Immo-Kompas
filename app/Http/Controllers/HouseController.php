<?php

namespace App\Http\Controllers;

use App\Models\EstateAgent;
use App\Models\House;
use App\Models\Specification;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;

class HouseController extends Controller
{
    //update
    public function update(Request $request, $id)
    {
        $house = House::find($id);
        $house->update($request->all());
        return $house->save();
    }

    //delete
    public function delete($id){
        $house = House::find($id);
        $result = $house->delete();
        if($result)
        {
            return ["Success"];
        }
        else{
            return ["Fail"];
        }
    }

    //post
    public function addHouse(Request $request)
    {
        $house = new House();
        $house->estate_agent_id=$request->estate_agent_id;
        $house->property_id=$request->property_id;
        $house->sale_id=$request->sale_id;
        $house->state_id=$request->state_id;
        $house->locality=$request->locality;
        $house->subtype_of_property=$request->subtype_of_property;
        $house->price=$request->price;
        $house->number_of_rooms=$request->number_of_rooms;
        $house->area=$request->area;
        $result = $house->save();
        if($result)
        {
            return ["Succes"];
        }
        else{
            return ["Fail"];
        }
    }


    //get
    public function list()
    {
        return House::all();
        //return House::paginate(16);
    }

    public function show($id)
    {
        return House::findOrFail($id);
    }

    public function getHouseByLocality(Request $request)
    {
        if($request->has('locality')){
            return House::where('locality', $request->locality)->get();
        }

        // $locality = $request->input('locality');

        // return House::where("locality", "=", "$locality")
        // ->get()->paginate(16);
    }

    public function getLocalities(){
        return DB::table('houses')
            ->select('locality')
            ->distinct()
            ->whereNot('locality', "=", '0')
            ->orderBy('locality')
            ->get();
    }

    public function getSubtypes(){
        return DB::table('houses')
            ->select('subtype_of_property')
            ->distinct()
            ->whereNot('subtype_of_property', "=", '0')
            ->orderBy('subtype_of_property')
            ->get();
    }

    public function getStates(){
        return DB::table('houses')
            ->join('building_states', 'houses.state_id', "=", 'building_states.id')
            ->select('building_state')
            ->distinct()
            ->whereNot('building_state', "=", '0')
            ->orderBy('building_state')
            ->get();
    }

    public function getHouseByPricing(Request $minPrice, Request $maxPrice)
    {
        $minPrice->input('minPrice');
        $maxPrice->input('maxPrice');

        return House::whereBetween('price', [$minPrice, $maxPrice])
        ->get()->paginate(16);
    }

    public function getHouseByEstateAgent(Request $request)
    {
        //$name = $request->input('name');
        if($request->has('name')){
            return DB::table('houses')
            ->join("estate_agents", "houses.estate_agent_id", "=", "estate_agents.id")
            ->where("estate_agents.name", "LIKE", "%$request->name%", "AND", "houses.estate_agent_id", "IS NOT NULL")
            ->get();
        }
    }

    public function getHouseByProperty(Request $request)
    {
        if($request->has('property_type')){
            return DB::table('houses')
            ->join('properties', 'houses.property_id', "=", 'properties.id')
            ->where('properties.property_type', "LIKE", "%$request->property_type%")
            ->get();
        }
    }

    public function getHouseByState(Request $request)
    {
        if($request->has('building_state')){
            return DB::table('houses')
            ->join('building_states', 'houses.state_id', "=", 'building_states.id')
            ->where('building_states.building_state', "LIKE", "%$request->building_state%", "AND", "houses.state_id", "IS NOT NULL")
            ->get();
        }
    }

    // public function getHouseBySearch(Request $property, Request $locality, Request $minPrice, Request $maxPrice)
    // {
    //     $minPrice->input('minPrice');
    //     $maxPrice->input('maxPrice');

    //     if($property->has('property_type') ){
    //         return DB::table('houses')
    //         ->join('properties', 'houses.property_id', "=", 'properties.id')
    //         ->where('properties.property_type', "=", "%$property->property_type%", "AND", 'houses.locality', "=", "$locality->locality")
    //         ->whereBetween('price', [$minPrice, $maxPrice])
    //         ->get();
    //     }
    // }

    public function getHouseBySearch(Request $request)
    {
        if($request->has('property_type', 'locality', 'min_price', 'max_price') ){
            return DB::table('houses')
            ->select('houses.id', 'houses.estate_agent_id', 'houses.property_id','houses.sale_id', 'houses.state_id', 'houses.locality', 'houses.price', 'houses.number_of_rooms', 'houses.area','houses.image_url', 'estate_agents.name', 'estate_agents.name', 'properties.property_type')
            ->join('properties', 'houses.property_id', "=", 'properties.id')
            ->join('estate_agents', 'houses.estate_agent_id', "=", 'estate_agents.id')
            ->where('properties.property_type', "=", "$request->property_type")
            ->where('houses.locality', "=", "$request->locality")
            ->whereBetween('houses.price', [$request->min_price, $request->max_price])
            ->get();
        }
    }

    public function getHouseByRecommendation(Request $request)
    {
        if($request->has('property_type', 'locality', 'min_price', 'max_price') ){
            return DB::table('houses')
            ->select('houses.id', 'houses.estate_agent_id', 'houses.property_id','houses.sale_id', 'houses.state_id', 'houses.locality', 'houses.price', 'houses.number_of_rooms', 'houses.area','houses.image_url', 'estate_agents.name', 'estate_agents.name', 'properties.property_type')
            ->join('properties', 'houses.property_id', "=", 'properties.id')
            ->join('estate_agents', 'houses.estate_agent_id', "=", 'estate_agents.id')
            ->where('properties.property_type', "=", "$request->property_type")
            ->where('houses.locality', "=", "$request->locality")
            ->whereBetween('houses.price', [$request->max_price, $request->max_price*1.1])
            ->get();
        }
    }
    
    // public function update(Request $request, House $house)
    // {
    //     $house->update($request->all());

    //     return response()->json($house, 200);
    // }

    // public function delete(House $house)
    // {
    //     $house->delete();

    //     return response()->json(null, 204);
    // }
 
    

    // public function store(Request $request)
    // {
    //     return House::create($request->all());
    // }

    // public function update(Request $request, $id)
    // {
    //     $House = House::findOrFail($id);
    //     $House->update($request->all());

    //     return $House;
    // }

    // public function delete(Request $request, $id)
    // {
    //     $House = House::findOrFail($id);
    //     $House->delete();

    //     return 204;
    // }
}
