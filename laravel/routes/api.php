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


Route::get('/users/{userId}/captains',[PersonController::class,'showCaptainsByUser'])->middleware(UserExists::class);
Route::get('/users/{userId}/owners',[PersonController::class,'showCaptainsByUser'])->middleware(UserExists::class);
Route::get('/users/{userId}/captains/{id}',[PersonController::class,'show'])->middleware(UserExists::class);
Route::get('/users/{userId}/owners/{id}',[PersonController::class,'show'])->middleware(UserExists::class);

Route::post('/users/{userId}/captains',[PersonController::class,'storeCaptain'])->middleware(UserExists::class);
Route::post('/users/{userId}/owners',[PersonController::class,'storeOwner'])->middleware(UserExists::class);
Route::patch('/users/{userId}/captains/{captainId}',[PersonController::class,'updateCaptain'])->middleware(UserExists::class);
Route::delete('/users/{userId}/captains/{captainId}',[PersonController::class,'destroyCaptain'])->middleware(UserExists::class);
Route::delete('/users/{userId}/owners/{ownerId}',[PersonController::class,'destroyOwner'])->middleware(UserExists::class);


Route::get('/boats/{userName}',[BoatController::class,'index']);
Route::get('/boats/{userName}/{boatName}',[BoatController::class,'show']);
Route::post('/boats/{userName}',[BoatController::class,'store']);
Route::patch('/boats/{userName}/{boatName}',[BoatController::class,'update']);
Route::delete('/boats/{userName}/{boatName}',[BoatController::class,'destroy']);

