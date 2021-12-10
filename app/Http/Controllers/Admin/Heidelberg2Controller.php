<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\SecondHeidelberg\SecondHeidelbergCollection;
use App\Model\Dominant;
use App\Model\Lamination;
use App\Model\Leafing;
use App\Model\Project;
use App\Model\SecondHeidelberg;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Heidelberg2Controller  extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            if (auth('admin')->user()->role_id == 1 || auth('admin')->user()->role_id == 2) {
                $whereStatus = [0,1,2,3];
            } else{
                $whereStatus = [2];
            }
            $datas = SecondHeidelberg::orderBy('id','desc')->whereIn('status',$whereStatus)
            ->with(['project'=>function($query){
                $query->select('id','cutsize','total_sheet','job_no','file','colour','icon');
            }])
            ->select('id','job_no','project_id','status','updated_at');

            if (auth('admin')->user()->role_id == 1 || auth('admin')->user()->role_id == 2){
                $datas->whereIn('status', $request->status?[$request->status]:[1,2]);
            } else{
                $datas->whereIn('status', $request->status?[$request->status]:[2]);
            }

            if ($request->fromDate && $request->toDate) {
                $from = Carbon::parse($request->fromDate)->format('Y-m-d');
                $to = Carbon::parse($request->toDate)->format('Y-m-d');
                $datas->whereBetween('updated_at', [$from." 00:00:00", $to." 23:59:59"]);
            }

            $search = $request->search['value'];
            if ($search) {
                $datas->where('job_no', 'like', '%'.$search.'%');
                $datas->orWhere('carton_name', 'like', '%'.$search.'%');
            }

            $request->request->add(['page'=>(($request->start+$request->length)/$request->length )]);
            $datas = $datas->paginate($request->length);
            return response()->json(new SecondHeidelbergCollection($datas));
        }
        return view('admin.heidleberg.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(SecondHeidelberg::where('id',$id)->delete()){
         return response()->json(['message'=>ucfirst(str_singular(request()->segment(2))).' Successfully Deleted', 'class'=>'success']); 
        }
        return back()->with(array('message' => 'Something Wrong', 'class' => 'error')); 
    }


    public function changeStatus(Request $request)
    {
    //return $request->all(); 
        $project = Project::find($request->project_id);

        if ( ($project->coating_machine == "dominent" || $project->coating_machine == "lamination" ) && ( $project->embossing_leafing == 'leafing' || $project->embossing_leafing == 'both')) {

            if ($request->status == 3){
               
                if(Leafing::where(['project_id'=>$request->project_id])->delete()){
                    if(SecondHeidelberg::whereIn('id',((is_array($request->id))?$request->id:[$request->id]))->update(['status'=>2])){
                        return response()->json(['message'=>'Project Status Changed', 'class'=>'success']); 
                    } 
                }
            }

            if($request->status == 1){

                $leafing = new Leafing; 
                $leafing->job_no = $project->job_no;
                $leafing->project_id = $project->id;
                $leafing->status = 2;
                if($leafing->save()){
                    if(SecondHeidelberg::whereIn('id',((is_array($request->id))?$request->id:[$request->id]))->update(['status'=>1])){
                        return response()->json(['message'=>'Project Status Changed', 'class'=>'success']); 
                    }
                }

            }
        }




        if( $project->coating_machine == "dominent" && ($project->embossing_leafing == 'embossing' || $project->embossing_leafing == 'none') ) {

            if ($request->status == 3){
               
                if(Dominant::where(['project_id'=>$request->project_id])->delete()){
                    if(SecondHeidelberg::whereIn('id',((is_array($request->id))?$request->id:[$request->id]))->update(['status'=>2])){
                        return response()->json(['message'=>'Project Status Changed', 'class'=>'success']); 
                    } 
                }
            }

            if($request->status == 1){

                $leafing = new Dominant; 
                $leafing->job_no = $project->job_no;
                $leafing->project_id = $project->id;
                $leafing->status = 2;
                if($leafing->save()){
                    if(SecondHeidelberg::whereIn('id',((is_array($request->id))?$request->id:[$request->id]))->update(['status'=>1])){
                        return response()->json(['message'=>'Project Status Changed', 'class'=>'success']); 
                    }
                }

            }
        }


        if( $project->coating_machine == "lamination" && ($project->embossing_leafing == 'embossing' || $project->embossing_leafing == 'none') ) {

            if ($request->status == 3){
               
                if(Lamination::where(['project_id'=>$request->project_id])->delete()){
                    if(SecondHeidelberg::whereIn('id',((is_array($request->id))?$request->id:[$request->id]))->update(['status'=>2])){
                        return response()->json(['message'=>'Project Status Changed', 'class'=>'success']); 
                    } 
                }
            }

            if($request->status == 1){

                $leafing = new Lamination; 
                $leafing->job_no = $project->job_no;
                $leafing->project_id = $project->id;
                $leafing->status = 2;
                if($leafing->save()){
                    if(SecondHeidelberg::whereIn('id',((is_array($request->id))?$request->id:[$request->id]))->update(['status'=>1])){
                        return response()->json(['message'=>'Project Status Changed', 'class'=>'success']); 
                    }
                }

            }
        }

        return response()->json(['message'=>'Whoops, looks like something went wrong ! Try again ...', 'class'=>'error']);

    }
}
