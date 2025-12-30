<div class="modal-header">
    <h5 class="modal-title">Add Exam Setting</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<form class="forms-sample" action="{{ route('save-exam-setting') }}" method="POST">
    @csrf

    <div class="modal-body">
        <!-- exam name -->
        <div class="form-group">
            <label>
                Exam Name <i class="fa fa-asterisk text-danger"></i>
            </label>
            <input type="text" class="form-control" name="exam_name" required>
        </div>
    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-sm btn-block btn-success">
            Submit
        </button>
    </div>
</form>
