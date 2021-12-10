@extends('admin.layouts.master')

@section('title','Create Post')
<style type="text/css">
    .bg-success {
    background-color: #00ffb2 !important;
    color: #000;
}
.bg-warning {
    background-color: #ff9966 !important;
    color: #000;
}
.bg-info {
    background-color: #4ee9fe !important;
    color: #000;
}
</style>
@push('links')

<link rel="stylesheet" href="{{asset('admin-assets/dropify/css/dropify.min.css')}}">

<link rel="stylesheet" href="{{asset('admin-assets/summernote/dist/summernote.css')}}"/>

<link rel="stylesheet" href="{{asset('admin-assets/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}">

<style type="text/css">

    .dropify-wrapper{

        height: 217px;

    }

</style>

@php

    function getDifference($created_at, $updated_at) {

        $days = $created_at->diffInDays($updated_at);

        $hours = $created_at->diffInHours($updated_at->subDays($days));

        $minutes = $created_at->diffInMinutes($updated_at->subHours($hours));

        //$seconds = $created_at->diffInSeconds($updated_at->subMinutes($minutes));

        return Carbon\CarbonInterval::days($days)->hours($hours)->minutes($minutes)->forHumans();//->seconds($seconds)->forHumans()

    }

@endphp



@endpush

@section('main')

<div class="content-header row">

    <div class="content-header-left col-md-6 col-12 mb-2">

      <h5 class="content-header-title mb-0">Job No. {{$project->job_no}}</h5>

  </div>

  <div class="content-header-right col-md-6 col-12">

      <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">

        <div class="btn-group" role="group">

            @can('browse_'.ucfirst(str_singular(request()->segment(2))))

            <a href="{{ route('admin.'.request()->segment(2).'.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-list"></i> {{ucfirst(str_singular(request()->segment(2)))}} List</a>

            @endcan

        </div>

    </div>

</div>

</div>





<div class="card">





<div class="table-responsive">

    <table class="table mb-0">

        <thead>

            <tr>

                <th>#</th>

                <th>Machine</th>

                <th>Assign Date</th>

                <th>Close Date</th>

                <th>Taken Time</th>

            </tr>

        </thead>

        <tbody>















            @if($project->embossing_leafing == 'leafing' || $project->embossing_leafing == 'both') 



                @if($project->cutting)

                    <tr class="bg-success">

                        <th><i class="{{$project->cutting->status==1?'ft-check-square':'ft-minus-square'}}"></i></th>

                        <td>Cutting</td>

                        <td>{{$project->cutting->created_at->format('d F Y | h:i:s A')}}</td>

                        <td>{{$project->cutting->status==1?$project->cutting->updated_at->format('d F Y | h:i:s A'):'Working'}}</td>

                        <td>{{$project->cutting->status==1?getDifference($project->cutting->created_at,$project->cutting->updated_at):getDifference($project->cutting->created_at,now())}}</td>

                    </tr>

                @else

                    <tr class="bg-success">

                        <th><i class="ft-x-square"></i></th>

                        <td>Cutting</td>

                        <td>--</td>

                        <td>--</td>

                        <td>--</td>

                    </tr>

                @endif





                @if($project->printing_machine == 'heidleberg1' || $project->printing_machine == 'heidleberg') 

                @if($project->firstHeidelberg)

                    <tr class="{{$project->firstHeidelberg->status==1?'bg-success':'bg-info'}}">

                        <th><i class="{{$project->firstHeidelberg->status==1?'ft-check-square':'ft-minus-square'}}"></i></th>

                        <td>Heidelberg-1</td>

                        <td>{{$project->firstHeidelberg->created_at->format('d F Y | h:i:s A')}}</td>

                        <td>{{$project->firstHeidelberg->status==1?$project->firstHeidelberg->updated_at->format('d F Y | h:i:s A'):'Working'}}</td>

                        <td>{{$project->firstHeidelberg->status==1?getDifference($project->firstHeidelberg->created_at,$project->firstHeidelberg->updated_at):getDifference($project->firstHeidelberg->created_at,now())}}</td>

                    </tr>

                @else

                    <tr class="bg-warning">

                        <th><i class="ft-x-square"></i></th>

                        <td>Heidelberg-1</td>

                        <td>--</td>

                        <td>--</td>

                        <td>--</td>

                    </tr>

                @endif

                @endif



                @if($project->printing_machine == 'heidelberg1') 

                @if($project->firstHeidelberg)

                    <tr class="{{$project->firstHeidelberg->status==1?'bg-success':'bg-info'}}">

                        <th><i class="{{$project->firstHeidelberg->status==1?'ft-check-square':'ft-minus-square'}}"></i></th>

                        <td>Heidelberg-1</td>

                        <td>{{$project->firstHeidelberg->created_at->format('d F Y | h:i:s A')}}</td>

                        <td>{{$project->firstHeidelberg->status==1?$project->firstHeidelberg->updated_at->format('d F Y | h:i:s A'):'Working'}}</td>

                        <td>{{$project->firstHeidelberg->status==1?getDifference($project->firstHeidelberg->created_at,$project->firstHeidelberg->updated_at):getDifference($project->firstHeidelberg->created_at,now())}}</td>

                    </tr>

                @else

                    <tr class="bg-warning">

                        <th><i class="ft-x-square"></i></th>

                        <td>Heidelberg-1</td>

                        <td>--</td>

                        <td>--</td>

                        <td>--</td>

                    </tr>

                @endif

                @endif




@if($project->printing_machine == 'heidelberg2') 

                @if($project->secondHeidelberg)

                    <tr class="{{$project->secondHeidelberg->status==1?'bg-success':'bg-info'}}">

                        <th><i class="{{$project->secondHeidelberg->status==1?'ft-check-square':'ft-minus-square'}}"></i></th>

                        <td>Heidelberg-2</td>

                        <td>{{$project->secondHeidelberg->created_at->format('d F Y | h:i:s A')}}</td>

                        <td>{{$project->secondHeidelberg->status==1?$project->secondHeidelberg->updated_at->format('d F Y | h:i:s A'):'Working'}}</td>

                        <td>{{$project->secondHeidelberg->status==1?getDifference($project->secondHeidelberg->created_at,$project->secondHeidelberg->updated_at):getDifference($project->secondHeidelberg->created_at,now())}}</td>

                    </tr>

                @else

                    <tr class="bg-warning">

                        <th><i class="ft-x-square"></i></th>

                        <td>Heidelberg-2</td>

                        <td>--</td>

                        <td>--</td>

                        <td>--</td>

                    </tr>

                @endif

                @endif







                @if($project->printing_machine == 'dominent')

                @if($project->dominant) 

                    <tr class="{{@$project->dominant->status==1?'bg-success':'bg-info'}}">

                        <th><i class="{{$project->dominant->status==1?'ft-check-square':'ft-minus-square'}}"></i></th>

                        <td>Dominant (Printing)</td>

                        <td>{{$project->dominant->created_at->format('d F Y | h:i:s A')}}</td>

                        <td>{{$project->dominant->status==1?$project->dominant->updated_at->format('d F Y | h:i:s A'):'Working'}}</td>

                        <td>{{$project->dominant->status==1?getDifference($project->dominant->created_at,$project->dominant->updated_at):getDifference($project->dominant->created_at,now())}}</td>

                    </tr>

                @else

                    <tr class="bg-warning">

                        <th><i class="ft-x-square"></i></th>

                        <td>Dominant (Printing)</td>

                        <td>--</td>

                        <td>--</td>

                        <td>--</td>

                    </tr>

                @endif

                @endif







                @if($project->embossing_leafing == 'leafing' || $project->embossing_leafing == 'Leafing' ||$project->embossing_leafing == 'both' || $project->embossing_leafing == 'Both')

                @if($project->leafing) 

                    <tr class="{{@$project->leafing->status==1?'bg-success':'bg-info'}}">

                        <th><i class="{{$project->leafing->status==1?'ft-check-square':'ft-minus-square'}}"></i></th>

                        <td>Leafing</td>

                        <td>{{$project->leafing->created_at->format('d F Y | h:i:s A')}}</td>

                        <td>{{$project->leafing->status==1?$project->leafing->updated_at->format('d F Y | h:i:s A'):'Working'}}</td>

                        <td>{{$project->leafing->status==1?getDifference($project->leafing->created_at,$project->leafing->updated_at):getDifference($project->leafing->created_at,now())}}</td>

                    </tr>

                @else

                    <tr class="bg-warning">

                        <th><i class="ft-x-square"></i></th>

                        <td>Dominant (Printing)</td>

                        <td>--</td>

                        <td>--</td>

                        <td>--</td>

                    </tr>

                @endif

                @endif





                @if($project->coating_machine == 'Lamination' || $project->coating_machine == 'lamination')

                @if($project->lamination) 

                    <tr class="{{@$project->lamination->status==1?'bg-success':'bg-info'}}">

                        <th><i class="{{$project->lamination->status==1?'ft-check-square':'ft-minus-square'}}"></i></th>

                        <td>Lamination</td>

                        <td>{{$project->lamination->created_at->format('d F Y | h:i:s A')}}</td>

                        <td>{{$project->lamination->status==1?$project->lamination->updated_at->format('d F Y | h:i:s A'):'Working'}}</td>

                        <td>{{$project->lamination->status==1?getDifference($project->lamination->created_at,$project->lamination->updated_at):getDifference($project->lamination->created_at,now())}}</td>

                    </tr>

                @else

                    <tr class="bg-warning">

                        <th><i class="ft-x-square"></i></th>

                        <td>Lamination</td>

                        <td>--</td>

                        <td>--</td>

                        <td>--</td>

                    </tr>

                @endif

                @endif





                @if($project->coating_machine == 'dominent') 

                @if($project->dominant)

                    <tr class="{{@$project->dominant->status==1?'bg-success':'bg-info'}}">

                        <th><i class="{{$project->dominant->status==1?'ft-check-square':'ft-minus-square'}}"></i></th>

                        <td>Dominant(Coating)</td>

                        <td>{{$project->dominant->created_at->format('d F Y | h:i:s A')}}</td>

                        <td>{{$project->dominant->status==1?$project->dominant->updated_at->format('d F Y | h:i:s A'):'Working'}}</td>

                        <td>{{$project->dominant->status==1?getDifference($project->dominant->created_at,$project->dominant->updated_at):getDifference($project->dominant->created_at,now())}}</td>

                    </tr>

                @else

                    <tr class="bg-warning">

                        <th><i class="ft-x-square"></i></th>

                        <td>Dominant(Coating)</td>

                        <td>--</td>

                        <td>--</td>

                        <td>--</td>

                    </tr>



                @endif

                @endif





                @if($project->embossing_leafing == 'embossing' || $project->embossing_leafing == 'Embossing' || $project->embossing_leafing == 'Both' || $project->embossing_leafing == 'both')

                @if($project->embossing) 

                    <tr class="{{@$project->embossing->status==1?'bg-success':'bg-info'}}">

                        <th><i class="{{$project->embossing->status==1?'ft-check-square':'ft-minus-square'}}"></i></th>

                        <td>Embossing</td>

                        <td>{{$project->embossing->created_at->format('d F Y | h:i:s A')}}</td>

                        <td>{{$project->embossing->status==1?$project->embossing->updated_at->format('d F Y | h:i:s A'):'Working'}}</td>

                        <td>{{$project->embossing->status==1?getDifference($project->embossing->created_at,$project->embossing->updated_at):getDifference($project->embossing->created_at,now())}}</td>

                    </tr>

                @else

                    <tr class="bg-warning">

                        <th><i class="ft-x-square"></i></th>

                        <td>Embossing</td>

                        <td>--</td>

                        <td>--</td>

                        <td>--</td>

                    </tr>

                @endif

                @endif







                @if($project->dieCutting)

                    <tr class="{{@$project->dieCutting->status==1?'bg-success':'bg-info'}}">

                        <th><i class="{{$project->dieCutting->status==1?'ft-check-square':'ft-minus-square'}}"></i></th>

                        <td>dieCutting</td>

                        <td>{{$project->dieCutting->created_at->format('d F Y | h:i:s A')}}</td>

                        <td>{{$project->dieCutting->status==1?$project->dieCutting->updated_at->format('d F Y | h:i:s A'):'Working'}}</td>

                        <td>{{$project->dieCutting->status==1?getDifference($project->dieCutting->created_at,$project->dieCutting->updated_at):getDifference($project->dieCutting->created_at,now())}}</td>

                    </tr>

                @else

                    <tr class="bg-warning">

                        <th><i class="ft-x-square"></i></th>

                        <td>Die Cutting</td>

                        <td>--</td>

                        <td>--</td>

                        <td>--</td>

                    </tr>



                @endif





                @if($project->pasting)

                    <tr class="{{@$project->pasting->status==1?'bg-success':'bg-info'}}">

                        <th><i class="{{$project->pasting->status==1?'ft-check-square':'ft-minus-square'}}"></i></th>

                        <td>pasting</td>

                        <td>{{$project->pasting->created_at->format('d F Y | h:i:s A')}}</td>

                        <td>{{$project->pasting->status==1?$project->pasting->updated_at->format('d F Y | h:i:s A'):'Working'}}</td>

                        <td>{{$project->pasting->status==1?getDifference($project->pasting->created_at,$project->pasting->updated_at):getDifference($project->pasting->created_at,now())}}</td>

                    </tr>

                @else

                    <tr class="bg-warning">

                        <th><i class="ft-x-square"></i></th>

                        <td>Pasting</td>

                        <td>--</td>

                        <td>--</td>

                        <td>--</td>

                    </tr>



                @endif



            @endif















            @if($project->embossing_leafing == 'embossing' || $project->embossing_leafing == 'Embossing') 



                @if($project->cutting)

                    <tr class="bg-success">

                        <th><i class="{{$project->cutting->status==1?'ft-check-square':'ft-minus-square'}}"></i></th>

                        <td>Cutting</td>

                        <td>{{$project->cutting->created_at->format('d F Y | h:i:s A')}}</td>

                        <td>{{$project->cutting->status==1?$project->cutting->updated_at->format('d F Y | h:i:s A'):'Working'}}</td>

                        <td>{{$project->cutting->status==1?getDifference($project->cutting->created_at,$project->cutting->updated_at):getDifference($project->cutting->created_at,now())}}</td>

                    </tr>

                @else

                    <tr class="bg-warning">

                        <th><i class="ft-x-square"></i></th>

                        <td>Cutting</td>

                        <td>--</td>

                        <td>--</td>

                        <td>--</td>

                    </tr>

                @endif



                @if($project->printing_machine == 'heidelberg1' || $project->printing_machine == 'heidelberg') 

                @if($project->firstHeidelberg)

                    <tr class="{{$project->firstHeidelberg->status==1?'bg-success':'bg-info'}}">

                        <th><i class="{{$project->firstHeidelberg->status==1?'ft-check-square':'ft-minus-square'}}"></i></th>

                        <td>Heidelberg-1</td>

                        <td>{{$project->firstHeidelberg->created_at->format('d F Y | h:i:s A')}}</td>

                        <td>{{$project->firstHeidelberg->status==1?$project->firstHeidelberg->updated_at->format('d F Y | h:i:s A'):'Working'}}</td>

                        <td>{{$project->firstHeidelberg->status==1?getDifference($project->firstHeidelberg->created_at,$project->firstHeidelberg->updated_at):getDifference($project->firstHeidelberg->created_at,now())}}</td>

                    </tr>

                @else

                    <tr class="bg-warning">

                        <th><i class="ft-x-square"></i></th>

                        <td>Heidelberg-1</td>

                        <td>--</td>

                        <td>--</td>

                        <td>--</td>

                    </tr>

                @endif

                @endif



                @if($project->printing_machine == 'heidelberg2') 

                @if($project->secondHeidelberg)

                    <tr class="{{$project->secondHeidelberg->status==1?'bg-success':'bg-info'}}">

                        <th><i class="{{$project->secondHeidelberg->status==1?'ft-check-square':'ft-minus-square'}}"></i></th>

                        <td>Heidelberg-2</td>

                        <td>{{$project->secondHeidelberg->created_at->format('d F Y | h:i:s A')}}</td>

                        <td>{{$project->secondHeidelberg->status==1?$project->secondHeidelberg->updated_at->format('d F Y | h:i:s A'):'Working'}}</td>

                        <td>{{$project->secondHeidelberg->status==1?getDifference($project->secondHeidelberg->created_at,$project->secondHeidelberg->updated_at):getDifference($project->secondHeidelberg->created_at,now())}}</td>

                    </tr>

                @else

                    <tr class="bg-warning">

                        <th><i class="ft-x-square"></i></th>

                        <td>Heidelberg-2</td>

                        <td>--</td>

                        <td>--</td>

                        <td>--</td>

                    </tr>

                @endif

                @endif





                @if($project->printing_machine == 'dominent')

                @if($project->dominant) 

                    <tr class="{{@$project->dominant->status==1?'bg-success':'bg-info'}}">

                        <th><i class="{{$project->dominant->status==1?'ft-check-square':'ft-minus-square'}}"></i></th>

                        <td>Dominant (Printing)</td>

                        <td>{{$project->dominant->created_at->format('d F Y | h:i:s A')}}</td>

                        <td>{{$project->dominant->status==1?$project->dominant->updated_at->format('d F Y | h:i:s A'):'Working'}}</td>

                        <td>{{$project->dominant->status==1?getDifference($project->dominant->created_at,$project->dominant->updated_at):getDifference($project->dominant->created_at,now())}}</td>

                    </tr>

                @else

                    <tr class="bg-warning">

                        <th><i class="ft-x-square"></i></th>

                        <td>Dominant (Printing)</td>

                        <td>--</td>

                        <td>--</td>

                        <td>--</td>

                    </tr>

                @endif

                @endif





                @if($project->coating_machine == 'lamination')

                @if($project->lamination) 

                    <tr class="{{@$project->lamination->status==1?'bg-success':'bg-info'}}">

                        <th><i class="{{$project->lamination->status==1?'ft-check-square':'ft-minus-square'}}"></i></th>

                        <td>Lamination</td>

                        <td>{{$project->lamination->created_at->format('d F Y | h:i:s A')}}</td>

                        <td>{{$project->lamination->status==1?$project->lamination->updated_at->format('d F Y | h:i:s A'):'Working'}}</td>

                        <td>{{$project->lamination->status==1?getDifference($project->lamination->created_at,$project->lamination->updated_at):getDifference($project->lamination->created_at,now())}}</td>

                    </tr>

                @else

                    <tr class="bg-warning">

                        <th><i class="ft-x-square"></i></th>

                        <td>Lamination</td>

                        <td>--</td>

                        <td>--</td>

                        <td>--</td>

                    </tr>

                @endif

                @endif





                @if($project->embossing_leafing == 'embossing' || $project->embossing_leafing == 'Embossing')

                @if($project->embossing) 

                    <tr class="{{@$project->embossing->status==1?'bg-success':'bg-info'}}">

                        <th><i class="{{$project->embossing->status==1?'ft-check-square':'ft-minus-square'}}"></i></th>

                        <td>Embossing</td>

                        <td>{{$project->embossing->created_at->format('d F Y | h:i:s A')}}</td>

                        <td>{{$project->embossing->status==1?$project->embossing->updated_at->format('d F Y | h:i:s A'):'Working'}}</td>

                        <td>{{$project->embossing->status==1?getDifference($project->embossing->created_at,$project->embossing->updated_at):getDifference($project->embossing->created_at,now())}}</td>

                    </tr>

                @else

                    <tr class="bg-warning">

                        <th><i class="ft-x-square"></i></th>

                        <td>Embossing</td>

                        <td>--</td>

                        <td>--</td>

                        <td>--</td>

                    </tr>

                @endif

                @endif





                @if($project->dieCutting)

                    <tr class="{{@$project->dieCutting->status==1?'bg-success':'bg-info'}}">

                        <th><i class="{{$project->dieCutting->status==1?'ft-check-square':'ft-minus-square'}}"></i></th>

                        <td>dieCutting</td>

                        <td>{{$project->dieCutting->created_at->format('d F Y | h:i:s A')}}</td>

                        <td>{{$project->dieCutting->status==1?$project->dieCutting->updated_at->format('d F Y | h:i:s A'):'Working'}}</td>

                        <td>{{$project->dieCutting->status==1?getDifference($project->dieCutting->created_at,$project->dieCutting->updated_at):getDifference($project->dieCutting->created_at,now())}}</td>

                    </tr>

                @else

                    <tr class="bg-warning">

                        <th><i class="ft-x-square"></i></th>

                        <td>Die Cutting</td>

                        <td>--</td>

                        <td>--</td>

                        <td>--</td>

                    </tr>



                @endif





                @if($project->pasting)

                    <tr class="{{@$project->pasting->status==1?'bg-success':'bg-info'}}">

                        <th><i class="{{$project->pasting->status==1?'ft-check-square':'ft-minus-square'}}"></i></th>

                        <td>pasting</td>

                        <td>{{$project->pasting->created_at->format('d F Y | h:i:s A')}}</td>

                        <td>{{$project->pasting->status==1?$project->pasting->updated_at->format('d F Y | h:i:s A'):'Working'}}</td>

                        <td>{{$project->pasting->status==1?getDifference($project->pasting->created_at,$project->pasting->updated_at):getDifference($project->pasting->created_at,now())}}</td>

                    </tr>

                @else

                    <tr class="bg-warning">

                        <th><i class="ft-x-square"></i></th>

                        <td>Pasting</td>

                        <td>--</td>

                        <td>--</td>

                        <td>--</td>

                    </tr>



                @endif







            @endif































            @if($project->embossing_leafing == 'none' || $project->embossing_leafing == 'None')



                @if($project->cutting)

                    <tr class="bg-success">

                        <th><i class="{{$project->cutting->status==1?'ft-check-square':'ft-minus-square'}}"></i></th>

                        <td>Cutting</td>

                        <td>{{$project->cutting->created_at->format('d F Y | h:i:s A')}}</td>

                        <td>{{$project->cutting->status==1?$project->cutting->updated_at->format('d F Y | h:i:s A'):'Working'}}</td>

                        <td>{{$project->cutting->status==1?getDifference($project->cutting->created_at,$project->cutting->updated_at):getDifference($project->cutting->created_at,now())}}</td>

                    </tr>

                @else

                    <tr class="bg-success">

                        <th><i class="ft-x-square"></i></th>

                        <td>Cutting</td>

                        <td>--</td>

                        <td>--</td>

                        <td>--</td>

                    </tr>

                @endif



                @if($project->printing_machine == 'heidelberg1' || $project->printing_machine == 'heidleberg') 

                @if($project->firstHeidelberg)

                    <tr class="{{$project->firstHeidelberg->status==1?'bg-success':'bg-info'}}">

                        <th><i class="{{$project->firstHeidelberg->status==1?'ft-check-square':'ft-minus-square'}}"></i></th>

                        <td>Heidelberg-1</td>

                        <td>{{$project->firstHeidelberg->created_at->format('d F Y | h:i:s A')}}</td>

                        <td>{{$project->firstHeidelberg->status==1?$project->firstHeidelberg->updated_at->format('d F Y | h:i:s A'):'Working'}}</td>

                        <td>{{$project->firstHeidelberg->status==1?getDifference($project->firstHeidelberg->created_at,$project->firstHeidelberg->updated_at):getDifference($project->firstHeidelberg->created_at,now())}}</td>

                    </tr>

                @else

                    <tr class="bg-warning">

                        <th><i class="ft-x-square"></i></th>

                        <td>Heidelberg-1</td>

                        <td>--</td>

                        <td>--</td>

                        <td>--</td>

                    </tr>

                @endif

                @endif



                @if($project->printing_machine == 'heidelberg2') 

                @if($project->secondHeidelberg)

                    <tr class="{{$project->secondHeidelberg->status==1?'bg-success':'bg-info'}}">

                        <th><i class="{{$project->secondHeidelberg->status==1?'ft-check-square':'ft-minus-square'}}"></i></th>

                        <td>Heidelberg-2</td>

                        <td>{{$project->secondHeidelberg->created_at->format('d F Y | h:i:s A')}}</td>

                        <td>{{$project->secondHeidelberg->status==1?$project->secondHeidelberg->updated_at->format('d F Y | h:i:s A'):'Working'}}</td>

                        <td>{{$project->secondHeidelberg->status==1?getDifference($project->secondHeidelberg->created_at,$project->secondHeidelberg->updated_at):getDifference($project->secondHeidelberg->created_at,now())}}</td>

                    </tr>

                @else

                    <tr class="bg-warning">

                        <th><i class="ft-x-square"></i></th>

                        <td>Heidelberg-2</td>

                        <td>--</td>

                        <td>--</td>

                        <td>--</td>

                    </tr>

                @endif

                @endif



                @if($project->printing_machine == 'dominent')

                @if($project->dominant) 

                    <tr class="{{@$project->dominant->status==1?'bg-success':'bg-info'}}">

                        <th><i class="{{$project->dominant->status==1?'ft-check-square':'ft-minus-square'}}"></i></th>

                        <td>Dominant (Printing)</td>

                        <td>{{$project->dominant->created_at->format('d F Y | h:i:s A')}}</td>

                        <td>{{$project->dominant->status==1?$project->dominant->updated_at->format('d F Y | h:i:s A'):'Working'}}</td>

                        <td>{{$project->dominant->status==1?getDifference($project->dominant->created_at,$project->dominant->updated_at):getDifference($project->dominant->created_at,now())}}</td>

                    </tr>

                @else

                    <tr class="bg-warning">

                        <th><i class="ft-x-square"></i></th>

                        <td>Dominant (Printing)</td>

                        <td>--</td>

                        <td>--</td>

                        <td>--</td>

                    </tr>

                @endif

                @endif





                @if($project->coating_machine == 'lamination')

                @if($project->lamination) 

                    <tr class="{{@$project->lamination->status==1?'bg-success':'bg-info'}}">

                        <th><i class="{{$project->lamination->status==1?'ft-check-square':'ft-minus-square'}}"></i></th>

                        <td>Lamination</td>

                        <td>{{$project->lamination->created_at->format('d F Y | h:i:s A')}}</td>

                        <td>{{$project->lamination->status==1?$project->lamination->updated_at->format('d F Y | h:i:s A'):'Working'}}</td>

                        <td>{{$project->lamination->status==1?getDifference($project->lamination->created_at,$project->lamination->updated_at):getDifference($project->lamination->created_at,now())}}</td>

                    </tr>

                @else

                    <tr class="bg-warning">

                        <th><i class="ft-x-square"></i></th>

                        <td>Lamination</td>

                        <td>--</td>

                        <td>--</td>

                        <td>--</td>

                    </tr>

                @endif

                @endif





                @if($project->coating_machine == 'dominent') 

                @if($project->dominant)

                    <tr class="{{@$project->dominant->status==1?'bg-success':'bg-info'}}">

                        <th><i class="{{$project->dominant->status==1?'ft-check-square':'ft-minus-square'}}"></i></th>

                        <td>Dominant(Coating)</td>

                        <td>{{$project->dominant->created_at->format('d F Y | h:i:s A')}}</td>

                        <td>{{$project->dominant->status==1?$project->dominant->updated_at->format('d F Y | h:i:s A'):'Working'}}</td>

                        <td>{{$project->dominant->status==1?getDifference($project->dominant->created_at,$project->dominant->updated_at):getDifference($project->dominant->created_at,now())}}</td>

                    </tr>

                @else

                    <tr class="bg-warning">

                        <th><i class="ft-x-square"></i></th>

                        <td>Dominant(Coating)</td>

                        <td>--</td>

                        <td>--</td>

                        <td>--</td>

                    </tr>



                @endif

                @endif



                @if($project->dieCutting)

                    <tr class="{{@$project->dieCutting->status==1?'bg-success':'bg-info'}}">

                        <th><i class="{{$project->dieCutting->status==1?'ft-check-square':'ft-minus-square'}}"></i></th>

                        <td>dieCutting(Coating)</td>

                        <td>{{$project->dieCutting->created_at->format('d F Y | h:i:s A')}}</td>

                        <td>{{$project->dieCutting->status==1?$project->dieCutting->updated_at->format('d F Y | h:i:s A'):'Working'}}</td>

                        <td>{{$project->dieCutting->status==1?getDifference($project->dieCutting->created_at,$project->dieCutting->updated_at):getDifference($project->dieCutting->created_at,now())}}</td>

                    </tr>

                @else

                    <tr class="bg-warning">

                        <th><i class="ft-x-square"></i></th>

                        <td>Die Cutting</td>

                        <td>--</td>

                        <td>--</td>

                        <td>--</td>

                    </tr>



                @endif





                @if($project->pasting)

                    <tr class="{{@$project->pasting->status==1?'bg-success':'bg-info'}}">

                        <th><i class="{{$project->pasting->status==1?'ft-check-square':'ft-minus-square'}}"></i></th>

                        <td>pasting</td>

                        <td>{{$project->pasting->created_at->format('d F Y | h:i:s A')}}</td>

                        <td>{{$project->pasting->status==1?$project->pasting->updated_at->format('d F Y | h:i:s A'):'Working'}}</td>

                        <td>{{$project->pasting->status==1?getDifference($project->pasting->created_at,$project->pasting->updated_at):getDifference($project->pasting->created_at,now())}}</td>

                    </tr>

                @else

                    <tr class="bg-warning">

                        <th><i class="ft-x-square"></i></th>

                        <td>Pasting</td>

                        <td>--</td>

                        <td>--</td>

                        <td>--</td>

                    </tr>



                @endif



            @endif





        </tbody>

    </table>

</div>

</div>

</div>





@endsection

@push('scripts')

<script src="{{asset('admin-assets/dropify/js/dropify.min.js')}}"></script>

<script type="text/javascript" src="{{asset('admin-assets/dropify/dropify.js')}}"></script>

<script src="{{asset('admin-assets/app-assets/js/scripts/customizer.js')}}" type="text/javascript"></script>

<script src="{{asset('admin-assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>

<script type="text/javascript">



    $('.datePic').datepicker({

        format: 'dd-mm-yyyy',

        todayHighlight: true,

        autoClose:true,

    });

</script>

@endpush