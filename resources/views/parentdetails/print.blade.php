<!DOCTYPE html>
<html>
<head>
    <title>Parents Details</title>

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

<body onload="window.print()">

<h2>Parents Details</h2>

<table>
    <thead>
        <tr>
            <th>S.N.</th>
            <th>Parent Name</th>
            <th>Student Name</th>
            <th>Relation</th>
            <th>Contact</th>
            <th>Address</th>
            <th>Occupation</th>
        </tr>
    </thead>

    <tbody>
        @forelse($parents as $key => $parent)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $parent->parent_name }}</td>
                <td>{{ $parent->student->student_full_name ?? 'N/A' }}</td>
                <td>{{ $parent->relation_to_student }}</td>
                <td>{{ $parent->contact_no }}</td>
                <td>{{ $parent->address }}</td>
                <td>{{ $parent->occupation }}</td>
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
