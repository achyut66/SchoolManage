@extends('layouts.master')

@section('content')

<div class="row">
  <div class="col-12">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb breadcrumb-custom">
        <li class="breadcrumb-item">
          <a href="{{ url('/dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
          <a href="{{ route('student-parent-list') }}">Students</a>
        </li>
        <li class="breadcrumb-item active">
          Education Details
        </li>
      </ol>
    </nav>
  </div>
</div>

<div class="row">
  <div class="col-12">

    {{-- Success message --}}
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Validation errors --}}
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    {{-- Tabs --}}
    <ul class="nav nav-tabs mb-3">
      <li class="nav-item">
        <a class="nav-link"
           href="{{ route('students.personal', $student->id) }}">
          Personal Details
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link active">
          Education Details
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link"
           href="{{ route('students.parents', $student->id) }}">
          Parent / Guardian Details
        </a>
      </li>
    </ul>

    <div class="card">
      <div class="card-header bg-dark text-white">
        Student Education Information
      </div>

      <div class="card-body">

        <form method="POST"
              action="{{ isset($education)
                ? route('students.education.update', $student->id)
                : route('students.education.store', $student->id) }}"
              enctype="multipart/form-data">

          @csrf
          @if(isset($education))
            @method('PUT')
          @endif


          {{-- Hidden student id --}}
          <input type="hidden" name="student_id" value="{{ $student->id }}">

          <div class="row">

            <div class="col-md-6 mb-3">
              <label>Previous School Name <span class="text-danger">*</span></label>
              <input type="text"
                     name="prev_school_name"
                     class="form-control"
                     value="{{ old('prev_school_name', $education->prev_school_name ?? '') }}"
                     required>
            </div>

            <div class="col-md-6 mb-3">
              <label>Previous School Address <span class="text-danger">*</span></label>
              <input type="text"
                     name="prev_school_address"
                     class="form-control"
                     value="{{ old('prev_school_address', $education->prev_school_address ?? '') }}"
                     required>
            </div>

            <div class="col-md-4 mb-3">
              <label>Grade Left <span class="text-danger">*</span></label>
              <input type="text"
                     name="prev_school_left_grade"
                     class="form-control"
                     value="{{ old('prev_school_left_grade', $education->prev_school_left_grade ?? '') }}"
                     required>
            </div>

            <div class="col-md-4 mb-3">
              <label>Obtained Percentage (%) <span class="text-danger">*</span></label>
              <input type="number"
                     step="0.01"
                     name="prev_school_obtained_percentage"
                     class="form-control"
                     value="{{ old('prev_school_obtained_percentage', $education->prev_school_obtained_percentage ?? '') }}"
                     required>
            </div>

            <div class="col-md-4 mb-3">
              <label>School Leaving Certificate</label>
              <input type="file"
                     name="prev_school_left_certificate"
                     class="form-control"
                     accept=".jpg,.jpeg,.png,.pdf">
            </div>

            @if(isset($education) && $education->prev_school_left_certificate)
              <div class="col-md-12 mb-3">
                <label>Uploaded Certificate</label><br>
                <a href="{{ asset('storage/'.$education->prev_school_left_certificate) }}"
                   target="_blank"
                   class="btn btn-sm btn-outline-primary">
                  View Certificate
                </a>
              </div>
            @endif

            <div class="col-md-12 mt-3">
              <button type="submit" class="btn btn-primary">
                {{ isset($education) ? 'Update Education Details' : 'Save Education Details' }}
              </button>
            </div>

          </div>
        </form>

      </div>
    </div>

  </div>
</div>

@endsection
