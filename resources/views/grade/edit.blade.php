<div class="modal-header">
    <h5 class="modal-title">Edit Grade</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<form class="forms-sample" action="{{ route('update-grade', $row->id) }}" method="POST">
    @csrf

    <div class="modal-body">

        {{-- Grade Name --}}
        <div class="form-group">
            <label>
                Grade <i class="fa fa-asterisk text-danger"></i>
            </label>
            <input type="text"
                   class="form-control"
                   name="name"
                   value="{{ $row->name }}"
                   required>
        </div>

        {{-- Sections --}}
        <label>
            Sections <i class="fa fa-asterisk text-danger"></i>
        </label>

        <div id="section-wrapper">

            {{-- Existing Sections --}}
            @forelse($row->sections as $section)
              <div class="input-group mb-2">
                  <input type="text"
                        name="sections[]"
                        class="form-control"
                        value="{{ $section->sections }}"
                        required>
                  <div class="input-group-append">
                      <button type="button" class="btn btn-danger remove-section">
                          <i class="fa fa-minus"></i>
                      </button>
                  </div>
              </div>
          @empty
              <div class="input-group mb-2">
                  <input type="text"
                        name="sections[]"
                        class="form-control"
                        placeholder="Enter section"
                        required>
                  <div class="input-group-append">
                      <button type="button" class="btn btn-success add-section">
                          <i class="fa fa-plus"></i>
                      </button>
                  </div>
              </div>
          @endforelse
        </div>
    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-sm btn-block btn-success">
            Update
        </button>
    </div>
</form>
<script>
$(document).on('click', '.add-section', function () {
    let html = `
        <div class="input-group mb-2">
            <input type="text" name="sections[]" class="form-control" placeholder="Enter section" required>
            <div class="input-group-append">
                <button type="button" class="btn btn-danger remove-section">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
    `;
    $('#section-wrapper').append(html);
});

$(document).on('click', '.remove-section', function () {
    $(this).closest('.input-group').remove();
});
</script>
