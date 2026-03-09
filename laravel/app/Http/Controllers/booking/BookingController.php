<?php

namespace App\Http\Controllers\booking;

use App\Http\Resources\BookingResource;
use App\Models\booking\Booking;
use App\Services\booking\BookingService;
use App\Utils\Auth\JwtService;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;

class BookingController
{

    public function index(Request $request)
    {

        $user = JwtService::getUserId($request->bearerToken());

        $bookings = BookingService::getBookingsByUser($user);

        return BookingResource::collection($bookings);

    }

    public function show(Request $request, $order)
    {
        $user = JwtService::getUserId($request->bearerToken());

        $bookings = BookingService::getBookingByOrder($user, $order);

        return BookingResource::collection($bookings);


    }

    public function invoice(Request $request, $order)
    {
        $user = JwtService::getUserId($request->bearerToken());
        $booking = BookingService::getBookingByOrder($user, $order);
        Log::info("booking #{$booking}");

        $options = new Options();
        $options->set('defaultFont', 'Arial');

        $dompdf = new Dompdf($options);

        $html = view('pdf.invoice', [
            'bookings' => BookingResource::collection($booking),
            'order' => $order
        ])->render();

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return response($dompdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => "inline; filename=\"invoice-{$order}.pdf\"",
        ]);

    }

    public function bookingsBoat(Request $request, $id){

        $user = JwtService::getUserId($request->bearerToken());

        $bookings = BookingService::getBookingsByBoat($user, $id);

        return BookingResource::collection($bookings);


    }
}