<!DOCTYPE html>
<html>
<head>
    <title>Student List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
        }
        h2 {
            text-align: center;
            margin-bottom: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }
        th {
            background: #f0f0f0;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="no-print" style="text-align:right;margin-bottom:10px;">
    <button onclick="window.print()">Print</button>
</div>
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-6 col-lg-6 col-xl-3">
              @if(!empty($palikaProfile))
                <img src="{{ asset('storage/'.$palikaProfile->logo) }}" style="width:119px; height:100px;" alt="Palika Logo">
              @else
                <img src="{{ asset('assets/images/new_logo.png') }}" style="width:119px; height:100px;" alt="Logo">
              @endif
            </div>

            <div class="col-md-6 col-lg-6 col-xl-9 text-center" style="margin-top:-110px;margin-left:350px;">
              <h3 class="text-center"style="margin-left:20px;">
                {{ !empty($palikaProfile) && !empty($palikaProfile->schoolname) ? $palikaProfile->schoolname : '' }}
              </h3>
              
              @if(!empty($palikaProfile) && !empty($palikaProfile->slogan))
                <p style=" margin-top:5px; font-weight: bold; color: #041750;margin-left:30px;">
                  {{ $palikaProfile->slogan }}
                </p>
              @endif
              <p style="margin-top:10px;">
                {{ !empty($palikaProfile) && !empty($palikaProfile->address) ? $palikaProfile->address : '' }}
                @if(!empty($palikaProfile) && !empty($palikaProfile->district))
                  , {{ $palikaProfile->district }}
                @endif
                @if(!empty($palikaProfile) && !empty($palikaProfile->pradesh))
                  , {{ $palikaProfile->pradesh }}
                @endif
              </p>
            </div>

          </div>
          <hr>
          @yield('content')
        </div>

      </div>

<h2>Student Details</h2>

<table>
    <thead>
        <tr>
            <th>S.N.</th>
            <th>Student Code</th>
            <th>Academic Year</th>
            <th>Full Name</th>
            <th>Grade</th>
            <th>Section</th>
            <th>Address</th>
            <th>Father's Name</th>
            <!-- <th>Birth Place</th> -->
            <th>Email</th>
            <th>Fee</th>
        </tr>
    </thead>
    <tbody>
        @forelse($students as $key => $student)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $student->unique_id }}</td>
                <td>{{ $student->academic_year }}</td>
                <td>{{ $student->student_full_name }}</td>
                <td>{{ $student->student_enrollment_class }}</td>
                <td>{{ $student->student_enrollment_section }}</td>
                <td>
                    {{ $student->s_province }},
                    {{ $student->s_district }},
                    {{ $student->s_municipality }}
                </td>
                <td>{{ $student->student_fathers_name }}</td>
                <!-- <td>{{ $student->s_birthplace }}</td> -->
                <td>{{ $student->student_email }}</td>
                <td>
                  <span class="{{ $student->fee_cleared ? 'text-success' : 'text-danger' }}">
                    {{ $student->fee_cleared ? 'Cleared' : 'Not Cleared' }}
                  </span>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" style="text-align:center;">
                    No records found
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

</body>
</html>
