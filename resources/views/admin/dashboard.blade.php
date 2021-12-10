@extends('admin.layouts.master')
@push('links')
<link rel="stylesheet" type="text/css" href="{{asset('admin-assets/app-assets/fonts/simple-line-icons/style.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('admin-assets/app-assets/css/core/colors/palette-gradient.css')}}">

@endpush
@section('main')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">

      <h3 class="content-header-title mb-0">Dashboard</h3>
  </div>
  <div class="content-header-right col-md-6 col-12">
      <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
        <div class="btn-group" role="group">

        </div>

    </div>
</div>
</div>

<div class="row">
    @can('completed_job_dashboard')
    <div class="col-xl-3 col-lg-6 col-12">
        <div class="card">
          <div class="card-content">
            <a href="/admin/project?status=completed">
                <div class="media align-items-stretch">

                  <div class="p-2 text-center bg-primary bg-darken-2">
                    <i class="icon-camera font-large-2 white"></i>
                </div>
                <div class="p-2 bg-gradient-x-primary white media-body">
                    <h5>Completed Jobs</h5>
                    <h5 class="text-bold-400 mb-0"><i class="ft-plus"></i> {{$projects->where('status',1)->count()}}</h5>
                </div>

            </div>
        </a>
    </div>
</div>
</div>
@endcan

@can('inprocess_job_dashboard')
<div class="col-xl-3 col-lg-6 col-12">
    <div class="card">
      <div class="card-content">
        <a href="/admin/project?status=inprocess">
            <div class="media align-items-stretch">
              <div class="p-2 text-center bg-danger bg-darken-2">
                <i class="icon-user font-large-2 white"></i>
            </div>
            <div class="p-2 bg-gradient-x-danger white media-body">
                <h5>Inprocess Jobs</h5>
                <h5 class="text-bold-400 mb-0"><i class="ft-arrow-up"></i>{{$projects->where('status',2)->count()}}</h5>
            </div>
        </div>
    </a>
</div>
</div>
</div>
@endcan

@can('pending_job_dashboard')
<div class="col-xl-3 col-lg-6 col-12">
    <div class="card">
      <div class="card-content">
        <a href="/admin/project?status=pending">
            <div class="media align-items-stretch">
              <div class="p-2 text-center bg-warning bg-darken-2">
                <i class="icon-picture font-large-2 white"></i>
            </div>
            <div class="p-2 bg-gradient-x-warning white media-body">
                <h5>Pending Jobs</h5>
                <h5 class="text-bold-400 mb-0"><i class="ft-plus"></i>{{$projects->where('status',0)->count()}}</h5>
            </div>
        </div>
    </a>
</div>
</div>
</div>
@endcan

@can('all_job_dashboard')
<div class="col-xl-3 col-lg-6 col-12">
    <div class="card">
      <div class="card-content">
        <a href="/admin/project?status=all">
            <div class="media align-items-stretch">
              <div class="p-2 text-center bg-success bg-darken-2">
                <i class="icon-briefcase font-large-2 white"></i>
            </div>
            <div class="p-2 bg-gradient-x-success white media-body">
                <h5>Total Jobs</h5>
                <h5 class="text-bold-400 mb-0"><i class="ft-arrow-up"></i>{{$projects->count()}}</h5>
            </div>
        </div>
    </a>
</div>
</div>
</div>
@endcan
</div>


<div class="row">
          <div class="col-xl-3 col-lg-6 col-12">
            <div class="card">
              <div class="card-content">
                <div class="card-body">
                  <div class="media">
                    <div class="media-body text-left w-100">
                      <h3 class="primary">{{$cutting = App\Model\Cutting::where('status',2)->count()}}</h3>
                      <span>Cutting</span>
                    </div>
                    <div class="media-right media-middle">
                      <i class="ft-scissors primary font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="progress progress-sm mt-1 mb-0">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: {{$cutting}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-6 col-12">
            <div class="card">
              <div class="card-content">
                <div class="card-body">
                  <div class="media">
                    <div class="media-body text-left w-100">
                      <h3 class="danger">{{$heidelberg1 = App\Model\FirstHeidelberg::where('status',2)->count()}}</h3>
                      <span>Heidelberg-1</span>
                    </div>
                    <div class="media-right media-middle">
                      <i class="ft-server danger font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="progress progress-sm mt-1 mb-0">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: {{$heidelberg1}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-lg-6 col-12">
            <div class="card">
              <div class="card-content">
                <div class="card-body">
                  <div class="media">
                    <div class="media-body text-left w-100">
                      <h3 class="info">{{$heidelberg2 = App\Model\SecondHeidelberg::where('status',2)->count()}}</h3>
                      <span>Heidelberg-2</span>
                    </div>
                    <div class="media-right media-middle">
                      <i class="ft-server info font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="progress progress-sm mt-1 mb-0">
                    <div class="progress-bar bg-info" role="progressbar" style="width: {{$heidelberg2}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-lg-6 col-12">
            <div class="card">
              <div class="card-content">
                <div class="card-body">
                  <div class="media">
                    <div class="media-body text-left w-100">
                      <h3 class="success">{{$dominant = App\Model\Dominant::where('status',2)->count()}}</h3>
                      <span>Dominant</span>
                    </div>
                    <div class="media-right media-middle">
                      <i class="ft-stop-circle success font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="progress progress-sm mt-1 mb-0">
                    <div class="progress-bar bg-success" role="progressbar" style="width: {{$dominant}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-lg-6 col-12">
            <div class="card">
              <div class="card-content">
                <div class="card-body">
                  <div class="media">
                    <div class="media-body text-left w-100">
                      <h3 class="warning">{{$lamination = App\Model\Lamination::where('status',2)->count()}}</h3>
                      <span>Lamination</span>
                    </div>
                    <div class="media-right media-middle">
                      <i class="ft-airplay warning font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="progress progress-sm mt-1 mb-0">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: {{$lamination}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-lg-6 col-12">
            <div class="card">
              <div class="card-content">
                <div class="card-body">
                  <div class="media">
                    <div class="media-body text-left w-100">
                      <h3 class="primary">{{$embossing = App\Model\Embossing::where('status',2)->count()}}</h3>
                      <span>Embossing</span>
                    </div>
                    <div class="media-right media-middle">
                      <i class="ft-aperture primary font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="progress progress-sm mt-1 mb-0">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: {{$embossing}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-lg-6 col-12">
            <div class="card">
              <div class="card-content">
                <div class="card-body">
                  <div class="media">
                    <div class="media-body text-left w-100">
                      <h3 class="danger">{{$leafing = App\Model\Leafing::where('status',2)->count()}}</h3>
                      <span>Leafing</span>
                    </div>
                    <div class="media-right media-middle">
                      <i class="fa fa-leaf danger font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="progress progress-sm mt-1 mb-0">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: {{$leafing}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-lg-6 col-12">
            <div class="card">
              <div class="card-content">
                <div class="card-body">
                  <div class="media">
                    <div class="media-body text-left w-100">
                      <h3 class="info">{{$diecutting = App\Model\DieCutting::where('status',2)->count()}}</h3>
                      <span>Die Cutting</span>
                    </div>
                    <div class="media-right media-middle">
                      <i class="fa fa-crosshairs info font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="progress progress-sm mt-1 mb-0">
                    <div class="progress-bar bg-info" role="progressbar" style="width: {{$diecutting}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-lg-6 col-12">
            <div class="card">
              <div class="card-content">
                <div class="card-body">
                  <div class="media">
                    <div class="media-body text-left w-100">
                      <h3 class="success">{{$pasting = App\Model\Pasting::where('status',2)->count()}}</h3>
                      <span>Pasting</span>
                    </div>
                    <div class="media-right media-middle">
                      <i class="fa fa-ticket success font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="progress progress-sm mt-1 mb-0">
                    <div class="progress-bar bg-success" role="progressbar" style="width: {{$pasting}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>

@endsection

@push('scripts')

@endpush