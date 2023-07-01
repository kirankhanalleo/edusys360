@extends('admin.admin_master')
@section('admin')
<main>
    @include('admin.body.header')
    <div class="data-table large-table">
        <div><h2>{{ $editData['getStudent']['name'] .' - '. $editData['getStudent']['reg_id']}}</h2></div>
        <hr>
        <div class="modal-body" style="margin-bottom: 1.5rem;">
            <form action="#" method="#">
                @csrf
                <input type="hidden" name="id" value={{ $editData->student_id }}>
                <div class="input-form">
                    <div class="row">
                        <div class="form-group">
                            <h3>Student's Name<span class="danger">*</span></h3>
                            <input type="text" name="student_name" id="student_name" value={{ $editData['getStudent']['name'] }} readonly>
                            @error('name')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                        <div class="form-group">
                            <h3>Father's Name<span class="danger">*</span></h3>
                            <input type="text" name="father_name" id="father_name" value={{ $editData['getStudent']['father_name'] }} readonly>
                            @error('name')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                        <div class="form-group">
                            <h3>Mother's Name<span class="danger">*</span></h3>
                            <input type="text" name="mother_name" id="mother_name" value={{ $editData['getStudent']['mother_name'] }} readonly>
                            @error('name')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <h3>Email<span class="danger">*</span></h3>
                            <input type="email" name="email" id="email" value={{ $editData['getStudent']['email'] }} readonly>
                            @error('email')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                        <div class="form-group">
                            <h3>Phone<span class="danger">*</span></h3>
                            <input type="text" name="phone" id="phone" value="{{ $editData['getStudent']['contact'] }}" readonly>
                            @error('phone')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                        <div class="form-group">
                            <h3>Address<span class="danger">*</span></h3>
                            <input type="text" name="address" id="address" value="{{ $editData['getStudent']['address'] }}" readonly>
                            @error('address')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <h3>Local Guardian<span class="danger">*</span></h3>
                            <input type="text" name="local_guardian" id="local_guardian" value="{{ $editData['getStudent']['local_guardian'] }}" readonly>
                            @error('local_guardian')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                        <div class="form-group">
                            <h3>Relationship to Student<span class="danger">*</span></h3>
                            <select name="local_guardian_relationship" id="local_guardian_relationship">
                                <option value="Relative">{{ ($editData['getStudent']['local_guardian_relationship'])}}</option>
                                </select>
                            @error('local_guardian_relationship')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                        <div class="form-group">
                            <h3>Emergency Contact<span class="danger">*</span></h3>
                            <input type="text" name="local_guardian_contact" id="local_guardian_contact" value="{{ $editData['getStudent']['local_guardian_contact'] }}" readonly>
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
                                @foreach ($class as $classes )
                                    <option value="{{ $classes->id }}" {{($editData->class_id == $classes->id) ? 'selected' : ''  }}>{{ $classes->name }}</option>
                                @endforeach
                            </select> 
                        </div>
                        <div class="form-group">
                            <h3>Scholorship Amount<span class="danger">*</span></h3>
                            <input type="text" name="discount_amount" id="discount_amount" value="{{ $editData['getStudentDiscount']['discount'] }}" readonly>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <h3>DOB<span class="danger">*</span></h3>
                            <input type="date" name="dob" id="dob" value="{{ $editData['getStudent']['dob'] }}" readonly>   
                        </div>
                        <div class="form-group">
                            <h3>Gender<span class="danger">*</span></h3>
                            <select name="gender" id="gender">
                                <option>{{ ($editData['getStudent']['gender'])}}</option>
                            </select>   
                        </div>
                        <div class="form-group">
                            <h3>Religion<span class="danger">*</span></h3>
                            <select name="religion" id="religion">
                                <option selected disabled>Select Religion</option>
                                <option>{{ ($editData['getStudent']['religion'])}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <h3>Caste<span class="danger">*</span></h3>
                            <select name="caste" id="caste">
                                <option>{{ ($editData['getStudent']['caste'])}}</option>
                                </select>    
                        </div>
                        <div class="form-group">
                            <img id="viewImage"  src="{{ (!empty($editData['getStudent']['profileimg'])) ? url('assets/studentimages/'.$editData['getStudent']['profileimg']): url('assets/studentimages/no-image.jpg') }}" 
                            class ="viewImage">
                        </div>
                        <div class="form-group">
                            
                        </div>
                    </div>
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