<table class="table table-bordered">
  <tr>
    <th>Parent Name</th>
    <td>{{ $parent->parent_name }}</td>
  </tr>
  <tr>
    <th>Student Name</th>
    <td>{{ $parent->student->student_full_name ?? 'N/A' }}</td>
  </tr>
  <tr>
    <th>Relation</th>
    <td>{{ $parent->relation_to_student }}</td>
  </tr>
  <tr>
    <th>Contact</th>
    <td>{{ $parent->contact_no }}</td>
  </tr>
  <tr>
    <th>Address</th>
    <td>{{ $parent->address }}</td>
  </tr>
  <tr>
    <th>Occupation</th>
    <td>{{ $parent->occupation }}</td>
  </tr>
  <tr>
    <th>Emergency Contact No.</th>
    <td>{{ $parent->emergency_contact }}</td>
  </tr>
  <tr>
    <th>Student's Medical Condition.</th>
    <td>{{ $parent->medical_condition }}</td>
  </tr>
</table>
