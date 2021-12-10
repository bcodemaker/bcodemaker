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

                                <th>Total Carton</th>

                                <th>Total Sheet</th>

                                <th>File</th>

                                @can(['edit_pasting','delete_pasting','browse_pasting','change_status_pasting'])

                                    <th width="13%">Action</th>

                                @endcan

                                

                            </tr>

                        </thead>

                        

                    </table>

                </div>

            </div>

        </div>

             

    </div>

</div>





<div class="modal fade text-left" id="pasting" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" style="display: none;" aria-hidden="true">

    <div class="modal-dialog modal-lg" role="document">

      <div class="modal-content">

        <div class="modal-header bg-info white">

          <h4 class="modal-title" id="jobtitle">Job No.:- </h4>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">

            <span aria-hidden="true">×</span>

          </button>

        </div>

        {!! Form::open(['method' => 'POST', 'route' => 'admin.'.request()->segment(2).'.changeStatus','method'=>'put', 'class' => 'form form-horizontal striped-rows form-bordered']) !!}

        <div id="modalbody" class="modal-body">

          

          

        </div>

        <div class="modal-footer">

            <input type="hidden" name="status" value="1">

            <input type="hidden" name="project_id" value="1" id="projectid">

            <input type="hidden" name="id" value="1" id="pastingid">

            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>

            <button type="submit" class="btn btn-outline-primary">Save changes</button>

        </div>

        {!! Form::close() !!}

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

                "lengthMenu": [30, 50, 100,200],

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

                    { "data": "total_carton" },

                    { "data": "total_sheet" },

                    { "data": "file" },

                    @can(['edit_pasting','delete_pasting','read_pasting','change_status_pasting'])

                    {

                        "data": "action",

                        render: function(data, type, row) {

                            if (type === 'display') {

                                var btn = '';

                                if( row['fromDate'] != null && row['toDate'] != null){

                                   return btn+=row['updated_at'];

                                } else{



                                @can('change_status_pasting')

                                

                                if( row['changeStatus']=='1'){

                                    btn+='<button type="button" onclick="updateData(\'{{ route('admin.'.request()->segment(2).'.changeStatus') }}\',{id:'+row['id']+',project_id:'+row['project_id']+',status:3})" class="btn btn-social-icon btn-outline-warning btn-xs" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Cancel"><i class="ft-x-square"></i></button> ';

                                }

                                if( row['changeStatus']=='2' || row['changeStatus']=='3' ){

                                    btn+='<button type="button" onclick="updateDataPasting(\'{{ route('admin.'.request()->segment(2).'.changeStatus') }}\',{id:'+row['id']+',project_id:'+row['project_id']+',status:2})" class="btn btn-social-icon btn-outline-info btn-xs" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Assign"><i class="ft-check-square"></i></button> ';

                                }



                                @endcan



                                @can('read_pasting')

                                btn += '<a class="btn btn-social-icon btn-outline-success btn-xs" href="{{ request()->url() }}/' + row['id'] + '" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="View"><i class="fa fa-eye"></i></a>&nbsp;';

                                @endcan



                                @can('edit_pasting')

                                    btn+='<a class="btn btn-xs btn-social-icon btn-outline-secondary" href="'+window.location.href+'/'+row['id']+'/edit" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit"><i class="fa fa-pencil-square-o"></i></a> ';

                                @endcan

                                @can('delete_pasting')

                                    btn += '<button type="button" onclick="deleteAjax(\''+window.location.href+'/'+row['id']+'\')" class="btn btn-xs btn-social-icon btn-outline-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete"></i></button>&nbsp;';

                                @endcan

                               

                                return btn;

                            }

                            }

                            return ' ';

                        },

                } @endcan ]

            });



            // table2.on('page.dt', function() {

            //   $('html, body').animate({

            //     scrollTop: $("body").offset().top,

            //    }, 'slow');

            // });





            function updateDataPasting(url,data={},callback=null){

                $('#modalbody').html('');

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

                $.ajax({

                    url:url,

                    method: 'post',

                    data:Object.assign({'_method':'PUT','_token':'{{ csrf_token() }}'},data),

                    dataType:'json',

                    success:function(response){

                        if(response.data.length > 0){

                            $('#jobtitle').html("Job No.:- "+response.project.job_no)

                            $('#projectid').val(data.project_id)

                            $('#pastingid').val(data.id)

                            $.each(response.data, function(key, val) {

                                $('#modalbody').append('<div class="form-group row" style="padding-right: 15px;"><label class="col-md-3 label-control" for="projectinput1">'+val+'</label><div class="col-md-9"><input type="text" id="projectinput1" class="form-control" name="billing[]" placeholder="Carton Quantity"></div></div>')

                            });

                        }



                        $('#pasting').modal('show'); 

                    }

                });

            }

            function status(){

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

@endpush