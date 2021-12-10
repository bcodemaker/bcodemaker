<?php



namespace App\Http\Resources\Admin\Pasting;



use Illuminate\Http\Resources\Json\JsonResource;

class PastingResource extends JsonResource

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

            'file' => $this->project->icon?'<img style="cursor:pointer" onClick="zoomImage(this,'.$this->project->id.')" src="'.asset($this->project->icon).'">':'N/A',        

            'total_carton' => @$this->project->carton_quantity,

            'project_id' => @$this->project_id,

            'changeStatus' => $this->status,

            'fromDate' => $request->fromDate??null,          

            'toDate' => $request->toDate??null,          

            'updated_at' => $this->updated_at->format('d F Y'),           

        ];

    }

}

