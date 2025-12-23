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
       <div class="main-menu-name">
          All Records
       </div>
       <hr style="height: 1px; border-color: yellow;width:200px;">
       <li class="nav-item">
         <a class="nav-link font-weight-bold" data-toggle="collapse" href="#teacher_record_settings" aria-expanded="false"
           aria-controls="pages">
           <i class="fa fa-file"></i> &nbsp; Teacher's Record
           &nbsp;<i class="fa fa-angle-down"></i>
         </a>
         <div class="collapse" id="teacher_record_settings">
           <ul class="nav flex-column sub-menu">
             <li class="nav-item"> <a class="nav-link" href="{{ route('teachers-personal-list') }}"><i
                   class="fa fa-hand-o-right"></i>&nbsp; Teacher's List</a></li>
                   <li class="nav-item"> <a class="nav-link" href="{{ route('teachers-as-type') }}"><i
                   class="fa fa-hand-o-right"></i>&nbsp; Filter Teacher's Data</a></li>
                   <!-- <li class="nav-item"> <a class="nav-link" href="{{ route('curriculum') }}"><i
                   class="fa fa-hand-o-right"></i>&nbsp; Teacher's As Grade</a></li>
                   <li class="nav-item"> <a class="nav-link" href="{{ route('curriculum') }}"><i
                   class="fa fa-hand-o-right"></i>&nbsp; Teacher's As Subject</a></li> -->
           </ul>
         </div>
       </li>
       <!-- <li class="nav-item">
         <a class="nav-link font-weight-bold" href="{{ route('teachers-personal-list') }}">
           <i class="fa fa-address-book"></i> &nbsp; Teacher's Record
         </a>
       </li> -->
       <li class="nav-item">
       <a class="nav-link font-weight-bold" data-toggle="collapse" href="#student_record_settings" aria-expanded="false"
           aria-controls="pages">
           <i class="fa fa-file"></i> &nbsp; Student's Record
           &nbsp;<i class="fa fa-angle-down"></i>
         </a>
         <div class="collapse" id="student_record_settings">
           <ul class="nav flex-column sub-menu">
             <li class="nav-item"> <a class="nav-link" href="{{ route('student-parent-list') }}"><i
                   class="fa fa-hand-o-right"></i>&nbsp; Student's List</a></li>
                   <li class="nav-item"> <a class="nav-link" href="{{ route('students-record-transfer') }}"><i
                   class="fa fa-hand-o-right"></i>&nbsp; Student's Transfer</a></li>
                   <li class="nav-item"> <a class="nav-link" href="{{ route('student-result-list') }}"><i
                   class="fa fa-hand-o-right"></i>&nbsp; Student's Result</a></li>
           </ul>
         </div>
       </li>
       <li class="nav-item">
       <a class="nav-link font-weight-bold" data-toggle="collapse" href="#transfer_record_settings" aria-expanded="false"
           aria-controls="pages">
           <i class="fa fa-file"></i> &nbsp; Transfer Record
           &nbsp;<i class="fa fa-angle-down"></i>
         </a>
         <div class="collapse" id="transfer_record_settings">
           <ul class="nav flex-column sub-menu">
             <li class="nav-item"> <a class="nav-link" href="{{ route('get-student-data-migration') }}"><i
                   class="fa fa-hand-o-right"></i>&nbsp; Student's Transfer</a></li>
                   <!-- <li class="nav-item"> <a class="nav-link" href="{{ route('students-record-transfer') }}"><i
                   class="fa fa-hand-o-right"></i>&nbsp; Student's Transfer</a></li> -->
           </ul>
         </div>
       </li>
       <li class="nav-item">
         <a class="nav-link font-weight-bold" href="{{ route('parents-information') }}">
           <i class="fa fa-file"></i> &nbsp; Parent's Record
         </a>
       </li>

       <!-- account section -->
       <div class="main-menu-name">
          Financial Accounting
       </div>
       <hr style="height: 1px; border-color: yellow;width:200px;">
       <li class="nav-item">
         <a class="nav-link font-weight-bold" data-toggle="collapse" href="#account_record_settings" aria-expanded="false"
           aria-controls="pages">
           <i class="fa fa-file"></i> &nbsp; Account Fees/Salary
           &nbsp;<i class="fa fa-angle-down"></i>
         </a>
         <div class="collapse" id="account_record_settings">
           <ul class="nav flex-column sub-menu">
             <li class="nav-item"> <a class="nav-link" href="{{ route('students-fee-collection') }}"><i
                   class="fa fa-hand-o-right"></i>&nbsp; Students Account</a></li>
                   <li class="nav-item"> <a class="nav-link" href="{{ route('paid-student-details') }}"><i
                   class="fa fa-hand-o-right"></i>&nbsp; Student's Ledger</a></li>
                   <hr style="border:2px solid black; width:100px;">
                   <li class="nav-item"> <a class="nav-link" href="{{ route('curriculum') }}"><i
                   class="fa fa-hand-o-right"></i>&nbsp; Teacher's Account</a></li>
                   <li class="nav-item"> <a class="nav-link" href="{{ route('curriculum') }}"><i
                   class="fa fa-hand-o-right"></i>&nbsp; Teacher's Ledger</a></li>
           </ul>
         </div>
       </li>
       <!-- account section ends here -->

       <div class="main-menu-name">
          All Settings
       </div>
       <hr style="height: 1px; border-color: yellow;width:200px;">
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
                   <li class="nav-item"> <a class="nav-link" href="{{ route('curriculum') }}"><i
                   class="fa fa-hand-o-right"></i>&nbsp; Curriculum</a></li>
           </ul>
         </div>
       </li>

       <!-- account setting -->
       <li class="nav-item">
         <a class="nav-link font-weight-bold" data-toggle="collapse" href="#account_settings" aria-expanded="false"
           aria-controls="pages">
           <i class="fa fa-cogs"></i> &nbsp; Account Settings
           &nbsp;<i class="fa fa-angle-down"></i>
         </a>
         <div class="collapse" id="account_settings">
           <ul class="nav flex-column sub-menu">
             <li class="nav-item"> <a class="nav-link" href="{{ route('studentfee') }}"><i
                   class="fa fa-hand-o-right"></i>&nbsp; Student's Fee</a></li>
                   <li class="nav-item"> <a class="nav-link" href="{{ route('curriculum') }}"><i
                   class="fa fa-hand-o-right"></i>&nbsp; Teacher's Salary</a></li>
           </ul>
         </div>
       </li>
       <!-- ends here -->

       <div class="main-menu-name">
          User's Management
       </div>
       <hr style="height: 1px; border-color: yellow;width:200px;">
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
       <div class="main-menu-name">
          Profile Setting
       </div>
       <hr style="height: 1px; border-color: yellow;width:200px;">
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