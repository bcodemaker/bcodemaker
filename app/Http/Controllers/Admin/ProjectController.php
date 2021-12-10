<?php



namespace App\Http\Controllers\Admin;



use App\Http\Controllers\Controller;

use App\Http\Resources\Admin\Project\ProjectCollection;

use App\Model\Company;

use App\Model\Cutting;

use App\Model\Project;

use Carbon\Carbon;

use Illuminate\Http\Request;

use Intervention\Image\ImageManagerStatic as Image;



class ProjectController extends Controller

{

    

    public function index(Request $request)

    {

       if ($request->wantsJson()) {

            $datas = Project::orderBy('id','desc')->select('id','job_no','company','po_date','icon','carton_name','status');

            if ($request->status === "0") {

                $datas->where('status', 0);

            } else{

                $datas->whereIn('status', $request->status?[$request->status]:[1,2,3,0]); 

            }

            $datas->whereIn('company', $request->company?[$request->company]:Company::select('name')->get());



            $search = $request->search['value'];

            if ($search) {

                $datas->where('job_no', 'like', '%'.$search.'%');

                $datas->orWhere('carton_name', 'like', '%'.$search.'%');

            }



            $request->request->add(['page'=>(($request->start+$request->length)/$request->length )]);

            $datas = $datas->paginate($request->length);

            return response()->json(new ProjectCollection($datas));

        }

        return view('admin.project.list');

    }



   

    public function create()

    {

        return view('admin.project.create');

    }



    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request, Project $project){

        //return $request->all();

        $this->validate($request, [

            'job_no' => 'required|numeric|min:2',

            'company' => 'required',

            'paper' => 'required',

            'carton_name' => 'required',

            'carton_quantity' => 'required|numeric',

            'colour' => 'required',

            'cutsize' => 'required',

            'po_date' => 'required',

            'po_number' => 'required|numeric',

            'die_no' => 'required',

            'coating' => 'required',

            'coating_machine' => 'required',

            'embossing_leafing' => 'required',

            'printing_machine' => 'required',

            'total_sheet' => 'required|numeric',

            //'file' => 'nullable|image|mimes:jpeg,png,jpg|max:4000',

        ]);



        $project = new Project;

        $project->job_no = $request->job_no;

        $project->company = $request->company;

        $project->paper = $request->paper;

        $project->carton_name = $request->carton_name;

        $project->carton_quantity = $request->carton_quantity;

        $project->colour = $request->colour;

        $project->cutsize = $request->cutsize;

        $project->po_date = Carbon::parse($request->po_date)->format('Y-m-d');

        $project->po_number = $request->po_number;

        $project->die_no = $request->die_no;

        $project->coating = $request->coating;

        $project->coating_machine = $request->coating_machine;

        $project->embossing_leafing = $request->embossing_leafing;

        $project->printing_machine = $request->printing_machine;

        $project->total_sheet = $request->total_sheet;



        if($request->hasFile('file')){

            $image_name = time().".".$request->file('file')->getClientOriginalExtension();

            $image = $request->file('file')->storeAs('projects', $image_name);

            $project->file = 'storage/'.$image;



            $iconimage = $request->file('file');

            $image_resize = Image::make($iconimage->getRealPath());              

            $image_resize->resize(50, 50);

            $image_resize->save(public_path('storage/projects/icon/' .$image_name));

            $project->icon = 'storage/projects/icon/'.$image_name;

        }



        if($project->save()){ 

            return redirect()->route('admin.project.index')->with(['class'=>'success','message'=>'Project Created Successfully.']);

            }

        return redirect()->back()->with(['class'=>'error','message'=>'Whoops, looks like something went wrong ! Try again ...']);

    }

    /**

     * Display the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function show($id)

    {

        $project = Project::with(['billing','cutting','dieCutting','dominant','embossing','firstHeidelberg','secondHeidelberg','lamination','leafing','pasting'])->where('id',$id)->first();

        return view('admin.project.view',compact('project'));

    }



    public function track($id)

    {

       return  Project::with(['billing','cutting','dieCutting','dominant','embossing','firstHeidelberg','secondHeidelberg','lamination','leafing','pasting'])->where('id',$id)->first();

    }



    public function zoomImage(Request $request, $id)

    {

        $project = Project::where('id',$id)->select('id','file','job_no')->first();

        if ($project) {

            return response()->json(['message'=>'Record Found', 'class'=>'success','data'=>$project]);

        }

        return response()->json(['message'=>'Record Not Found', 'class'=>'error','data'=>'']);

    }



    /**

     * Show the form for editing the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function edit($id)

    {

        $project = Project::find($id);

        return view('admin.project.edit',compact('project'));

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

        $this->validate($request, [

            'job_no' => 'required|numeric|min:2',

            'company' => 'required',

            'paper' => 'required',

            'carton_name' => 'required',

            'carton_quantity' => 'required|numeric',

            'colour' => 'required',

            'cutsize' => 'required',

            'po_date' => 'required',

            'po_number' => 'required|numeric',

            'die_no' => 'required',

            'coating' => 'required',

            'coating_machine' => 'required',

            'embossing_leafing' => 'required',

            'printing_machine' => 'required',

            'total_sheet' => 'required|numeric',

            'file' => 'nullable|image|mimes:jpeg,png,jpg|max:4000',

        ]);



        $project = Project::find($id);

        $project->job_no = $request->job_no;

        $project->company = $request->company;

        $project->paper = $request->paper;

        $project->carton_name = $request->carton_name;

        $project->carton_quantity = $request->carton_quantity;

        $project->colour = $request->colour;

        $project->cutsize = $request->cutsize;

        $project->po_date = Carbon::parse($request->po_date)->format('Y-m-d');

        $project->po_number = $request->po_number;

        $project->die_no = $request->die_no;

        $project->coating = $request->coating;

        $project->coating_machine = $request->coating_machine;

        $project->embossing_leafing = $request->embossing_leafing;

        $project->printing_machine = $request->printing_machine;

        $project->total_sheet = $request->total_sheet;



        if($request->hasFile('file')){

            $image_name = time().".".$request->file('file')->getClientOriginalExtension();

            $image = $request->file('file')->storeAs('projects', $image_name);

            $project->file = 'storage/'.$image;



            $iconimage = $request->file('file');

            $image_resize = Image::make($iconimage->getRealPath());              

            $image_resize->resize(50, 50);

            $image_resize->save(public_path('storage/projects/icon/' .$image_name));

            $project->icon = 'storage/projects/icon/'.$image_name;

        }



        if($project->save()){ 

            return redirect()->route('admin.project.index')->with(['class'=>'success','message'=>'Project Created Successfully.']);

            }

        return redirect()->back()->with(['class'=>'error','message'=>'Whoops, looks like something went wrong ! Try again ...']);

    }



    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)

    {

        if(Project::where('id',$id)->delete()){

         return response()->json(['message'=>ucfirst(str_singular(request()->segment(2))).' Successfully Deleted', 'class'=>'success']); 

        }

        return back()->with(array('message' => 'Something Wrong', 'class' => 'error')); 

    }





    public function changeStatus(Request $request)

    { 

        if(Cutting::where(['project_id'=>$request->project])->update(['status'=>$request->status])){

             if(Project::whereIn('id',((is_array($request->project))?$request->project:[$request->project]))->update(['status'=>$request->status])){

                return response()->json(['message'=>'Project Status Changed', 'class'=>'success']); 

             } 

        } else{

          $cutting = new Cutting; 

          $cutting->job_no = Project::where('id',$request->project)->value('job_no');

          $cutting->project_id = $request->project;

          $cutting->status = $request->status;

          if($cutting->save()){

            if(Project::whereIn('id',((is_array($request->project))?$request->project:[$request->project]))->update(['status'=>$request->status])){

                return response()->json(['message'=>'Project Status Changed', 'class'=>'success']); 

             }

          }

        }



        

        return response()->json(['message'=>'Whoops, looks like something went wrong ! Try again ...', 'class'=>'error']);



    }



}

