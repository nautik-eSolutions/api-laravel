<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'start_date'=>$this->start_date?->format('Y-m-d'),
            'end_date'=>$this->end_date?->format('Y-m-d'),
            'total_cost'=>$this->total_cost,
            'boat_id'=>$this->boat_id,
            'port_name'=>$this->mooring?->mooringCategory?->zone?->port?->name,
            'mooring_name'=> new MooringResourece($this->mooring)
        ];
    }

}