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
        <li class="breadcrumb-item">
          <a href="{{ url('/dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
          <a href="{{ route('student-parent-list') }}">Students</a>
        </li>
        <li class="breadcrumb-item active">Student Profile</li>
      </ol>
    </nav>
  </div>
</div>

<div class="row">
  <div class="col-12">
    <div class="row gutters-sm">

      {{-- LEFT PROFILE CARD --}}
      <div class="col-md-3 mb-3">
        <div class="card">
          <div class="card-body text-center">
            <img src="{{ asset('assets/images/avatardefault_92824.png') }}"
                 class="rounded-circle mb-3"
                 width="150">

            <h4>{{ $student->student_full_name }}</h4>
            <p class="text-secondary">
              Class: {{ $student->student_enrollment_class }}
            </p>
            <p class="text-muted">
              {{ $student->s_municipality }}, {{ $student->s_district }}
            </p>
            <hr>

            <div class="progress progress-lg mt-2">
              <div class="progress-bar bg-success progress-bar-striped progress-bar-animated"
                   style="width: 100%"></div>
            </div>
          </div>
        </div>

        {{-- SIDE LINKS --}}
        <div class="card mt-3">
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              <a href="{{ route('student-parent-detail-edit', $student->id) }}">
                <i class="fa fa-info-circle"></i> Personal Details
              </a>
            </li>
            <li class="list-group-item">
              <a href="{{ route('students.education', $student->id) }}">
                <i class="fa fa-graduation-cap"></i> Education Details
              </a>
            </li>
            <li class="list-group-item">
              <a href="{{ route('students.parents', $student->id) }}">
                <i class="fa fa-users"></i> Parent / Guardian Details
              </a>
            </li>
          </ul>
        </div>
      </div>

      {{-- RIGHT CONTENT --}}
      <div class="col-md-9">

        {{-- TABS --}}
        <ul class="nav nav-tabs mb-3">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#personal">
              <i class="fa fa-info-circle"></i> Personal
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#education">
              <i class="fa fa-graduation-cap"></i> Education
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#guardian">
              <i class="fa fa-users"></i> Guardian
            </a>
          </li>
        </ul>

        <div class="tab-content">

          {{-- PERSONAL TAB --}}
          <div class="tab-pane fade show active" id="personal">
            <table class="rltable">
              <tr style="background:#5294e2;color:#fff">
                <td colspan="3"><b>Student Personal Details</b></td>
              </tr>

              <tr>
                <td><b>Full Name:</b> {{ $student->student_full_name }}</td>
                <td><b>Gender:</b> {{ $student->s_gender }}</td>
                <td><b>DOB:</b> {{ $student->student_dob }}</td>
              </tr>

              <tr>
                <td><b>Caste:</b> {{ $student->s_caste }}</td>
                <td><b>Religion:</b> {{ $student->s_religion }}</td>
                <td><b>Birthplace:</b> {{ $student->s_birthplace }}</td>
              </tr>

              <tr>
                <td><b>Province:</b> {{ $student->s_province }}</td>
                <td><b>District:</b> {{ $student->s_district }}</td>
                <td><b>Municipality:</b> {{ $student->s_municipality }}</td>
              </tr>

              <tr>
                <td><b>Ward:</b> {{ $student->s_ward }}</td>
                <td><b>Tole:</b> {{ $student->s_tol }}</td>
                <td><b>Contact:</b> {{ $student->student_contact }}</td>
              </tr>

              <tr>
                <td colspan="3">
                  <b>Address:</b> {{ $student->student_address }}
                </td>
              </tr>
            </table>
          </div>

          {{-- EDUCATION TAB --}}
          <div class="tab-pane fade" id="education">
            @if($education)
              <table class="rltable">
                <tr style="background:#5294e2;color:#fff">
                  <td colspan="3"><b>Educational Details</b></td>
                </tr>
                <tr>
                  <td><b>Previous School Name:</b> {{ $education->prev_school_name ?? 'N/A' }}</td>
                  <td><b>Previous School Address:</b> {{ $education->prev_school_address ?? 'N/A' }}</td>
                  <td><b>Previous Grade:</b> {{ $education->prev_school_left_grade ?? 'N/A' }}</td>
                </tr>
                <tr>
                  <td><b>Obtained Percentage:</b> {{ $education->prev_school_obtained_percentage ?? 'N/A' }}</td>
                </tr>
              </table>
            @else
              <div class="alert alert-danger">
                No education details available.
              </div>
            @endif
          </div>

          {{-- GUARDIAN TAB --}}
          <div class="tab-pane fade" id="guardian">
            @if($guardian)
              <table class="rltable">
                <tr style="background:#5294e2;color:#fff">
                  <td colspan="3"><b>Parent / Guardian Details</b></td>
                </tr>

                <tr>
                  <td><b>Name:</b> {{ $guardian->parent_name }}</td>
                  <td><b>Relation:</b> {{ $guardian->relation_to_student }}</td>
                  <td><b>Contact:</b> {{ $guardian->contact_no }}</td>
                </tr>

                <tr>
                  <td><b>Emergency Contact:</b> {{ $guardian->emergency_contact }}</td>
                  <td><b>Occupation:</b> {{ $guardian->occupation }}</td>
                  <td></td>
                </tr>

                <tr>
                  <td colspan="3">
                    <b>Address:</b> {{ $guardian->address }}
                  </td>
                </tr>
              </table>
            @else
              <div class="alert alert-danger">
                No guardian details available.
              </div>
            @endif
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

@endsection
