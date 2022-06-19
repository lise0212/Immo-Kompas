<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BuildingStateController;
use App\Http\Controllers\EstateAgentController;
use App\Http\Controllers\HouseController;
use App\Http\Controllers\locationsBelgiumController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SpecificationController;
use App\Http\Controllers\StateController;
use App\Models\House;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
    
});

//update search
Route::put('updateSearch/{id}', [SearchController::class, 'update']);
//delete search
Route::delete('deleteSearch/{id}', [SearchController::class, 'delete']);
//post search (voor koper)
Route::post('addSearch', [SearchController::class, 'addSearch']);
//get search
Route::get('searches', [SearchController::class, 'list']);
Route::get('searches/{id}', [SearchController::class, 'show']);


//update house
Route::put('updateHouse/{id}', [HouseController::class, 'update']);
//delete house
Route::delete('deleteHouse/{id}', [HouseController::class, 'delete']);
//post house (voor makelaar)
Route::post('addHouse', [HouseController::class, 'addHouse']);
//get house
Route::get('houses', [HouseController::class, 'list']);
Route::get('houses/{id}', [HouseController::class, 'show']);
Route::get('housesByLocality', [HouseController::class, 'getHouseByLocality']);
Route::get('housesLocality', [HouseController::class, 'getLocalities']);
Route::get('housesSubtype', [HouseController::class, 'getSubtypes']);
Route::get('housesState', [HouseController::class, 'getStates']);
Route::get('housesByPrice', [HouseController::class, 'getHouseByPricing']);
Route::get('housesByAgent', [HouseController::class, 'getHouseByEstateAgent']);
Route::get('housesByProperty', [HouseController::class, 'getHouseByProperty']);
Route::get('housesByState', [HouseController::class, 'getHouseByState']);
Route::get('housesBySearch', [HouseController::class, 'getHouseBySearch']);
Route::get('housesByRecommendation', [HouseController::class, 'getHouseByRecommendation']);


//get locations belgium
Route::get('locationsBelgium', [locationsBelgiumController::class, 'getLocationsBelgium']);

Route::get('allUsers', [LoginController::class, 'getUsers']);
Route::get('login', [LoginController::class, 'validateUser']);

Route::get('emails', [RegisterController::class, 'getEmails']);
Route::post('register',[RegisterController::class, 'create']);


//update agent
//Route::put('updateAgent/{id}', [EstateAgentController::class, 'update']);
//delete agent
Route::delete('deleteAgent/{id}', [EstateAgentController::class, 'delete']);
//post agent 
Route::post('addAgent', [EstateAgentController::class, 'addEstateAgent']);
//get agent
Route::get('agents', [EstateAgentController::class, 'list']);
Route::get('agents/{id}', [EstateAgentController::class, 'show']);
Route::get('agentByName', [EstateAgentController::class, 'getEstateAgentByName']);

//update specification
Route::put('updateSpecification/{id}', [SpecificationController::class, 'update']);
//delete specification
Route::delete('deleteSpecification/{id}', [SpecificationController::class, 'delete']);
//post specification (voor makelaar)
Route::post('addSpecification', [SpecificationController::class, 'addSpecification']);
//get specifications
Route::get('specifications', [SpecificationController::class, 'list']);
Route::get('specifications/{id}', [SpecificationController::class, 'show']);

//update properties
//Route::put('updateProperty/{id}', [PropertyController::class, 'update']);
//delete properties
Route::delete('deleteProperty/{id}', [PropertyController::class, 'delete']);
//post property 
Route::post('addProperty', [PropertyController::class, 'addProperty']);
//get property
Route::get('properties', [PropertyController::class, 'list']);
Route::get('properties/{id}', [PropertyController::class, 'show']);


//update building state
Route::put('updateBuildingState/{id}', [BuildingStateController::class, 'update']);
//delete building state
Route::delete('deleteBuildingState/{id}', [BuildingStateController::class, 'delete']);
//get building state
Route::get('buildingState', [BuildingStateController::class, 'list']);
Route::get('buildingState/{id}', [BuildingStateController::class, 'show']);


