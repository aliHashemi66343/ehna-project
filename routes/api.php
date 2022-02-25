<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Mosahebe;
use App\Http\Controllers\MosahebeController;
use App\Http\Controllers\AuthController;
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



//Protected Routes
Route::group(["middleware"=>['auth:sanctum']],function() {
    //each route in here will be executed if the user is authenticated to site
    Route::get('/show',[MosahebeController::class,'showall']);
    Route::post('/mosahebe/create',[MosahebeController::class,'create']);
    Route::post('/mosahebe/update/{id}',[MosahebeController::class,'update']);
    Route::post('/mosahebe/delete/{id}',[MosahebeController::class,'delete']);
    //User Routes
    Route::post('/user/logout',[AuthController::class,'logout']);
    Route::post('/user/mosahebe/notification',[MosahebeController::class,'notifyUser']);




});

//Public Routes
//Route::get('/show',[MosahebeController::class,'showall']);
Route::get('/mosahebe/show/{id}',[MosahebeController::class,'show']);
Route::post('/user/register',[AuthController::class,"register"]);
Route::post('/user/login',[AuthController::class,"login"]);


Route::get('api-doc',function (){
    return "usage of mosahebe api\n\n
     Mosahebe Routes:\n\n
     /show :for see all mosahebes(get)\n
    /mosahebe/show/{id}: for show a mosahebe's detail(get) \n
    /mosahebe/create: for creating mosahebe(post)\n
    data required: 1.title 2.detail 3.date\n
    /mosahebe/update/{id}: for updating mosahebe(post)\n
    data required(one of them are required): 1.title 2.detail 3.date\n
/mosahebe/delete/{id}: for delete mosahabe\n

Auth User:\n
/user/logout: for logout user(post)\n
/user/register: for registering user(post)\n
data required: 1.name 2.email 3.password 4.password_confirmation\n
        /user/login: for login user(post)\n
        data required:1.email 2.password

        ";
});
