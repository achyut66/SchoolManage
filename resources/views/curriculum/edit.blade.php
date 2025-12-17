<div class="modal-header">
  <h5 class="modal-title">Edit Grade</h5>
  <button type="button" class="close" data-dismiss="modal">
    <span>&times;</span>
  </button>
</div>

<form action="{{ route('update-grade', $grade) }}" method="POST">
  @csrf
  @method('PUT')

  <div class="modal-body">

    <div class="form-group">
      <label>Grade</label>
      <input type="text"
             class="form-control"
             name="grade"
             value="{{ $grade ?? '' }}"
             readonly>
    </div>

    <div class="form-group">
      <label>Subjects</label>

      <div id="subject-wrapper">
        @forelse($subjects as $subject)
          <div class="input-group mb-2">
            <input type="text"
                   name="subjects[]"
                   class="form-control"
                   value="{{ $subject }}">

            <div class="input-group-append">
              <button type="button" class="btn btn-danger remove-subject">
                −
              </button>
            </div>
          </div>
        @empty
          <input type="text" name="subjects[]" class="form-control">
        @endforelse
      </div>

    </div>

  </div>

  <div class="modal-footer">
    <button class="btn btn-success btn-sm btn-block">Update</button>
  </div>
</form>
