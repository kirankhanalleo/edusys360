@extends('admin.admin_master')
@section('admin')
<div class="main-content">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4>EDIT PROFILE</h4>
            </div>
            <form action="{{ route('update.profile') }}" method="post" enctype="multipart/form-data">
            @csrf
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="col-md-6"> 
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <span class="text-danger">*</span>
                                    <input type="text" class="form-control" name="name" id="name" value="{{ ($editProfileData->name) }}">
                                </div>
                            </div> <!--End col-md-6 -->
                            <div class="col-md-6"> 
                                <div class="form-group">
                                    <label>Email</label>
                                    <span class="text-danger">*</span>
                                    <input type="email" class="form-control" name="email" id="email" value="{{ ($editProfileData->email) }}">
                                </div>
                            </div> <!--End col-md-6 -->
                            <div class="col-md-6"> 
                                <div class="form-group">
                                    <label>Mobile</label>
                                    <span class="text-danger">*</span>
                                    <input type="text" class="form-control" name="phone" id="phone" value="{{ ($editProfileData->phone) }}">
                                </div>
                            </div> <!--End col-md-6 -->
                            <div class="col-md-6"> 
                                <div class="form-group">
                                    <label>Telephone</label>
                                    <input type="text" class="form-control" name="telephone" id="telephone" value="{{ ($editProfileData->telephone) }}">
                                </div>
                            </div> <!--End col-md-6 -->
                            <div class="col-md-6"> 
                                <div class="form-group">
                                    <label>Address</label>
                                    <span class="text-danger">*</span>
                                    <input type="text" class="form-control" name="address" id="address" value="{{ ($editProfileData->address) }}" >
                                </div>
                            </div> <!--End col-md-6 -->
                            <div class="col-md-6"> 
                                <div class="form-group">
                                    <label>Profile Image</label>
                                    <input type="file" class="form-control" name="profileimg" id="profileimg" value="{{ ($editProfileData->address) }}" >
                                </div>
                                <div class="form-group">
                                    <img id="viewImage"  src="{{ (!empty($user->profileimg))?url('assets/userimages/profileimg'.$user->image): url('assets/userimages/no-image.jpg') }}" 
                                     class ="viewImage">
                                </div>
                            </div> <!--End col-md-6 -->
                        </div> <!--End form-row -->
                    </div>
                    <div class="col-md-12"> 
                        <input type="submit" class=" btn btn-primary rounded-pill" value="Update Profile">
                    </div> <!--End col-md-12 -->
                </div>
            </form>            
        </div>
    </div>
</div>
@endsection
<<!-- Jquery Ajax -->
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script> --}}
<script src="{{ asset('assets/assets/js/jquery-3.7.1.min.js') }}"></script>
<<!-- js function to show image on upload -->>
<script type="text/javascript">
    $(document).ready(function(){
        $('#profileimg').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#viewImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>