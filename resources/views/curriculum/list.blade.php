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
        <li class="breadcrumb-item active">Curriculum</li>
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
        <div class="mb-3">
          <a href="#addModal"
             class="btn btn-sm btn-dark"
             data-toggle="modal"
             data-url="{{ route('add-curriculum') }}">
            <i class="fa fa-plus-circle"></i> Add New
          </a>
        </div>

        <!-- Table -->
        <div class="table-responsive">
          <table class="table table-bordered table-striped">
            <thead class="thead-dark">
              <tr>
                <th width="5%">S.N.</th>
                <th width="20%">Grade</th>
                <th>Subjects</th>
                <th width="10%">Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse($data as $key => $row)
                <tr>
                  <td>{{ $key + 1 }}</td>
                  <td>{{ $row->grade }}</td>
                  <td>
                    @php
                      $subjects = \App\Models\SettingCurriculum::where('grade', $row->grade)->pluck('subjects');
                    @endphp

                    @foreach($subjects as $sub)
                      <span class="badge badge-info">{{ $sub }}</span>
                    @endforeach
                  </td>
                  <td>
                    <form action="{{ route('delete-curriculum', $row->grade) }}"
                            method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this grade and all its subjects?');"
                            style="display:inline-block;">

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
                  <td colspan="4" class="text-center">No data found</td>
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

<!-- EDIT MODAL -->
<!-- <div class="modal fade" id="editModal" tabindex="-1">
  <div class="modal-dialog modal-sm">
    <div class="modal-content" id="editModalContent">
    </div>
  </div>
</div> -->

@endsection
<script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
<script src="{{ asset('assets/vendors/js/vendor.bundle.addons.js') }}"></script>

<!-- =================== SCRIPTS (INSIDE SAME BLADE) =================== -->
<script>
$(document).ready(function () {

  /* Load modal content via AJAX */
  $(document).on('click', '[data-toggle="modal"]', function (e) {
    e.preventDefault();

    let url = $(this).data('url');
    let target = $(this).attr('href') === '#addModal'
        ? '#addModalContent'
        : '#editModalContent';

    if (url) {
        $(target).html('<div class="text-center p-5">Loading...</div>');
        $(target).load(url);
    }
});


  /* Add subject input */
  $(document).on('click', '.add-subject', function () {
    $('#subject-wrapper').append(`
      <div class="input-group mb-2">
        <input type="text" name="subjects[]" class="form-control" required>
        <div class="input-group-append">
          <button type="button" class="btn btn-danger remove-subject">
            <i class="fa fa-minus"></i>
          </button>
        </div>
      </div>
    `);
  });

  /* Remove subject input */
  $(document).on('click', '.remove-subject', function () {
    $(this).closest('.input-group').remove();
  });

});
</script>
