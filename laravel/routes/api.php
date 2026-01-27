<?php

use App\Http\Controllers\boats\BoatController;
use App\Http\Controllers\persons\CaptainController;
use App\Http\Controllers\persons\OwnerController;
use App\Http\Controllers\persons\PersonController;
use App\Http\Controllers\users\UserController;
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


Route::get('/persons', [PersonController::class, 'index']);
Route::post('persons/captains');



Route::get('/cities');

