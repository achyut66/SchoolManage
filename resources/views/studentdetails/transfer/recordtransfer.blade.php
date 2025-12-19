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

      {{-- SEARCH FORM --}}
      <form action="{{ route('students-record-transfer') }}" method="GET" class="search-form mb-3">
        <div class="row align-items-end">

          <div class="col-md-3">
            <label class="small mb-1">Student Name</label>
            <input type="text"
                   name="search"
                   class="form-control"
                   placeholder="Search by student name"
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

        </div>
      </form>

      {{-- STUDENT TABLE --}}
      <div class="table-responsive">
        <table class="table table-hover table-bordered" style="font-size:12px;">

          <thead class="bg-light">
            <tr>
              <th>S.N.</th>
              <th>Student Code</th>
              <th>Academic Year</th>
              <th>Full Name</th>
              <th>Grade</th>
              <th>Address</th>
              <th>Father</th>
              <th>Email</th>
              <th width="120">Action</th>
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
                <td>
                  {{ $student->s_province }},
                  {{ $student->s_district }},
                  {{ $student->s_municipality }}
                </td>
                <td>{{ $student->student_fathers_name }}</td>
                <td>{{ $student->student_email }}</td>
                <td class="text-nowrap">

                  <a href="{{ url('student-parent-detail-show', $student->id) }}"
                     class="btn btn-sm btn-secondary">
                    <i class="fa fa-eye"></i>
                  </a>

                  {{-- TRANSFER BUTTON --}}
                  <a href="javascript:void(0)"
                    class="btn btn-sm btn-warning"
                    data-toggle="modal"
                    data-target="#transferModal"
                    data-student-id="{{ $student->id }}"
                    data-student-name="{{ $student->student_full_name }}">
                    <i class="fa fa-exchange"></i>
                  </a>

                </td>
              </tr>
            @empty
              <tr>
                <td colspan="9" class="text-center text-danger">
                  No student records found.
                </td>
              </tr>
            @endforelse
          </tbody>

        </table>
      </div>

      <div class="d-flex justify-content-center mt-3">
        {{ $students->links('vendor.pagination.prev-next') }}
      </div>

    </div>
  </div>
</div>

{{-- TRANSFER MODAL --}}
<div class="modal fade" id="transferModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-md modal-dialog-centered" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Transfer Student</h5>
        <button type="button" class="close" data-dismiss="modal">
          <span>&times;</span>
        </button>
      </div>

      <form method="POST" action="{{ route('student-data-migration') }}">
        @csrf
        <div class="modal-body">
          <input type="hidden" name="student_id" id="student_id">
          <div class="form-group">
            <label>Student Name</label>
            <input type="text" id="student_name" name="student_name" class="form-control" readonly>
          </div>
          <div class="form-group">
            <label>Transfer To Grade</label>
            <select name="grade" class="form-control" required>
              <option value="">-- Select Grade --</option>
              @foreach($grades as $grade)
                <option value="{{ $grade->name }}">{{ $grade->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label>Academic Year</label>
            <input type="text"
                   name="academic_year"
                   class="form-control"
                   placeholder="2081-2082"
                   required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button"
                  class="btn btn-secondary btn-sm"
                  data-dismiss="modal">
            Cancel
          </button>
          <button type="submit"
                  class="btn btn-warning btn-sm">
            Transfer
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
{{-- REQUIRED SCRIPTS --}}
@section('scripts')
<script>
$(document).ready(function () {
    $('#transferModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var studentId   = button.data('student-id');
        var studentName = button.data('student-name');
        $('#student_id').val(studentId);
        $('#student_name').val(studentName);
    });
});
</script>
@endsection

