<?php

namespace App\Services;

use App\Models\persons\Captain;

class CaptainService
{
    public function __construct()
    {
    }

    public function index()
    {
        return Captain::all();
    }

    public function show($captainId)
    {
        return Captain::find($captainId);
    }

    public function store($data){

    }

    public function edit($data)
    {

    }

    public function destroy($captainId)
    {

    }


}
