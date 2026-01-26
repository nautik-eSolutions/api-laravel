<?php

use App\Http\Controllers\boats\BoatController;
use App\Http\Controllers\persons\CaptainController;
use App\Http\Controllers\persons\OwnerController;
use App\Http\Controllers\persons\PersonController;
use App\Http\Controllers\users\UserController;
use Illuminate\Support\Facades\Route;



Route::get('/users/{userName}', [UserController::class, 'show']);
Route::patch('/users/{userName}', [UserController::class, 'update']);
Route::delete('/users/{userName}', [UserController::class, 'destroy']);
Route::post('/users', [UserController::class, 'store']);


Route::get('/boats/{userName}',[BoatController::class,'index']);
Route::get('/boats/{userName}/{boatName}',[BoatController::class,'show']);
Route::post('/boats/{userName}',[BoatController::class,'store']);
Route::patch('/boats/{userName}/{boatName}',[BoatController::class,'update']);
Route::delete('/boats/{userName}/{boatName}',[BoatController::class,'destroy']);


Route::get('/captains');
Route::post('/captains/{personId}', [CaptainController::class, 'store']);
Route::get('/captains/{captainId}', [CaptainController::class, 'show']);
Route::patch('/captains/{captainId}', [CaptainController::class, 'update']);
Route::delete('/captains/{captainId}', [CaptainController::class, 'destroy']);


Route::get('/owners', [OwnerController::class, 'index']);
Route::get('/owners/{ownerId}', [OwnerController::class, 'show']);
Route::post('/owners/{personId}', [OwnerController::class, 'store']);
Route::patch('/owners/{ownerId}');
Route::delete('/owners/{ownerId}', [OwnerController::class, 'destroy']);

Route::get('/persons', [PersonController::class, 'index']);
Route::post('/persons', [PersonController::class, 'store']);
Route::patch('/persons/{personId}', [PersonController::class, 'update']);
Route::get('/persons/{personId}', [PersonController::class, 'show']);
Route::delete('/persons/{personId}', [PersonController::class, 'destroy']);

Route::get('/cities');

