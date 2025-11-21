@extends('layouts.master')
@section('content')

@if ($message = Session::get('access'))
  <div class="row">
    <div class="col-12">
      <div class="alert alert-fill-danger" role="alert">
        <i class="fa fa-warning"></i>{{ $message }}
      </div>
    </div>
  </div>
@endif
<div class="row">
  <div class="col-md-6 col-lg-6 col-xl-12 grid-margin stretch-card">
    <button class="button school-btn" style="width: 1200px; margin-left:-20px;">Welcome To School Management System ({{ $palikaProfile->schoolname }})</button>
  </div>
</div>
<hr>
<div class="row">
  <div class="col-md-6 col-lg-6 col-xl-3 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
          <div class="icon-wrap">
            <i class="fa fa-university"></i>
          </div>
          <div class="flex-right-height">
            <h2 class="countnum ml-4">{{  $count  }}</h2>
            <p class="font-weight-bold mb-1"><a href="{{ route('school-details') }}">Total Students</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-lg-6 col-xl-3 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
          <div class="icon-wrap">
            <i class="fa fa-user"></i>
          </div>
          <div class="flex-right-height">
            <h2 class="countnum">{{ $tot_steachers }}</h2>
            <p class="font-weight-bold mb-1"><a href="{{ route('school-details') }}" style="margin-left:-15px">Permanent Teachers</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-lg-6 col-xl-3 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
          <div class="icon-wrap">
            <i class="fa fa-user"></i>
          </div>
          <div class="flex-right-height">
            <h2 class="countnum">{{  $tot_ateachers  }}</h2>
            <p class="font-weight-bold mb-1 ml-2"><a href="{{ route('school-details') }}" class="ml-1">Temporary Teachers</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-lg-6 col-xl-3 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
          <div class="icon-wrap">
            <i class="fa fa-users"></i>
          </div>
          
          <div class="flex-right-height">
            <h2 class="countnum">{{  $tot_teachers  }}</h2>
            <p class="font-weight-bold mb-1"><a href="{{ route('school-details') }}">Total Teachers</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<hr>
<div class="row">
  <div class="col-md-6 col-lg-6 col-xl-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-header cardhead">Permanent Teachers Profile</div>
      <div class="card-body">
        <div class="table-responsive permanent-table">
          @if($sthai_teacher->isNotEmpty())
          <table class="table table-hover table-wrapper">
            <thead style="background-color: #607dc4; width:fit-content; color:azure;">
              <tr>
                <th class="pt-1 p-2 text-center">S.N</th>
                <th class="pt-1 p-2 text-center">Profile</th>
                <th class="pt-1 p-2 text-center">Full Name</th>
                <th class="pt-1 p-2 text-center">Contact Number</th>
                <th>View Profile</th>
              </tr>
            </thead>
            @php $i=1;@endphp
            <tbody>
             
              @foreach($sthai_teacher as $key => $st)
              <tr>
                <td>{{ $i++; }}</td>
                <td><i class="fa fa-users" aria-hidden="true"></i></td>
                <td class="py-1 pl-0">
                  <div class="d-flex align-items-center">
                    <div class="ml-3">
                      <p class="mb-2">{{ $st->teachers_name_nep }}</p>
                      <p class="mb-0 text-muted text-small">{{ $st->teachers_name_eng}}</p>
                    </div>
                  </div>
                </td>
                <td>
                  {{ $st->teachers_mobno }}
                </td>
                <td>
                <label class="badge badge-success"><a href="{{ route('teachers-profile-detail',$st->id) }}" style="color: #fff;">View Profile</label>
                </td>
              </tr>
            </tbody>
            @endforeach
          </table>
          @else
          <div class="alert alert-fill-danger" role="alert"><i class="fa fa-warning"></i>No permanent teacher details available.</div>
          @endif
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-lg-6 col-xl-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-header cardhead">Temporary Teacher's Profile</div>
      <div class="card-body">
        <div class="table-responsive permanent-table">
          @if($asthai_teacher->isNotEmpty())
          <table class="table table-hover table-wrapper">
            <thead style="background-color: #607dc4; width:fit-content; color:azure;">
              <tr>
                <th class="pt-1 p-2 text-center">S.N</th>
                <th class="pt-1 p-2 text-center">Profile</th>
                <th class="pt-1 p-2 text-center">Full Name</th>
                <th class="pt-1 p-2 text-center">Contact Number</th>
                <th>View Profile</th>
              </tr>
            </thead>
            @php $i=1;@endphp
            <tbody>
             
              @foreach($asthai_teacher as $key => $st)
              <tr>
                <td>{{ $i++; }}</td>
                <td><i class="fa fa-users" aria-hidden="true"></i></td>
                <td class="py-1 pl-0">
                  <div class="d-flex align-items-center">
                    <div class="ml-3">
                      <p class="mb-2">{{ $st->teachers_name_nep }}</p>
                      <p class="mb-0 text-muted text-small">{{ $st->teachers_name_eng}}</p>
                    </div>
                  </div>
                </td>
                <td>
                  {{ $st->teachers_mobno }}
                </td>
                <td>
                <label class="badge badge-success"><a href="{{ route('teachers-profile-detail',$st->id) }}" style="color: #fff;">View Profile</label>
                </td>
              </tr>
            </tbody>
            @endforeach
          </table>
          @else 
          <div class="alert alert-fill-danger" role="alert"><i class="fa fa-warning"></i>No temporary teacher details available</div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection