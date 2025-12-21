<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Teachers Type Report</title>

    <style>
        body {
            font-family: "DejaVu Sans", Arial, sans-serif;
            font-size: 13px;
            color: #000;
        }

        .header {
            text-align: center;
            margin-bottom: 15px;
        }

        .header img {
            width: 80px;
            margin-bottom: 5px;
        }

        .header h3 {
            margin: 2px 0;
            font-size: 18px;
            text-transform: uppercase;
        }

        .header p {
            margin: 0;
            font-size: 12px;
        }

        .report-title {
            text-align: center;
            margin: 15px 0;
            font-size: 15px;
            font-weight: bold;
            text-decoration: underline;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table th,
        table td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        table th {
            background: #f2f2f2;
            text-align: center;
        }

        .text-center {
            text-align: center;
        }

        .footer {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
        }

        .signature {
            width: 30%;
            text-align: center;
        }

        .signature span {
            display: block;
            margin-top: 50px;
            border-top: 1px solid #000;
        }

        @media print {
            @page {
                margin: 15mm;
            }
        }
    </style>
</head>

<body onload="window.print()">

    <!-- HEADER -->
    <div class="header">
        <h3>{{ $row->schoolname ?? 'School Name' }}</h3>
        <p>{{ $row->address ?? '' }}</p>
        <p>{{ $row->district ?? '' }}, {{ $row->pradesh ?? '' }}</p>
    </div>

    <!-- REPORT TITLE -->
    <div class="report-title">
        Teachers Type Report
    </div>

    <!-- TABLE -->
    <table>
        <thead>
            <tr>
                <th width="5%">S.N.</th>
                <th>Teacher Code</th>
                <th>Full Name</th>
                <th>teaching Grade</th>
                <th>section</th>
                <th>Type</th>
                <th>Address</th>
                <th>Contact</th>
                <th>Email</th>
            </tr>
        </thead>

        <tbody>
            @forelse($newdata as $key => $teacher)
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td>{{ $teacher->unique_id }}</td>
                    <td>{{ $teacher->teachers_name_eng }}</td>
                    <td>{{ $teacher->teaching_grade }}</td>
                    <td>{{ $teacher->section }}</td>
                    <td>
                    {{ $teacher->is_class_teacher == 1 
                        ? 'Class Teacher' 
                        : ($teacher->is_class_teacher == 2 ? 'Subject Teacher' : 'N/A') }}
                    </td>
                    <td>
                    {{ $teacher->teachers_province }} -
                    {{ $teacher->teachers_zone }},
                    {{ $teacher->teachers_localadd }}
                    </td>
                    <td>{{ $teacher->teachers_mobno }}</td>
                    <td>{{ $teacher->teachers_email }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">
                        No records found
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>
