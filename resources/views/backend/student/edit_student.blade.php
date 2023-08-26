@extends('admin.admin_master')
@section('admin')
<main>
    @include('admin.body.header')
    <div class="data-table large-table">
        <div><h2>Edit Student Details</h2></div>
        <hr>
        <div class="modal-body" style="margin-bottom: 1.5rem;">
            <form action="{{ route('update.student.registration',$editData->student_id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value={{ $editData->student_id }}>
                <div class="input-form">
                    <div class="row">
                        <div class="form-group">
                            <h3>Student's Name<span class="danger">*</span></h3>
                            <input type="text" name="student_name" id="student_name" value={{ $editData['getStudent']['name'] }}>
                            @error('name')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                        <div class="form-group">
                            <h3>Father's Name<span class="danger">*</span></h3>
                            <input type="text" name="father_name" id="father_name" value={{ $editData['getStudent']['father_name'] }}>
                            @error('name')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                        <div class="form-group">
                            <h3>Mother's Name<span class="danger">*</span></h3>
                            <input type="text" name="mother_name" id="mother_name" value={{ $editData['getStudent']['mother_name'] }}>
                            @error('name')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <h3>Email<span class="danger">*</span></h3>
                            <input type="email" name="email" id="email" value={{ $editData['getStudent']['email'] }}>
                            @error('email')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                        <div class="form-group">
                            <h3>Phone<span class="danger">*</span></h3>
                            <input type="text" name="phone" id="phone" value="{{ $editData['getStudent']['contact'] }}">
                            @error('phone')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                        <div class="form-group">
                            <h3>Address<span class="danger">*</span></h3>
                            <input type="text" name="address" id="address" value="{{ $editData['getStudent']['address'] }}">
                            @error('address')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <h3>Local Guardian<span class="danger">*</span></h3>
                            <input type="text" name="local_guardian" id="local_guardian" value="{{ $editData['getStudent']['local_guardian'] }}">
                            @error('local_guardian')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                        <div class="form-group">
                            <h3>Relationship to Student<span class="danger">*</span></h3>
                            <select name="local_guardian_relationship" id="local_guardian_relationship">
                                <option selected disabled>Select Relationship</option>
                                <option value="Relative" {{ ($editData['getStudent']['local_guardian_relationship']=='Relative')?'selected':'' }}>Relative</option>
                                <option value="Legal Guardian" {{ ($editData['getStudent']['local_guardian_relationship']=='Legal Guardian')?'selected':'' }}>Legal Guardian</option>
                                <option value="Family Friend" {{ ($editData['getStudent']['local_guardian_relationship']=='Family Friend')?'selected':'' }}>Family Friend</option>
                                <option value="Host Family" {{ ($editData['getStudent']['local_guardian_relationship']=='Host Family')?'selected':'' }}>Host Family</option>
                            </select>
                            @error('local_guardian_relationship')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                        <div class="form-group">
                            <h3>Emergency Contact<span class="danger">*</span></h3>
                            <input type="text" name="local_guardian_contact" id="local_guardian_contact" value="{{ $editData['getStudent']['local_guardian_contact'] }}">
                            @error('local_guardian_contact')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <h3>Academic Year<span class="danger">*</span></h3>
                            <select name="academic_year" id="academic_year">
                                <option selected disabled>Select Academic Year</option>
                                @foreach ($academicYear as $year )
                                    <option value="{{ $year->id }}" {{ ($editData->year_id == $year->id) ? 'selected' : ''  }}>{{ $year->name }}</option>
                                @endforeach
                            </select>
                            @error('academic_year')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                        <div class="form-group">
                            <h3>Class<span class="danger">*</span></h3>
                            <select name="class" id="class">
                                <option selected disbaled>Select Class</option>
                                @foreach ($class as $classes )
                                    <option value="{{ $classes->id }}" {{($editData->class_id == $classes->id) ? 'selected' : ''  }}>{{ $classes->name }}</option>
                                @endforeach
                            </select>
                            @error('class')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                        <div class="form-group">
                            <h3>Scholorship Amount<span class="danger">*</span></h3>
                            <input type="text" name="discount_amount" id="discount_amount" value="{{ $editData['getStudentDiscount']['discount'] }}">
                            @error('address')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <h3>DOB<span class="danger">*</span></h3>
                            <input type="date" name="dob" id="dob" value="{{ $editData['getStudent']['dob'] }}">
                            @error('dob')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                        <div class="form-group">
                            <h3>Gender<span class="danger">*</span></h3>
                            <select name="gender" id="gender">
                                <option disabled >Select Gender</option>
                                <option value="Male" {{ ($editData['getStudent']['gender']=='Male')?'selected':'' }}>Male</option>
                                <option value="Female" {{ ($editData['getStudent']['gender']=='Female')?'selected':'' }}>Female</option>
                            </select>
                            @error('gender')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                        <div class="form-group">
                            <h3>Religion<span class="danger">*</span></h3>
                            <select name="religion" id="religion">
                                <option selected disabled>Select Religion</option>
                                <option value="Hindu" {{ ($editData['getStudent']['religion']=='Hindu')?'selected':'' }}>Hindu</option>
                                <option value="Muslim" {{ ($editData['getStudent']['religion']=='Muslim')?'selected':'' }}>Muslim</option>
                                <option value="Buddhist" {{ ($editData['getStudent']['religion']=='Buddhist')?'selected':'' }}>Buddhist</option>
                                <option value="Christian" {{ ($editData['getStudent']['religion']=='Christian')?'selected':'' }}>Christian</option>
                                <option value="Others" {{ ($editData['getStudent']['religion']=='Others')?'selected':'' }}>Others</option>
                            </select>
                            @error('religion')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <h3>Caste<span class="danger">*</span></h3>
                            <select name="caste" id="caste">
                                <option selected disabled>Select Caste</option>
                                <option value="Brahmin/Chettri" {{ ($editData['getStudent']['caste']=='Brahmin/Chettri')?'selected':'' }}>Brahmin/Chettri</option>
                                <option value="Janajati" {{ ($editData['getStudent']['caste']=='Janajati')?'selected':'' }}>Janajati</option>
                                <option value="Dalit" {{ ($editData['getStudent']['caste']=='Dalit')?'selected':'' }}>Dalit</option>
                                <option value="Madhesi" {{ ($editData['getStudent']['caste']=='Madhesi')?'selected':'' }}>Madhesi</option>
                                <option value="Others" {{ ($editData['getStudent']['caste']=='Others')?'selected':'' }}>Others</option>
                            </select>
                            @error('religion')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                        <div class="form-group">
                            <h3>Photo<span class="danger">*</span></h3>
                            <input type="file" class="form-control" name="profileimg" id="profileimg">
                        </div>
                        <div class="form-group">
                            <img id="viewImage"  src="{{ (!empty($editData['getStudent']['profileimg'])) ? url('assets/studentimages/'.$editData['getStudent']['profileimg']): url('assets/studentimages/no-image.jpg') }}" 
                            class ="viewImage">
                        </div>
                    </div>
                        <button type="submit" class="create user">Update student details</button>
                    </div> 
                </div>
            </form>  
        </div>
    </div>
</main>
<style>
    .container{
        grid-template-columns: 14rem auto 1rem;
    }
    @media screen and (max-width:768px){
        .container{
            grid-template-columns: 1fr;
            width:100%;
        }
    }
</style>
@endsection
{{-- Jquery Ajax --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
{{-- js function to show image on upload --}}
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
