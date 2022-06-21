<?php

namespace App\Http\Controllers;

use App\Models\EstateAgent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstateAgentController extends Controller
{
    //update
    public function update(Request $request, $id)
    {
        $estateAgent = EstateAgent::find($id);
        $estateAgent->update($request->all());
        $result = $estateAgent->save();
        if($result)
        {
            return ["Success"];
        }
        else{
            return ["Fail"];
        }
    }

    //delete
    public function delete($id){
        $estateAgent = EstateAgent::find($id);
        $result = $estateAgent->delete();
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
        EstateAgent::all();
        return EstateAgent::paginate(16);
    }

    public function show($id)
    {
        return EstateAgent::findOrFail($id);
    }

    public function getEstateAgentByName(Request $request)
    {
        // if($request->has('name')){
        //     return EstateAgent::where('name', $request->name)->get();
        // }
        
        

        $agents = DB::table('estate_agents')
        ->where("name", "=", "$request->name")
        ->get();

        return $agents;
    }

    //post
    public function addEstateAgent(Request $request)
    {
        $estateAgent = new EstateAgent();
        $estateAgent->name=$request->name;
        $estateAgent->email=$request->email;
        $result = $estateAgent->save();
        if($result)
        {
            return ["Success"];
        }
        else{
            return ["Fail"];
        }
    }
}
