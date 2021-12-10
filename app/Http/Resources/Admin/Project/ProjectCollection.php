<?php

namespace App\Http\Resources\Admin\Project;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Admin\Project\ProjecResource;
class ProjectCollection extends ResourceCollection
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
            'data' => ProjectResource::collection($this->collection),
            'recordsTotal' => $this->total(),
            'recordsFiltered' => $this->total(),
            'length' => $this->perPage(),
        ];
    }
}
