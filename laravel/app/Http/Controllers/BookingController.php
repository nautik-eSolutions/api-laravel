<?php

namespace App\Http\Controllers;

use App\Services\booking\MooringService;
use function Symfony\Component\String\s;

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
    public function indexMooringsByDatePort($portId){
        $moorings =  $this->mooringService->showMooringsByPort($portId);

        return $moorings;
    }

    public function indexMooringsByDateZonePort($portId,$startDate,$endDate){
        return $this->mooringService->showAvailableMooringsByPortAndDates($portId,$startDate,$endDate);
    }


}
