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
          <span>Parents Detail</span>
        </li>
      </ol>
    </nav>

      {{-- Search Form --}}
      <form action="{{ route('parents-information') }}"
            method="GET"
            class="search-form">

        <div class="row">
          <div class="col-md-3">
            <input type="text"
                   name="search"
                   class="form-control"
                   placeholder="Search by student name"
                   value="{{ request('search') }}">
          </div>

          <div class="col-md-2">
            <button type="submit"
                    class="btn btn-danger btn-sm mt-1">
              <i class="fa fa-search"></i> Search
            </button>
          </div>

          <div class="col-md-4">

          <a href="{{ route('parents.print', ['search' => request('search')]) }}"
            target="_blank"
            class="btn btn-primary btn-sm mt-1">
            <i class="fa fa-print"></i> Print
         </a>


          <!-- <a href="{{ route('students.export', ['search' => request('search')]) }}"
            class="btn btn-warning btn-sm mt-1">
            <i class="fa fa-file-excel-o"></i> Excel
          </a> -->

          </div>
        </div>
      </form>

      {{-- Search Info --}}
      @if(request('search'))
        <div class="alert alert-info mt-3">
          Showing results for:
          <strong>{{ request('search') }}</strong>
          ({{ count($parents) }} found)
        </div>
      @endif

      <hr>

      {{-- Student Table --}}
      <div class="details">
        <table class="rtable">
          <thead>
            <tr>
              <th>S.N.</th>
              <th>Parent's Name</th>
              <th>Student's Name</th>
              <th>Relation</th>
              <th>Contact No.</th>
              <th>Address</th>
              <th>Occupation</th>
              <th>Action</th>
            </tr>
          </thead>

          <tbody>
            @forelse($parents as $student)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $student->parent_name }}</td>
                <td>{{ $student->student->student_full_name }}</td>
                <td>{{ $student->relation_to_student }}</td>
                <td>{{ $student->contact_no }}</td>
                <td>{{ $student->address }}</td>
                <td>{{ $student->occupation }}</td>
                <td>
                <button
                    class="btn btn-sm btn-secondary btn-rounded view-parent"
                    data-id="{{ $student->id }}">
                    <i class="fa fa-eye"></i>
                </button>
                    <a class="btn btn-sm btn-primary btn-rounded"
                        href="mailto:{{ $student->parent_email }}?subject=Student Information&body=Dear Parent,%0D%0A%0D%0AThis is regarding your child {{ $student->name }}.%0D%0A%0D%0AThank you.">
                        <i class="fa fa-envelope"></i>
                    </a>
                </td>
                
              </tr>
            @empty
              <tr>
                <td colspan="8" class="text-center text-danger">
                  No Parents records found.
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>

        <hr style="border-top:2px solid brown">
        <!-- pagination -->
        <div class="d-flex justify-content-center mt-3">
            {{ $parents->links('vendor.pagination.prev-next') }}
          </div>

      </div>
       <!-- Parent Detail Modal -->
       <div class="modal fade" id="parentModal" tabindex="-1">
        <div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content" style="min-height: 450px;">
            <div class="modal-header">
                <h5 class="modal-title">Parent Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body" id="parentModalBody">
                <div class="text-center">
                <i class="fa fa-spinner fa-spin"></i> Loading...
                </div>
            </div>
            </div>
        </div>
        </div>

    </div>
  </div>
</div>
<script>
document.querySelectorAll('.view-parent').forEach(btn => {
    btn.addEventListener('click', function () {
        let id = this.dataset.id;
        let modal = new bootstrap.Modal(document.getElementById('parentModal'));

        fetch(`/parents/${id}/modal`)
            .then(res => res.text())
            .then(html => {
                document.getElementById('parentModalBody').innerHTML = html;
                modal.show();
            });
    });
});
</script>
@endsection

