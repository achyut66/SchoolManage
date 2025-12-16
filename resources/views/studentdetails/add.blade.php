@extends('layouts.master')
@section('content')
<div class="row">
  <div class="col-12">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb breadcrumb-custom">
        <li class="breadcrumb-item"><a href="{{ URL :: to('/dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item" aria-current="page"><span><a
              href="{{ URL :: to('/teachers-personal-list') }}">Teachers Profile Details</span></li>
        <li class="breadcrumb-item active" aria-current="page"><span>Add New</span></li>
      </ol>
    </nav>
  </div>
</div>
<div class="row">
  <div class="col-12">
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
      <p>{{ $message }}</p>
    </div>
    @endif
    <ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link {{ request()->routeIs('student-parent-detail') ? 'active' : '' }}"
       href="{{ route('student-parent-detail') }}">
       Student's Personal Details
    </a>
  </li>

  @isset($student)
  <li class="nav-item">
    <a class="nav-link {{ request()->routeIs('students.education') ? 'active' : '' }}"
       href="{{ route('students.education', $student->id) }}">
       Student's Educational Details
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link {{ request()->routeIs('students.parents') ? 'active' : '' }}"
       href="{{ route('students.parents', $student->id) }}">
       Student's Parent Details
    </a>
  </li>
  @endisset
</ul>
    <div class="tab-content">

 @if (count($errors) > 0)
                      <div class="row">
                          <div class="col-md-12">
                              <div class="alert alert-danger alert-dismissible">
                                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                  @foreach($errors->all() as $error)
                                  {{ $error }} <br>
                                  @endforeach      
                              </div>
                          </div>
                      </div>
                    @endif
      <!-- Teacher personal details tabls -->
      <div class="tab-pane fade active show" id="personal-details" role="tabpanel" aria-labelledby="personal-details">
        <div class="card">
          <div class="card-header" style="background-color:#041750;color:#fff">Student's Personal Details</div>
          <div class="card-body">
            <form id="" action="{{ route('student-parent-data-save') }}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="row">
               
                <div class="col-md-12">
                <div class="col-md-6 mb-4">
                  <label>Grade (Studying Class) <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <select name="student_enrollment_class" class="form-control" required>
                    <option value="">--Select--</option>
                    @php $i = 1 @endphp
                    @foreach ($grade as $key => $grade)
                      <option value="{{ $grade->name }}" style="font-weight:bold;">{{$i++}}. &nbsp;&nbsp; {{ $grade->name }}</div></option>
                    @endforeach
                  </select>
                </div>
                </div>
                
                <div class="col-md-12">
                  <hr>
                </div>
                <div class="col-md-12 mt-3">
                  <div class="card-title">
                    <div class="alert alert-fill-dark"><i class="fa fa-info-circle"></i>Personal Details</div>
                  </div>
                  <hr>
                </div>
                <!-- <div class="col-md-3 mb-4">
                  <label>Full Name (देवनागरि लिपि) <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="text" name="teachers_name_nep" class="form-control" placeholder="" required>
                </div> -->
                <div class="col-md-3 mb-4">
                  <label>Full Name (English) <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="text" name="student_full_name" class="form-control" placeholder="" required>
                </div>
                <div class="col-md-3 mb-4">
                  <label>Caste<i class="fa fa-asterisk" style="color: red;"></i></label>
                  <!-- <input type="text" name="teachers_caste" class="form-control" placeholder=""> -->
                  <select name="s_caste" class="form-control" required>
                    <option value="">--Select--</option>
                    @foreach($caste as $key => $c)
                    <option value="{{ $c->name }}">{{ $c->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-3 mb-4">
                  <label>Religion<i class="fa fa-asterisk" style="color: red;"></i> </label>
                  <!-- <input type="text" name="teachers_religion" class="form-control" placeholder=""> -->
                  <select name="s_religion" class="form-control" required>
                    <option value="">--Select--</option>
                    @foreach($religion as $key => $r)
                    <option value="{{ $r->name }}">{{ $r->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-3 mb-4">
                  <label>Gender <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <select name="s_gender" class="form-control" required>
                    <option value="">--Select--</option>
                    <option value="1">Male</option>
                    <option value="2">Female</option>
                    <option value="3">Other</option>
                  </select>
                </div>
                <div class="col-md-3 mb-4">
                  <label>Mobile No. <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="text" name="student_contact" class="form-control" placeholder="" required>
                </div>
                <div class="col-md-3 mb-4">
                  <label>Email Address. <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="text" name="student_email" class="form-control" placeholder="" required>
                </div>
                <div class="col-md-3 mb-4">
                  <label>Place Of Birth <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="text" name="s_birthplace" class="form-control" placeholder="" required>
                </div>
                <div class="col-md-3 mb-4">
                  <label>DOB (BS)<i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="text" name="student_dob" class="form-control" placeholder="" id="dob" required>
                </div>
                <div class="col-md-3 mb-4">
                  <label>DOB (AD) <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="text" name="student_dob_ad" class="form-control" placeholder="" id="englishdob" required>
                </div>
               
                <div class="col-md-3 mb-4">
                  <label>BirthCertificate Copy <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="file" name="s_bccopy" class="form-control" placeholder="" required>
                </div>

                <div class="col-md-12 mt-3">
                  <hr>
                  <div class="card-title">
                    <div class="alert alert-fill-dark"><i class="fa fa-address-book"></i>Current Address</div>
                  </div>
                  <hr>
                </div>

                <div class="col-md-2">
                  <label>Province <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="text" name="s_province" class="form-control" placeholder="" required>
                </div>
                <div class="col-md-3">
                  <label>District <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="text" name="s_district" class="form-control" placeholder="" required>
                </div>
                <div class="col-md-3">
                  <label>Municipality <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="text" name="s_municipality" class="form-control" placeholder="" required>
                </div>

                <div class="col-md-2">
                  <label>Ward<i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="text" name="s_ward" class="form-control" placeholder="" required>
                </div>
                <div class="col-md-2">
                  <label>Tol <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="text" name="s_tol" class="form-control" placeholder="" required>
                </div>
                <div class="col-md-12 mt-3">
                  <hr>
                  <div class="card-title">
                    <div class="alert alert-fill-dark"><i class="fa fa-users"></i> Family Details</div>
                  </div>
                  <hr>
                </div>
                <div class="col-md-3">
                  <label>Grandfathers Name <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="text" name="s_gf_name" class="form-control" placeholder="" required>
                </div>
                <div class="col-md-3">
                  <label>Fathers Name<i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="text" name="student_fathers_name" class="form-control" placeholder="" required>
                </div>
                <div class="col-md-3">
                  <label>Mothers Name <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="text" name="student_mothers_name" class="form-control" placeholder="" required>
                </div>
                <!-- <div class="col-md-3">
                  <label>Spouse Name </label>
                  <input type="text" name="teachers_hw_name" class="form-control" placeholder="">
                </div> -->
               
                <div class="col-md-12">
                  <hr>
                  <button type="submit" class="btn btn-block btn-secondary">Submit</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="{{ asset('assets/nepali-date-picker/js/nepali.datepicker.v3.7.min.js') }}" type="text/javascript"></script>
<script>
$(document).ready(function() {
  /* Initialize Datepicker with options */
  $('#dob').nepaliDatePicker({
    ndpYear: true,
    ndpMonth: true,

    onChange: function() {

      $.ajax({
        url: "convert-date",
        data: {
          dob: $("#dob").val()
        },
        type: "GET",
        success: function(resp) {
          //console.log(resp);
          $('#englishdob').val(resp);
        },
        error: function() {
          console.log('Internal Server Error!');
        }
      });
    }
  });

  $('.nepali_date').nepaliDatePicker({
    ndpYear: true,
    ndpMonth: true,
  });
});
</script>
@endsection