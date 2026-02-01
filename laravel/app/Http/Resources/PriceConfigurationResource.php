<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PriceConfigurationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'min_price'=>$this->min_price
        ];
    }
}
