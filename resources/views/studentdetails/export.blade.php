<table>
    <thead>
        <tr>
            <th>S.N.</th>
            <th>Full Name</th>
            <th>Grade</th>
            <th>Province</th>
            <th>District</th>
            <th>Municipality</th>
            <th>Father Name</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        @foreach($students as $key => $student)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $student->student_full_name }}</td>
                <td>{{ $student->student_enrollment_class }}</td>
                <td>{{ $student->s_province }}</td>
                <td>{{ $student->s_district }}</td>
                <td>{{ $student->s_municipality }}</td>
                <td>{{ $student->student_fathers_name }}</td>
                <td>{{ $student->student_email }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
