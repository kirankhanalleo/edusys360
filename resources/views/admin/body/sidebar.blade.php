<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="{{route('dashboard')}}"> <img alt="image" src="{{ asset('assets/img/logo.png') }}" class="header-logo" /> <span
        class="logo-name">Edusys360</span>
      </a>
    </div>
    <ul class="sidebar-menu">
      <li class="menu-header">Main</li>
      <li class="dropdown active">
        <a href="{{ route('dashboard') }}" class="nav-link"><i data-feather="home"></i>
          <span>Dashboard</span></a>
      </li>
      <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown"><i
          data-feather="users"></i><span>Manage Users</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="{{ route('view.user') }}">View Users</a></li>
          <li><a class="nav-link" href="{{ route('add.user') }}">Add User</a></li>
        </ul>
      </li>
      <li class="menu-header">User Interface</li>
      <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="copy"></i><span>Basic
          Components</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="alert.html">Alert</a></li>
          <li><a class="nav-link" href="badge.html">Badge</a></li>
          <li><a class="nav-link" href="breadcrumb.html">Breadcrumb</a></li>
          <li><a class="nav-link" href="buttons.html">Buttons</a></li>
        </ul>
      </li>
    </ul>  
  </aside>
</div>