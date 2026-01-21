<?php

namespace App\Http\Controllers;

use App\Models\BoatType;
use Illuminate\Http\Request;

class BoatTypeController extends Controller
{
    public function index()
    {
        return BoatType::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([

        ]);

        return BoatType::create($data);
    }

    public function show(BoatType $boatType)
    {
        return $boatType;
    }

    public function update(Request $request, BoatType $boatType)
    {
        $data = $request->validate([

        ]);

        $boatType->update($data);

        return $boatType;
    }

    public function destroy(BoatType $boatType)
    {
        $boatType->delete();

        return response()->json();
    }
}
