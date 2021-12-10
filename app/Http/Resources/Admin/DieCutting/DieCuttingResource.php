<?php



namespace App\Http\Resources\Admin\DieCutting;



use Illuminate\Http\Resources\Json\JsonResource;

class DieCuttingResource extends JsonResource

{

    /**

     * Transform the resource into an array.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return array

     */

    



    public function toArray($request)

    {

        return [

            'sn' => ++$request->start,

            'id' => $this->id,       

            'job_no' => $this->job_no,       

            'total_sheet' => @$this->project->total_sheet,         

            'cutsize' => @$this->project->cutsize,         

            'file' => $this->project->icon?'<img style="cursor:pointer" onClick="zoomImage(this,'.$this->project->id.')" src="'.asset($this->project->icon).'">':'N/A',       

            'die_no' => @$this->project->die_no,

            'project_id' => @$this->project_id,

            'changeStatus' => $this->status,          

            'admin_id' => $this->admin_id,          

            'username' => $this->username,          

            'role_id' => auth('admin')->user()->role_id,          

            'current_admin_id' => auth('admin')->user()->id,

            'fromDate' => $request->fromDate??null,          

            'toDate' => $request->toDate??null,          

            'updated_at' => $this->updated_at->format('d F Y'),          

        ];

    }

}

