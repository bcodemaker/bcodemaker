@extends('admin.layouts.master')

@push('links')

<link rel="stylesheet" href="{{asset('admin-assets/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}">

@endpush

@section('main')

<div class="content-header row">

    <div class="content-header-left col-md-2 col-12 mb-2">

      <h5 class="content-header-title mb-0">{{ucfirst(str_singular(request()->segment(2)))}}</h5>

    </div>



@if(Auth::guard('admin')->user()->role_id == 1 || Auth::guard('admin')->user()->role_id == 2)

    <div class="content-header-left col-md-2 col-12 mb-12">

        <div class="" style="max-width: 200px;margin:0 auto">

        <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}" style="margin-bottom: 0">

            {!! Form::select('status',[1=>'Complated',2=>'Inprocess'], 2, ['id' => 'status', 'class' => 'form-control form-control-sm','placeholder'=>'All Status','onChange'=>'status()']) !!}

            <small class="text-danger">{{ $errors->first('status') }}</small>

        </div>

    </div>

    </div>

@endif





@if(Auth::guard('admin')->user()->role_id == 1 || Auth::guard('admin')->user()->role_id == 2)

    <div class="content-header-left col-md-2 col-12 mb-12">

    <div class="" style="max-width: 200px;margin:0 auto">



        <div class="form-group{{ $errors->has('fromDate') ? ' has-error' : '' }}">

            {!! Form::text('fromDate', null, ['id'=>'fromDate','class' => 'form-control form-control-sm datePic', 'placeholder' => 'Date From','data-provide'=>'datepicker','data-date-autoclose'=>'true']) !!}

            <small class="text-danger">{{ $errors->first('fromDate') }}</small>

        </div>

        

    </div>

    </div>

@endif





@if(Auth::guard('admin')->user()->role_id == 1 || Auth::guard('admin')->user()->role_id == 2)

    <div class="content-header-left col-md-2 col-12 mb-12">

    <div class="" style="max-width: 200px;margin:0 auto">



        <div class="form-group{{ $errors->has('toDate') ? ' has-error' : '' }}">

            {!! Form::text('toDate', null, ['id'=>'toDate','class' => 'form-control form-control-sm datePic', 'placeholder' => 'Date To','data-provide'=>'datepicker','data-date-autoclose'=>'true']) !!}

            <small class="text-danger">{{ $errors->first('toDate') }}</small>

        </div>

        

    </div>

    </div>

@endif



@if(Auth::guard('admin')->user()->role_id == 1 || Auth::guard('admin')->user()->role_id == 2)

    <div class="content-header-left col-md-2 col-12 mb-12">

    <div class="" style="max-width: 200px;margin:0 auto">

        <div class="btn-group">

        {!! Form::submit('Date Filter', ['class' => 'btn btn-secondary btn-sm','onClick'=>'dateFilter(this)']) !!}

        {!! Form::button('X', ['class' => 'btn btn-danger btn-sm','onClick'=>'clerFilter(this)']) !!}

    </div>

        

    </div>

    </div>

@endif





<div class="content-header-right col-md-2 col-12">

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

                    <table id="dataTableAjax" class="table display dataTableAjax table-striped table-bordered scroll-horizontal dataTable no-footer" >

                        <thead>

                            <tr>
                                <th>Si</th>

                                <th>Job No.</th>

                                <th>Paper</th>

                                <th>Cutsize</th>

                                <th>Total Sheet</th>

                                @can(['edit_cutting','delete_cutting','browse_cutting','change_status_cutting'])

                                    <th>Action</th>

                                @endcan

                                

                            </tr>

                        </thead>

                        

                    </table>

                </div>

            </div>

        </div>

             

    </div>

</div>

@endsection

@push('scripts')

<script type="text/javascript">

  //alert('hello');  

            var table2 = $('#dataTableAjax').DataTable({

                "drawCallback": function( settings ) {

                    $('[data-toggle="tooltip"]').tooltip();

                    $('html, body').animate({

                        scrollTop: $("body").offset().top,

                    }, 'slow');

                    $('li.paginate_button.page-item .page-link').on('click', function() {

                        $.blockUI({

                            message: '<div class=""><img width="100" src="/images/table.gif"></div>',

                            timeout: 2000, //unblock after 2 seconds

                            overlayCSS: {

                                backgroundColor: '#FFF',

                                opacity: 0.8,

                                cursor: 'wait'

                            },

                            css: {

                                border: 0,

                                padding: 0,

                                backgroundColor: 'transparent'

                            }

                        });

                    });

                },

                "processing": true,

                "serverSide": true,

                //"scrollX": true,

                "lengthMenu": [100, 150, 200,300],

                'ajax': {

                    'url': '{{ route('admin.'.request()->segment(2).'.index') }}',

                    'data': function(d) {

                        d._token = '{{ csrf_token() }}';

                        d.status = $('#status').val();

                        d.fromDate = $('#fromDate').val();

                        d.toDate = $('#toDate').val();

                        d._method = 'PATCH';

                    }

                },

                "columns": [
                { "data": "sn" },

                    { "data": "job_no" },

                    { "data": "paper" },

                    { "data": "cutsize" },

                    { "data": "total_sheet" },

                    @can(['edit_cutting','delete_cutting','read_cutting','change_status_cutting'])

                    {

                        "data": "action",

                        render: function(data, type, row) {

                            if (type === 'display') {

                                var btn = '';



                                if( row['fromDate'] != null && row['toDate'] != null){

                                   return btn+=row['updated_at'];

                                } else{



                                @can('change_status_cutting')

                                

                                if( row['changeStatus']=='1'){

                                    btn+='<button type="button" onclick="updateData(\'{{ route('admin.cutting.changeStatus') }}\',{id:'+row['id']+',project_id:'+row['project_id']+',status:3})" class="btn btn-social-icon btn-outline-warning btn-xs" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Cancel"><i class="ft-x-square"></i></button> ';

                                }

                                if( row['changeStatus']=='2' || row['changeStatus']=='3' ){

                                    btn+='<button type="button" onclick="updateData(\'{{ route('admin.cutting.changeStatus') }}\',{id:'+row['id']+',project_id:'+row['project_id']+',status:1})" class="btn btn-social-icon btn-outline-info btn-xs" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Assign"><i class="ft-check-square"></i></button> ';

                                }



                                @endcan



                                @can('read_cutting')

                                btn += '<a class="btn btn-social-icon btn-outline-success btn-xs" href="{{ request()->url() }}/' + row['id'] + '" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="View"><i class="fa fa-eye"></i></a>&nbsp;';

                                @endcan



                                @can('edit_cutting')

                                    btn+='<a class="btn btn-xs btn-social-icon btn-outline-secondary" href="'+window.location.href+'/'+row['id']+'/edit" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit"><i class="fa fa-pencil-square-o"></i></a> ';

                                @endcan

                                @can('delete_cutting')

                                    btn += '<button type="button" onclick="deleteAjax(\''+window.location.href+'/'+row['id']+'\')" class="btn btn-xs btn-social-icon btn-outline-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete"></i></button>&nbsp;';

                                @endcan

                               

                                return btn;

                            }

                            }



                            return ' ';

                        },



                } @endcan ]

            });



            function status(){

                table2.draw();

            }

           // $(table2.column(5).header()).text('Action');

            function dateFilter(element) {

                var fromDate = $('#fromDate');

                var toDate = $('#toDate');

                if(fromDate != '' && toDate != ''){

                    table2.draw(); 

                    //$(table2.column(5).header()).text('Date');

                } else{

                    table2.draw();

                    //$(table2.column(5).header()).text('Action');

                }

                 

            }



            function clerFilter(element) {

                $('#fromDate').val('');

                $('#toDate').val('');

                table2.draw();

            }

            

    </script>





<script src="{{asset('admin-assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>

<script type="text/javascript">

    $('.datePic').datepicker({

        format: 'dd-mm-yyyy',

        todayHighlight: true,

        autoClose:true,

    });

 </script>

@endpush