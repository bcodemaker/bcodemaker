<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Cutting\CuttingCollection;
use App\Model\Cutting;
use App\Model\Dominant;
use App\Model\FirstHeidelberg;
use App\Model\Heidleberg;
use App\Model\Project;
use App\Model\SecondHeidelberg;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CuttingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->wantsJson()) {
            
            $datas = Cutting::orderBy('id','desc')
            ->with(['project'=>function($query){
                $query->select('id','cutsize','total_sheet','job_no','file','paper','icon');
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
            return response()->json(new CuttingCollection($datas));
        }
        return view('admin.cutting.list');
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
        if(Cutting::where('id',$id)->delete()){
         return response()->json(['message'=>ucfirst(str_singular(request()->segment(2))).' Successfully Deleted', 'class'=>'success']); 
        }
        return back()->with(array('message' => 'Something Wrong', 'class' => 'error')); 
    }


    public function changeStatus(Request $request)
    { 
        $project = Project::find($request->project_id);

        if ($project->printing_machine == "heidelberg1") {

            if ($request->status == 3){
               
                if(FirstHeidelberg::where(['project_id'=>$request->project_id])->delete()){
                    if(Cutting::whereIn('id',((is_array($request->id))?$request->id:[$request->id]))->update(['status'=>2])){
                        return response()->json(['message'=>'Project Status Changed', 'class'=>'success']); 
                    } 
                }
            }
            if($request->status == 1){

                $firstheidelberg = new FirstHeidelberg; 
                $firstheidelberg->job_no = $project->job_no;
                $firstheidelberg->project_id = $project->id;
                $firstheidelberg->status = 2;
                if($firstheidelberg->save()){
                    if(Cutting::whereIn('id',((is_array($request->id))?$request->id:[$request->id]))->update(['status'=>1])){
                        return response()->json(['message'=>'Project Status Changed', 'class'=>'success']); 
                    }
                }

            }
            
        }


        if ($project->printing_machine == "heidelberg2") {

            if ($request->status == 3){
               
                if(SecondHeidelberg::where(['project_id'=>$request->project_id])->delete()){
                    if(Cutting::whereIn('id',((is_array($request->id))?$request->id:[$request->id]))->update(['status'=>2])){
                        return response()->json(['message'=>'Project Status Changed', 'class'=>'success']); 
                    } 
                }
            }
            if($request->status == 1){

                $secondheidelberg = new SecondHeidelberg; 
                $secondheidelberg->job_no = $project->job_no;
                $secondheidelberg->project_id = $project->id;
                $secondheidelberg->status = 2;
                if($secondheidelberg->save()){
                    if(Cutting::whereIn('id',((is_array($request->id))?$request->id:[$request->id]))->update(['status'=>1])){
                        return response()->json(['message'=>'Project Status Changed', 'class'=>'success']); 
                    }
                }

            }
            
        }



        if ($project->printing_machine == 'dominent') {

            
            if ($request->status == 3){
               
                if(Dominant::where(['project_id'=>$request->project_id])->delete()){
                    if(Cutting::whereIn('id',((is_array($request->id))?$request->id:[$request->id]))->update(['status'=>2])){
                        return response()->json(['message'=>'Project Status Changed', 'class'=>'success']); 
                    } 
                }
            }
            if($request->status == 1){

                $dominant = new Dominant; 
                $dominant->job_no = $project->job_no;
                $dominant->project_id = $project->id;
                $dominant->status = 2;
                if($dominant->save()){
                    if(Cutting::whereIn('id',((is_array($request->id))?$request->id:[$request->id]))->update(['status'=>1])){
                        return response()->json(['message'=>'Project Status Changed', 'class'=>'success']); 
                    }
                }

            }
        }  

        return response()->json(['message'=>'Whoops, looks like something went wrong ! Try again ...', 'class'=>'error']);

    }
}
