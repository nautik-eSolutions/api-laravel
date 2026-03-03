<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Resources\JsonApi\JsonApiResource;

class PortResource extends JsonResource
{


    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'city'=>new CityResource($this->city),
            'zones'=>new ZoneCollection($this->zones),

            'description' => $this->description,
            'address'     => $this->address,

            'latitude'  => $this->latitude  ? (float) $this->latitude  : null,
            'longitude' => $this->longitude ? (float) $this->longitude : null,

            'images' => $this->images ?? [],

            'total_moorings' => (int) ($this->total_moorings ?? 0),
            'max_length'     => $this->max_length ? (float) $this->max_length : null,
            'max_beam'       => $this->max_beam   ? (float) $this->max_beam   : null,
            'max_draft'      => $this->max_draft  ? (float) $this->max_draft  : null,
        ];
    }
}
