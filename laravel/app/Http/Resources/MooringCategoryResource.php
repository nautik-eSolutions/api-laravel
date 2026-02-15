<?php

namespace App\Http\Resources;

use App\Models\booking\PriceConfiguration;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MooringCategoryResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id'=> $this->id,
            'price'=> new PriceConfigurationCollection($this->priceConfigurations),
            'beam'=>$this->mooringDimension->max_beam,
            'length'=>$this->mooringDimension->max_length
        ];

    }
}