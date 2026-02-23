<?php

namespace App\Http\Controllers\booking;

use App\Http\Resources\BookingResource;
use App\Models\booking\Booking;
use App\Utils\Auth\JwtService;
use Illuminate\Http\Request;

class BookingController
{

    public function index(Request $request)
    {

        $user = JwtService::getUserId($request->bearerToken());



        $bookings = Booking::with(
            'mooring.mooringCategory.zone.port',
            'boat'
        )
            ->whereHas('boat', function ($query) use ($user) {
                $query->where('user_id', $user);
            })
            ->get();

        return BookingResource::collection($bookings);

    }

}