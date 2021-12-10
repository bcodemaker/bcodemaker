<?php
namespace App\Http\Controllers\Admin;
use App\Admin;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Admin\AdminCollection;
use App\Mail\NewAdminPassword;
use App\Model\AdminDetail;
use App\Model\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            $datas = Admin::orderBy('admins.created_at','desc')->whereNotIn('admins.id',[1])->join('roles','roles.id','admins.role_id')->select(['admins.id as id','roles.name as role','admins.name as name','email','admins.status']);
            $request->request->add(['page'=>(($request->start+$request->length)/$request->length )]);
            $datas = $datas->paginate($request->length);
            return response()->json(new AdminCollection($datas));
        }
        return view('admin.admin.list');
    }



    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create(Request $request ){
        $roles = Role::orderBy('name','asc')->whereNotIn('id',[1])->select(['id','name'])->get()->pluck('name','id')->toArray();
        return view('admin.admin.create',compact('roles'));
    }



    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function show(Request $request, admin $admin )
    {   
        $loginTimes = adminLogin::where('admin_id',$admin->id)->get();
        $policy = DB::table('role_policies')->where('role_id',$admin->role_id)->first();
        return view('admin.admin.view',compact('admin','loginTimes','policy'));
    }

    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request) {
 
        $this->validate($request,[
            'name'=>'required',
            'role'=>'required',
            'password'=>'required',
            'email'=>'required|email|unique:admins',    
        ]);
        $admin = new Admin;
        $admin->role_id = $request->role;
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->status = 1;
        $admin->password = bcrypt($request->password);
        if($admin->save()){ 
            return redirect()->route('admin.admin.index')->with(['class'=>'success','message'=>'User Created successfully.']);
        }
        return redirect()->back()->with(['class'=>'error','message'=>'Whoops, looks like something went wrong ! Try again ...']);
    }

        

    /**

     * Show the form for editing the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function edit(Request $request, admin $admin)
    {
        $roles = Role::select('id','name')->get()->pluck('name','id')->toArray();
        $kycPan = KycPan::firstOrNew(['admin_id'=>$admin->id]);
        $kycAadhar = KycAadhar::firstOrNew(['admin_id'=>$admin->id]);
        $bank = adminBankDetail::firstOrNew(['admin_id'=>$admin->id]);
        $details = adminDetail::firstOrNew(['admin_id'=>$admin->id]);
        return view('admin.admin.edit', compact('admin','roles','kycPan','kycAadhar','details','bank')); 
    }



    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, admin $admin)
    {


    }



    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy(Request $request, admin $admin)
    {
        $adminOld = implode(',', $admin->only('id','name','role_id','email'));
        if($admin->delete()){  
            return response()->json(['message'=>'Admin deleted successfully ...', 'class'=>'success']);  
        }
        return response()->json(['message'=>'Whoops, looks like something went wrong ! Try again ...', 'class'=>'error']);

    }

}

