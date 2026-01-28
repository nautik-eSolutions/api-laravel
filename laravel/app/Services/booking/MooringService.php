<?php

namespace App\Services\booking;

use App\Models\ports\Port;

class MooringService
{
    public function __construct()
    {
    }

    public function getMooringsByPort($portId){
        $port =  Port::find($portId);

        $zones =  $port->zones;

        $mooringsCategoriesCollection = [];
        $moorings = [];
        foreach($zones as $zone){
            $mooringsCategoriesCollection[] = $zone->mooringCategories;
        }

        foreach ($mooringsCategoriesCollection as $mooringsCategories) {
            foreach ($mooringsCategories as $mooringsCategory) {
                foreach ($mooringsCategory->moorings as $mooring){
                    $moorings[] = $mooring;
                }

            }
        }


        return $moorings;
    }







}
