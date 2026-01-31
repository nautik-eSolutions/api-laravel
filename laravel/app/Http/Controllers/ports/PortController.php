<?php

namespace App\Http\Controllers\ports;

use App\Http\Controllers\Controller;
use App\Http\Resources\PortCollection;
use App\Http\Resources\PortResource;
use App\Models\ports\Port;
use App\Services\booking\MooringService;
use App\Services\booking\PortService;

class PortController extends Controller
{
    private MooringService $mooringService;
    private PortService $portService;
    public function __construct()
    {
        $this->mooringService =  new MooringService();
        $this->portService = new PortService();
    }

    public function index()
    {
        $ports = $this->portService->index();
        return new PortCollection($ports);
    }
    public function indexMooringsByPort($portId){
        $moorings =  $this->mooringService->showMooringsByPort($portId);

        return $moorings;
    }

    public function indexMooringsByPortDate($portId,$startDate,$endDate){
        return $this->mooringService->showAllAvailableMooringsByPortAndDates($portId,$startDate,$endDate);
    }

    public function indexMooringsByPortZoneDate($portId,$length, $beam,$startDate, $endDate){
        return $this->mooringService->showAvailableMooringsByPortDimensionsAndDate($portId,$length,$beam,$startDate,$endDate);
    }


}
