<?php

namespace App\Services\booking;

use App\Models\ports\Port;
use Date;

class MooringService
{
    public function __construct()
    {
    }

    public function showMooringsByPort($portId): array
    {
        $port = Port::find($portId);

        $zones = $port->zones;

        $mooringsCategoriesCollection = [];
        $moorings = [];

        foreach ($zones as $zone) {
            $mooringsCategoriesCollection[] = $zone->mooringCategories;
        }

        foreach ($mooringsCategoriesCollection as $mooringsCategories) {
            foreach ($mooringsCategories as $mooringsCategory) {
                foreach ($mooringsCategory->moorings as $mooring) {
                    $moorings[] = $mooring;
                }

            }
        }


        return $moorings;
    }


    public function showAvailableMooringsByPortAndDates(int $portId, $startDate,  $endDate)
    {
        $startDate = date_create_from_format("Y-m-d",$startDate);
        $endDate = date_create_from_format("Y-m-d",$endDate);

        $moorings = $this->showMooringsByPort($portId);

        $availableMoorings = [];
        $port = Port::find($portId);


        foreach ($moorings as $mooring){
            $availableMoorings[] = $mooring->bookings;
        }

        return $availableMoorings;
    }


}
