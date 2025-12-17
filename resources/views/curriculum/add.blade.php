<div class="modal-header">
  <h5 class="modal-title">Add Curriculum</h5>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>

<form action="{{ route('save-curriculum') }}" method="POST">
  @csrf

  <div class="modal-body">

    <div class="form-group">
      <label>Grade <span class="text-danger">*</span></label>
      <select name="grade" class="form-control" required>
        <option value="">-- Select Grade --</option>
        @foreach($grades as $grade)
          <option value="{{ $grade }}">{{ $grade }}</option>
        @endforeach
      </select>
    </div>

    <div class="form-group">
      <label>Subjects <span class="text-danger">*</span></label>

      <div id="subject-wrapper">
        <div class="input-group mb-2">
          <input type="text" name="subjects[]" class="form-control" required>
          <div class="input-group-append">
            <button type="button" class="btn btn-success add-subject">
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
