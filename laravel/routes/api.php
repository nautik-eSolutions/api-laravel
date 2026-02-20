<?php

use App\Http\Controllers\boats\BoatController;
use App\Http\Controllers\payments\PaymentController;
use App\Http\Controllers\persons\PersonController;
use App\Http\Controllers\ports\PortController;
use App\Http\Controllers\users\UserAuthController;
use App\Http\Controllers\users\UserController;
use App\Http\Middleware\users\UserExists;
use Illuminate\Support\Facades\Route;

Route::post('/register',[UserAuthController::class,'register']);
Route::post('/login',[UserAuthController::class,'login']);
Route::post('/logout',[UserAuthController::class,'logout']);
Route::post('login/oauth',[UserAuthController::class,'OAuthLogin']);


Route::controller(UserController::class)->group(function(){
   Route::get('/users','show');
   Route::patch('/users','update');
   Route::delete('/users','destroy');
});

Route::controller(BoatController::class)->group(function(){
   Route::get('/boats','index');
   Route::get('/boats/{id}','show');
   Route::post('/boats','store');
   Route::put('/boats/{id}','update');
   Route::delete('boats/{id}','destroy');
});


Route::controller(PortController::class)->group(function(){

    Route::get('/ports','index');
    Route::get('/ports/{id}','show');
});




Route::get('/ports',[PortController::class,'index']);
Route::get('/ports/{id}/moorings',[PortController::class,'indexMooringsByPort']);
Route::get('/ports/{id}/moorings/{startDate}/{endDate}',[PortController::class,'indexMooringsByPortDate']);
Route::get('/ports/{id}/moorings/{length}/{beam}/{startDate}/{endDate}',[PortController::class,'indexMooringsByPortZoneDate']);


Route::post('/payment',[PaymentController::class,'store']);