{{-- function to show active sidebar page --}}
@php
  // use Illuminate\Support\Facades\Request;
  // use Illuminate\Support\Facades\Route;
  // use Illuminate\Support\Facades\Auth;
  $prefix=Request::route()->getprefix();
  $route=Route::current()->getName();
@endphp
<aside>
  <div class="top">
      <div class="logo">
            <a href="{{route('dashboard')}}">
                <img class="logo" src="{{ asset('assets/assets/images/logo/logo.png') }}" alt="logo">
            </a>
            <h2>EDUS<span class="primary">YS360</span></h2>
      </div>
      <div class="close" id="close-btn">
          <span class="material-symbols-sharp">close</span>
      </div>
  </div>
  <div class="sidebar">
    <div class="sidebar-menu">
      <a href="{{ route('dashboard') }}" class="{{ ($route=='dashboard')?'active':'' }}">
          <span class="material-symbols-sharp">home</span>
          <h3>Dashboard</h3>
      </a>
    </div>
    <!-- USER MANAGEMENT -->
    @if(Auth::user()->role=='Admin')
    <div class="sidebar-menu">
      <a href="#" class="toggle-btn {{ ($prefix=='/users')?'active':'' }}">
        <span class="material-symbols-sharp">manage_accounts</span>
        <h3>Manage Users</h3>    
        <span class="material-symbols-sharp expand-btn">expand_more</span>
      </a>
      <div class="sub-menu">
        <a href="{{ route('view.user') }}">
          <span class="material-symbols-sharp">chevron_right</span>
          <h3>View Users</h3>
        </a>
        <a href="{{ route('add.user') }}">
          <span class="material-symbols-sharp">chevron_right</span>
          <h3>Add User</h3>
        </a>
      </div>
    </div>
    @endif
    <!-- SYSTEM MANAGEMENT -->
    <div class="sidebar-menu">
      <a href="#" class="toggle-btn {{ ($prefix=='/system')?'active':'' }}">
          <span class="material-symbols-sharp">widgets</span>
          <h3>Manage System</h3>
          <span class="material-symbols-sharp expand-btn">expand_more</span>
      </a>
      <div class="sub-menu">
        <a href="{{ route('view.year') }}">
            <span class="material-symbols-sharp">chevron_right</span>
            <h3>School Year</h3>
        </a>
        <a href="{{ route('view.subjects') }}">
          <span class="material-symbols-sharp">chevron_right</span>
          <h3>Course</h3>
        </a>
        <a href="{{ route('view.class') }}">
          <span class="material-symbols-sharp">chevron_right</span>
          <h3>Classroom</h3>
          </a>
        <a href="{{ route('view.assign.subjects') }}">
          <span class="material-symbols-sharp">chevron_right</span>
          <h3>Assign Subjects</h3>
        </a>
        <a href="{{ route('view.exam.model') }}">
          <span class="material-symbols-sharp">chevron_right</span>
          <h3>Exam</h3>
        </a>
        <a href="{{ route('view.fee.category') }}">
          <span class="material-symbols-sharp">chevron_right</span>
          <h3>Fee Categories</h3>
        </a>
        <a href="{{ route('view.fee.amount') }}">
          <span class="material-symbols-sharp">chevron_right</span>
          <h3>Fee Amounts</h3>
        </a>
        <a href="{{ route('view.designation') }}">
          <span class="material-symbols-sharp">chevron_right</span>            
          <h3>Designation</h3>
        </a>
      </div>
    </div>
    <!-- STUDENT MANAGEMENT -->
    <div class="sidebar-menu">
      <a href="#" class="toggle-btn {{ ($prefix=='/student')?'active':'' }}">
        <span class="material-symbols-sharp">school</span>
        <h3>Manage Student</h3>    
        <span class="material-symbols-sharp expand-btn">expand_more</span>
      </a>
      <div class="sub-menu">
        <a href="{{ route('view.student.registration') }}">
          <span class="material-symbols-sharp">chevron_right</span>
          <h3>Register Student</h3>
        </a>
        <a href="{{ route('view.admission.fee') }}">
          <span class="material-symbols-sharp">chevron_right</span>
          <h3>Admission Fee</h3>
        </a>
        <a href="{{ route('view.monthly.fee') }}">
          <span class="material-symbols-sharp">chevron_right</span>
          <h3>Monthly Fee</h3>
        </a>
        <a href="{{ route('view.exam.fee') }}">
          <span class="material-symbols-sharp">chevron_right</span>
          <h3>Exam Fee</h3>
        </a>
      </div>
    </div> 
    <!-- EMPLOYEE MANAGEMENT-->
    <div class="sidebar-menu">
      <a href="#" class="toggle-btn {{ ($prefix=='/employee')?'active':'' }}">
        <span class="material-symbols-sharp">group</span>
        <h3>Manage Employee</h3>    
        <span class="material-symbols-sharp expand-btn">expand_more</span>
      </a>
      <div class="sub-menu">
        <a href="{{ route('view.employee') }}">
          <span class="material-symbols-sharp">chevron_right</span>
          <h3>Register Employee</h3>
        </a>
        <a href="{{ route('view.employee.salary') }}">
          <span class="material-symbols-sharp">chevron_right</span>
          <h3>View Salary</h3>
        </a>
        <a href="{{ route('view.employee.leave') }}">
          <span class="material-symbols-sharp">chevron_right</span>
          <h3>Manage Leave</h3>
        </a>
        <a href="{{ route('view.employee.attendance') }}">
          <span class="material-symbols-sharp">chevron_right</span>
          <h3>Attendance Record</h3>
        </a>
        <a href="{{ route('view.employee.monthly.salary') }}">
          <span class="material-symbols-sharp">chevron_right</span>
          <h3>Employee Salary</h3>
        </a>
      </div>
    </div> 
    <!-- Exam Management-->
    <div class="sidebar-menu">
      <a href="#" class="toggle-btn {{ ($prefix=='/exam')?'active':'' }}">
        <span class="material-symbols-sharp">quiz</span>
        <h3>Manage Exams</h3>    
        <span class="material-symbols-sharp expand-btn">expand_more</span>
      </a>
      <div class="sub-menu">
        <a href="{{ route('add.exam.marks') }}">
          <span class="material-symbols-sharp">chevron_right</span>
          <h3>Add Exam Marks</h3>
        </a>
        <a href="{{ route('add.grade.point') }}">
          <span class="material-symbols-sharp">chevron_right</span>
          <h3>Add Grade Point</h3>
        </a>
      </div>
    </div> 
    <!-- Finance Management -->
    <div class="sidebar-menu">
      <a href="#" class="toggle-btn {{ ($prefix=='/finance')?'active':'' }}">
        <span class="material-symbols-sharp">payments</span>
        <h3>Manage Finance</h3>    
        <span class="material-symbols-sharp expand-btn">expand_more</span>
      </a>
      <div class="sub-menu">
        <a href="{{ route('view.student.fee') }}">
          <span class="material-symbols-sharp">chevron_right</span>
          <h3>Student Fee</h3>
        </a>
        <a href="{{ route('view.finance.employee.salary') }}">
          <span class="material-symbols-sharp">chevron_right</span>
          <h3>Employee Salary</h3>
        </a>
        <a href="{{ route('view.miscellaneous.cost') }}">
          <span class="material-symbols-sharp">chevron_right</span>
          <h3>Miscellaneous Cost</h3>
        </a>
      </div>
    </div> 
    <!-- Reporting & Analytics Management -->
    <div class="sidebar-menu">
      <a href="#" class="toggle-btn {{ ($prefix=='/analytics')?'active':'' }}">
        <span class="material-symbols-sharp">monitoring</span>
        <h3>Report & Analytics</h3>    
        <span class="material-symbols-sharp expand-btn">expand_more</span>
      </a>
      <div class="sub-menu">
        <a href="{{ route('view.profit') }}">
          <span class="material-symbols-sharp">chevron_right</span>
          <h3>Account Report</h3>
        </a>
        <a href="{{ route('view.marksheet') }}">
          <span class="material-symbols-sharp">chevron_right</span>
          <h3>Student Marksheet</h3>
        </a>
      </div>
    </div> 
    <a href="{{ route('user.logout') }}">
      <span class="material-symbols-sharp">logout</span>
      <h3>Sign Out</h3>
    </a>
  </div>
  <div  id="overlay"></div>
</aside>
<!-- CUSTOM JS -->
<script type="text/javascript">
  $(document).ready(function(){
      $('.toggle-btn').click(function(){
          $(this).next('.sub-menu').slideToggle();
      });
  });
</script>