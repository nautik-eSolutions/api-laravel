<?php

namespace App\Http\Controllers;

use App\Services\booking\MooringService;
use function Symfony\Component\String\s;

class PortController extends Controller
{
    private MooringService $mooringService;

    public function __construct()
    {
        $this->mooringService =  new MooringService();
    }

    public function index()
    {

    }
    public function indexMooringsByPort($portId){
        $moorings =  $this->mooringService->showMooringsByPort($portId);

        return $moorings;
    }

    public function indexMooringsByPortDate($portId,$startDate,$endDate){
        return $this->mooringService->showAllAvailableMooringsByPortAndDates($portId,$startDate,$endDate);
    }

    public function indexMooringsByPortZoneDate($portId,$length, $draft,$startDate, $endDate){

    }


}
