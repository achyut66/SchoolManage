@extends('layouts.master')

@section('content')

<style>
body {
    background: #f5f5f5;
}
.marksheet {
    width: 1100px;
    margin: auto;
    background: #fff;
    border: 2px solid #000;
    padding: 15px;
    font-size: 14px;
    color: #000;
}
.header {
    text-align: center;
    position: relative;
}
.gov-logo {
    position: absolute;
    left: 10px;
    top: 0;
    width: 70px;
}
.header h4 {
    margin: 2px 0;
    font-weight: bold;
}
.header h3 {
    margin: 4px 0;
    text-transform: uppercase;
    font-weight: bold;
}
.info-line {
    border-bottom: 1px dotted #000;
    display: inline-block;
    min-width: 300px;
}
.info-table td {
    padding: 4px;
    vertical-align: bottom;
}
.marks-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}
.marks-table th,
.marks-table td {
    border: 1px solid #000;
    padding: 4px;
    text-align: center;
}
.marks-table th {
    font-size: 11px;
}
.text-left {
    text-align: left;
}
.footer-table td {
    padding: 6px;
    border: 1px solid #000;
    text-align: center;
}
.signature {
    margin-top: 40px;
}
.info-paragraph {
    margin-top:40px;
    font-size: 16px;
    line-height: 1.9;
    text-align: justify;
    text-transform: uppercase;
    text-size: 16px;
}

.dotted {
    display: inline-block;
    border-bottom: 1px dotted #000;
    padding: 0 6px;
    min-width: 80px;
    font-weight: bold;
}
.dotted.wide { min-width: 200px; }
.dotted.small { min-width: 50px; }

</style>
<a class="btn btn-secondary" href="{{route('student-result-list')}}" style="margin-left: 25px;margin-bottom:3px;">Back To List</a>
<div class="marksheet">

    {{-- HEADER --}}
    <div class="header">
        <img src="{{ asset('storage/'.$school_profile->logo) }}" class="gov-logo">
        <h4 style="text-transform: uppercase;">{{ !empty($school_profile) && !empty($school_profile->schoolname) ? $school_profile->schoolname : '' }}</h4>
        <h4 style="text-transform: uppercase;">{{ " $palikaProfile->slogan " }}</h4>
        <h4 style="text-transform: uppercase;">{{ !empty($palikaProfile) && !empty($palikaProfile->address) ? $palikaProfile->address : '' }}
                @if(!empty($palikaProfile) && !empty($palikaProfile->district))
                  , {{ $palikaProfile->district }}
                @endif
                @if(!empty($palikaProfile) && !empty($palikaProfile->pradesh))
                  , {{ $palikaProfile->pradesh }}
                @endif
        </h4>
        
        <h3 style="text-decoration: underline;">MARK - SHEET</h3>
        <a href="{{ route('result.pdf', $student->student_id) }}"
        class="btn btn-success"
        target="_blank"
        style="margin-top:-130px;margin-right:-700px;">
        <i class="fa fa-file-pdf-o"></i> Download PDF
        </a>

    </div>

    <hr style="width:800px;"></hr>

    {{-- STUDENT DETAILS --}}
    <p class="info-paragraph">
        THE MARKS SECURED BY
        <span class="dotted wide">{{ $student->student_name }}</span>
        DATE OF BIRTH
        <span class="dotted small" style="font-size:16px;">{{ $dob ?? '—' }}</span>,
        ROLL
        <span class="dotted small" style="font-size:16px;">{{ $student->student_id }}</span>
        SYMBOL NO
        <span class="dotted small" style="font-size:16px;">{{ $student->school_id ?? '—' }}</span>
        OF
        <span class="dotted wide">
            {{ $school_profile->schoolname }},
        </span>
        IN THE <strong>{{ optional($results->first()->examType)->exam_name }}</strong> OF
        <span class="dotted small" style="font-size:16px;">{{ $student->academic_year }}</span>
        GRADE
        <span class="dotted small" style="font-size:16px;">{{ $student->grade }} </span>
        ARE GIVEN BELOW.
    </p>

    {{-- MARKS TABLE --}}
    <table class="marks-table" style="border:1px solid black;">
        <thead>
            <tr>
                <th rowspan="2">S.N</th>
                <th rowspan="2">SUBJECTS</th>
                <th rowspan="2">FULL<br>MARKS</th>
                <th rowspan="2">PASS<br>MARKS</th>
                <th colspan="2">OBTAINED MARKS</th>
                <th rowspan="2">TOTAL</th>
                <th rowspan="2">GRADE</th>
            </tr>

            <tr>
                <th>TH</th>
                <th>PR</th>
            </tr>
        </thead>
        <tbody>
        @foreach($results as $i => $row)
            @php
                $subjectTotal = $row->obtained_marks + ($row->practical_marks ?? 0);
                $subjectPercentage = ($subjectTotal / 100) * 100;
                $subjectGrade = calculateGpaFromPercentage($subjectPercentage);
            @endphp
            <tr>
                <td>{{ $i + 1 }}</td>
                <td class="text-left">{{ strtoupper($row->subjects) }}</td>
                <td>100</td>
                <td>32</td>
                <td>{{ $row->obtained_marks }}</td>
                <td>{{ $row->practical_marks ?? '-' }}</td>
                <td>{{ $subjectTotal }}</td>
                <td><strong>{{ $subjectGrade['grade'] }}</strong></td>
            </tr>
            @endforeach

        </tbody>
    </table>

    {{-- SUMMARY --}}
    <table class="footer-table" width="100%" style="border:2px solid black;">
        <tr>
            <td>GRAND TOTAL</td>
            <td>{{ $totalMarks }}</td>
            <td>PERCENTAGE</td>
            <td>{{ number_format($percentage, 2) }}%</td>
            <td colspan="2">
            @if($position)
                POSITION: &nbsp;
                <span class="badge">
                    {{ $position }}
                </span>
            @endif
            </td>
        </tr>
        <tr>
            <td>GPA</td>
            <td>{{ $gpa }}</td>
            <td>GRADE</td>
            <td>{{ $gpa_class }}</td>
            <td>RESULT</td>
            <td><strong>{{ $division }}</strong></td>
        </tr>
    </table>


    {{-- FOOTER --}}
    <div class="signature">
        <table width="100%">
            <tr>
                <td>
                    _______________________<br>
                    CHECKED BY:<br>
                </td>
                <td style="text-align:right;">
                    _______________________<br>
                    APPROVED BY:
                </td>
            </tr>
        </table>
    </div>

</div>

@endsection
