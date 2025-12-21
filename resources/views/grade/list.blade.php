@extends('layouts.master')
@section('content')
<div class="row">
  <div class="col-lg-12">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb breadcrumb-custom">
        <li class="breadcrumb-item"><a href="{{ URL :: to('/dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page"><span>Grades</span></span></li>
      </ol>
    </nav>
    <div class="card">

      @if ($message = Session::get('success'))
      <div class="alert alert-success">
        <p>{{ $message }}</p>
      </div>
      @endif
      <div class="table-responsive">
        <div class="card-title">
          <a class="btn btn-sm btn-dark" href="#frmadd" data-toggle="modal" data-url="{{route('add-grade')}}"
            data-id=""><i class="fa fa-plus-circle"></i> Add New</a>
        </div><br>
        <table class="rtable">
          <thead>
            <tr>
              <th>S.N.</th>
              <th>Grade</th>
              <!-- <th>#</th> -->
            </tr>
          </thead>
          <tbody>
            @if (!empty($data))
            @php $i=1; @endphp
            @foreach($data as $key => $title)
            <tr>
              <td>{{ $i++ }}</td>
              <td>{{ $title->name }}</td>
              <!-- <td>
              <form action="{{ route('grade-destroy', $title->id) }}"
                  method="POST"
                  onsubmit="return confirm('Are you sure you want to delete this grade?');">
                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-sm btn-danger">
                    <i class="fa fa-trash"></i>
                </button>
            </form>

              </td> -->
            </tr>
            @endforeach
            @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</div>
<!-- content-wrapper ends -->
@endsection