<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MooringCategoryCollection extends ResourceCollection
{
    public $collects = MooringCategoryResource::class;
    public function toArray(Request $request): array
    {
        return [
            $this->collection
        ];
    }
}
