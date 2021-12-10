<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Project;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
   
    public function index(Request $request){
    	$projects = Project::all();
        return view('admin.dashboard',compact('projects'));
    }

    
    
}
