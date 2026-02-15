<?php

namespace App\Services\booking;

use App\Models\ports\Port;

class PortService
{


    public function index(){
        return Port::all();
    }

    public function show($portId){
        return Port::find($portId);
    }


}