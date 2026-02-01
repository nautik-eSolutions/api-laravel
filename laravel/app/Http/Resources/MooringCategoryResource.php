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
            'zone' => new ZoneResource($this->zones),
            'price'=> new PriceConfigurationCollection($this->priceConfigurations)

        ];

    }
}