<?php

use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/users/{userName}', [UserController::class,'show']);
Route::patch('/users/{userName}',[UserController::class,'update']);
Route::delete('/users/{userName}',[UserController::class,'destroy']);
Route::post('/users',[UserController::class,'store']);


Route::get('/boats/{userName}',);
Route::get('/boats/{userName}/{boatName}');
Route::post('/boats/{userName}');
Route::patch('/boats/{userName}/{boatName}');
Route::delete('/boats/{userName}/{boatName}');


Route::get('/captains/{userName}',);
Route::get('/captains/{userName}');
Route::post('/captains/{userName}');
Route::patch('/captains/{userName}');
Route::delete('/captains/{userName}');


Route::get('/owners/{id}',);
Route::get('/owners/{userName}');
Route::post('/owners/{id}',[OwnerController::class,'store']);
Route::patch('/owners/{userName}');
Route::delete('/owners/{userName}');

Route::post('/persons',[PersonController::class,'store']);
