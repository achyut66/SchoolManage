<div class="modal-header">
    <h5 class="modal-title">Add Exam Schedule</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<form class="forms-sample" action="{{ route('save-schedule-setting') }}" method="POST">
    @csrf

    <div class="modal-body" id="examScheduleModal">
        <!-- exam name -->
         <input type="hidden" name="academic_year" value="{{$ac_year->academic_year}}">
        <div class="form-group">
            <label>
                Select Exam Type <i class="fa fa-asterisk text-danger"></i>
            </label>
           <select name="exam_id" class="form-control">
            <option value="">--select--</option>
            @foreach ($exams as $exam)
            <option value="{{$exam->id}}">{{ $exam->exam_name }}</option>
            @endforeach 
           </select>
        </div>

        <div class="form-group">
            <label>
                Exam Start Date <i class="fa fa-asterisk text-danger"></i>
            </label>
            <input type="text" name="exam_start_date" class="form-control flatpickr" placeholder="Select date">
        </div>

        <div class="form-group">
            <label>
                Exam End Date <i class="fa fa-asterisk text-danger"></i>
            </label>
            <input type="text" name="exam_end_date" class="form-control flatpickr" placeholder="Select date">
        </div>
    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-sm btn-block btn-success">
            Submit
        </button>
    </div>
</form>
<script>
flatpickr('.flatpickr', {
    dateFormat: 'Y-m-d'
});
$('#examScheduleModal').on('shown.bs.modal', function () {
    flatpickr('.flatpickr', {
        dateFormat: 'Y-m-d'
    });
});

</script>
