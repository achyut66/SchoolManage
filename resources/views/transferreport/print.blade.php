<!DOCTYPE html>
<html>
<head>
    <title>Student Migration Report</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
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
            background: #f2f2f2;
        }

        .text-center {
            text-align: center;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body onload="window.print()">

<h2>Student Migration Report</h2>

<table>
    <thead>
        <tr>
            <th>S.N.</th>
            <th>Student Code</th>
            <th>Academic Year</th>
            <th>Student Name</th>
            <th>Grade</th>
            <th>Address</th>
            <th>Email</th>
        </tr>
    </thead>

    <tbody>
        @forelse($students as $student)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $student->student->unique_id ?? '-' }}</td>
                <td>{{ $student->academic_year }}</td>
                <td>{{ $student->student_name }}</td>
                <td>{{ $student->grade }}</td>
                <td>
                    {{ $student->student->s_province ?? '' }},
                    {{ $student->student->s_district ?? '' }},
                    {{ $student->student->s_municipality ?? '' }}
                </td>
                <td>{{ $student->student->student_email ?? '-' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">
                    No migration records found.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

</body>
</html>
