<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class BookingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $now = Carbon::now();
        $startDate = $this->start_date;
        $endDate = $this->end_date;

        $shouldShowMooring = $endDate && $startDate && (
                $endDate->diffInHours($now) <= 24 ||
                $now->greaterThanOrEqualTo($startDate)
            );

        return [
            'id'=>$this->id,
            'start_date' => $startDate?->format('Y-m-d'),
            'end_date' => $endDate?->format('Y-m-d'),
            'total_cost' => $this->total_cost,
            'boat_id' => $this->boat_id,
            'boat_name'=>$this->boat->name,
            'port_name' => $this->mooring?->mooringCategory?->zone?->port?->name,
            'zone_name'=>$this->mooring->mooringCategory->zone->name,
            'zone_description'=>$this->mooring->mooringCategory->zone->description,
            'mooring_name' => $this->when($shouldShowMooring, new MooringResourece($this->mooring)),
        ];
    }
}