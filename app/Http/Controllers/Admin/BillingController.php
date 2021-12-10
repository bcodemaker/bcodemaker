<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Billing\BillingCollection;
use App\Model\Billing;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if (auth('admin')->user()->role_id == 1 || auth('admin')->user()->role_id == 2){
                $whereStatus = [0,1,2,3];
            } else{
                $whereStatus = [2];
            }
            $billings = Billing::orderBy('id','desc')->whereIn('status',$whereStatus)
            ->with(['project'=>function($query){
                $query->select('id','carton_name','total_sheet','icon');
            }])
            ->select('id','job_no','project_id','carton_name','carton_quantity')->paginate(30);


        // if ($request->wantsJson()) {
        //     if (auth('admin')->user()->role_id == 1 || auth('admin')->user()->role_id == 2){
        //         $whereStatus = [0,1,2,3];
        //     } else{
        //         $whereStatus = [2];
        //     }
        //     $datas = Billing::orderBy('id','desc')->whereIn('status',$whereStatus)
        //     ->with(['project'=>function($query){
        //         $query->select('id','carton_name','total_sheet');
        //     }])
        //     ->select('id','job_no','project_id','carton_name','carton_quantity');

        //     $search = $request->search['value'];
        //     if ($search) {
        //         $datas->where('job_no', 'like', '%'.$search.'%');
        //         $datas->orWhere('carton_name', 'like', '%'.$search.'%');
        //     }

        //     $request->request->add(['page'=>(($request->start+$request->length)/$request->length )]);
        //     $datas = $datas->paginate($request->length);
        //     return response()->json(new BillingCollection($datas));
        // }
        return view('admin.billing.list',compact('billings'));
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
        //
    }
}
