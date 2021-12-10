<?php

namespace App\Http\Resources\Admin\Project;

use Illuminate\Http\Resources\Json\JsonResource;
class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function status($status)
    {
        if ($status == 1) {
            return $status = "<span class='badge badge-success'>Complated</span>";
        } 
        if ($status == 2) {
            return $status = "<span class='badge badge-info'>Inprocess</span>";
        } 
        if ($status == 0) {
           return  $status = "<span class='badge badge-warning'>Pending</span>";
        } 
        if ($status == 3) {
            return $status = "<span class='badge badge-danger'>Canceled</span>";
        }
        
    }

    public function toArray($request)
    {
        return [
            'sn' => ++$request->start,
            'id' => $this->id,       
            'job_no' => $this->job_no,       
            'company' => $this->company,          
            'po_date' => $this->po_date->format('d F Y'),          
            'file' => $this->icon?'<img style="cursor:pointer" onClick="zoomImage(this,'.$this->id.')" src="'.asset($this->icon).'">':'N/A',          
            'carton_name' => $this->carton_name,          
            'status' => $this->status($this->status),          
            'changeStatus' => $this->status,          
        ];
    }
}
