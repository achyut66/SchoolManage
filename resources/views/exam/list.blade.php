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

      @if (session('error'))
          <script>
              alert("{{ session('error') }}");
          </script>
      @endif

      {{-- Search Form --}}
      <form action="{{ route('students-result-dashboard') }}"
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
                <td class="text-nowrap">
                  
                  <a class="btn btn-sm btn-success btn-rounded openResultModal"
                    href="javascript:void(0)"
                    data-url="{{ url('student-data/student-result-dash', $student->id) }}"
                    data-id="{{$student->id}}"
                    data-academic-year="{{$student->academic_year}}"
                  >
                      <i class="fa fa-graduation-cap"></i>
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
<!-- modal open before input marks -->
<form id="examResultForm" method="POST" action="{{ route('save-exam-type-result') }}">
    @csrf

    <div class="modal fade" id="resultConfirmModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Select Exam Type</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="student_id" id="student_id">
                    <input type="hidden" name="academic_year" id="academic_year">

                    <select class="form-control" name="exam_type_id" required>
                        <option value="">--select--</option>
                        @foreach ($exam as $ex)
                            <option value="{{ $ex->exam_id }}">
                                {{ $ex->exam->exam_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Cancel
                    </button>

                    <!-- IMPORTANT: button type="submit" -->
                    <button type="submit" class="btn btn-success">
                        Yes, Continue
                    </button>
                </div>

            </div>
        </div>
    </div>
</form>


<script>
$(document).on('click', '.openResultModal:not(.disabled)', function () {
    // let url = $(this).data('url');
    let id = $(this).data('id');
    let academic_year = $(this).data('academic-year');
    // console.log(id);
    $('#student_id').val(id);
    $('#academic_year').val(academic_year);
    // $('#examResultForm').attr('href', url);
    $('#resultConfirmModal').modal('show');
});
</script>


@endsection

