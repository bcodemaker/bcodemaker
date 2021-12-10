@extends('admin.layouts.master')
@section('title','List Projects')

@push('links')

<link rel="stylesheet" href="{{asset('admin-assets/dropify/css/dropify.min.css')}}">
@endpush
@section('main')

<div class="content-header row">

    <div class="content-header-left col-md-6 col-12 mb-2">
      <h5 class="content-header-title mb-0">Site Setting</h5>
    </div>

    <div class="content-header-right col-md-6 col-12">
      <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
        {{-- <div class="btn-group" role="group">
            @can('add_project')
                <a href="{{ route('admin.project.create') }}" class="btn btn-primary btn-sm">Add Project</a>
            @endcan
       </div> --}}
    </div>
</div>
</div>

<div class="row my-1">
    <div class="col-lg-6 col-6">

        <div class="card">
            <div class="card-content">
                <div class="card-body">

                    {!! Form::open(['method' => 'POST', 'route' => 'admin.site-setting.logo', 'class' => 'form-horizontal','files'=>true]) !!}
                    
                        <div class="form-group{{ $errors->has('site_title') ? ' has-error' : '' }}">
                            {!! Form::label('site_title', 'Site Title') !!}
                            {!! Form::text('site_title', $logo->site_title, ['class' => 'form-control', 'required' => 'required','placeholder'=>'Site Logo']) !!}
                            <small class="text-danger">{{ $errors->first('site_title') }}</small>
                        </div>

                        <div class="form-group{{ $errors->has('site_description') ? ' has-error' : '' }}">
                            {!! Form::label('site_description', 'Site site_Description') !!}
                            {!! Form::text('site_description', $logo->site_description, ['class' => 'form-control', 'required' => 'required','placeholder'=>'Site Description']) !!}
                            <small class="text-danger">{{ $errors->first('site_description') }}</small>
                        </div>

                        <div class="form-group {{ $errors->has('logo') ? ' has-error' : '' }}">

                            {!! Form::label('logo', 'Site Logo') !!}

                            {!! Form::file('logo', ['class'=>'dropify','data-default-file'=>asset(@$logo->logo)]) !!}

                            {!! Form::hidden('checkfile',@$logo->logo, ['id' => 'checkfile']) !!}

                            <small class="text-danger">{{ $errors->first('logo') }}</small>

                        </div> 




                        <div class="form-group {{ $errors->has('favicon') ? ' has-error' : '' }}">

                            {!! Form::label('favicon', 'Site Favicon Icon') !!}

                            {!! Form::file('favicon', ['class'=>'dropify','data-default-file'=>asset(@$logo->favicon)]) !!}

                            {!! Form::hidden('checkfile',@$logo->favicon, ['id' => 'checkfile']) !!}

                            <small class="text-danger">{{ $errors->first('favicon') }}</small>

                        </div> 


                        <div class="btn-group">
                            {!! Form::submit("Save", ['class' => 'btn btn-success']) !!}
                        </div>
                    
                    {!! Form::close() !!}
                 
                   

                </div>
            </div>
        </div>
             
    </div>
</div>



@endsection


@push('scripts')

<script src="{{asset('admin-assets/dropify/js/dropify.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin-assets/dropify/dropify.js')}}"></script>


<script type="text/javascript">

 </script>

@endpush