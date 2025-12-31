@extends('layouts.master')

@section('content')

<div class="row">
  <div class="col-lg-12">

    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb breadcrumb-custom">
        <li class="breadcrumb-item">
          <a href="{{ url('/dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">
          <span>Students Results</span>
        </li>
      </ol>
    </nav>

    <div class="card shadow-sm">

      {{-- RESULT TABLE --}}
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-hover" style="font-size:13px;">
            <thead class="bg-light">
              <tr>
                <th width="40">S.N</th>
                <th>Student Name</th>
                <th>Grade</th>
                <th>Exam Type</th>
                <th>Academic Year</th>
                <th>Total Marks</th>
                <th width="130">Action</th>
              </tr>
            </thead>

            <tbody>
              @forelse($results as $result)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $result->student_name }}</td>
                  <td>{{ $result->grade }}</td>
                  <td>{{ $result->examType->exam_name }}</td>
                  <td>{{ $result->academic_year }}</td>
                  <td>
                    <span class="badge badge-success">
                      {{ $result->total_marks }}
                    </span>
                  </td>
                  <td class="text-nowrap">

                    {{-- VIEW --}}
                    <a href="{{ route('student-result-show', [
                        'id' => $result->student_id,
                        'typeId' => $result->exam_type_id
                    ]) }}"
                      class="btn btn-sm btn-info"
                      title="View Result">
                      <i class="fa fa-eye"></i>
                    </a>

                    {{-- approve the result --}}

                    <form action="{{ route('result.approved') }}"
                        method="POST"
                        style="display:inline;"
                        onsubmit="return confirmApprove();">
                        @csrf
                        <input type="hidden" name="id" value="{{ $result->student_id }}">
                        <input type="hidden" name="typeId" value="{{ $result->exam_type_id }}">
                        <input type="hidden" name="approved_by" value="{{ auth()->user()->name }}">

                        <button type="submit"
                                class="btn btn-sm btn-success"
                                title="Approve Result">
                            Approve
                        </button>
                    </form>


                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="6" class="text-center text-muted">
                    No result records found
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
          @if($results->hasPages())
            <div class="d-flex justify-content-center mt-3">
              {{ $results->links('vendor.pagination.prev-next') }}
            </div>
          @endif

        </div>
      </div>

    </div>
  </div>
</div>
<script>
    function confirmApprove() {
        return confirm('Are you sure you want to approve this result?');
    }
</script>
@endsection
