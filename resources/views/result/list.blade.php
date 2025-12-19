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
          <span>Students Results</span>
        </li>
      </ol>
    </nav>

    <div class="card shadow-sm">

      {{-- SEARCH FILTER --}}
      <div class="card-body border-bottom">
        <form method="GET" action="{{ route('student-result-list') }}">
          <div class="row align-items-end">

            <div class="col-md-4">
              <label class="form-label">Student Name</label>
              <input type="text"
                     name="student_name"
                     class="form-control"
                     placeholder="Search by student name"
                     value="{{ request('student_name') }}">
            </div>

            <div class="col-md-2">
              <button type="submit" class="btn btn-primary w-100">
                <i class="fa fa-search"></i> Search
              </button>
            </div>

            <div class="col-md-2">
              <a href="{{ route('student-result-list') }}"
                 class="btn btn-secondary w-100">
                Reset
              </a>
            </div>

          </div>
        </form>
      </div>

      {{-- RESULT TABLE --}}
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-hover" style="font-size:13px;">
            <thead class="bg-light">
              <tr>
                <th width="40">S.N</th>
                <th>Student Name</th>
                <th>Grade</th>
                <th>Academic Year</th>
                <th>Total Marks</th>
                <th width="130">Action</th>
              </tr>
            </thead>

            <tbody>
              @forelse($results as $result)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $result->student_name }}</td>
                  <td>{{ $result->grade }}</td>
                  <td>{{ $result->academic_year }}</td>
                  <td>
                    <span class="badge badge-success">
                      {{ $result->total_marks }}
                    </span>
                  </td>
                  <td class="text-nowrap">

                    {{-- VIEW --}}
                    <a href=""
                       class="btn btn-sm btn-info"
                       title="View Result">
                      <i class="fa fa-eye"></i>
                    </a>

                    {{-- EDIT --}}
                    <a href="{{ route('student-result-edit', $result->student_id) }}"
                       class="btn btn-sm btn-warning"
                       title="Edit Result">
                      <i class="fa fa-edit"></i>
                    </a>

                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="6" class="text-center text-muted">
                    No result records found
                  </td>
                </tr>
              @endforelse
            </tbody>

          </table>
        </div>
      </div>

    </div>
  </div>
</div>

@endsection
