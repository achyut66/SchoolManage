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
              <th>#</th>
            </tr>
          </thead>
          <tbody>
            @if (!empty($data))
            @php $i=1; @endphp
            @foreach($data as $key => $title)
            <tr>
              <td>{{ $i++ }}</td>
              <td>{{ $title->name }}</td>
              <td>
              <a href="#frmedit" class="btn btn-sm btn-info" data-toggle="modal"
   data-url="{{ route('edit-grade', $title->id) }}"
   data-id="{{ $title->id }}">
    <i class="fa fa-pencil"></i>
</a>


              </td>
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