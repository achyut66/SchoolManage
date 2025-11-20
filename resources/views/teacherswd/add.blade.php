@extends('layouts.master')
@section('content')
<div class="row">
  <div class="col-12">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb breadcrumb-custom">
        <li class="breadcrumb-item"><a href="{{ URL :: to('/dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page"><span><a
              href="{{ URL :: to('/teachers-personal-detail') }}">Work Details</span></li>
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
        <a class="nav-link" id="personal-details"><i class="fa fa-info-circle"></i> Teacher's Personal Details</a>
      </li>
      <li class="nav-item">
        <a class="nav-link " id="education-details"><i class="fa fa-info-circle"></i> Teacher's Education Details</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" id="work-details"><i class="fa fa-info-circle"></i> Teacher's Work Details</a>
      </li>
    </ul>
    <div class="card">
      <div class="card-header" style="background-color:#041750;color:#fff">Education Details</div>
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

        <form id="example-form" action="{{ route('teachers-work-detail-save') }}" method="post"
          enctype="multipart/form-data">
          @csrf
          <div class="row">
            <input type="hidden" name="teachers_id" value="{{ $pro->id }}">
            <div class="col-md-12">
              <table class="table rtable">
                <thead>
                <tr>
                  <th colspan="5" style="padding:10px;"><b>Working Details</b></th>
                </tr>
                </thead>
                <tbody>
                  <tr>
                    <td colspan="4"><b>School Details</b></td>
                  </tr>
                  <tr>
                    <td colspan="2">
                      <label>School Name<i class="fa fa-asterisk" style="color: red;"></i></label>
                      <input type="text" name="perma_taught_school_name" class="form-control" placeholder="">
                    </td>
                    <td>
                      <label>Province<i class="fa fa-asterisk" style="color: red;"></i></label>
                      <input type="text" name="perma_taught_school_province" class="form-control" placeholder="">
                    </td>
                    <td>
                      <label>District<i class="fa fa-asterisk" style="color: red;"></i></label>
                      <input type="text" name="perma_taught_school_district" class="form-control" placeholder="">
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <label>Municipality<i class="fa fa-asterisk" style="color: red;"></i></label>
                      <input type="text" name="perma_taught_school_local" class="form-control" placeholder="">
                    </td>
                    <td>
                      <label>Ward No.<i class="fa fa-asterisk" style="color: red;"></i></label>
                      <input type="text" name="perma_taught_school_ward" class="form-control" placeholder="">
                    </td>
                    <td>
                      <label>Start Date<i class="fa fa-asterisk" style="color: red;"></i></label>
                      <input type="text" name="perma_work_start_date" class="form-control nepali_date">
                    </td>
                    <!-- <td>
                      <label>Total Years Of Teaching<i class="fa fa-asterisk" style="color: red;"></i></label>
                      <input type="text" name="perma_work_till_date" class="form-control" placeholder="">
                    </td> -->
                  </tr>
                  <tr>
                    <td>
                      <label>Terminate Date<i class="fa fa-asterisk" style="color: red;"></i></label>
                      <input type="text" name="perma_work_last_date" class="form-control nepali_date" placeholder="">
                    </td>
                    <td>
                      <label>Total Years Of Teaching Experience<i class="fa fa-asterisk" style="color: red;"></i></label>
                      <input type="text" name="perma_work_till_date" class="form-control" placeholder="">
                    </td>
                    <td colspan="2">
                      <label>Experience Letter<i class="fa fa-asterisk" style="color: red;"></i></label>
                      <input type="file" name="perma_experience_letter_upload" class="form-control" placeholder="">
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <!-- <div class="col-md-12">
              <table class="table rtable">
                <thead>
                <tr>
                  <th colspan="5" style="padding:10px;"><b>अस्थाई शिक्षकको पेशागत विवरण</b></th>
                </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <label>अस्थाई शिक्षक नियुक्ति मिति</label>
                      <input type="text" name="tempo_enroll_date" class="form-control nepali_date">
                    </td>
                    
                    <td>
                      <label>नियुक्ति पत्र अपलोड</label>
                      <input type="file" name="tempo_file_upload" class="form-control">
                    </td>
                    <td>
                        <label>कार्यरत अन्तिम मिति </label>
                        <input type="text" name="tempo_last_date" class="form-control nepali_date">
                    </td>
                  </tr>
                </tbody>
              </table>
            </div> -->

            <div class="col-md-12">
              <table class="table rtable">
                <thead>
                <tr>
                  <th colspan="5" style="padding:10px;"><b>Training Details</b></th>
                </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                        <label>Training Took Date</label>
                        <input type="text" name="training_took_date" class="form-control nepali_date">
                    </td>
                    
                    <td>
                      <label>Period of Training Took</label>
                      <input type="text" name="training_period" class="form-control">
                    </td>
                    <td>
                      <label>Organization Who Gives Training</label>
                      <input type="text" name="training_given_org" class="form-control">
                    </td>
                    <td>
                      <label>Certificate</label>
                      <input type="file" name="training_related_paper_upload" class="form-control">
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