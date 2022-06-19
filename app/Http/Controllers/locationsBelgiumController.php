<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class locationsBelgiumController extends Controller
{
    public function getLocationsBelgium(){
        return DB::table('locations_belgium')
            ->select('location')
            ->distinct()
            ->orderBy('location')
            ->get();
    }
}
