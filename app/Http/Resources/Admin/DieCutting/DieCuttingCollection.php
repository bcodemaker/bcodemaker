<?php

namespace App\Http\Resources\Admin\DieCutting;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Admin\DieCutting\DieCuttingResource;
class DieCuttingCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => DieCuttingResource::collection($this->collection),
            'recordsTotal' => $this->total(),
            'recordsFiltered' => $this->total(),
            'length' => $this->perPage(),
        ];
    }
}
