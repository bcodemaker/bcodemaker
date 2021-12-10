<?php

namespace App\Http\Resources\Admin\Pasting;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Admin\Pasting\PastingResource;
class PastingCollection extends ResourceCollection
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
            'data' => PastingResource::collection($this->collection),
            'recordsTotal' => $this->total(),
            'recordsFiltered' => $this->total(),
            'length' => $this->perPage(),
        ];
    }
}
