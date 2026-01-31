<?php

namespace App\Services\booking;

use App\Models\booking\Booking;
use App\Models\ports\Mooring;
use App\Models\ports\Port;
use Date;
use Dflydev\DotAccessData\Data;
use Illuminate\Support\Collection;
use function PHPUnit\Framework\isFalse;

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
                    $moorings[] = $mooring;
                }
            }
        }


        return $moorings;
    }


    public function showAllAvailableMooringsByPortAndDates(int $portId, $startDate, $endDate): array
    {
        $startDate = date_create_from_format("Y-m-d", $startDate);
        $endDate = date_create_from_format("Y-m-d", $endDate);

        $moorings = $this->showMooringsByPort($portId);
        $availableMoorings = [];

        foreach ($moorings as $mooring) {
            $isBooked = $mooring->bookings
                ->search(
                    function (Booking $booking) use ($startDate, $endDate) {
                        return ($booking->start_date < $endDate) && ($booking->end_date > $startDate);
                    });

            if ($isBooked === false) {
                $availableMoorings[] = $mooring;
            }
        }


        return $availableMoorings;
    }


    public function showAvailableMooringsByPortDimensionsAndDate(int $portId, int $length, int $beam, $startDate, $endDate)
    {
        $port = Port::find($portId);

        $zones = $port->zones;
        $mooringCategories = [];
        $mooringDimensions = new Collection;

        foreach ($zones as $zone) {
            foreach ($zone->mooringCategories as $mooringCategory){
                $mooringCategories[] = $mooringCategory;
            }
        }


        foreach ($mooringCategories as $mooringCategory){
            $mooringDimensions->push($mooringCategory->mooringDimensions);
        }

        $mooringDimensions = $mooringDimensions
            ->where('max_length','>=',$length)
            ->where('max_beam','>=',$beam);


        $moorings =  new Collection;
        $reverseMooringCategories = new Collection;
        foreach ($mooringDimensions->all() as $dimension){
            foreach($dimension->mooringCategory as $mooringCategory){

                $reverseMooringCategories->push($mooringCategory);
            };
        }


        foreach ($reverseMooringCategories->unique()->all() as $mooringCategory){
            foreach ($mooringCategory->moorings as $mooring){
                $moorings->push($mooring);
            }
        }




        return $reverseMooringCategories->unique()->all();
    }


    private function indexAvailableBookingsByMooringsAndDates(Collection $moorings, $startDate, $endDate){

        foreach ($moorings as $mooring) {
            $isBooked = $mooring->bookings
                ->search(
                    function (Booking $booking) use ($startDate, $endDate) {
                        return ($booking->start_date < $endDate) && ($booking->end_date > $startDate);
                    });

            if ($isBooked === false) {
                $availableMoorings[] = $mooring;
            }

            return $availableMoorings;
        }
    }


}
