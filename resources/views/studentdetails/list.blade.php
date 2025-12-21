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

        <div class="row align-items-end">

          <!-- Search by Name -->
          <div class="col-md-2">
            <label class="small mb-1">Student Name</label>
            <input type="text"
                  name="search"
                  class="form-control"
                  placeholder="Search by student name"
                  value="{{ request('search') }}">
          </div>

          <!-- Search by Grade -->
          <div class="col-md-2">
            <label class="small mb-1">Grade</label>
            <select name="student_enrollment_class"
                    class="form-control">
              <option value="">-- All Grades --</option>

              @foreach($grades as $grade)
                <option value="{{ $grade->name }}"
                  {{ request('student_enrollment_class') == $grade->name ? 'selected' : '' }}>
                  {{ $grade->name }}
                </option>
              @endforeach
            </select>
          </div>

          <!-- Search by Section -->
          <div class="col-md-2">
            <label class="small mb-1">Section</label>
            <select name="student_enrollment_section" class="form-control">
              <option value="">-- All Sections --</option>

              @foreach($sections as $section)
                <option value="{{ $section }}"
                  {{ request('student_enrollment_section') == $section ? 'selected' : '' }}>
                  {{ $section }}
                </option>
              @endforeach
            </select>
          </div>

          <!-- Search Button -->
          <div class="col-md-2">
            <button type="submit"
                    class="btn btn-danger btn-sm">
              <i class="fa fa-search"></i> Search
            </button>
          </div>

          <!-- Print & Export -->
          <div class="col-md-4 text-right">
            <a href="{{ route('students.print', request()->query()) }}"
              class="btn btn-primary btn-sm">
              <i class="fa fa-print"></i> Print
            </a>

            <a href="{{ route('students.export', request()->query()) }}"
              class="btn btn-warning btn-sm">
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
              <th>Student Code</th>
              <th>Academic Year</th>
              <th>Full Name</th>
              <th>Grade</th>
              <th>Section</th>
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
                <td>{{ $student->unique_id }}</td>
                <td>{{ $student->academic_year }}</td>
                <td>{{ $student->student_full_name }}</td>
                <td>{{ $student->student_enrollment_class }}</td>
                <td>{{ $student->student_enrollment_section }}</td>
                <td>
                  {{ $student->s_province }} -
                  {{ $student->s_district }},
                  {{ $student->s_municipality }}
                </td>
                <td>{{ $student->student_fathers_name }}</td>
                <td>{{ $student->s_birthplace }}</td>
                <td>{{ $student->student_email }}</td>
                <td class="text-nowrap">
                  <a class="btn btn-sm btn-secondary btn-rounded"
                  title="View Student Details"
                    href="{{ url('student-parent-detail-show', $student->id) }}">
                    <i class="fa fa-eye"></i>
                  </a>
                  <!-- <a class="btn btn-sm btn-primary btn-rounded"
                    href="{{ url('student-data/student-result-dash', $student->id) }}">
                    <i class="fa fa-file"></i>
                  </a> -->
                  <a class="btn btn-sm btn-success btn-rounded
                    {{ in_array($student->id, $resultStudentIds) ? 'disabled' : '' }}"
                    href="{{ in_array($student->id, $resultStudentIds)
                              ? 'javascript:void(0)'
                              : url('student-data/student-result-dash', $student->id) }}"
                    title="{{ in_array($student->id, $resultStudentIds)
                              ? 'Result already exists'
                              : 'Add Result' }}"
                  >
                      <i class="fa fa-graduation-cap"></i>
                  </a>


                  <form action="{{ route('disable-student-admission', $student->id) }}"
                        method="POST"
                        onsubmit="return confirm('Are you sure you want to dismiss the student admission?');"
                        style="display:inline-block;">
                      @csrf
                      <button type="submit" class="btn btn-sm btn-danger btn-rounded" title="Remove Student Details">
                          <i class="fa fa-close"></i>
                      </button>
                  </form>
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

