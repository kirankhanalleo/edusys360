@extends('admin.admin_master')
@section('admin')
    <div class="main-content">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>EDIT USER !</h4>
                </div>
                <form action="{{ route('update.user',$editData->id) }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="form-row">
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label>Select Role</label>
                                        <select class="form-control" name="userrole" id="userrole" required="">
                                            <option diabled>Select Role</option>
                                            <option value="Admin" {{ ($editData->role=="Admin"?"selected":"") }}>Admin</option>
                                            <option value="User" {{ ($editData->role=="User"?"selected":"") }} >User</option>
                                        </select>
                                    </div>
                                </div> <!--End col-md-6 -->
                                
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" class="form-control" name="name" id="name" value="{{ ($editData->name) }}" required="">
                                    </div>
                                </div> <!--End col-md-6 -->
            
                            </div> <!--End form-row -->
                        </div>
                        
                            <div class="col-md-12"> 
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" id="email" value="{{ $editData->email }}" class="form-control" required="">
                                </div>
                            </div> <!--End col-md-12 -->
                            
                            <div class="col-md-12"> 
                                <input type="submit" class=" btn btn-primary rounded-pill" value="Update User">
                            </div> <!--End col-md-12 -->
                    </div>
                </form>
                
            </div>
        </div>
    </div>
@endsection