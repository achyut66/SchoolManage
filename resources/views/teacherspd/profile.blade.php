@extends('layouts.master')
@section('content')
<style>
  .card-header{
    background-color:#041750;
    color:#fff;
  }
</style>
<div class="row">
  <div class="col-lg-12">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb breadcrumb-custom">
        <li class="breadcrumb-item"><a href="{{ URL :: to('/dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ URL :: to('/teachers-personal-detail') }}">Add Details</a></li>
        <li class="breadcrumb-item active" aria-current="page"><span>Teachers Profile</span></span></li>
      </ol>
    </nav>
  </div>
</div>
    <div class="row">
      <div class="col-12">
        <div class="row gutters-sm">
            <div class="col-md-3 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="{{ asset('assets/images/avatardefault_92824.png') }}" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4>{{ $teacherDetail->teachers_name_eng}}</h4>
                      <p class="text-secondary mb-1">{{$teacherDetail->teachers_tole.'-'.$teacherDetail->teachers_ward}}</p>
                      <p class="text-muted font-size-sm">{{$teacherDetail->teachers_localadd.','.$teacherDetail->teachers_zone}}</p>
                      <p>PAN No. {{ $teacherDetail->teachers_panno}}</p>
                      <hr>
                        <p>
                          <div class="progress progress-lg mt-2">
                            <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width: 100%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card mt-3">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><a href=""> <i class="fa fa-info-circle"></i> View Personal Details</a></h6>
                   
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"> <a href="{{route('teachers-education-detail-list', $teacherDetail->id)}}"> <i class="fa fa fa-graduation-cap"></i> View Educational Details </a></h6>
                    
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><a href=" {{route('teachers-work-detail', $teacherDetail->id)}}"> <i class="fa fa-briefcase"></i> Work Details </a></h6>
                  
                  </li>
                  
                </ul>
              </div>
            </div>
            <div class="col-md-9">
              <div class="row">
                <div class="col-12">
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home-1" role="tab" aria-controls="home-1" aria-selected="true"><i class="fa fa-info-circle"></i> Personal Details</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile-1" role="tab" aria-controls="profile-1" aria-selected="false"><i class="fa fa-graduation-cap"></i> Educational Details</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact-1" role="tab" aria-controls="contact-1" aria-selected="false"><i class="fa fa-briefcase"></i> Work Details </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="docs-tab" data-toggle="tab" href="#docs-1" role="tab" aria-controls="docs-1" aria-selected="false"><i class="fa fa-folder-open-o"></i> Uploaded Documents</a>
                    </li>
                  </ul>
                </div>
                @php
                  if($teacherDetail->teacher_enroll_status == 1){
                    $teacher_status = "Permanent";
                  }else{
                    $teacher_status = "Temporary";
                  }
                @endphp
                <!-- tab contents -->
                <div class="col-12">
                  <div class="tab-content">
                    <!-- personal details -->
                    <div class="tab-pane fade show active" id="home-1" role="tabpanel" aria-labelledby="home-tab">
                      <!-- personal details -->
                      <div class="table-responsive">
                        <table class ="rltable">
                          <tr style="background-color:#5294e2;color:#fff"><td colspan ="3"><b>Personal Details</b></td></tr>
                          <tr style="background-color:yellow;color:#000"><td colspan ="3"><b>Teachers Work Status : {{ $teacher_status }} </b></td></tr>
                          <tr>
                            <!-- <td>
                              <p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> नाम थर (देवनागरि लिपि): {{ $teacherDetail->teachers_name_nep }}</b></p>
                            </td> -->
                            <td>
                              <p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> Full Name (English): {{ $teacherDetail->teachers_name_eng }}</b></p>
                            </td>
                            <td>
                              <p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> Mobile No. {{ $teacherDetail->teachers_mobno }}</b></p>
                            </td>
                          
                          </tr>
                          <tr>
                            <td>
                              <p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> DOB:{{ $teacherDetail->teachers_dob_bs }}</b></p>
                            </td>
                            <td> 
                              <p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> Place Of Birth: {{ $teacherDetail->teachers_birth_place }}</b></p>
                            </td>
                            <td>
                              <p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> Marital Status: {{ $teacherDetail->teachers_marriage_satatus == 1? 'Married':'Unmarried' }}</b></p>
                            </td>
                          </tr>

                          <tr>
                            <td>
                              <p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> Cit No: {{ $teacherDetail->teachers_citno }}</b></p>
                            </td>
                            <td> 
                              <p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> Issue Date: {{ $teacherDetail->teachers_cit_jari_date }}</b></p>
                            </td>
                            <td>
                              <p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> Issue District: {{ $teacherDetail->teachers_cit_jari_district }}</b></p>
                            </td>
                          </tr>

                          <tr>
                            <td>
                              <p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> Grandfathers Name: {{ $teacherDetail->teachers_gf_name }}</b></p>
                            </td>
                            <td> 
                              <p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> Fathers Name: {{ $teacherDetail->teachers_f_name }}</b></p>
                            </td>
                            <td>
                              <p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> Mothers Name: {{ $teacherDetail->teachers_m_name }}</b></p>
                            </td>
                          </tr>

                          <tr>
                            <td>
                              <p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> License Grade: {{ $licenseLevel->name }}</b></p>
                            </td>
                            <td> 
                              <p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> License Subject: {{ $teacherDetail->teachers_teacher_license_sub }}</b></p>
                            </td>
                            <td>
                              <p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> LIcense Issue Date: {{ $teacherDetail->teachers_teacher_licenseno_jari_date }}</b></p>
                            </td>
                          </tr>
                        </table>
                      </div>
                    </div>
                    <!-- education details -->
                    <div class="tab-pane fade" id="profile-1" role="tabpanel" aria-labelledby="profile-tab">
                      @if(! $educationDetail->isEmpty())
                      @foreach($educationDetail as $key => $edu)
                      <div class="table-responsive">
                        <table class ="rltable">
                          <tr style="background-color:#5294e2;color:#fff"><td colspan ="3"><b>SLC/SEE details</b></td></tr>
                          <tr>
                            <td>
                              <p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> Passed Year: {{ $edu->slc_passed_year }}</b></p>
                            </td>
                            <td>
                              <p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> School Name: {{ $edu->slc_school_name }}</b></p>
                            </td>
                            <td>
                              <p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> Percent: {{ $edu->slc_percent }}</b></p>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> CGPA: {{ $edu->slc_pass_marks }}</b></p>
                            </td>
                            <td> 
                              <p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> Major Subject: {{ $edu->slc_major_subject}}
                            <td></td>
                          </tr>
                          <!-- plus 2 details -->
                          <tr style="background-color:#5294e2;color:#fff"><td colspan ="3"><b>Plus Two details</b></td></tr>
                          <tr>
                            <td>
                              <p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> Passed Year: {{ $edu->plustwo_passed_year }}</b></p>
                            </td>
                            <td>
                              <p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> School Name: {{ $edu->plustwo_school_name }}</b></p>
                            </td>
                            <td>
                              <p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> Address: {{ $edu->plustwo_school_address }}</b></p>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> Faculty: {{ $edu->plustwo_faculty }}</b></p>
                            </td>
                            <td>
                              <p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> Percent: {{ $edu->plustwo_percentage }}</b></p>
                            </td>
                            <td>
                              <p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> CGPA: {{ $edu->plustwo_pass_marks }}</b></p>
                            </td>
                            
                          </tr>
                          <tr style="background-color:#5294e2;color:#fff"><td colspan ="3"><b>Bachelor Details</b></td></tr>
                          <tr>
                            <td>
                              <p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> Passed Year: {{ $edu->bachelor_passed_year }}</b></p>
                            </td>
                            <td>
                              <p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> School Name: {{ $edu->bachelor_school_name }}</b></p>
                            </td>
                            <td>
                              <p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> Address: {{ $edu->bachelor_school_address }}</b></p>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> Faculty: {{ $edu->bachelor_faculty }}</b></p>
                            </td>
                            <td>
                              <p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> Percent: {{ $edu->bachelor_percentage }}</b></p>
                            </td>
                            <td>
                              <p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> CGPA: {{ $edu->bachelor_pass_marks }}</b></p>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> Major Subject: {{ $edu->bachelor_major_subject }}</b></p>
                            </td>
                            <td></td>
                            <td></td>
                          </tr>

                          <tr style="background-color:#5294e2;color:#fff"><td colspan ="3"><b>Master's Degree Details</b></td></tr>
                          <tr>
                            <td>
                              <p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> Passed Year: {{ $edu->masters_passed_year }}</b></p>
                            </td>
                            <td>
                              <p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> School Name: {{ $edu->masters_school_name }}</b></p>
                            </td>
                            <td>
                              <p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> Address: {{ $edu->masters_school_address }}</b></p>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> Faculty: {{ $edu->masters_faculty }}</b></p>
                            </td>
                            <td>
                              <p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> Percent: {{ $edu->masters_percentage }}</b></p>
                            </td>
                            <td>
                              <p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> CGPA: {{ $edu->masters_pass_marks }}</b></p>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> Major Subject: {{ $edu->masters_major_subject }}</b></p>
                            </td>
                            <td></td>
                            <td></td>
                          </tr>

                          <tr style="background-color:#5294e2;color:#fff"><td colspan ="3"><b>1 YEAR B.ED Details</b></td></tr>
                          <tr>
                            <td>
                              <p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> Passed Year: {{ $edu->bed_passed_year }}</b></p>
                            </td>
                            <td>
                              <p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> School Name: {{ $edu->bed_school_name }}</b></p>
                            </td>
                            <td>
                              <p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> Address: {{ $edu->bed_school_address }}</b></p>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> Faculty: {{ $edu->bed_faculty }}</b></p>
                            </td>
                            <td>
                              <p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> Percent: {{ $edu->bed_percentage }}</b></p>
                            </td>
                            <td>
                              <p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> CGPA: {{ $edu->bed_pass_marks }}</b></p>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> Major Subject: {{ $edu->bed_major_subject }}</b></p>
                            </td>
                            <td></td>
                            <td></td>
                          </tr>
                        </table>
                      </div>
                      @endforeach
                      @else
                      <div class="alert alert-fill-danger">No details available!!! <br><br> <a href="{{ route('teachers-education-create', $teacherDetail->id) }}" class="btn btn-sm btn-success"><i class="fa fa-plus-circle"></i>विवरण थापनुहोस</a></div>
                      @endif
                    </div>

                    <!-- work details -->
                    <div class="tab-pane fade" id="contact-1" role="tabpanel" aria-labelledby="contact-tab">
                      <div class="col-12">
                        @if(! $workDetail->isEmpty())
                        @foreach($workDetail as $key => $wd)
                        <table class ="rltable">
                          <tr style="background-color:#5294e2;color:#fff"><td colspan ="3"><b>Permanent Teacher's Work Details</b></td></tr>
                          <tr>
                            <td>
                              <p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> Permanent Teacher's Certificate Issue Date: {{ $wd->perma_enroll_date }}</b></p>
                            </td>
                            <td>
                              <p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> Subject of Certification: {{ $wd->perma_paper_sub }}</b></p>
                            </td>
                            <td>
                              <p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> Service Start Date: {{ $wd->perma_work_start_date }}</b></p>
                            </td>
                          </tr>

                          <tr>
                            <td>
                              <p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> Service Year: {{ $wd->perma_work_till_date }}</b></p>
                            </td>
                            <td>
                              <p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> License End Date: {{ $wd->perma_work_last_date }}</b></p>
                            </td>
                            <td>
                              <p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> Remaining Year To Terminate: {{ $wd->perma_work_last_date_remain }}</b></p>
                            </td>
                          </tr>
                          <tr><td colspan= "3">School Details</td></tr>
                          <tr>
                            <td>
                              <p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> School Name: {{ $wd->perma_taught_school_name }}</b></p>
                            </td>
                            <td>
                              <p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> Address: {{ $wd->perma_taught_school_palika }}-{{$wd->perma_taught_school_ward}},{{$wd->perma_taught_school_district}}, {{$wd->perma_taught_school_province}}</b></p>
                            </td>
                            <td>
                              <p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> Grade of Enrollment  : {{ $wd->perma_enroll_post }}</b></p>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> Legal Service Year: {{ $wd->perma_enroll_time_period }}</b></p>
                            </td>
                            <td></td>
                            <td></td>
                          </tr>
                          <tr style="background-color:#5294e2;color:#fff"><td colspan ="3"><b>Temporary Teacher's Work Details</b></td></tr>
                          <tr>
                            <td>
                              <p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> Enrollment Date: {{ $wd->tempo_enroll_date }}</b></p>
                            </td>
                            <td><p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> Last Date to Work Till: {{ $wd->tempo_last_date }}</b></p></td>
                            <td></td>
                          </tr>
                          <tr style="background-color:#5294e2;color:#fff"><td colspan ="3"><b>Training Details</b></td></tr>
                          <tr>
                            <td><p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> Training Took Date: {{ $wd->training_took_date }}</b></p></td>
                            <td><p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> Years of Validation: {{ $wd->training_period }}</b></p></td>
                            <td><p class="badge badge-outline-success badge-pill"><i class="fa fa-hand-o-right"></i><b> Training Provide Organization: {{ $wd->training_given_org }}</b></p></td>
                          </tr>
                        </table>
                        @endforeach
                        @else 
                        <div class="alert alert-fill-danger">No Details Available!!! <br><br> <a href="{{route('teachers-work-detail-create', $teacherDetail->id) }}" class="btn btn-sm btn-success"><i class="fa fa-plus-circle"></i>Add New</a></div>
                        @endif
                      </div>
                    </div>

                    <!-- docs details -->
                    <div class="tab-pane fade" id="docs-1" role="tabpanel" aria-labelledby="docs-tab">
                      <div class="col-12">
                        <div class="card">
                          <div class="card-header">Teacher's Documents</div>
                          <div class="card-body">
                            <table class="rtable">
                              <tr>
                                <td>Citizenship</td>
                                <td>
                                  @if(!empty($teacherDetail->teachers_cit_upload))
                                  <a href="{{asset('storage/'.$teacherDetail->teachers_cit_upload)}}" class="btn btn-success btn-sm" target="_blank"><i class="fa fa-download"></i> Download</a>
                                  @else 
                                 n/a
                                  @endif
                                </td>
                              </tr>
                               <tr>
                                <td>License</td>
                                <td>
                                  @if(!empty($teacherDetail->teachers_teacher_license_upload))
                                  <a href="{{asset('storage/'.$teacherDetail->teachers_teacher_license_upload)}}" class="btn btn-success btn-sm" target="_blank"><i class="fa fa-download"></i> Download</a>
                                  @else 
                                  n/a
                                  @endif
                                </td>
                              </tr>
                               <tr>
                                <td>PAN</td>
                                <td>
                                  @if(!empty($teacherDetail->teachers_pan_upload))
                                  <a href="{{asset('storage/'.$teacherDetail->teachers_pan_upload)}}" class="btn btn-success btn-sm" target="_blank"><i class="fa fa-download"></i> Download</a>
                                  @else 
                                  n/a
                                  @endif
                                </td>
                              </tr>
                              @if(!empty($educationDetail))
                              @foreach($educationDetail as $key => $edu)
                               <tr>
                                <td>SLC Certificate </td>
                                <td>
                                  @if(!empty($edu->slc_certificate_upload))
                                  <a href="{{asset('storage/'.$edu->slc_certificate_upload)}}" class="btn btn-success btn-sm" target="_blank"><i class="fa fa-download"></i> Download</a>
                                  @else 
                                  n/a
                                  @endif
                                </td>
                              </tr>
                               <tr>
                                <td>SLC Marksheet</td>
                                <td>
                                  @if(!empty($edu->slc_marksheet_upload))
                                  <a href="{{asset('storage/'.$edu->slc_marksheet_upload)}}" class="btn btn-success btn-sm" target="_blank"><i class="fa fa-download"></i> Download</a>
                                  @else 
                                  n/a
                                  @endif
                                </td>
                              </tr>
                               <tr>
                                <td>10+2 Certificate </td>
                                <td>
                                  @if(!empty($edu->plustwo_certificate_upload))
                                  <a href="{{asset('storage/'.$edu->plustwo_certificate_upload)}}" class="btn btn-success btn-sm" target="_blank"><i class="fa fa-download"></i> Download</a>
                                  @else 
                                  n/a
                                  @endif
                                </td>
                              </tr>
                               <tr>
                                <td>10+2 Marksheet </td>
                                <td>
                                  @if(!empty($edu->plustwo_marksheet_upload))
                                  <a href="{{asset('storage/'.$edu->plustwo_marksheet_upload)}}" class="btn btn-success btn-sm" target="_blank"><i class="fa fa-download"></i> Download</a>
                                  @else 
                                  n/a
                                  @endif
                                </td>
                              </tr>
                               <tr>
                                <td>10+2 Transcript </td>
                                <td>
                                  @if(!empty($edu->plustwo_transcript_upload))
                                  <a href="{{asset('storage/'.$edu->plustwo_transcript_upload)}}" class="btn btn-success btn-sm" target="_blank"><i class="fa fa-download"></i> Download</a>
                                  @else 
                                  n/a
                                  @endif
                                </td>
                              </tr>
                              <tr>
                                <td>Bachelor's Certificate </td>
                                <td>
                                  @if(!empty($edu->bachelor_certificate_upload))
                                  <a href="{{asset('storage/'.$edu->bachelor_certificate_upload)}}" class="btn btn-success btn-sm" target="_blank"><i class="fa fa-download"></i> Download</a>
                                  @else 
                                  n/a
                                  @endif
                                </td>
                              </tr>
                              <tr>
                                <td>Bachelor's Marksheet</td>
                                <td>
                                  @if(!empty($edu->bachelor_marksheet_upload))
                                  <a href="{{asset('storage/'.$edu->bachelor_marksheet_upload)}}" class="btn btn-success btn-sm" target="_blank"><i class="fa fa-download"></i> Download</a>
                                  @else 
                                  n/a
                                  @endif
                                </td>
                              </tr>
                              <tr>
                                <td>Bachelor's Transcript</td>
                                <td>
                                  @if(!empty($edu->bachelor_transcript_upload))
                                  <a href="{{asset('storage/'.$edu->bachelor_transcript_upload)}}" class="btn btn-success btn-sm" target="_blank"><i class="fa fa-download"></i> Download</a>
                                  @else 
                                  n/a
                                  @endif
                                </td>
                              </tr>
                              <tr>
                                <td>Master's Certificate </td>
                                <td>
                                  @if(!empty($edu->masters_certificate_upload))
                                  <a href="{{asset('storage/'.$edu->masters_certificate_upload)}}" class="btn btn-success btn-sm" target="_blank"><i class="fa fa-download"></i> Download</a>
                                  @else 
                                  n/a
                                  @endif
                                </td>
                              </tr>
                              <tr>
                                <td>Master's Marksheet </td>
                                <td>
                                  @if(!empty($edu->masters_marksheet_upload))
                                  <a href="{{asset('storage/'.$edu->masters_marksheet_upload)}}" class="btn btn-success btn-sm" target="_blank"><i class="fa fa-download"></i> Download</a>
                                  @else 
                                  n/a
                                  @endif
                                </td>
                              </tr>
                              <tr>
                                <td>Master's Transcript </td>
                                <td>
                                  @if(!empty($edu->masters_transcript_upload))
                                  <a href="{{asset('storage/'.$edu->masters_transcript_upload)}}" class="btn btn-success btn-sm" target="_blank"><i class="fa fa-download"></i> Download</a>
                                  @else 
                                  n/a
                                  @endif
                                </td>
                              </tr>
                              @endforeach
                              @endif
                              @if(!empty($workDetail))
                              @foreach($workDetail as $key => $wd)
                              <tr>
                                <td>Enrollment Letter</td>
                                <td>
                                  @if(!empty($wd->perma_enroll_paper_upload))
                                  <a href="{{asset('storage/'.$wd->perma_enroll_paper_upload)}}" class="btn btn-success btn-sm" target="_blank"><i class="fa fa-download"></i> Download</a>
                                  @else 
                                  n/a
                                  @endif</td>
                              </tr>
                              <tr>
                                <td>Experience Letter</td>
                                <td>
                                  @if(!empty($wd->perma_experience_letter_upload))
                                  <a href="{{asset('storage/'.$wd->perma_experience_letter_upload)}}" class="btn btn-success btn-sm" target="_blank"><i class="fa fa-download"></i> Download</a>
                                  @else 
                                  n/a
                                  @endif</td>
                              </tr>
                              <tr>
                                <td>Training Letter</td>
                                <td>
                                  @if(!empty($wd->training_related_paper_upload))
                                  <a href="{{asset('storage/'.$wd->training_related_paper_upload)}}" class="btn btn-success btn-sm" target="_blank"><i class="fa fa-download"></i> Download</a>
                                  @else 
                                  n/a
                                  @endif</td>
                              </tr>
                              @endforeach
                              @endif
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
    </div>
@endsection