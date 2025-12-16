@extends('layouts.master')

@section('content')

<div class="row">
  <div class="col-lg-12">

    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb breadcrumb-custom">
        <li class="breadcrumb-item">
          <a href="{{ url('/dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">
          <span>Students Detail</span>
        </li>
      </ol>
    </nav>

    <div class="card">

      {{-- Success Message --}}
      @if ($message = Session::get('success'))
        <div class="alert alert-success">
          {{ $message }}
        </div>
      @endif

      {{-- Card Title --}}
      <div class="card-title mb-2">
        <a class="btn btn-sm btn-dark"
           href="{{ route('student-parent-detail') }}">
          <i class="fa fa-plus-circle"></i> Add new student
        </a>

        <!-- <a class="btn btn-sm btn-success"
           href="#frmadd"
           data-toggle="modal">
          <i class="fa fa-file-excel-o"></i> Import
        </a> -->
      </div>

      <hr>

      {{-- Search Form --}}
      <form action="{{ route('student-parent-list') }}"
            method="GET"
            class="search-form">

        <div class="row">
          <div class="col-md-3">
            <input type="text"
                   name="search"
                   class="form-control"
                   placeholder="Search by student name"
                   value="{{ request('search') }}">
          </div>

          <div class="col-md-2">
            <button type="submit"
                    class="btn btn-danger btn-sm mt-1">
              <i class="fa fa-search"></i> Search
            </button>
          </div>

          <div class="col-md-4">

          <a href="{{ route('students.print', ['search' => request('search')]) }}"
            class="btn btn-primary btn-sm mt-1">
            <i class="fa fa-print"></i> Print
          </a>

          <a href="{{ route('students.export', ['search' => request('search')]) }}"
            class="btn btn-warning btn-sm mt-1">
            <i class="fa fa-file-excel-o"></i> Excel
          </a>

          </div>
        </div>
      </form>

      {{-- Search Info --}}
      @if(request('search'))
        <div class="alert alert-info mt-3">
          Showing results for:
          <strong>{{ request('search') }}</strong>
          ({{ count($students) }} found)
        </div>
      @endif

      <hr>

      {{-- Student Table --}}
      <div class="details">
        <table class="rtable">
          <thead>
            <tr>
              <th>S.N.</th>
              <th>Full Name</th>
              <th>Grade</th>
              <th>Address</th>
              <th>Father's Name</th>
              <th>Birth Place</th>
              <th>Email</th>
              <th>Action</th>
            </tr>
          </thead>

          <tbody>
            @forelse($students as $student)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $student->student_full_name }}</td>
                <td>{{ $student->student_enrollment_class }}</td>
                <td>
                  {{ $student->s_province }} -
                  {{ $student->s_district }},
                  {{ $student->s_municipality }}
                </td>
                <td>{{ $student->student_fathers_name }}</td>
                <td>{{ $student->s_birthplace }}</td>
                <td>{{ $student->student_email }}</td>
                <td>
                  <a class="btn btn-sm btn-secondary btn-rounded"
                     href="{{ url('student-parent-detail-show', $student->id) }}">
                    <i class="fa fa-eye"></i>
                  </a>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="8" class="text-center text-danger">
                  No student records found.
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
        <hr style="border-top:2px solid brown">
        <div class="d-flex justify-content-center mt-3">
            {{ $students->links('vendor.pagination.prev-next') }}
        </div>


      </div>

    </div>
  </div>
</div>

@endsection
