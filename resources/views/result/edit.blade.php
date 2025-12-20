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
        <li class="breadcrumb-item">
          <a href="{{ route('student-result-list') }}">Students Results</a>
        </li>
        <li class="breadcrumb-item active">
          <span>Edit Result</span>
        </li>
      </ol>
    </nav>

    <div class="card shadow-sm">
      <div class="card-header bg-white">
        <h5 class="mb-0">Edit Student Result</h5>
      </div>

      <div class="card-body">

        {{-- STUDENT INFO --}}
        <div class="row mb-3">
          <div class="col-md-4">
            <strong>Student Name:</strong> {{ $student->student_name }}
          </div>
          <div class="col-md-4">
            <strong>Grade:</strong> {{ $student->grade }}
          </div>
          <div class="col-md-4">
            <strong>Academic Year:</strong> {{ $student->academic_year }}
          </div>
        </div>

        {{-- EDIT FORM --}}
        <form action="{{ route('student-result-update', $student->student_id) }}"
              method="POST">
          @csrf

          <div class="table-responsive">
            <table class="table table-bordered">
              <thead class="bg-light">
                <tr>
                  <th width="60">S.N</th>
                  <th>Subject</th>
                  <th width="150">Theoritical Marks</th>
                  <th width="150">Practical Marks</th>
                </tr>
              </thead>

              <tbody>
                @foreach($results as $index => $row)
                  <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                      {{ $row->subjects }}
                      <input type="hidden" name="subjects[]" value="{{ $row->subjects }}">
                      <input type="hidden" name="result_ids[]" value="{{ $row->id }}">
                    </td>
                    <td>
                      <input type="number"
                             name="obtained_marks[]"
                             class="form-control"
                             value="{{ $row->obtained_marks }}"
                             min="0"
                             required>
                    </td>
                    <td>
                      <input type="number"
                             name="practical_marks[]"
                             class="form-control"
                             value="{{ $row->practical_marks }}"
                             min="0"
                             >
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>

          {{-- ACTION BUTTONS --}}
          <div class="text-right mt-3">
            <a href="{{ route('student-result-list') }}"
               class="btn btn-secondary">
              Back
            </a>

            <button type="submit"
                    class="btn btn-primary">
              <i class="fa fa-save"></i> Update Result
            </button>
          </div>

        </form>

      </div>
    </div>

  </div>
</div>

@endsection
