@extends('layouts.master')
@section('content')
<div class="row">
  <div class="col-lg-12">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb breadcrumb-custom">
        <li class="breadcrumb-item"><a href="{{ URL :: to('/dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page"><span>Exam Schedule</span></span></li>
      </ol>
    </nav>
    <div class="card">

      @if ($message = Session::get('success'))
      <div class="alert alert-success">
        <p>{{ $message }}</p>
      </div>
      @endif
      <div class="table-responsive">
        <div class="card-title">
          <a class="btn btn-sm btn-dark" href="#frmadd" data-toggle="modal" data-url="{{route('add-schedule-setting')}}"
            data-id=""><i class="fa fa-plus-circle"></i> Add New</a>
        </div><br>
        <table class="rtable">
          <thead>
            <tr>
              <th>S.N.</th>
              <th>Exam Name</th>
              <th>Academic Year</th>
              <th>Exam Start Date</th>
              <th>Exam End Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @if (!empty($exams))
            @php $i=1; @endphp
            @foreach($exams as $key => $title)
            <tr>
              <td>{{ $i++ }}</td>
              <td>{{ $title->exam->exam_name }}</td>
              <td>{{ $title->academic_year }}</td>
              <td>{{ $title->exam_start_date }}</td>
              <td>{{ $title->exam_end_date }}</td>
              <td>
                <div class="d-flex gap-2">
                    <a class="btn btn-sm btn-info" href="#frmedit" data-toggle="modal" data-url="{{route('edit-schedule-setting')}}"
                    data-id="{{ $title->id }}">
                    <i class="fa fa-pencil"></i>
                    </a>
                    &nbsp;
                    <!-- <form action="{{route('delete-exam-setting', $title->id)}}"
                        method="DELETE"
                        onsubmit="return confirm('Are you sure you want to delete this exam?');">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form> -->
                </div>
            </td>

            </tr>
            @endforeach
            @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</div>
<!-- content-wrapper ends -->
@endsection