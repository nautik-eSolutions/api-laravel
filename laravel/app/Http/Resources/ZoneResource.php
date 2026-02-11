<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\JsonApi\JsonApiResource;

class ZoneResource extends JsonResource
{

    public function toAttributes(Request $request): array
    {
        return [
            'name'=>$this->name,
            'description'=>$this->description,
            'mooring_categories'=>$this->mooringCategories
        ];
    }
}
