<?php

namespace App\Http\Resources\Admin\Embossing;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Admin\Embossing\EmbossingResource;
class EmbossingCollection extends ResourceCollection
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
            'data' => EmbossingResource::collection($this->collection),
            'recordsTotal' => $this->total(),
            'recordsFiltered' => $this->total(),
            'length' => $this->perPage(),
        ];
    }
}
