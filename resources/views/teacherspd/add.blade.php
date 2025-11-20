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
    <ul class="nav nav-tabs" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="personal-details" data-toggle="tab" href="#personal-details" role="tab"
          aria-controls="personal-details" aria-selected="true"><i class="fa fa-info-circle"></i> Personal Details</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="education-details" data-toggle="tab" href="#education-details" role="tab"
          aria-controls="education-details" aria-selected="true"><i class="fa fa-info-circle"></i> Educational Details</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="work-details" data-toggle="tab" href="#work-details" role="tab"
          aria-controls="work-details" aria-selected="true"><i class="fa fa-info-circle"></i> Work Details</a>
      </li>
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
          <div class="card-header" style="background-color:#041750;color:#fff">Personal Details</div>
          <div class="card-body">
            <form id="" action="{{ route('teachers-personal-data-save') }}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="row">
                <!-- <div class="col-md-2">
                  <div class="">
                    <h3>Grade</h3>
                  </div>
                </div> -->
                <!-- <div class="col-md-5">
                  <select name="school_id" class="form-control" required>
                    <option value="">--Select--</option>
                    @foreach($nameschool as $key => $sn)
                    <option value="{{ $sn->id }}">{{ $sn->school_name }}</option>
                    @endforeach
                  </select>
                </div> -->
                <div class="col-md-4">
                  <div class="form-group row">
                    <!-- <label class="col-form-label">शिक्षक अवस्था </label> -->
                    <div class="col-sm-4">
                      <div class="form-check">
                        <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="teacher_enroll_status" id="teacher_enroll_status" value="1" checked="">
                          Permanent
                        <i class="input-helper"></i></label>
                      </div>
                    </div>
                    <div class="col-sm-5">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="teacher_enroll_status" id="teacher_enroll_status1" value="2">
                          Temporary
                        <i class="input-helper"></i></label>
                      </div>
                    </div>
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
                  <input type="text" name="teachers_name_eng" class="form-control" placeholder="" required>
                </div>
                <div class="col-md-3 mb-4">
                  <label>Caste<i class="fa fa-asterisk" style="color: red;"></i></label>
                  <!-- <input type="text" name="teachers_caste" class="form-control" placeholder=""> -->
                  <select name="teachers_caste" class="form-control" required>
                    <option value="">--Select--</option>
                    @foreach($caste as $key => $c)
                    <option value="{{ $c->name }}">{{ $c->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-3 mb-4">
                  <label>Religion<i class="fa fa-asterisk" style="color: red;"></i> </label>
                  <!-- <input type="text" name="teachers_religion" class="form-control" placeholder=""> -->
                  <select name="teachers_religion" class="form-control" required>
                    <option value="">--Select--</option>
                    @foreach($religion as $key => $r)
                    <option value="{{ $r->name }}">{{ $r->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-3 mb-4">
                  <label>Gender <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <select name="teachers_gender" class="form-control" required>
                    <option value="">--Select--</option>
                    <option value="1">Male</option>
                    <option value="2">Female</option>
                    <option value="3">Other</option>
                  </select>
                </div>
                <div class="col-md-3 mb-4">
                  <label>Mobile No. <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="text" name="teachers_mobno" class="form-control" placeholder="" required>
                </div>
                <div class="col-md-3 mb-4">
                  <label>Email Address. <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="text" name="teachers_email" class="form-control" placeholder="" required>
                </div>
                <div class="col-md-3 mb-4">
                  <label>Place Of Birth <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="text" name="teachers_birth_place" class="form-control" placeholder="" required>
                </div>
                <div class="col-md-3 mb-4">
                  <label>DOB (BS)<i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="text" name="teachers_dob_bs" class="form-control" placeholder="" id="dob" required>
                </div>
                <div class="col-md-3 mb-4">
                  <label>DOB (AD) <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="text" name="teachers_dob_ad" class="form-control" placeholder="" id="englishdob" required>
                </div>
                <div class="col-md-3 mb-4">
                  <label>Marital Status <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <select name="teachers_marriage_satatus" class="form-control" required>
                    <option value="">--Select--</option>
                    <option value="1">Married</option>
                    <option value="2">Unmarried</option>
                  </select>
                </div>
                <!-- <div class="col-md-3 mb-4">
                  <label>विवाहको मिति </label>
                  <input type="text" name="teachers_marriage_date" class="form-control nepali_date" placeholder="">
                </div> -->
                <div class="col-md-3 mb-4">
                  <label>Citizenship No.<i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="text" name="teachers_citno" class="form-control" placeholder="" required>
                </div>
                <div class="col-md-3 mb-4">
                  <label>Cit Issue Date<i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="text" name="teachers_cit_jari_date" class="form-control nepali_date" placeholder="" required>
                </div>
                <div class="col-md-3 mb-4">
                  <label>Cit Issue District <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="text" name="teachers_cit_jari_district" class="form-control" placeholder="" required>
                </div>
                <div class="col-md-3 mb-4">
                  <label>Citizenship Copy <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="file" name="teachers_cit_upload" class="form-control" placeholder="" required>
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
                  <input type="text" name="teachers_province" class="form-control" placeholder="" required>
                </div>
                <div class="col-md-3">
                  <label>District <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="text" name="teachers_zone" class="form-control" placeholder="" required>
                </div>
                <div class="col-md-3">
                  <label>Municipality <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="text" name="teachers_localadd" class="form-control" placeholder="" required>
                </div>

                <div class="col-md-2">
                  <label>Ward<i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="text" name="teachers_ward" class="form-control" placeholder="" required>
                </div>
                <div class="col-md-2">
                  <label>Tol <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="text" name="teachers_tole" class="form-control" placeholder="" required>
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
                  <input type="text" name="teachers_gf_name" class="form-control" placeholder="" required>
                </div>
                <div class="col-md-3">
                  <label>Fathers Name<i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="text" name="teachers_f_name" class="form-control" placeholder="" required>
                </div>
                <div class="col-md-3">
                  <label>Mothers Name <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="text" name="teachers_m_name" class="form-control" placeholder="" required>
                </div>
                <div class="col-md-3">
                  <label>Spouse Name </label>
                  <input type="text" name="teachers_hw_name" class="form-control" placeholder="">
                </div>
                <div class="col-md-12 mt-3">
                  <hr>
                  <div class="card-title">
                    <div class="alert alert-fill-dark"><i class="fa fa-certificate"></i> License No.</div>
                  </div>
                  <hr>
                </div>
                <div class="col-md-3">
                  <label>License Grade <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <select name="teachers_teacher_licensestep" class="form-control" required>
                    <option value="">--Select--</option>
                    @foreach($level as $key => $l)
                    <option value="{{ $l->id }}">{{ $l->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-3">
                  <label>License Subject <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="text" name="teachers_teacher_license_sub" class="form-control" placeholder="" required>
                </div>

                <div class="col-md-3">
                  <label>License Issue Date <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="text" name="teachers_teacher_licenseno_jari_date" class="form-control nepali_date"
                    placeholder="" required>
                </div>
                <div class="col-md-3">
                  <label>License Copy <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="file" name="teachers_teacher_license_upload" class="form-control"
                    placeholder="" required>
                </div>
                <div class="col-md-12 mt-3">
                  <hr>
                  <div class="card-title">
                    <div class="alert alert-fill-dark"><i class="fa fa-certificate"></i> PAN Details</div>
                  </div>
                  <hr>
                </div>
                <div class="col-md-4">
                  <label>PAN No.<i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="text" name="teachers_panno" class="form-control" placeholder="" required>
                </div>
                <div class="col-md-4">
                  <label>License No.<i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="text" name="teachers_teacher_licenseno" class="form-control" placeholder="" required>
                </div>
                <div class="col-md-4">
                  <label>PAN Copy <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="file" name="teachers_pan_upload" class="form-control" placeholder="" required>
                </div>

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