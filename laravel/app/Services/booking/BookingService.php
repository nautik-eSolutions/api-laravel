<?php

namespace App\Services\booking;

use App\Models\booking\Booking;

class BookingService
{
    public static function getBookingByOrder( $user, $order)
    {


        return Booking::with(
            'mooring.mooringCategory.zone.port',
            'boat'
            )->whereHas('boat', function ($query) use ($user) {
            $query->where('user_id', $user);
            })->where('order_number', $order)->get();

    }

    public static function getBookingsByUser($user){
        return Booking::with(
            'mooring.mooringCategory.zone.port',
            'boat'
        )
            ->whereHas('boat', function ($query) use ($user) {
                $query->where('user_id', $user);
            })
            ->get();

    }

    public static function getBookingsByBoat($user, $idBoat){

        return Booking::with([
            'mooring.mooringCategory.zone.port',
            'boat'
        ])
            ->whereHas('boat', function ($query) use ($user, $idBoat) {
                $query->where('boat_id', $idBoat)
                    ->where('user_id', $user);
            })
            ->get();

    }

}