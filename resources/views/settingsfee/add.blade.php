<div class="modal-header">
  <h5 class="modal-title">Add Student Fee</h5>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>

<form action="{{ route('save-studentfee') }}" method="POST">
  @csrf

  <div class="modal-body">

    <!-- Grade -->
    <div class="form-group">
      <label>Grade <span class="text-danger">*</span></label>
      <select name="grade_id" class="form-control" required>
        <option value="">-- Select Grade --</option>
        @foreach($grades as $grade)
          <option value="{{ $grade->id }}">{{ $grade->name }}</option>
        @endforeach
      </select>
    </div>

    <!-- Fee Rows -->
    <label>Fee Details <span class="text-danger">*</span></label>

    <div id="fee-wrapper">

      <div class="fee-row mb-2">
        <div class="input-group">
          <input type="text" name="fee_name[]" class="form-control" placeholder="Fee Name" required>
          <input type="number" name="fee_amount[]" class="form-control" placeholder="Amount" required>

          <div class="input-group-append">
            <button type="button" class="btn btn-success add-row">
              <i class="fa fa-plus"></i>
            </button>
          </div>
        </div>
      </div>

    </div>
  </div>

  <div class="modal-footer">
    <button type="submit" class="btn btn-success btn-sm btn-block">
      Save
    </button>
  </div>
</form>
