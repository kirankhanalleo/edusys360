@extends('admin.admin_master')
@section('admin')
<div class="main-content">        
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4>CREATE NEW USER !</h4>
            </div>
            <form action="{{ route('create.user') }}" method="post" id="register-form">
                @csrf
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="col-md-6"> 
                                <div class="form-group">
                                    <label>Select Role</label>
                                    <span class="text-danger">*</span>
                                    <select class="form-control" name="userrole" id="userrole">
                                        <option>User Role</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Accountant">Accountant</option>
                                    </select>
                                    @error('userrole')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div> <!--End col-md-6 -->
                            
                            <div class="col-md-6"> 
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <span class="text-danger">*</span>
                                    <input type="text" class="form-control" name="name" id="name">
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div> <!--End col-md-6 -->
        
                        </div> <!--End form-row -->
                    </div>
                    
                        <div class="col-md-12"> 
                            <div class="form-group">
                                <label>Email</label>
                                <span class="text-danger">*</span>
                                <input type="email" name="email" id="email" class="form-control">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror 
                            </div>
                        </div> <!--End col-md-6 -->
                        
                        <div class="col-md-12"> 
                            <div class="form-group">
                                <label>Password</label>
                                <span class="text-danger">*</span>
                                <label style="float:right;">(Must be 8 characters long, contain atleast one uppercase, one lowercase and one numeric value)</label>
                                <input type="password" name="password" id="password" class="form-control" value="">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <input type="submit" class=" btn btn-success rounded-pill" value="Create user">
                        </div> <!--End col-md-6 -->
                </div>
            </form>
            
        </div>
    </div>
</div>
@endsection
