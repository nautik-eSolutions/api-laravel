<?php

namespace App\Services\booking;

use App\Models\booking\Booking;
use App\Models\ports\Mooring;
use App\Models\ports\Port;
use Date;
use Dflydev\DotAccessData\Data;
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


    public function showAvailableMooringsByPortAndDates(int $portId, $startDate, $endDate)
    {
        $startDate = date_create_from_format("Y-m-d", $startDate);
        $endDate = date_create_from_format("Y-m-d", $endDate);

        $moorings = $this->showMooringsByPort($portId);
        $availableMoorings = [];
        $bookings = [];

        foreach ($moorings as $mooring) {
            $bookings[] = $mooring->bookings
                ->search(
                    function (Booking $booking) use ($startDate, $endDate) {
                        return ($booking->start_date < $endDate) && ($booking->end_date > $startDate);
                    });
        }


        for ($i = 0; $i < sizeof($bookings); $i++) {

            if ($bookings[$i]===false){
                $availableMoorings[] = $moorings[$i];
            }
        }


        return $availableMoorings;
    }


}
