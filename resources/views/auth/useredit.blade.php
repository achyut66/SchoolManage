@extends('layouts.master')
@section('content')

<div class="row">
  <div class="col-lg-12">
    <nav aria-label="breadcrumb card-header">
      <ol class="breadcrumb breadcrumb-custom">
        <li class="breadcrumb-item"><a href="{{ URL :: to('/dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ URL :: to('/users') }}">User List</a></li>
        <li class=" breadcrumb-item active" aria-current="page"><span></span> Edit User </li>
      </ol>
    </nav>
    <form method="post" action="{{ route('update-user', $user->id) }}" class="sky-form">
      @csrf
      <header>Edit User details</header>
      <fieldset>
        <div class="row">
          <section class="col col-6">
            <label><b>User Name<span class="text-danger">*</span></b></label>
            <div class="input">
              <i class="icon-append fa fa-info-circle"></i>
              <input type="text" class="form-control" name="name" placeholder="" value="{{ $user->name }}">
            </div>
            @if ($errors->has('name'))
            <span class="text-danger">{{ $errors->first('name') }}</span>
            @endif
          </section>
          <section class="col col-6">
            <label><b>Email Address</b><span class="text-danger">*</span></label>
            <div class="input">
              <i class="icon-append icon-envelope-alt"></i>
              <input type="email" class="form-control" name="email" placeholder="" value = "{{ $user->email }}">
            </div>
            @if ($errors->has('email'))
            <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
          </section>
          <section class="col col-6">
            <label><b>Contact Number</b><span class="text-danger">*</span></label>
            <div class="input">
              <i class="icon-append fa fa-phone"></i>
              <input type="number" class="form-control" name="phone" placeholder="" value ="{{ $user->phone }}">
            </div>
            @if ($errors->has('phone'))
            <span class="text-danger">{{ $errors->first('phone') }}</span>
            @endif
          </section>

          <section class="col col-6">
            <label><b>Post </b><span class="text-danger">*</span></label>
            <div class="input">
              <i class="icon-append fa fa-info-circle"></i>
              <input type="text" class="form-control" name="designation" placeholder="" value="{{ $user->designation }}">
            </div>
            @if ($errors->has('designation'))
            <span class="text-danger">{{ $errors->first('designation') }}</span>
            @endif
          </section>
        </div>
      </fieldset>
      <fieldset>
        <div class="row">
        <section class="col col-3">
            <label><b>Section </b><span class="text-danger">*</span></label>
            <div class="select">
              <select class="form-control" name="shakha_id">
                <option value=""> --Select--</option>
                @if (!empty($shakhas))
                @foreach($shakhas as $shakha)
                <option value="{{ $shakha->id }}" {{$user->shakha_id == $shakha->id  ? 'selected' : ''}}>{{$shakha->name}}</option>
                @endforeach
                @endif
              </select>
              <i></i>
            </div>
            @if ($errors->has('role'))
            <span class="text-danger">{{ $errors->first('role') }}</span>
            @endif
          </section>
          <section class="col col-3">
            <label><b>Role </b><span class="text-danger">*</span></label>
            <div class="select">
              <select class="form-control" name="role_id">
                <option value=""> --Select--</option>
                @if (!empty($roles))
                @foreach($roles as $role)
                <option value="{{ $role->id }}" {{$user->role_id == $role->id  ? 'selected' : ''}}>{{$role->name}}</option>
                @endforeach
                @endif
              </select>
              <i></i>
            </div>
            @if ($errors->has('role'))
            <span class="text-danger">{{ $errors->first('role') }}</span>
            @endif
          </section>
          <section class="col col-3">
            <label><b>User ID</b><span class="text-danger">*</span></label>
            <div class="input">
              <i class="icon-append fa fa-square "></i>
              <input type="text" class="form-control" name="username" placeholder="" value=" {{ $user->username }}">
            </div>
            @if ($errors->has('username'))
            <span class="text-danger">{{ $errors->first('username') }}</span>
            @endif
          </section>
          <section class="col col-3">
            <label><b>Password </b><span class="text-danger">*</span></label>
            <div class="input">
              <i class="icon-append fa fa-key"></i>
              <input type="password" class="form-control" name="password" placeholder="">
            </div>
            @if ($errors->has('password'))
            <span class="text-danger">{{ $errors->first('password') }}</span>
            @endif
          </section>
      </fieldset>
      <footer>
        <button type="submit" class="button">Submit</button>
      </footer>
    </form>
  </div>
</div>
<!-- content-wrapper ends -->
@endsection