   <!-- partial:partials/_sidebar.html -->
   <nav class="sidebar sidebar-offcanvas" id="sidebar">
     <ul class="nav">

       <li class="nav-item">
         <div class="profile">
         @if(!empty($palikaProfile) && !empty($palikaProfile->logo))
                <img src="{{ asset('storage/'.$palikaProfile->logo) }}" style="width:119px; height:100px;" alt="Palika Logo">
              @else
                <img src="{{ asset('assets/images/new_logo.png') }}" style="width:119px; height:100px;" alt="Logo">
              @endif
         </div>

       </li>
       <li class="nav-item">
         <a class="nav-link font-weight-bold active" href="{{route('dashboard')}}">
           <i class="fa fa-dashboard"></i>&nbsp; Dashboard
         </a>
       </li>
       <li class="nav-item">
         <a class="nav-link font-weight-bold" data-toggle="collapse" href="#settings" aria-expanded="false"
           aria-controls="pages">
           <i class="fa fa-cogs"></i> &nbsp; General Settings
           &nbsp;<i class="fa fa-angle-down"></i>
         </a>
         <div class="collapse" id="settings">
           <ul class="nav flex-column sub-menu">
             <li class="nav-item"> <a class="nav-link" href="{{ route('caste') }}"><i
                   class="fa fa-hand-o-right"></i>&nbsp; Caste</a></li>
             <li class="nav-item"> <a class="nav-link" href="{{ route('religion') }}"><i
                   class="fa fa-hand-o-right"></i>&nbsp; Religion</a></li>
             <li class="nav-item"> <a class="nav-link" href="{{ route('licenselevel') }}"><i
                   class="fa fa-hand-o-right"></i>&nbsp; License Grade </a></li>
             <!-- <li class="nav-item"> <a class="nav-link" href="{{ route('school-type') }}"><i
                   class="fa fa-hand-o-right"></i>&nbsp; विद्यालयको किसिम</a></li>-->
           </ul>
         </div>
       </li>
       <li class="nav-item">
         <a class="nav-link font-weight-bold" data-toggle="collapse" href="#school_settings" aria-expanded="false"
           aria-controls="pages">
           <i class="fa fa-cogs"></i> &nbsp; School Settings
           &nbsp;<i class="fa fa-angle-down"></i>
         </a>
         <div class="collapse" id="school_settings">
           <ul class="nav flex-column sub-menu">
             <li class="nav-item"> <a class="nav-link" href="{{ route('grade') }}"><i
                   class="fa fa-hand-o-right"></i>&nbsp; Grades</a></li>
             <!-- <li class="nav-item"> <a class="nav-link" href="{{ route('religion') }}"><i
                   class="fa fa-hand-o-right"></i>&nbsp; Religion</a></li>
             <li class="nav-item"> <a class="nav-link" href="{{ route('licenselevel') }}"><i
                   class="fa fa-hand-o-right"></i>&nbsp; License Grade </a></li> -->
             <!-- <li class="nav-item"> <a class="nav-link" href="{{ route('school-type') }}"><i
                   class="fa fa-hand-o-right"></i>&nbsp; विद्यालयको किसिम</a></li>-->
           </ul>
         </div>
       </li>

       <!-- <li class="nav-item">
         <a class="nav-link font-weight-bold" href="{{ route('school-details') }}">
           <i class="fa fa-university"></i> &nbsp; विद्यालय दर्ता
         </a>
       </li> -->

       <li class="nav-item">
         <a class="nav-link font-weight-bold" href="{{ route('teachers-personal-list') }}">
           <i class="fa fa-address-book"></i> &nbsp; Teacher's Record
         </a>
       </li>
       <li class="nav-item">
         <a class="nav-link font-weight-bold" href="{{ route('student-parent-list') }}">
           <i class="fa fa-users"></i> &nbsp; Student's Record
         </a>
       </li>
       @can('view-user')
       <li class="nav-item">
         <a class="nav-link font-weight-bold" data-toggle="collapse" href="#pages" aria-expanded="false"
           aria-controls="pages">
           <i class="fa fa-user"></i> &nbsp; User Management
           &nbsp;<i class="fa fa-angle-down"></i>
         </a>
         <div class="collapse" id="pages">
           <ul class="nav flex-column sub-menu">

             @can('view-role')
             <li class="nav-item"> <a class="nav-link" href="{{ URL :: to('/roles') }}"><i
                   class="fa fa-hand-o-right"></i>&nbsp; Role </a></li>
             @endcan
             @can('view-permission')
             <li class="nav-item"> <a class="nav-link" href="{{ route('modules') }}"><i
                   class="fa fa-hand-o-right"></i>&nbsp; Permission </a></li>
             @endcan
             @can('view-user')
             <li class="nav-item"> <a class="nav-link" href="{{ URL :: to('/users') }}"> <i
                   class="fa fa-hand-o-right"></i>&nbsp; User </a></li>
             @endcan


           </ul>
         </div>
       </li>

       @can('system-setup')
       <li class="nav-item">
         <a class="nav-link font-weight-bold" href="{{ route('system-config') }}">
           <i class="fa fa-cogs"></i> &nbsp; School Profile
         </a>
       </li>
       @endcan
       @endcan
       <li class="nav-item">
         <hr>
         <form method="POST" action="{{URL::to('logout')}}">
           @csrf
           <button type="submit" class="btn btn-danger btn-block btn-lg font-weight-medium auth-form-btn"><i class="fa fa-power-off"></i> &nbsp; Logout</button>
         </form>
       </li>
     </ul>
     <hr>
   </nav>