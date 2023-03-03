@extends('admin.admin_master')
@section('admin')
<div class="main-content">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4>CHANGE PASSWORD</h4>
            </div>
            <form action="{{ route('update.password') }}" method="post">
            @csrf
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Current Password</label>
                            <span class="text-danger">*</span>
                            <input type="password" id="current_password" name="current_password" class="form-control">
                            @error('current_password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>New Password</label>
                            <span class="text-danger">*</span>
                            <input type="password" id="password" name="password" class="form-control">
                            @error('password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <span class="text-danger">*</span>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" >
                            @error('password_confirmation')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12"> 
                        <input type="submit" class=" btn btn-primary rounded-pill" value="Change Password">
                    </div> <!--End col-md-12 -->
                </div>
            </form>            
        </div>
    </div>
</div>
@endsection