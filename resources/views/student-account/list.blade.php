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

      {{-- Search Form --}}
      <form action="{{ route('students-fee-collection') }}"
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
                  <a class="btn btn-sm btn-warning btn-rounded"
                  title="View Student Details"
                    href="{{ route('student-fee-payment', $student->id) }}">
                    <i class="fa fa-money"> Pay</i>
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

