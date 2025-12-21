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
    {{-- Search Form --}}
<form action="{{ route('teachers-as-type') }}"
      method="GET"
      class="search-form mb-3">

  <div class="row align-items-end">

    <!-- Teacher Name -->
    <div class="col-md-2">
      <label class="small font-weight-bold">Teacher Name</label>
      <input type="text"
             name="teachers_name_english"
             class="form-control"
             placeholder="Search by teacher name"
             value="{{ request('teachers_name_english') }}">
    </div>

    <!-- Teacher Type -->
    <div class="col-md-2">
      <label class="small font-weight-bold">Teacher Type</label>
      <select name="type" class="form-control">
        <option value="">-- All --</option>
        <option value="Class Teacher"
          {{ request('type') == 'Class Teacher' ? 'selected' : '' }}>
          Class Teacher
        </option>
        <option value="Subject Teacher"
          {{ request('type') == 'Subject Teacher' ? 'selected' : '' }}>
          Subject Teacher
        </option>
      </select>
    </div>

    <!-- Teaching Grade -->
    <div class="col-md-2">
      <label class="small font-weight-bold">Teaching Grade</label>
      <select name="teaching_grade" class="form-control" id="grade">
        <option value="">-- All Grades --</option>
        @foreach($grades as $grade)
          <option value="{{ $grade->name }}"
            {{ request('teaching_grade') == $grade->id ? 'selected' : '' }}>
            {{ $grade->name }}
          </option>
        @endforeach
      </select>
    </div>
    <!-- section -->
    <div class="col-md-2">
      <label class="small font-weight-bold">Section</label>
      <select name="section"
        id="section"
          class="form-control">
        <option value="">-- Select Section --</option>
      </select>
    </div>

    <!-- Buttons -->
    <div class="col-md-3">
      <button type="submit" class="btn btn-danger btn-sm mt-1">
        <i class="fa fa-search"></i> Search
      </button>

      <a href="{{ route('teachers.type.print', request()->query()) }}"
        class="btn btn-primary btn-sm">
        <i class="fa fa-print"></i> Print
     </a>
    </div>

  </div>
</form>


      {{-- Search Info --}}
      @if(request('search'))
        <div class="alert alert-info mt-3">
          Showing results for:
          <strong>{{ request('search') }}</strong>
          ({{ count($data) }} found)
        </div>
      @endif

      <hr>

      {{-- Student Table --}}
      <div class="details">
        <table class="rtable">
          <thead>
            <tr>
              <th>S.N.</th>
              <th>Teacher Code</th>
              <th>Full Name</th>
              <th>teaching Grade</th>
              <th>section</th>
              <th>Type</th>
              <th>Address</th>
              <th>Contact</th>
              <th>Email </th>
              <th>Action</th>
            </tr>
          </thead>

          <tbody>
            @forelse($data as $student)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $student->unique_id }}</td>
                <td>{{ $student->teachers_name_eng }}</td>
                <td>{{ $student->teaching_grade }}</td>
                <td>{{ $student->section }}</td>
                <td>
                {{ $student->is_class_teacher == 1 
                    ? 'Class Teacher' 
                    : ($student->is_class_teacher == 2 ? 'Subject Teacher' : 'N/A') }}
                </td>

                <td>
                  {{ $student->teachers_province }} -
                  {{ $student->teachers_zone }},
                  {{ $student->teachers_localadd }}
                </td>
                <td>{{ $student->teachers_mobno }}</td>
                <td>{{ $student->teachers_email }}</td>
                <td>
                    <a class="btn btn-sm btn-primary btn-rounded"
                        href="mailto:{{ $student->parent_email }}?subject=Student Information&body=Dear Parent,%0D%0A%0D%0AThis is regarding your child {{ $student->name }}.%0D%0A%0D%0AThank you.">
                        <i class="fa fa-envelope"></i>
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
            {{ $data->links('vendor.pagination.prev-next') }}
        </div>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {

  // section ajax
  $('#grade').on('change', function () {
        let grade = $(this).val();
        let sectionSelect = $('#section');

        sectionSelect.html('<option value="">Loading...</option>');

        if (grade) {
            $.ajax({
                url: "{{ url('/get-sections') }}/" + grade,
                type: "GET",
                success: function (data) {
                    sectionSelect.empty();
                    sectionSelect.append('<option value="">-- Select Section --</option>');

                    $.each(data, function (key, value) {
                        sectionSelect.append(
                            '<option value="' + value + '">' + value + '</option>'
                        );
                    });
                }
            });
        } else {
            sectionSelect.html('<option value="">-- Select Section --</option>');
        }
    });
});
</script>
@endsection
