<?php

namespace App\Http\Controllers;

use App\Services\booking\MooringService;

class BookingController extends Controller
{
    private MooringService $mooringService;

    public function __construct()
    {
        $this->mooringService =  new MooringService();
    }

    public function index()
    {

    }
    public function indexMooringsByDatePort($portId,$startDate, $endDate){
        $moorings =  $this->mooringService->getMooringsByPort($portId);

        return $moorings;
    }

    public function indexMooringsByDateZonePort(){

    }


}
