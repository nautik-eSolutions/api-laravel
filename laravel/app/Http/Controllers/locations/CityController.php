<?php

namespace App\Http\Controllers\locations;

use App\Http\Controllers\Controller;
use App\Models\locations\City;
use function Pest\Laravel\json;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::all();
        if (!$cities){
            $data = [
                'message'=>'No cities were found',
                'status'=>404
            ];
            return response()->json($data,404);
        }

    }
    public function show(){

    }

    public function showByCommunity(){

    }
}
