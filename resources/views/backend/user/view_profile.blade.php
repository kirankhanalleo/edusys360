@extends('admin.admin_master')
@section('admin')
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
@endsection
