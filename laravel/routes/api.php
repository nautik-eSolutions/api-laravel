<?php

use App\Http\Controllers\boats\BoatController;
use App\Http\Controllers\persons\PersonController;
use App\Http\Controllers\ports\PortController;
use App\Http\Controllers\users\UserController;
use App\Http\Middleware\users\UserExists;
use Illuminate\Support\Facades\Route;

Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
Route::get('/users/{userId}', [UserController::class, 'show'])->middleware(UserExists::class);
Route::patch('/users/{userId}', [UserController::class, 'update'])->middleware(UserExists::class);
Route::delete('/users/{userId}', [UserController::class, 'destroy'])->middleware(UserExists::class);

Route::get('/captains/{id}',[PersonController::class,'show']);
Route::get('/owners/{id}',[PersonController::class,'show']);

Route::get('/users/{userId}/captains',[PersonController::class,'showCaptainsByUser'])->middleware(UserExists::class);
Route::get('/users/{userId}/owners',[PersonController::class,'showOwnersByUser'])->middleware(UserExists::class);
Route::get('/users/{userId}/captains/{id}',[PersonController::class,'show'])->middleware(UserExists::class);
Route::get('/users/{userId}/owners/{id}',[PersonController::class,'show'])->middleware(UserExists::class);

Route::post('/users/{userId}/captains',[PersonController::class,'storeCaptain'])->middleware(UserExists::class);
Route::post('/users/{userId}/owners',[PersonController::class,'storeOwner'])->middleware(UserExists::class);
Route::patch('/users/{userId}/captains/{captainId}',[PersonController::class,'updateCaptain'])->middleware(UserExists::class);
Route::delete('/users/{userId}/captains/{captainId}',[PersonController::class,'destroyCaptain'])->middleware(UserExists::class);
Route::delete('/users/{userId}/owners/{ownerId}',[PersonController::class,'destroyOwner'])->middleware(UserExists::class);


Route::get('/owners/{ownerId}/boats',[BoatController::class,'indexByOwner']);
Route::get('/users/{userId}/boats',[BoatController::class,'indexByUser']);
Route::get('/boats/{id}',[BoatController::class,'show']);
Route::post('/boats/{ownerId}',[BoatController::class,'store']);
Route::patch('/boats/{boatId}',[BoatController::class,'update']);
Route::delete('/boats/{boatId}',[BoatController::class,'destroy']);

Route::get('/ports',[PortController::class,'index']);
Route::get('/ports/{id}/moorings',[PortController::class,'indexMooringsByPort']);
Route::get('/ports/{id}/moorings/{startDate}/{endDate}',[PortController::class,'indexMooringsByPortDate']);
Route::get('/ports/{id}/moorings/{length}/{beam}/{startDate}/{endDate}',[PortController::class,'indexMooringsByPortZoneDate']);
