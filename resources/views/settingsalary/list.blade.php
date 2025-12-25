@extends('layouts.master')

@section('content')
<div class="row">
  <div class="col-lg-12">

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb breadcrumb-custom">
        <li class="breadcrumb-item">
          <a href="{{ url('/dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Teacher Salary Settings</li>
      </ol>
    </nav>

    <div class="card">

      <!-- Success Message -->
      @if ($message = Session::get('success'))
        <div class="alert alert-success m-3">
          {{ $message }}
        </div>
      @endif

      <div class="card-body">

        <!-- Add Button -->
        <a href="#addModal"
          class="btn btn-sm btn-dark open-modal mb-2"
          data-toggle="modal"
          data-url="{{ route('add-teacherssalary') }}">
          <i class="fa fa-plus-circle"></i> Add New
        </a>


        <!-- Table -->
        <div class="table-responsive">
          <table class="table table-bordered table-striped">
            <thead class="thead-dark">
              <tr>
                <th width="5%">S.N.</th>
                <th width="20%">Grade</th>
                <th width="20%">Academic Year</th>
                <th>Allowance Type : Amount</th>
                <th width="10%">Action</th>
              </tr>
            </thead>
              <tbody>
                @forelse($data as $gradeId => $fees)
                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>
                        {{ $fees->first()->grade->name ?? 'N/A' }}
                    </td>

                    <td>
                        {{ $fees->first()->academic_year }}
                    </td>

                    <td>
                        @foreach($fees as $fee)
                            <span class="badge badge-info">
                                {{ $fee->allowance_type }} : {{ $fee->allowance_amount }}
                            </span>
                        @endforeach
                    </td>

                    <td>
                        <form action="{{ route('delete-teacherssalary', $gradeId) }}"
                              method="POST"
                              onsubmit="return confirm('Are you sure you want to delete salary detail for this grade?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">No data found</td>
                </tr>
                @endforelse
                </tbody>

          </table>
        </div>

      </div>
    </div>
  </div>
</div>

<!-- ADD MODAL -->
<div class="modal fade" id="addModal" tabindex="-1">
  <div class="modal-dialog modal-sm">
    <div class="modal-content" id="addModalContent">
      <!-- AJAX content -->
    </div>
  </div>
</div>

@endsection
<script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
<script src="{{ asset('assets/vendors/js/vendor.bundle.addons.js') }}"></script>

<!-- =================== SCRIPTS (INSIDE SAME BLADE) =================== -->
<script>
$(document).ready(function () {

  /* OPEN MODAL VIA AJAX */
  $(document).on('click', '.open-modal', function (e) {
    e.preventDefault();

    let url = $(this).data('url');

    $('#addModalContent').html('<div class="p-4 text-center">Loading...</div>');
    $('#addModalContent').load(url);
  });

  /* ADD FEE ROW */
  $(document).on('click', '.add-row', function () {
    $('#fee-wrapper').append(`
      <div class="fee-row mb-2">
        <div class="input-group">
          <input type="text" name="allowance_type[]" class="form-control" placeholder="Allowance Name" required>
          <input type="number" name="allowance_amount[]" class="form-control" placeholder="Amount" required>
          <div class="input-group-append">
            <button type="button" class="btn btn-danger remove-row">
              <i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
      </div>
    `);
  });

  /* REMOVE FEE ROW */
  $(document).on('click', '.remove-row', function () {
    $(this).closest('.fee-row').remove();
  });

});
</script>


