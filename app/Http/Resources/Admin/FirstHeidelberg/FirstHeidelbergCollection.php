<?php

namespace App\Http\Resources\Admin\FirstHeidelberg;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Admin\FirstHeidelberg\FirstHeidelbergResource;
class FirstHeidelbergCollection extends ResourceCollection
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
            'data' => FirstHeidelbergResource::collection($this->collection),
            'recordsTotal' => $this->total(),
            'recordsFiltered' => $this->total(),
            'length' => $this->perPage(),
        ];
    }
}
