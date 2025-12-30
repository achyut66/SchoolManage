@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-lg-8 mx-auto">

        <div class="card">
            <div class="card-header bg-light text-center">
                <strong>Student Result Entry</strong>
            </div>
            <div class="card-header bg-red text-center" style="font-size:18px;background-color:red;">
                <strong>{{$name}}</strong>
            </div>

            <div class="card-body">

                {{-- STUDENT INFO --}}
                <table class="table table-bordered table-lg mb-4">
                    <tr style="font-weight:bold;font-size:18px;background-color:yellow;">
                        <th width="30%">Student Name</th>
                        <td style="font-weight:bold;font-size:18px;">{{ $student->student_full_name }}</td>
                    </tr>
                    <tr style="background-color:yellow;">
                        <th style="font-weight:bold;font-size:18px;">Grade/Section</th>
                        <td style="font-weight:bold;font-size:18px;">{{ $student->student_enrollment_class }} ({{ $student->student_enrollment_section }})</td>
                    </tr>
                    <tr style="background-color:yellow;">
                        <th style="font-weight:bold;font-size:18px;">Academic Year</th>
                        <td style="font-weight:bold;font-size:18px;">{{ $student->academic_year }}</td>
                    </tr>
                </table>

                {{-- RESULT FORM --}}
                <form action="{{ route('student-result-save') }}" method="POST">
                    @csrf

                    <input type="hidden" name="student_id" value="{{ $student->id }}">

                    <table class="table table-bordered">
                        <thead class="bg-light">
                            <tr>
                                <th width="50%" class="text-center" style="font-weight:bold;font-size:14px;">Subject</th>
                                <th width="25%" class="text-center" style="font-weight:bold;font-size:14px;">Theoritical Marks</th>
                                <th width="25%" class="text-center" style="font-weight:bold;font-size:14px;">Practical Marks</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($curriculum as $item)
                                <tr>
                                    <td style="font-weight:bold;font-size:18px;">
                                        {{ $item->subjects }}
                                        <input type="hidden"
                                               name="subjects[]"
                                               value="{{ $item->subjects }}">
                                    </td>
                                    <td>
                                        <input type="number"
                                               name="marks[]"
                                               class="form-control"
                                               min="0"
                                               max="100"
                                               required>
                                    </td>
                                    <td>
                                        <input type="number"
                                               name="practical_marks[]"
                                               class="form-control"
                                               min="0"
                                               max="100"
                                               >
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="text-right">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-save"></i> Save Result
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection
