<!-- ADD MODAL -->
<div class="modal fade" id="frmadd" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Add Staff</h5>
        <button type="button" class="close" data-dismiss="modal">
          <span>&times;</span>
        </button>
      </div>

      <form class="forms-sample" action="" method="POST">
        @csrf

        <div class="modal-body">

          <div class="form-group">
            <label>Staff Full Name *</label>
            <input type="text" class="form-control" name="full_name" required>
          </div>

          <div class="form-group">
            <label>Address *</label>
            <input type="text" class="form-control" name="address" required>
          </div>

          <div class="form-group">
            <label>Contact Number *</label>
            <input type="text" class="form-control" name="contact_no" required>
          </div>

          <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" name="email">
          </div>

          <div class="form-group">
            <label>Post *</label>
            <input type="text" class="form-control" name="post" required>
          </div>

          <div class="form-group">
            <label>Salary *</label>
            <input type="number" class="form-control" name="salary" required>
          </div>

        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-success btn-sm">Submit</button>
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
        </div>
      </form>

    </div>
  </div>
</div>
