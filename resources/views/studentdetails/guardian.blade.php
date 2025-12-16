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
          Parent / Guardian Details
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
        <a class="nav-link"
           href="{{ route('students.education', $student->id) }}">
          Education Details
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link active">
          Parent / Guardian Details
        </a>
      </li>
    </ul>

    <div class="card">
      <div class="card-header bg-dark text-white">
        Parent / Guardian Information
      </div>

      <div class="card-body">

        <form method="POST"
          action="{{ isset($guardian)
              ? route('students.parents.update', $student->id)
              : route('students.parents.store', $student->id) }}">

          @csrf
          @if(isset($guardian))
            @method('PUT')
          @endif

          {{-- Hidden student id --}}
          <input type="hidden" name="student_id" value="{{ $student->id }}">

          <div class="row">

            <div class="col-md-6 mb-3">
              <label>Parent / Guardian Name <span class="text-danger">*</span></label>
              <input type="text"
                     name="parent_name"
                     class="form-control"
                     value="{{ old('parent_name', $guardian->parent_name ?? '') }}"
                     required>
            </div>

            <div class="col-md-6 mb-3">
              <label>Relation to Student <span class="text-danger">*</span></label>
              <select name="relation_to_student"
                      class="form-control"
                      required>
                <option value="">-- Select --</option>
                @foreach(['Father','Mother','Guardian','Uncle','Aunt','Other'] as $relation)
                  <option value="{{ $relation }}"
                    {{ old('relation_to_student', $guardian->relation_to_student ?? '') == $relation ? 'selected' : '' }}>
                    {{ $relation }}
                  </option>
                @endforeach
              </select>
            </div>

            <div class="col-md-6 mb-3">
              <label>Contact Number <span class="text-danger">*</span></label>
              <input type="text"
                     name="contact_no"
                     class="form-control"
                     value="{{ old('contact_no', $guardian->contact_no ?? '') }}"
                     required>
            </div>

            <div class="col-md-6 mb-3">
              <label>Emergency Contact</label>
              <input type="text"
                     name="emergency_contact"
                     class="form-control"
                     value="{{ old('emergency_contact', $guardian->emergency_contact ?? '') }}">
            </div>

            <div class="col-md-12 mb-3">
              <label>Address <span class="text-danger">*</span></label>
              <textarea name="address"
                        class="form-control"
                        rows="2"
                        required>{{ old('address', $guardian->address ?? '') }}</textarea>
            </div>

            <div class="col-md-6 mb-3">
              <label>Occupation</label>
              <input type="text"
                     name="occupation"
                     class="form-control"
                     value="{{ old('occupation', $guardian->occupation ?? '') }}">
            </div>

            <div class="col-md-6 mb-3">
              <label>Medical Conditions (if any)</label>
              <input type="text"
                     name="medical_condition"
                     class="form-control"
                     value="{{ old('medical_condition', $guardian->medical_condition ?? '') }}">
            </div>

            <div class="col-md-12 mt-3">
              <button type="submit" class="btn btn-primary">
                {{ isset($guardian) ? 'Update Guardian Details' : 'Save Guardian Details' }}
              </button>
            </div>

          </div>
        </form>

      </div>
    </div>

  </div>
</div>

@endsection
