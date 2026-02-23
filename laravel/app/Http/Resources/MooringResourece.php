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
            'label' => sprintf(
                'Amarre %s – Zona %s (%sm x %sm)',
                $this->number,
                $this->mooringCategory->zone->name,
                $this->mooringCategory->mooringDimension->max_length,
                $this->mooringCategory->mooringDimension->max_beam
            ),
        ];
    }
}
