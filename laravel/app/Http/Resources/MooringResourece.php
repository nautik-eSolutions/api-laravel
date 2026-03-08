<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MooringResourece extends JsonResource
{
    public function toArray($request)
    {
        $zone = $this->mooring_category?->zone?->name;
        $dimensions = $this->mooring_category?->mooring_dimensions;

        return [
            'id' => $this->id,
            'number'=> $this->number,
             'zone_name'=>$this->mooringCategory->zone->name,
            'zone_description'=>$this->mooringCategory->zone->description,
             'max_length'=>$this->mooringCategory->mooringDimension->max_length,
             'max_beam'=>$this->mooringCategory->mooringDimension->max_beam

        ];
    }
}
