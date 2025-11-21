@extends('layouts.master')
@section('content')

<div class="row">
  <div class="col-lg-12">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb breadcrumb-custom">
        <li class="breadcrumb-item"><a href="{{ URL :: to('/dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ URL :: to('/teachers-personal-detail') }}">Add new details</a></li>
        <li class="breadcrumb-item active" aria-current="page"><span>Students detail</span></span></li>
      </ol>
    </nav>
    <div class="card">
      @if ($message = Session::get('success'))
      <div class="alert alert-success">
        <p>{{ $message }}</p>
      </div>
      @endif
        <div class="card-title mb-2">
          <a class="btn btn-sm btn-dark" href="{{ route('teachers-personal-detail')}}" ><i class="fa fa-plus-circle"></i> Add new student</a>
          <a class="btn btn-sm btn-success" href="#frmadd" data-toggle="modal" data-url="{{route('import-teacher-details')}}"
            data-id=""><i class="fa fa-file-excel-o"></i> Import</a>
        </div>
        <hr>
        <form action="{{ route('teacher-search') }}" method="post" class="search-form">
        @csrf
          <div class="row">
            <div class="col-md-2">
              <input type="text" name="name" class="form-control" placeholder="Name">
            </div>
            <div class="col-md-2">
              <input type="text" name="contactNo" class="form-control" placeholder="Contact No">
            </div>
            <div class="col-md-2"><button type="submit" class="btn btn-danger btn-sm mt-1 search-btn" id="search-btn"><i class="fa fa-search"></i> Search</button>
            </div>
            <div class="col-md-2" id="print">
              <a href="{{ route('teacherpd-prints')}}" class="btn btn-primary btn-sm mt-1"><i class="fa fa-print"> Print</i></a>
              <a href="{{route('teachers-details-export')}}" class="btn btn-warning btn-sm mt-1"><i class="fa fa-file-excel-o" aria-hidden="true"> Excel</i></a>
            </div>
          </div>
        </form>
        <hr>
        <div class="details">
          <table class="rtable">
            <thead>
              <tr>
                <th>S.n.</th>
                <th>Full Name</th>
                <th>Grade</th>
                <th>Address</th>
                <th>Parent's Name</th>
                <th>Parent Contact Number </th>
                <th>Parents Email Address</th>
                <th>#</th> 
              </tr>
            </thead>
            <tbody>
              @if (!empty($students) && count($students) > 0)
                  @php $i = 1; @endphp
                  @foreach($students as $key => $title)
                      <tr>
                          <td>{{ $i++ }}</td>
                          <td>{{ $title->student_full_name }}</td>
                          <td>{{ $title->student_enrollment_class }}</td>
                          <td>{{ $title->student_address }}</td>
                          <td>{{ $title->student_parents_full_name }}</td>
                          <td>{{ $title->student_parents_cont_no }}</td>
                          <td>{{ $title->student_parents_email }}</td>
                          <td>
                            <a class="btn btn-sm btn-info btn-rounded" href="{{ URL('student-parent-detail-edit',$title->id) }}">
                              <i class="fa fa-pencil"></i>
                            </a>
                            <a class="btn btn-sm btn-secondary btn-rounded" href="{{ URL('student-parent-detail',$title->id) }}">
                              <i class="fa fa-eye"></i>
                            </a>
                          </td>
                      </tr>
                  @endforeach
              @else
                  <tr>
                      <td colspan="8">There is no details available for students.</td>
                  </tr>
              @endif
          </tbody>
          </table>
          <hr style="background-color:brown">
          <!-- pagination -->
          <div class="row">
</div>
        </div>
      </div>
    </div>
  </div>
@yield('script')
<script src="{{ asset('assets/js/search.js') }}"></script>
<script>
  $(document).ready(function(){
    $(document).on("click",'#search-btn',function(){
      $("#print").hide();
    });
  });
</script>
<!-- content-wrapper ends -->
@endsection

