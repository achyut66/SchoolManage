<div class="modal-header">
    <h5 class="modal-title">Edit Grade</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form class="forms-sample" action="{{ route('update-exam-setting', $row->id) }}" method="POST">
    @csrf
    <div class="modal-body">
        {{-- Exam Name --}}
        <div class="form-group">
            <label>
                Exam Name <i class="fa fa-asterisk text-danger"></i>
            </label>
            <input type="text"
                   class="form-control"
                   name="exam_name"
                   value="{{ $row->exam_name }}"
                   required>
        </div>
    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-sm btn-block btn-success">
            Update
        </button>
    </div>
</form>
