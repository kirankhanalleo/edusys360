{{-- function to show active sidebar page --}}
@php
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
      <a href="{{ route('dashboard') }}" class="{{ ($route=='dashboard')?'active':'' }}">
          <span class="material-symbols-sharp">home</span>
          <h3>Dashboard</h3>
      </a>
      <a href="{{ route('view.year') }}" class="{{ ($prefix=='/academicyear')?'active':'' }}">
          <span class="material-symbols-sharp">calendar_month</span>
          <h3>School Year</h3>
      </a>
      <a href="{{ route('view.subjects') }}" class="{{ ($prefix=='/course')?'active':'' }}">
          <span class="material-symbols-sharp">library_books</span>
          <h3>Course</h3>
      </a>
      <a href="{{ route('view.class') }}" class="{{ ($prefix=='/class')?'active':'' }}">
          <span class="material-symbols-sharp">nest_multi_room</span>
          <h3>Classroom</h3>
      </a>
      <a href="{{ route('view.exam.model') }}" class="{{ ($prefix=='/exam')?'active':'' }}">
          <span class="material-symbols-sharp">quiz</span>
          <h3>Exam</h3>
      </a>
      <a href="{{ route('view.fee.category') }}" class="{{ ($prefix=='/fee')?'active':'' }}" >
          <span class="material-symbols-sharp">category</span>
          <h3>Fee Categories</h3>
      </a>
      <a href="{{ route('view.fee.amount') }}" class="{{ ($prefix=='/feeamount')?'active':'' }}" >
        <span class="material-symbols-sharp">payments</span>
        <h3>Fee Amounts</h3>
    </a>
      <a href="{{ route('view.user') }}" class="{{ ($prefix=='/users')?'active':'' }}" >
          <span class="material-symbols-sharp">manage_accounts</span>
          <h3>Users</h3>
          <span class="count">3</span>
      </a>
      <a href="{{ route('user.logout') }}">
          <span class="material-symbols-sharp">logout</span>
          <h3>Sign Out</h3>
      </a>
  </div>
  <div  id="overlay"></div>
</aside>