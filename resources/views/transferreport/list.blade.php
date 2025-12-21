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
          <span>Student Migration Report</span>
        </li>
      </ol>
    </nav>

    <div class="card">

      {{-- SUCCESS MESSAGE --}}
      @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
      @endif

      {{-- ================= SEARCH FORM ================= --}}
      <form action="{{ route('get-student-data-migration') }}" method="GET" class="mb-3">
        <div class="row align-items-end">

          <div class="col-md-3">
            <label class="small mb-1">Student Name</label>
            <input type="text"
                   name="search"
                   class="form-control"
                   placeholder="Search student name"
                   value="{{ request('search') }}">
          </div>

          <div class="col-md-3">
            <label class="small mb-1">Grade</label>
            <select name="student_enrollment_class" class="form-control">
              <option value="">-- All Grades --</option>
              @foreach($grades as $grade)
                <option value="{{ $grade->name }}"
                  {{ request('student_enrollment_class') == $grade->name ? 'selected' : '' }}>
                  {{ $grade->name }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="col-md-2">
            <button type="submit" class="btn btn-danger btn-sm mt-4">
              <i class="fa fa-search"></i> Search
            </button>
          </div>

          {{-- PRINT BUTTON --}}
          <div class="col-md-2 text-end mt-4">
            <a href="{{ route('students.migration.print', request()->query()) }}"
               class="btn btn-primary btn-sm">
              <i class="fa fa-print"></i> Print
            </a>
          </div>

        </div>
      </form>
      {{-- ================= END SEARCH FORM ================= --}}

      {{-- TABLE --}}
      <div class="table-responsive">
        <table class="table table-bordered table-hover" style="font-size:12px;">

          <thead class="bg-light">
            <tr>
              <th>S.N.</th>
              <th>Student Code</th>
              <th>Academic Year</th>
              <th>Student Name</th>
              <th>Grade</th>
              <th>Section</th>
              <th>Address</th>
              <th>Email</th>
            </tr>
          </thead>

          <tbody>
            @forelse($students as $student)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $student->student->unique_id ?? '-' }}</td>
                <td>{{ $student->academic_year }}</td>
                <td>{{ $student->student_name }}</td>
                <td>{{ $student->grade }}</td>
                <td>{{ $student->section }}</td>
                <td>
                  {{ $student->student->s_province ?? '' }},
                  {{ $student->student->s_district ?? '' }},
                  {{ $student->student->s_municipality ?? '' }}
                </td>
                <td>{{ $student->student->student_email ?? '-' }}</td>
              </tr>
            @empty
              <tr>
                <td colspan="7" class="text-center text-danger">
                  No migration records found.
                </td>
              </tr>
            @endforelse
          </tbody>

        </table>
      </div>

      {{-- PAGINATION --}}
      <div class="d-flex justify-content-center mt-3">
        {{ $students->links('vendor.pagination.prev-next') }}
      </div>

    </div>
  </div>
</div>

@endsection
