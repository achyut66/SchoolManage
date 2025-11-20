@extends('layouts.master')
@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb breadcrumb-custom">
    <li class="breadcrumb-item"><a href="{{ URL :: to('/dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page"><span>Teacher's Personal Details</span></span></li>
  </ol>
</nav>
<div class="row">
  <div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">
        @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif

        <form id="example-form" action="{{ route('teachers-personal-detail-update' ,$row_data->id) }}" method="post" enctype="multipart/form-data">
          @csrf
          <input type="hidden" value="{{ route('convert-date')}}" id="url">
          <div class="col-12">
            <div class="row">
              <!-- <div class="col-md-3">
                <div class="text-center">
                  <h3 style="margin-top:10px;">विद्यालय छान्नुहोस्</h3>
                </div>
              </div> -->
              <!-- <div class="col-md-5">
                <select name="school_id" class="form-control">
                  <option value="0">--छान्नुहोस्--</option>
                  @foreach($schools as $key => $sn)
                  <option value="{{ $sn->id }}" {{$row_data->school_id == $sn->id  ? 'selected' : ''}}>
                    {{ $sn->school_name }}</option>
                  @endforeach
                </select>
              </div> -->
                <div class="col-md-4">
                  <div class="form-group row">
                    <!-- <label class="col-form-label">शिक्षक अवस्था </label> -->
                    <div class="col-sm-4">
                      <div class="form-check">
                        <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="teacher_enroll_status" id="teacher_enroll_status" value="1" {{$row_data->teacher_enroll_status == 1?'checked':''}}>
                          Permanent
                        <i class="input-helper"></i></label>
                      </div>
                    </div>
                    <div class="col-sm-5">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="teacher_enroll_status" id="teacher_enroll_status1" value="2" {{$row_data->teacher_enroll_status == 2?'checked':''}}>
                          Temporary
                        <i class="input-helper"></i></label>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
          </div>
          <hr>
          <div class="card-title">
            <div class="alert alert-fill-dark"><i class="fa fa-info-circle"></i>Teacher's Personal Details</div>
          </div>
          <div class="form-group">
            <div class="col-md-12">
              <div class="row">
                <!-- <div class="col-md-3">
                  <label>नाम थर (देवनागरि लिपि) <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="text" name="teachers_name_nep" class="form-control" placeholder="Nepali Name"
                    value="{{ $row_data->teachers_name_nep }}">
                </div> -->
                <div class="col-md-4">
                  <label>Full Name (English) <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="text" name="teachers_name_eng" class="form-control" placeholder="English Name"
                    value="{{ $row_data->teachers_name_eng }}">
                </div>
                <div class="col-md-4">
                  <label>Caste </label>
                  <select name="teachers_caste" class="form-control">
                    <option value="">--Select--</option>
                    @foreach($caste as $key => $c)
                    <option value="{{ $c->name }}" {{ $row_data->teachers_caste == $c->name ? 'selected':'' }}>
                      {{ $c->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-4">
                  <label>Religion </label>
                  <select name="teachers_religion" class="form-control">
                    <option value="">--Select--</option>
                    @foreach($religion as $key => $r)
                    <option value="{{ $r->name }}" {{ $row_data->teachers_religion == $r->name?'selected':''}}>
                      {{ $r->name }}
                    </option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
          <!-- <hr> -->
          <div class="form-group">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-3">
                  <label>Gender <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <select name="teachers_gender" class="form-control">
                    <option value="">--Select--</option>
                    <option value="1" {{ $row_data->teachers_gender === '1'  ? 'selected':''}}>Male</option>
                    <option value="2" {{ $row_data->teachers_gender === '2' ? 'selected':''}}>Felame</option>
                    <option value="3" {{ $row_data->teachers_gender === '3'? 'selected':''}}>Other</option>
                  </select>
                </div>
                <div class="col-md-3">
                  <label>Mobile No. <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="text" name="teachers_mobno" class="form-control" placeholder="Mobile No"
                    value="{{ $row_data->teachers_mobno }}">
                </div>
                <div class="col-md-3">
                  <label>Email Address <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="text" name="teachers_email" class="form-control" placeholder="Enter email"
                    value="{{ $row_data->teachers_email }}">
                </div>
                <div class="col-md-3">
                  <label>Place of Birth <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="text" name="teachers_birth_place" class="form-control" placeholder="Place of Birth"
                    value="{{ $row_data->teachers_birth_place }}">
                </div>
              </div>
            </div>
          </div>
          <!-- <hr> -->
          <div class="form-group">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-3">
                  <label>DOB (BS)<i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="text" name="teachers_dob_bs" class="form-control" placeholder=""
                    value="{{ $row_data->teachers_dob_bs }}" id="dob">
                </div>
                <div class="col-md-3">
                  <label>DOB (AD) <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="text" name="teachers_dob_ad" class="form-control" placeholder=""
                    value="{{ $row_data->teachers_dob_ad }}" id="englishdob">
                </div>

                <div class="col-md-3">
                  <label>Marital Status <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <select name="teachers_marriage_satatus" class="form-control">
                    <option value="">--Select--</option>
                    <option value="1" {{ $row_data->teachers_marriage_satatus === '1'?'selected':''}}>Married</option>
                    <option value="2" {{ $row_data->teachers_marriage_satatus === '2'?'selected':''}}>Unmarried</option>
                  </select>
                </div>
                <div class="col-md-3">
                  <label>Marriage Date <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="text" name="teachers_marriage_date" class="form-control nepali_date" placeholder="Marriage Date"
                    value="{{ $row_data->teachers_marriage_date }}">
                </div>
              </div>
            </div>
          </div>
          <!-- <hr> -->
          <div class="form-group">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-3">
                  <label>Citizenship No <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="text" name="teachers_citno" class="form-control" placeholder="Citizen No"
                    value="{{ $row_data->teachers_citno }}">
                </div>
                <div class="col-md-3">
                  <label>Cit Issue Date <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="text" name="teachers_cit_jari_date" class="form-control nepali_date" placeholder="Citizen Date"
                    value="{{ $row_data->teachers_cit_jari_date }}">
                </div>
                <div class="col-md-3">
                  <label>Cit Issue District <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="text" name="teachers_cit_jari_district" class="form-control"
                    placeholder="Citizen District" value="{{ $row_data->teachers_cit_jari_district }}">
                </div>
                <div class="col-md-3">
                  <label>Cit Copy <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="file" name="teachers_cit_upload" class="form-control" placeholder="Citizen Upload"
                    value="{{ $row_data->teachers_cit_upload }}">
                </div>
              </div>
            </div>
          </div>
          <hr>
          <div class="form-group">
            <div class="col-md-12">
              <div class="card-title">
                <div class="alert alert-fill-dark"><i class="fa fa-address-book"></i>Address</div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-2">
                  <label>Province <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="text" name="teachers_province" class="form-control" placeholder="Province"
                    value="{{ $row_data->teachers_province }}">
                </div>
                <div class="col-md-2">
                  <label>District <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="text" name="teachers_zone" class="form-control" placeholder="District"
                    value="{{ $row_data->teachers_zone }}">
                </div>
                <div class="col-md-4">
                  <label>Municipality <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="text" name="teachers_localadd" class="form-control" placeholder="Local Goverment Name"
                    value="{{ $row_data->teachers_localadd }}">
                </div>
                <div class="col-md-2">
                  <label>Ward No. <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="text" name="teachers_ward" class="form-control" placeholder="Ward No"
                    value="{{ $row_data->teachers_ward }}">
                </div>
                <div class="col-md-2">
                  <label>Tol <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="text" name="teachers_tole" class="form-control" placeholder="Village"
                    value="{{ $row_data->teachers_tole }}">
                </div>
              </div>
            </div>
          </div>
          <hr>
          <div class="form-group">
            <div class="col-md-12">
              <div class="card-title">
                <div class="alert alert-fill-dark"><i class="fa fa-users"></i>Family Details</div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-3">
                  <label>Grandfather's Name <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="text" name="teachers_gf_name" class="form-control" placeholder="Enter email"
                    value="{{ $row_data->teachers_gf_name }}">
                </div>
                <div class="col-md-3">
                  <label>Father's Name <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="text" name="teachers_f_name" class="form-control" placeholder="Enter email"
                    value="{{ $row_data->teachers_f_name }}">
                </div>
                <div class="col-md-3">
                  <label>Mother's Name <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="text" name="teachers_m_name" class="form-control" placeholder="Enter email"
                    value="{{ $row_data->teachers_m_name }}">
                </div>
                <div class="col-md-3">
                  <label>Spouse Name <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="text" name="teachers_hw_name" class="form-control" placeholder="Husband / Wife Name"
                    value="{{ $row_data->teachers_hw_name }}">
                </div>
              </div>
            </div>
          </div>
          <hr>
          <div class="form-group">
            <div class="col-md-12">
              <div class="card-title">
                <div class="alert alert-fill-dark"><i class="fa fa-certificate"></i>License Details</div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-3">
                  <label>License Grade <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <select name="teachers_teacher_licensestep" class="form-control">
                    <option value="">--Select--</option>
                    @foreach($level as $key => $l)
                    <option value="{{ $l->id }}" {{ $row_data->teachers_teacher_licensestep == $l->id?'selected':''}}>
                      {{ $l->name }}
                    </option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-3">
                  <label>License No. <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="text" name="teachers_teacher_licenseno" class="form-control" placeholder="License No"
                    value="{{ $row_data->teachers_teacher_licenseno }}">
                </div>
                <div class="col-md-3">
                  <label>Subject <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="text" name="teachers_teacher_license_sub" class="form-control"
                    placeholder="License Subject" value="{{ $row_data->teachers_teacher_license_sub }}">
                </div>
                <div class="col-md-3">
                  <label>License Issue Date <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="text" name="teachers_teacher_licenseno_jari_date" class="form-control"
                    placeholder="License Date" value="{{ $row_data->teachers_teacher_licenseno_jari_date }}">
                </div>
                <div></div>
                <div class="col-md-3">
                  <label>License Copy <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="file" name="teachers_teacher_license_upload" class="form-control"
                    placeholder="Upload License" value="{{ $row_data->teachers_teacher_license_upload }}">
                </div>
              </div>
            </div>
          </div>
          <hr>
          <div class="form-group">
            <div class="col-md-12">
              <div class="card-title">
                <div class="alert alert-fill-dark"><i class="fa fa-certificate"></i>PAN Details</div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-3">
                  <label>PAN No.<i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="text" name="teachers_panno" class="form-control" placeholder="Pan No"
                    value="{{ $row_data->teachers_panno }}">
                </div>
                
                <div class="col-md-3">
                  <label>PAN Copy <i class="fa fa-asterisk" style="color: red;"></i></label>
                  <input type="file" name="teachers_pan_upload" class="form-control" placeholder="Pan Upload"
                    value="{{ $row_data->teachers_pan_upload }}">
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <hr>
            <button type="submit" class="btn btn-block btn-secondary">Submit</button>
          </div>
        </form>
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
      var vurl = $('#url').val();
      // alert(url);
      $.ajax({
        type: 'GET',
        url: '{{route('convert-date')}}', //this is only changes
        datatype: 'json',
        data: {
          dob: $("#dob").val()
        },
        success: function(resp) {
         $('#englishdob').val(resp);
        },
        error: function() {
          //console.log('AJAX load did not work');
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