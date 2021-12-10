@extends('admin.layouts.master')
@push('links')
<style type="text/css">
    .pagination-old .pagination{
        float: right;
    }
</style>
@endpush
@section('main')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
      <h5 class="content-header-title mb-0">{{ucfirst(str_singular(request()->segment(2)))}}</h5>
    </div>


    <div class="content-header-right col-md-6 col-12">
      <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
        <div class="btn-group" role="group">
            @can('add_'.ucfirst(str_singular(request()->segment(2))))
                 <a href="{{ route('admin.'.request()->segment(2).'.create') }}" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> Add {{ucfirst(str_singular(request()->segment(2)))}}</a>
            @endcan
       </div>
    </div>
</div>
</div>
<div class="card">
    <div class="card-content">
        <div class="card-body">
            <div class="row my-1">
                <div class="col-lg-12 col-12">
                    <table class="table table-striped table-bordered scroll-horizontal dataTable no-footer" >
                        <thead>
                            <tr>
                                <th>Job No.</th>
                                <th>Carton Name</th>
                                <th>Total Sheet</th>
                                <th>Acrion</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($billings as $billing)
                                <tr>
                                    <td>{{$billing->job_no}}</td>
                                    <td>
                                        <table class="table table-striped table-bordered scroll-horizontal dataTable no-footer" style="font-size: 12px;">

                                              <tr>
                                                    @foreach (explode(",",$billing->carton_name) as $carton)
                                                        <th>{{$carton}}</th>
                                                    @endforeach
                                              </tr>
                                                <tr>
                                                    @foreach (explode(",",$billing->carton_quantity) as $quantity)
                                                        <td>{{$quantity}}</td>
                                                    @endforeach
                                                </tr>
                                            </table>
                                    </td>
                                    <td>{{@$billing->project->total_sheet}}</td>
                                    <td><button class="btn btn siccess">Completed</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                        
                    </table>
                </div>
                <div class="col-lg-6"><br>
                    Showing {{ $billings->firstItem() }} to {{ $billings->lastItem() }} of {{$billings->total() }} entries
                </div>
                <div class="col-lg-6 pagination-old"><br>
                    {{ $billings->links() }}
                </div>
            </div>
        </div>
             
    </div>
</div>
@endsection
@push('scripts')
@endpush