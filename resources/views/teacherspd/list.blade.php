@extends('layouts.master')
@section('content')

<div class="row">
  <div class="col-lg-12">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb breadcrumb-custom">
        <li class="breadcrumb-item"><a href="{{ URL :: to('/dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ URL :: to('/teachers-personal-detail') }}">Add new details</a></li>
        <li class="breadcrumb-item active" aria-current="page"><span>Teachers detail</span></span></li>
      </ol>
    </nav>
    <div class="card">
      @if ($message = Session::get('success'))
      <div class="alert alert-success">
        <p>{{ $message }}</p>
      </div>
      @endif
        <div class="card-title mb-2">
          <a class="btn btn-sm btn-dark" href="{{ route('teachers-personal-detail')}}" ><i class="fa fa-plus-circle"></i> Add new teacher</a>
          <a class="btn btn-sm btn-success" href="#frmadd" data-toggle="modal" data-url="{{route('import-teacher-details')}}"
            data-id=""><i class="fa fa-file-excel-o"></i> Import</a>
        </div>
        <hr>
        <form action="{{ route('teacher-search') }}" method="post" class="search-form">
        @csrf
          <div class="row">
            <!-- <div class="col-md-2">
              <select name="schoolID" class="form-control select2" id="">
                <option value="">विद्यालय  छानुहोस</option>
                @if(!empty($schools))
                @foreach($schools as $key => $school)
                <option value="{{ $school->id }}">{{ $school->school_name }}</option>
                @endforeach
                @endif
              </select>
            </div> -->

            <!-- Sthai Asthai Search For Teacher List -->
            <div class="col-md-2">
              <select name="statusID" class="form-control select2" id="">
                <option value="">Status</option>
                <option value="1">Permanent</option>
                <option value="2">Temporary</option>
              </select>
            </div>

            <div class="col-md-2">
              <input type="text" name="name" class="form-control" placeholder="Name">
            </div>
            <div class="col-md-2">
              <input type="text" name="licenceNo" class="form-control" placeholder="License No">
            </div>
            <div class="col-md-2"><button type="submit" class="btn btn-danger btn-sm mt-1 search-btn" id="search-btn"><i class="fa fa-search"></i> Search</button>
            </div>
            <div class="col-md-2" id="print">
              <a href="{{ route('teacherpd-prints')}}" class="btn btn-primary btn-sm mt-1"><i class="fa fa-print"> Print</i></a>
              <a href="{{route('teachers-details-export')}}" class="btn btn-warning btn-sm mt-1"><i class="fa fa-file-excel-o" aria-hidden="true"> Excel</i></a>
            </div>
          </div>
        </form>
        <hr>
        <div class="details">
          <table class="rtable">
            <thead>
              <tr>
                <th>S.n.</th>
                <th>Teacher Code</th>
                <th>Academic Year</th>
                <th>Full Name</th>
                <th>Teacher's Cit No.</th>
                <th>License No.</th>
                <th>PAN No. </th>
                <th>Contact No. </th>
                <th>Status </th>
                <th>#</th> 
              </tr>
            </thead>
            <tbody>
              @if (!empty($data))
              @php $i=1; @endphp
              @foreach($data as $key => $title)
              <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $title->unique_id }}</td>
                <td>{{ $title->academic_year }}</td>
                <td>{{ $title->teachers_name_eng}}</td>
                <td>{{ $title->teachers_citno }}</td>
                <td>{{ $title->teachers_teacher_licenseno }}</td>
                <td>{{ $title->teachers_panno }}</td>
                <td>{{ $title->teachers_mobno}}</td>
                <td><p class="btn btn-{{  $title->teacher_enroll_status == 1 ? 'success' : 'danger' }} btn-rounded btn-fw btn-sm">{{  $title->teacher_enroll_status == 1 ? 'Permanent' : 'Temporary' }}</p></td>
                <td>

                  <a class="btn btn-sm btn-info btn-rounded" href="{{ URL('teachers-personal-detail-edit',$title->id)}}">
                    <i class="fa fa-pencil"></i>
                  </a>

                  <a class="btn btn-sm btn-secondary btn-rounded" href="{{ URL('teachers-profile-detail',$title->id)}}">
                    <i class="fa fa-eye"></i>
                  </a>

                  <a class="btn btn-sm btn-warning btn-rounded open-leave-modal"
                    style="margin-top:5px;"
                    title="Is On leave"
                    href="javascript:void(0);"
                    data-id="{{ $title->id }}"
                    data-acyear="{{ $title->academic_year }}"
                    data-name="{{ $title->teachers_name_eng }}">
                    <i class="fa fa-file"></i>
                  </a>


                  <form action="{{ URL('disable-teacher-information',$title->id)}}"
                        method="POST"
                        onsubmit="return confirm('Are you sure you want to remove teachers record ?');"
                        style="display:inline-block;">
                      @csrf
                      <button type="submit" class="btn btn-sm btn-danger btn-rounded" style="margin-top:5px;">
                          <i class="fa fa-close"></i>
                      </button>
                  </form>

                </td>
              </tr>
              @endforeach
              @endif
            </tbody>
          </table>
          <hr style="background-color:brown">
          <!-- pagination -->
          <div class="d-flex justify-content-center mt-3">
            {{ $data->links('vendor.pagination.prev-next') }}
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- modal -->
   <!-- Teacher Leave Modal -->
<div class="modal fade" id="teacherLeaveModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Teacher Leave</h5>
        <button type="button" class="close" data-dismiss="modal">
          <span>&times;</span>
        </button>
      </div>

      <form action="{{ route('teacher-leave-save') }}" method="POST">
        @csrf
        
        <input type="hidden" name="teachers_id" id="teachers_id">
        <input type="hidden" name="academic_year" id="academic_year">

        <div class="modal-body">
          <p><strong>Teacher:</strong> <span id="teacher_name"></span></p>

          <div class="form-group">
            <label>Leave From</label>
            <input type="date" name="leave_from" class="form-control" required>
          </div>

          <div class="form-group">
            <label>Leave To</label>
            <input type="date" name="leave_to" class="form-control" required>
          </div>

          <div class="form-group">
            <label>Reason</label>
            <textarea name="reason" class="form-control" rows="3"></textarea>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary btn-sm">Save</button>
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
        </div>
      </form>

    </div>
  </div>
</div>
<!-- ends here -->
@yield('script')
<script src="{{ asset('assets/js/search.js') }}"></script>
<script>
  $(document).ready(function(){
    $(document).on("click",'#search-btn',function(){
      $("#print").hide();
    });
  });
  // modal
  $(document).on('click', '.open-leave-modal', function () {
    let teacherId = $(this).data('id');
    let teacherName = $(this).data('name');
    let academicYear = $(this).data('acyear');

    $('#teachers_id').val(teacherId);
    $('#teacher_name').text(teacherName);
    $('#academic_year').val(academicYear);

    $('#teacherLeaveModal').modal('show');
});
</script>
<!-- content-wrapper ends -->
@endsection

