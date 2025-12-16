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
          <a href="{{ url('/teachers-personal-list') }}">Students Profile Details</a>
        </li>
        <li class="breadcrumb-item active">Edit</li>
      </ol>
    </nav>
  </div>
</div>

<div class="row">
  <div class="col-12">

    {{-- Success --}}
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Tabs --}}
    <ul class="nav nav-tabs mb-3">
      <li class="nav-item">
        <a class="nav-link active">Student's Personal Details</a>
      </li>
      <li class="nav-item">
        <a class="nav-link"
           href="{{ route('students.education.edit', $student->id) }}">
          Student's Educational Details
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link"
           href="{{ route('students.parents', $student->id) }}">
          Student's Parent Details
        </a>
      </li>
    </ul>

    {{-- Errors --}}
    @if($errors->any())
      <div class="alert alert-danger">
        @foreach($errors->all() as $error)
          {{ $error }} <br>
        @endforeach
      </div>
    @endif

    <div class="card">
      <div class="card-header" style="background-color:#041750;color:#fff">
        Edit Student's Personal Details
      </div>

      <div class="card-body">
        <form method="POST"
              action="{{ route('student-parent-detail-update', $student->id) }}"
              enctype="multipart/form-data">

          @csrf

          <div class="row">

            {{-- Grade --}}
            <div class="col-md-6 mb-4">
              <label>Grade (Studying Class) *</label>
              <select name="student_enrollment_class" class="form-control" required>
                @foreach($grade as $g)
                  <option value="{{ $g->name }}"
                    {{ $student->student_enrollment_class == $g->name ? 'selected' : '' }}>
                    {{ $g->name }}
                  </option>
                @endforeach
              </select>
            </div>

            <div class="col-md-12"><hr></div>

            {{-- Personal Details --}}
            <div class="col-md-12 mt-3">
              <div class="alert alert-fill-dark">
                <i class="fa fa-info-circle"></i> Personal Details
              </div>
            </div>

            <div class="col-md-3 mb-4">
              <label>Full Name (English) *</label>
              <input type="text" name="student_full_name" class="form-control"
                     value="{{ old('student_full_name', $student->student_full_name) }}" required>
            </div>

            <div class="col-md-3 mb-4">
              <label>Caste *</label>
              <select name="s_caste" class="form-control" required>
                @foreach($caste as $c)
                  <option value="{{ $c->name }}"
                    {{ $student->s_caste == $c->name ? 'selected' : '' }}>
                    {{ $c->name }}
                  </option>
                @endforeach
              </select>
            </div>

            <div class="col-md-3 mb-4">
              <label>Religion *</label>
              <select name="s_religion" class="form-control" required>
                @foreach($religion as $r)
                  <option value="{{ $r->name }}"
                    {{ $student->s_religion == $r->name ? 'selected' : '' }}>
                    {{ $r->name }}
                  </option>
                @endforeach
              </select>
            </div>

            <div class="col-md-3 mb-4">
              <label>Gender *</label>
              <select name="s_gender" class="form-control" required>
                <option value="1" {{ $student->s_gender == 1 ? 'selected' : '' }}>Male</option>
                <option value="2" {{ $student->s_gender == 2 ? 'selected' : '' }}>Female</option>
                <option value="3" {{ $student->s_gender == 3 ? 'selected' : '' }}>Other</option>
              </select>
            </div>

            <div class="col-md-3 mb-4">
              <label>Mobile *</label>
              <input type="text" name="student_contact" class="form-control"
                     value="{{ $student->student_contact }}" required>
            </div>

            <div class="col-md-3 mb-4">
              <label>Email *</label>
              <input type="email" name="student_email" class="form-control"
                     value="{{ $student->student_email }}" required>
            </div>

            <div class="col-md-3 mb-4">
              <label>Place of Birth *</label>
              <input type="text" name="s_birthplace" class="form-control"
                     value="{{ $student->s_birthplace }}" required>
            </div>

            <div class="col-md-3 mb-4">
              <label>DOB (BS)</label>
              <input type="text" id="dob" name="student_dob"
                     class="form-control" value="{{ $student->student_dob }}">
            </div>

            <div class="col-md-3 mb-4">
              <label>DOB (AD)</label>
              <input type="text" id="englishdob" name="student_dob_ad"
                     class="form-control" value="{{ $student->student_dob_ad }}">
            </div>

            {{-- Address --}}
            <div class="col-md-12 mt-4">
              <hr>
              <div class="alert alert-fill-dark">
                <i class="fa fa-address-book"></i> Current Address
              </div>
            </div>

            <div class="col-md-2">
              <label>Province *</label>
              <input type="text" name="s_province" class="form-control"
                     value="{{ $student->s_province }}" required>
            </div>

            <div class="col-md-3">
              <label>District *</label>
              <input type="text" name="s_district" class="form-control"
                     value="{{ $student->s_district }}" required>
            </div>

            <div class="col-md-3">
              <label>Municipality *</label>
              <input type="text" name="s_municipality" class="form-control"
                     value="{{ $student->s_municipality }}" required>
            </div>

            <div class="col-md-2">
              <label>Ward *</label>
              <input type="text" name="s_ward" class="form-control"
                     value="{{ $student->s_ward }}" required>
            </div>

            <div class="col-md-2">
              <label>Tol *</label>
              <input type="text" name="s_tol" class="form-control"
                     value="{{ $student->s_tol }}" required>
            </div>

            {{-- Family --}}
            <div class="col-md-12 mt-4">
              <hr>
              <div class="alert alert-fill-dark">
                <i class="fa fa-users"></i> Family Details
              </div>
            </div>

            <div class="col-md-3">
              <label>Grandfather's Name *</label>
              <input type="text" name="s_gf_name" class="form-control"
                     value="{{ $student->s_gf_name }}" required>
            </div>

            <div class="col-md-3">
              <label>Father's Name *</label>
              <input type="text" name="student_fathers_name" class="form-control"
                     value="{{ $student->student_fathers_name }}" required>
            </div>

            <div class="col-md-3">
              <label>Mother's Name *</label>
              <input type="text" name="student_mothers_name" class="form-control"
                     value="{{ $student->student_mothers_name }}" required>
            </div>

            <div class="col-md-12 mt-4">
              <hr>
              <button type="submit" class="btn btn-secondary btn-block">
                Update Student Details
              </button>
            </div>

          </div>
        </form>
      </div>
    </div>

  </div>
</div>

<script src="{{ asset('assets/nepali-date-picker/js/nepali.datepicker.v3.7.min.js') }}"></script>
<script>
$('#dob').nepaliDatePicker({
  ndpYear:true,
  ndpMonth:true,
  onChange:function(){
    $.get("{{ url('convert-date') }}",{dob:$('#dob').val()},function(resp){
      $('#englishdob').val(resp);
    });
  }
});
</script>

@endsection
