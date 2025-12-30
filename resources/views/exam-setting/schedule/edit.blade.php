<div class="modal-header frmedit">
    <h5 class="modal-title">Edit Exam Schedule</h5>
    <button type="button" class="close" data-dismiss="modal">
        <span>&times;</span>
    </button>
</div>

<form action="{{route('update-schedule-setting', $schedule->id)}}" method="POST">
    @csrf

    <div class="modal-body" id="editExamScheduleModal">

        <input type="hidden" name="academic_year" value="{{ $schedule->academic_year }}">

        <div class="form-group">
            <label>Select Exam Type *</label>
            <select name="exam_id" class="form-control" required>
                <option value="">-- Select --</option>
                @foreach ($exams as $exam)
                    <option value="{{ $exam->id }}"
                        {{ $schedule->exam_id == $exam->id ? 'selected' : '' }}>
                        {{ $exam->exam_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Exam Start Date *</label>
            <input
                type="text"
                name="exam_start_date"
                class="form-control edit-flatpickr"
                value="{{ $schedule->exam_start_date }}"
                required
            >
        </div>

        <div class="form-group">
            <label>Exam End Date *</label>
            <input
                type="text"
                name="exam_end_date"
                class="form-control edit-flatpickr"
                value="{{ $schedule->exam_end_date }}"
                required
            >
        </div>

    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-success btn-sm btn-block">
            Update
        </button>
    </div>
</form>
<script>
flatpickr('.edit-flatpickr', {
    dateFormat: 'Y-m-d'
});
$('#editExamScheduleModal').on('shown.bs.modal', function () {
    flatpickr('.edit-flatpickr', {
        dateFormat: 'Y-m-d',
        allowInput: false
    });
});
</script>
