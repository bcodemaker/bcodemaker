<?php

namespace App\Http\Resources\Admin\Heidleberg;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Admin\Heidleberg\HeidlebergResource;
class HeidlebergCollection extends ResourceCollection
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
            'data' => HeidlebergResource::collection($this->collection),
            'recordsTotal' => $this->total(),
            'recordsFiltered' => $this->total(),
            'length' => $this->perPage(),
        ];
    }
}
