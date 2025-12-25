@extends('layouts.master')
@section('content')
<div class="row">
  <div class="col-lg-12">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb breadcrumb-custom">
        <li class="breadcrumb-item"><a href="{{ URL :: to('/dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page"><span>Religion</span></span></li>
      </ol>
    </nav>
    <div class="card">

      @if ($message = Session::get('success'))
      <div class="alert alert-success">
        <p>{{ $message }}</p>
      </div>
      @endif
      <div class="table-responsive">
        <div class="card-title">
          <a class="btn btn-sm btn-dark" href="#frmadd" data-toggle="modal"
            data-id=""><i class="fa fa-plus-circle"></i> Add New</a>
        </div><br>
        <table class="rtable">
          <thead>
            <tr>
              <th>S.N.</th>
              <th>Staff Name</th>
              <th>Contact Number</th>
              <th>Post</th>
              <th>Salary</th>
              <th>#</th>
            </tr>
          </thead>
          <tbody>
            @if (!empty($data))
            @php $i=1; @endphp
            @foreach($data as $key => $title)
            <tr>
              <td>{{ $i++ }}</td>
              <td>{{ $title->full_name }}</td>
              <td>{{ $title->contact_no }}</td>
              <td>{{ $title->post }}</td>
              <td>{{ $title->salary }}</td>
              <td>
              <a class="btn btn-sm btn-info"
                href="#frmedit"
                data-toggle="modal"
                data-id="{{ $title->id }}"
                data-full_name="{{ $title->full_name }}"
                data-academic_year="{{ $title->academic_year }}"
                data-contact_no="{{ $title->contact_no }}"
                data-email="{{ $title->email }}"
                data-address="{{ $title->address }}"
                data-post="{{ $title->post }}"
                data-salary="{{ $title->salary }}">
                <i class="fa fa-pencil"></i>
               </a>
             
              <a class="btn btn-sm btn-warning btn-rounded"
                  title="View Student Details"
                    href="{{ route('other-staff-make-payment', $title->id) }}">
                    <i class="fa fa-money"> Pay</i>
              </a>

              <a class="btn btn-sm btn-warning btn-rounded"
                  title="View Student Details"
                    href="{{ route('other-staff-ledger', $title->id) }}">
                    <i class="fa fa-file"> Ledger</i>
              </a>

              </td>
            </tr>
            @endforeach
            @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</div>
<!-- content-wrapper ends -->
<div class="modal fade" id="frmadd" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-md modal-dialog-centered" role="document">
    <div class="modal-content">

      <div class="modal-header bg-dark text-white py-2">
        <h6 class="modal-title mb-0">Add Other Staff</h6>
        <button type="button" class="close text-white" data-dismiss="modal">
          <span>&times;</span>
        </button>
      </div>

      <form method="POST" action="{{ route('other-staff-details-save') }}">
        @csrf

        <div class="modal-body">
         <input type="hidden" name="academic_year" value="{{ $ac_year->academic_year }}">
          <div class="row">
            <div class="col-md-12 mb-2">
              <label class="small font-weight-bold">Staff Full Name *</label>
              <input type="text" class="form-control form-control-sm" name="full_name" required>
            </div>

            <div class="col-md-6 mb-2">
              <label class="small font-weight-bold">Contact Number *</label>
              <input type="text" class="form-control form-control-sm" name="contact_no" required>
            </div>

            <div class="col-md-6 mb-2">
              <label class="small font-weight-bold">Email</label>
              <input type="email" class="form-control form-control-sm" name="email">
            </div>

            <div class="col-md-12 mb-2">
              <label class="small font-weight-bold">Address *</label>
              <input type="text" class="form-control form-control-sm" name="address" required>
            </div>

            <div class="col-md-6 mb-2">
              <label class="small font-weight-bold">Post *</label>
              <input type="text" class="form-control form-control-sm" name="post" required>
            </div>

            <div class="col-md-6 mb-2">
              <label class="small font-weight-bold">Salary *</label>
              <input type="number" class="form-control form-control-sm" name="salary" required>
            </div>
          </div>

        </div>

        <div class="modal-footer py-2">
          <button type="submit" class="btn btn-success btn-sm px-4">
            Save
          </button>
          <button type="button" class="btn btn-secondary btn-sm px-4" data-dismiss="modal">
            Cancel
          </button>
        </div>

      </form>

    </div>
  </div>
</div>
<!-- edit modal -->
 <!-- EDIT OTHER STAFF MODAL -->
<div class="modal fade" id="frmedit" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header bg-info text-white py-2">
        <h6 class="modal-title mb-0">Edit Other Staff</h6>
        <button type="button" class="close text-white" data-dismiss="modal">
          <span>&times;</span>
        </button>
      </div>

      <form method="POST" action="{{ route('other-staff-details-update') }}">
        @csrf
        <input type="text" name="id" id="edit_id">
        <input type="text" name="academic_year" id="edit_academic_year">
        <div class="modal-body">
          <div class="row">

            <div class="col-md-12 mb-2">
              <label class="small font-weight-bold">Staff Full Name *</label>
              <input type="text" class="form-control form-control-sm" name="full_name" id="edit_full_name" required>
            </div>

            <div class="col-md-6 mb-2">
              <label class="small font-weight-bold">Contact Number *</label>
              <input type="text" class="form-control form-control-sm" name="contact_no" id="edit_contact_no" required>
            </div>

            <div class="col-md-6 mb-2">
              <label class="small font-weight-bold">Email</label>
              <input type="email" class="form-control form-control-sm" name="email" id="edit_email">
            </div>

            <div class="col-md-12 mb-2">
              <label class="small font-weight-bold">Address *</label>
              <input type="text" class="form-control form-control-sm" name="address" id="edit_address" required>
            </div>

            <div class="col-md-6 mb-2">
              <label class="small font-weight-bold">Post *</label>
              <input type="text" class="form-control form-control-sm" name="post" id="edit_post" required>
            </div>

            <div class="col-md-6 mb-2">
              <label class="small font-weight-bold">Salary *</label>
              <input type="number" class="form-control form-control-sm" name="salary" id="edit_salary" required>
            </div>

          </div>
        </div>

        <div class="modal-footer py-2">
          <button type="submit" class="btn btn-info btn-sm px-4">Update</button>
          <button type="button" class="btn btn-secondary btn-sm px-4" data-dismiss="modal">Cancel</button>
        </div>

      </form>

    </div>
  </div>
</div>

@endsection
@push('scripts')
<script>
$('#frmedit').on('show.bs.modal', function (event) {
    let button = $(event.relatedTarget);

    $('#edit_id').val(button.data('id'));
    $('#edit_full_name').val(button.data('full_name'));
    $('#edit_contact_no').val(button.data('contact_no'));
    $('#edit_academic_year').val(button.data('academic_year'));
    $('#edit_email').val(button.data('email'));
    $('#edit_address').val(button.data('address'));
    $('#edit_post').val(button.data('post'));
    $('#edit_salary').val(button.data('salary'));
});
</script>
@endpush
