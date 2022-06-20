<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function addFavorite(Request $request)
    {
        $favorite = new Favorite();
        $favorite->user_id=$request->user_id;
        $favorite->house_id=$request->house_id;
        $result = $favorite->save();
        if($result)
        {
            return ["Success"];
        }
        else{
            return ["Fail"];
        }
    }
}
