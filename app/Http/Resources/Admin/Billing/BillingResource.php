<?php



namespace App\Http\Resources\Admin\Billing;



use Illuminate\Http\Resources\Json\JsonResource;

class BillingResource extends JsonResource

{

    /**

     * Transform the resource into an array.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return array

     */



    public function myfunc($data)

    {

       $mydatas = explode(',', $data);

       //$mydatas = collect($data);

       foreach ($mydatas as $value) {

         $value;

       }

       return $value;

       // $mydatas->map(function($data){

       //          echo $data;

       //      });



       

    }



    public function toArray($request)

    {

        return [

            'sn' => ++$request->start,

            'id' => $this->id,       

            'job_no' => $this->job_no,       

            'total_sheet' => @$this->project->total_sheet,     

            'carton_name' => $this->myfunc($this->carton_name),      

            'carton_quantity' => $this->carton_quantity,  
             
            'file' => $this->project->icon?'<img style="cursor:pointer" onClick="zoomImage(this,'.$this->project->id.')" src="'.asset($this->project->icon).'">':'N/A',   

            'project_id' => @$this->project_id,         

        ];;

    }

}

