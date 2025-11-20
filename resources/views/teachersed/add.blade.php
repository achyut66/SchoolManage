@extends('layouts.master')
@section('content')
<div class="row">
  <div class="col-12">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb breadcrumb-custom">
        <li class="breadcrumb-item"><a href="{{ URL :: to('/dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page"><span><a
              href="{{ URL :: to('/teachers-personal-detail') }}">Teachers Education Details</span></li>
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
        <a class="nav-link" id="personal-details"><i class="fa fa-info-circle"></i> Teachers Personal Details</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" id="education-details"><i class="fa fa-info-circle"></i> Teachers Educational Details</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="work-details"><i class="fa fa-info-circle"></i> Teachers Work Details</a>
      </li>
    </ul>
    <div class="card">
      <div class="card-header" style="background-color:#041750;color:#fff">Educational Details</div>
      <div class="card-body">

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

        <form id="example-form" action="{{ route('teachers-education-detail-save') }}" method="post"
          enctype="multipart/form-data">
          @csrf
          <div class="row">
            <input type="hidden" name="teachers_id" value="{{ $profile->id }}">
            <div class="col-md-12">
              <!-- slc -->
              <table class="table rtable">
                <thead>
                <tr>
                  <th colspan="5" style="padding:10px;"><b>1. SLC/SEE Details</b></th>
                </tr>
                </thead>
                <tbody>
                  <tr>
                    <td colspan="5" style="padding:10px;">
                          <label>School Name <i class="fa fa-asterisk" style="color: red;"></i></label>
                          <input type="text" name="slc_school_name" class="form-control" placeholder="School Name" required>
                      
                    </td>
                  </tr>
                  <tr>
                    <td>
                        <label>Passed Year <i class="fa fa-asterisk" style="color: red;"></i></label>  
                        <input type="text" name="slc_passed_year" class="form-control nepali_date" placeholder="Passed Year" required>
                    </td>
                    
                    <td>
                        <label>Percent(%)<i class="fa fa-asterisk" style="color: red;"></i> </label>
                        <input type="text" name="slc_percent" class="form-control" placeholder="Percentage" required>
                    </td>
                    <td>
                        <label>CGPA <i class="fa fa-asterisk" style="color: red;"></i></label>
                        <input type="text" name="slc_pass_marks" class="form-control" placeholder="Marks" required>
                    </td>
                    
                    <td>
                      <label>Certificate <i class="fa fa-asterisk" style="color: red;"></i></label>
                      <input type="file" name="slc_certificate_upload" class="form-control" required>
                    </td>
                    <td>
                      <label> Marksheet <i class="fa fa-asterisk" style="color: red;"></i></label>
                      <input type="file" name="slc_marksheet_upload" class="form-control" placeholder="" required>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="5">
                       <label>Major Subject</label>
                        <textarea name="slc_major_subject" class="form-control" placeholder="Please enter comma seperated subject name" rows="1"></textarea>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
              <!-- plus 2 -->
            <div class="col-md-12">
              <table class="table rtable">
                <thead>
                <tr>
                  <th colspan="5" style="padding:10px;"><b>2. Plus Two Details</b></th>
                </tr>
                </thead>
                <tbody>
                  <tr>
                    <td colspan="1" style="padding:10px;">
                      <label>School Name <i class="fa fa-asterisk" style="color: red;"></i></label>
                      <input type="text" name="plustwo_school_name" class="form-control" placeholder="School Name">
                    </td>
                    <td colspan="" style="padding:10px;">
                      <label>School Address <i class="fa fa-asterisk" style="color: red;"></i></label>
                      <input type="text" name="plustwo_school_address" class="form-control" placeholder="Address">
                    </td>
                    <td> <label>Faculty <i class="fa fa-asterisk" style="color: red;"></i></label>
                    <input type="text" name="plustwo_faculty" class="form-control" placeholder="Faculty"></td>
                  </tr>
                  <tr>
                    <td>
                        <label>Passed Year <i class="fa fa-asterisk" style="color: red;"></i></label>
                    <input type="text" name="plustwo_passed_year" class="form-control nepali_date">
                    </td>
                    
                    <td>
                        <label>Percent(%)<i class="fa fa-asterisk" style="color: red;"></i> </label>
                    <input type="text" name="plustwo_percentage" class="form-control" placeholder="Percent">
                    </td>
                    <td>
                        <label>CGPA <i class="fa fa-asterisk" style="color: red;"></i></label>
                    <input type="text" name="plustwo_pass_marks" class="form-control" placeholder="Marks">
                    </td>
                    
                  </tr>
                  <tr>
                    <td>
                      <label>Certificate <i class="fa fa-asterisk" style="color: red;"></i></label>
                    <input type="file" name="plustwo_certificate_upload" class="form-control">
                    <td>
                      <label>Marksheet <i class="fa fa-asterisk" style="color: red;"></i></label>
                    <input type="file" name="plustwo_marksheet_upload" class="form-control">
                    </td>
                    <td>
                      <label> Transcript <i class="fa fa-asterisk" style="color: red;"></i></label>
                    <input type="file" name="plustwo_transcript_upload" class="form-control">
                    </td>
                  </tr>
                  <tr>
                    <td colspan ="3">
                       <label>Major Subject</label>
                        <!-- <input type="text" name="slc_major_subject" class="form-control" placeholder="Subject" required> -->
                        <textarea name="slc_major_subject" class="form-control" placeholder="Please enter comma seperated subject name" rows="2"></textarea>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- bachelors -->
            <div class="col-md-12">
              <table class="table rtable">
                <thead>
                <tr>
                  <th colspan="5" style="padding:10px;"><b>3. Bachelor's Details</b></th>
                </tr>
                </thead>
                <tbody>
                  <tr>
                    <td colspan="1" style="padding:10px;">
                      <label>School Name <i class="fa fa-asterisk" style="color: red;"></i></label>
                      <input type="text" name="bachelor_school_name" class="form-control" placeholder="School Name">
                    </td>
                    <td colspan="" style="padding:10px;">
                      <label>School Address <i class="fa fa-asterisk" style="color: red;"></i></label>
                      <input type="text" name="bachelor_school_address" class="form-control" placeholder="Address">
                    </td>
                    <td> <label>University<i class="fa fa-asterisk" style="color: red;"></i></label>
                    <input type="text" name="bachelor_uuniversity_name" class="form-control" placeholder="Faculty"></td>
                  </tr>
                  <tr>
                    <td>
                        <label>Passed Year <i class="fa fa-asterisk" style="color: red;"></i></label>
                    <input type="text" name="bachelor_passed_year" class="form-control nepali_date">
                    </td>
                    
                    <td>
                        <label>Percent(%)<i class="fa fa-asterisk" style="color: red;"></i> </label>
                    <input type="text" name="bachelor_percentage" class="form-control" placeholder="Percent">
                    </td>
                    <td>
                        <label>CGPA <i class="fa fa-asterisk" style="color: red;"></i></label>
                        <input type="text" name="bachelor_pass_marks" class="form-control" placeholder="Marks">
                    </td>
                    
                  </tr>
                  <tr>
                    <td>
                      <label>Certificate <i class="fa fa-asterisk" style="color: red;"></i></label>
                    <input type="file" name="bachelor_certificate_upload" class="form-control">
                    <td>
                      <label>Marksheet <i class="fa fa-asterisk" style="color: red;"></i></label>
                    <input type="file" name="bachelor_marksheet_upload" class="form-control">
                    </td>
                    <td>
                      <label>Transcript <i class="fa fa-asterisk" style="color: red;"></i></label>
                    <input type="file" name="bachelor_transcript_upload" class="form-control">
                    </td>
                  </tr>
                  <tr>
                    <td colspan ="">
                       <label>Faculty <i class="fa fa-asterisk" style="color: red;"></i></label>
                        
                        <input type="text" name="bachelor_faculty" class="form-control" placeholder="Faculty">
                    </td>
                    <td colspan ="2">
                       <label>Major Subject <i class="fa fa-asterisk" style="color: red;"></i></label>
                        <textarea name="bachelor_major_subject" class="form-control" placeholder="Please enter comma seperated subject name" rows="2"></textarea>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- masters -->
            <div class="col-md-12">
              <table class="table rtable">
                <thead>
                <tr>
                  <th colspan="5" style="padding:10px;"><b>4. Master's Details</b></th>
                </tr>
                </thead>
                <tbody>
                  <tr>
                    <td colspan="1" style="padding:10px;">
                      <label>School Name <i class="fa fa-asterisk" style="color: red;"></i></label>
                      <input type="text" name="masters_school_name" class="form-control" placeholder="School Name">
                    </td>
                    <td colspan="" style="padding:10px;">
                      <label>School Address <i class="fa fa-asterisk" style="color: red;"></i></label>
                      <input type="text" name="masters_school_address" class="form-control" placeholder="Address">
                    </td>
                    <td> <label>University<i class="fa fa-asterisk" style="color: red;"></i></label>
                    <input type="text" name="masters_university_name" class="form-control" placeholder="Faculty"></td>
                  </tr>
                  <tr>
                    <td>
                        <label>Passed Year <i class="fa fa-asterisk" style="color: red;"></i></label>
                    <input type="text" name="masters_passed_year" class="form-control nepali_date">
                    </td>
                    
                    <td>
                        <label>Percent(%)<i class="fa fa-asterisk" style="color: red;"></i> </label>
                    <input type="text" name="masters_percentage" class="form-control" placeholder="Percent">
                    </td>
                    <td>
                        <label>CGPA <i class="fa fa-asterisk" style="color: red;"></i></label>
                        <input type="text" name="masters_pass_marks" class="form-control" placeholder="Marks">
                    </td>
                    
                  </tr>
                  <tr>
                    <td>
                      <label>Certificate <i class="fa fa-asterisk" style="color: red;"></i></label>
                    <input type="file" name="masters_certificate_upload" class="form-control">
                    <td>
                      <label>Marksheet <i class="fa fa-asterisk" style="color: red;"></i></label>
                    <input type="file" name="masters_marksheet_upload" class="form-control">
                    </td>
                    <td>
                      <label>Transcript <i class="fa fa-asterisk" style="color: red;"></i></label>
                    <input type="file" name="masters_transcript_upload" class="form-control">
                    </td>
                  </tr>
                  <tr>
                    <!-- <td colspan ="">
                       <label>संकाय <i class="fa fa-asterisk" style="color: red;"></i></label>
                        
                        <input type="text" name="master_faculty" class="form-control" placeholder="Faculty">
                    </td> -->
                    <td colspan ="3">
                       <label>Major Subject <i class="fa fa-asterisk" style="color: red;"></i></label>
                        <textarea name="masters_major_subject" class="form-control" placeholder="Please enter comma seperated subject name" rows="2"></textarea>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- 1year b.ed. -->
            <div class="col-md-6">
              <table class="table rtable">
                <thead>
                <tr>
                  <th colspan="5" style="padding:10px;"><b>5. 1 year B.Ed Details</b></th>
                </tr>
                </thead>
                <tbody>
                  <tr>
                    <td colspan="1" style="padding:10px;">
                      <label>School Name</label>
                      <input type="text" name="bed_school_name" class="form-control" placeholder="School Name">
                    </td>
                    <td colspan="" style="padding:10px;">
                      <label>School Details </label>
                      <input type="text" name="bed_school_address" class="form-control" placeholder="Address">
                    </td>
                    <td> <label>University</label>
                    <input type="text" name="bed_university_name" class="form-control" placeholder="Faculty"></td>
                  </tr>
                  <tr>
                    <td>
                      <label>Passed Year</label>
                      <input type="text" name="bed_passed_year" class="form-control nepali_date">
                    </td>
                    
                    <td>
                        <label>Percent(%) </label>
                    <input type="text" name="bed_percentage" class="form-control" placeholder="Percent">
                    </td>
                    <td>
                        <label>CGPA </label>
                        <input type="text" name="bed_pass_marks" class="form-control" placeholder="Marks">
                    </td>
                    
                  </tr>
                  <tr>
                    <td>
                      <label>Certificate </label>
                    <input type="file" name="bed_certificate_upload" class="form-control">
                    <td>
                      <label>Marksheet </label>
                    <input type="file" name="bed_marksheet_upload" class="form-control">
                    </td>
                    <td>
                      <label>Transcript </label>
                    <input type="file" name="bed_transcript_upload" class="form-control">
                    </td>
                  </tr>
                  <tr>
                    <td colspan ="">
                       <label>Faculty <i class="fa fa-asterisk" style="color: red;"></i></label>
                        
                        <input type="text" name="bed_faculty" class="form-control" placeholder="Faculty">
                    </td>
                    <td colspan ="2">
                       <label>Major Subject</label>
                        <textarea name="bed_major_subject" class="form-control" placeholder="Please enter comma seperated subject name" rows="2"></textarea>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- others -->
            <div class="col-md-6">
              <table class="table rtable">
                <thead>
                <tr>
                  <th colspan="5" style="padding:10px;"><b>Other Details</b></th>
                </tr>
                </thead>
                <tbody>
                  <tr>
                    <td colspan ="2">
                       <label>Certificate</label>
                       <input type="file" name="others_certificate_upload" class="form-control">
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col-md-12">
              <hr>
              <button type="submit" class="btn btn-block btn-secondary">Submit</button>
            </div>
          </div>
      </div>
    </div>

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
  $('.nepali_date').nepaliDatePicker({
    ndpYear: true,
    ndpMonth: true,
  });
});
</script>
@endsection