<div class="modal-header">
    <h5 class="modal-title">Add Grade</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<form class="forms-sample" action="{{ route('save-grade') }}" method="POST">
    @csrf

    <div class="modal-body">

        {{-- Grade Name --}}
        <div class="form-group">
            <label>
                Grade Name <i class="fa fa-asterisk text-danger"></i>
            </label>
            <input type="text" class="form-control" name="name" required>
        </div>

        {{-- Multiple Grade Inputs --}}
        <label>
            Sections <i class="fa fa-asterisk text-danger"></i>
        </label>

        <div id="grade-wrapper">

            <div class="input-group mb-2">
                <input type="text" name="sections[]" class="form-control" placeholder="Enter sections" required>
                <div class="input-group-append">
                    <button type="button" class="btn btn-success add-grade">
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>

        </div>

    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-sm btn-block btn-success">
            Submit
        </button>
    </div>
</form>
<script>
$(document).on('click', '.add-grade', function () {
    let html = `
        <div class="input-group mb-2">
            <input type="text" name="sections[]" class="form-control" placeholder="Enter sections" required>
            <div class="input-group-append">
                <button type="button" class="btn btn-danger remove-grade">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
    `;
    $('#grade-wrapper').append(html);
});

$(document).on('click', '.remove-grade', function () {
    $(this).closest('.input-group').remove();
});
</script>
