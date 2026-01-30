<?php

namespace App\Services\booking;

use App\Models\booking\Booking;
use App\Models\ports\Mooring;
use App\Models\ports\Port;
use Date;
use Dflydev\DotAccessData\Data;

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
        $mooringsCategories = [];
        $moorings = [];

        foreach ($zones as $zone) {
            $mooringsCategoriesCollection[] = $zone->mooringCategories;
        }

        foreach ($mooringsCategoriesCollection as $mooringsCategories) {
            foreach ($mooringsCategories as $mooringsCategory) {
                foreach ($mooringsCategory->moorings as $mooring) {
                    array_push($moorings,$mooring);
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

        $bookingsAvailable = [];
        $availableMoorings = [];

        $bookings = [];
        foreach ($moorings as $mooring){
            $bookings = $mooring->bookings
                ->where('start_date','>=',$startDate)
                ->where('end_date','<=',$endDate);

            if ($bookings->all()){
               $bookingsAvailable[]=$bookings->all();
            }
        }



        $mooring = Mooring::find(3);





        dd($mooring->bookings->where('start_date','>=',$startDate)->where('end_date','<=',$endDate));

        dd();





        $test =  collect($moorings);
        $test->filter(function(Mooring $mooring) use ($endDate, $startDate) {
            return !($mooring->bookings->filter(function (Booking $booking) use ($startDate, $endDate) {
                return  $booking->where('start_date','>=',$startDate)
                    ->where('end_date','<=',$endDate);
            }));
        });

        foreach ($bookingsAvailable as $booking){
            foreach ($booking as $item){
                $bookings [] = $item;
            }
        }


        return $test;
    }




}
