<?php

use App\Http\Controllers\boats\BoatController;
use App\Http\Controllers\persons\CaptainController;
use App\Http\Controllers\persons\OwnerController;
use App\Http\Controllers\persons\PersonController;
use App\Http\Controllers\users\UserController;
use App\Http\Middleware\persons\PersonExists;
use App\Http\Middleware\users\UserExists;
use Illuminate\Support\Facades\Route;

Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
Route::get('/users/{userId}', [UserController::class, 'show'])->middleware(UserExists::class);
Route::patch('/users/{userId}', [UserController::class, 'update'])->middleware(UserExists::class);
Route::delete('/users/{userId}', [UserController::class, 'destroy'])->middleware(UserExists::class);



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
Route::post('/persons/{userId}', [PersonController::class, 'store'])->middleware(UserExists::class);
Route::patch('/persons/{personId}', [PersonController::class, 'update'])->middleware(PersonExists::class);
Route::get('/persons/{personId}', [PersonController::class, 'show'])->middleware(PersonExists::class);
Route::delete('/persons/{personId}', [PersonController::class, 'destroy'])->middleware(PersonExists::class);

Route::get('/cities');

