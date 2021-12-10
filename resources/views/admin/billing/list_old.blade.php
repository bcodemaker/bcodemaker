@extends('admin.layouts.master')
@section('title','List Post')
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
                    <table id="dataTableAjax" class="table display dataTableAjax table-striped table-bordered scroll-horizontal dataTable no-footer" >
                        <thead>
                            <tr>
                                <th>Job No.</th>
                                <th>Carton Name</th>
                                <th>Total Sheet</th>
                                @can(['edit_billing','delete_billing','browse_billing','change_status_billing'])
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
@endsection
@push('scripts')
<script type="text/javascript">
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
                        d._method = 'PATCH';
                    }
                },
                "columns": [
                    { "data": "job_no" },
                    { "data": "carton_name" },
                    { "data": "total_sheet" },
                    @can(['edit_billing','delete_billing','read_billing','change_status_billing'])
                    {
                        "data": "action",
                        render: function(data, type, row) {
                            if (type === 'display') {
                                var btn = '';

                                @can('change_status_billing')
                                
                                if( row['changeStatus']=='1'){
                                    btn+='<button type="button" onclick="updateData(\'{{ route('admin.'.request()->segment(2).'.changeStatus') }}\',{id:'+row['id']+',project_id:'+row['project_id']+',status:3})" class="btn btn-social-icon btn-outline-warning btn-xs" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Cancel"><i class="ft-x-square"></i></button> ';
                                }
                                if( row['changeStatus']=='2' || row['changeStatus']=='3' ){
                                    btn+='<button type="button" onclick="updateData(\'{{ route('admin.'.request()->segment(2).'.changeStatus') }}\',{id:'+row['id']+',project_id:'+row['project_id']+',status:1})" class="btn btn-social-icon btn-outline-info btn-xs" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Assign"><i class="ft-check-square"></i></button> ';
                                }

                                @endcan

                                @can('read_billing')
                                btn += '<a class="btn btn-social-icon btn-outline-success btn-xs" href="{{ request()->url() }}/' + row['id'] + '" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="View"><i class="fa fa-eye"></i></a>&nbsp;';
                                @endcan

                                @can('edit_billing')
                                    btn+='<a class="btn btn-xs btn-social-icon btn-outline-secondary" href="'+window.location.href+'/'+row['id']+'/edit" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit"><i class="fa fa-pencil-square-o"></i></a> ';
                                @endcan
                                @can('delete_billing')
                                    btn += '<button type="button" onclick="deleteAjax(\''+window.location.href+'/'+row['id']+'\')" class="btn btn-xs btn-social-icon btn-outline-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete"></i></button>&nbsp;';
                                @endcan
                               
                                return btn;
                            }
                            return ' ';
                        },
                } @endcan ]
            });



            function company(){
                table2.draw();
            }
            function status(){
                table2.draw();
            }
            
    </script>
@endpush