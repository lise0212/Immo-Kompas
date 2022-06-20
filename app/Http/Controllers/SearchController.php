<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\Search;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SearchController extends Controller
{
    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'property_type'=>['required', 'string'],
    //         //'property_types'=> ['required', 'min:1'],
    //         'locality'=> ['required'],
    //         'min_price'=> ['required'],
    //         'max_price' =>['required'],

    //     ]);
    // }

    // /**
    //  *
    //  * @param  array  $data
    //  * @return \App\Models\Search
    //  */
    // protected function create(array $data)
    // {
    //     return Search::create([
    //         'email' => $data['email'],
    //         'property_type' => $data['property_type'],
    //         'locality' => $data['locality'],
    //         'min_price'=>$data['min_price'],
    //         'max_price'=>$data['max_price'],
    //     ]);
    // }
    
    //update
    public function update(Request $request, $id)
    {
        $search = Search::find($id);
        $search->update($request->all());
        $result = $search->save();
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
        $search = Search::find($id);
        $result = $search->delete();
        if($result)
        {
            return ["Success"];
        }
        else{
            return ["Fail"];
        }
    }

    //post
    public function addSearch(Request $request)
    {
        $search = new Search;
        $search->user_id=$request->user_id;
        $search->email=$request->email;
        $search->property_type=$request->property_type;
        $search->locality=$request->locality;
        $search->min_price=$request->min_price;
        $search->max_price=$request->max_price;
        $result = $search->save();
        if($result)
        {
            return ["Success"];
        }
        else{
            return ["Fail"];
        }
    }


    //get
    public function list()
    {
        Search::all();
        return Search::paginate(16);
    }
 
    public function show($id)
    {
        return Search::findOrFail($id);
    }
}
