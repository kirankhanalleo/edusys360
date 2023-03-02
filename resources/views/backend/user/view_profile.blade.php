@extends('admin.admin_master')
@section('admin')

<link rel="stylesheet" href="{{ asset('assets/bundles/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">  
<style>
  .add-user{
    position: absolute;
    right:20px;
    margin-top:20px;
  }
</style>
<div class="main-content">
  <div class="col-12">
    <div class="card">
      <a href="{{ route('edit.profile') }}" class="add-user btn rounded-pill btn-primary mb-5">Edit Profile</a>
      <div class="card-header" style="padding-top:30px;">
        <h4>Viewing as: {{ $user->name }}</h4>
      </div>
      <div class=" author-box">
        <div class="card-body">
          <div class="author-box-center">
            <img alt="image" src="{{ (!empty($user->profileimg))?url('assets/userimages/profileimg/'.$user->profileimg): url('assets/userimages/no-image.jpg') }}" class="rounded-circle author-box-picture">
            <div class="clearfix" style="padding-bottom:10px;"></div>
            <div class="author-box-name">
              <p class="text-muted" style="padding-bottom: 15px;"><small>{{ $user->name }}</small></p>
            </div>
            <div class="row">
              <div class="col-md-3 col-6 b-r">
                <strong>User Role</strong>
                <br>
                <p class="text-muted">{{ $user->userrole }}</p>
              </div>
              <div class="col-md-3 col-6 b-r">
                <strong>Phone</strong>
                <br>
                <a href="tel:{{ $user->phone }} " style="text-decoration:none;"> <p class="text-muted">{{ $user->phone }}</p></a>
              </div>
              <div class="col-md-3 col-6 b-r">
                <strong>Email</strong>
                <br>
                <a href="mailto:{{ $user->email }} " style="text-decoration: none;"><p class="text-muted">{{ $user->email }}</p></a>
              </div>
              <div class="col-md-3 col-6">
                <strong>Address</strong>
                <br>
                <p class="text-muted">{{ $user->address }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>                
    </div>
  </div>
</div>

<!-- JS Libraies -->
<script src="{{ asset('assets/bundles/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/bundles/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Page Specific JS File -->
<script src="{{ asset('assets/js/page/datatables.js') }}"></script>
@endsection
