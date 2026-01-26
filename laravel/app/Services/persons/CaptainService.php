<?php

namespace App\Services\persons;

use App\Models\persons\Captain;

class CaptainService
{

    public function __construct()
    {
    }

    public function indexByUser($userId)
    {

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
