<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Resources\JsonApi\JsonApiResource;

class PortCollection extends ResourceCollection
{

    public $collects = PortResource::class;

    public function toArray(Request $request)
    {
        return [
            'ports'=>$this->collection
        ];
    }


}