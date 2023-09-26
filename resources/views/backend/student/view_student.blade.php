@extends('admin.admin_master')
@section('admin')
<main>
    @include('admin.body.header')
    <p class="text-muted pt"><b><a href="{{ route('dashboard') }}">Home</a></b> - <a href="{{ route('view.student.registration') }}">Student List</a> </p>
    <div class="data-table large-table" style="margin-bottom:0rem; padding-bottom:2rem; border-bottom:3px solid #2384B4;">
        <div><h2>Search for Students</h2></div>
        <hr>
        <form method="get" action="{{ route('show.list') }}"> 
            <div class="row" style="padding-top:1.5rem;">
                <div class="form-group" >
                    <h3>Academic Year</h3>
                    <select name="year_id" id="year_id">
                        <option selected disabled>Select Academic Year</option>
                        @foreach ($academicYear as $year )
                            <option value="{{ $year->id }}"{{ (@$year_id==$year_id)?"selected":"" }}>{{ $year->name }}</option>
                        @endforeach
                    </select>   
                </div>
                <div class="form-group">
                    <h3>Class</h3>
                    <select name="class_id" id="class_id">
                        <option selected disabled>Select Class</option>
                        @foreach ($class as $classes )
                            <option value="{{ $classes->id }}" {{ (@$class_id==$classes->id)?"selected":"" }}>{{ $classes->name }}</option>
                        @endforeach
                    </select>   
                </div>
                <div class="form-group" style="padding-top:2.3rem;">
                    <button type="submit" class="create" name="search" style="width:40%;" value="Search">Search</button>
                </div>
            </div>
        </form>
    </div>
    <div class="data-table large-table">
        <div style="display:flex; justify-content:space-between; ">
            <div><h2>Viewing Student Lists</h2></div>
            <div class="searchbar">
                <input type="text" id="search-input" onkeyup="studentSearchBar()" placeholder="Search for students" class="searchbar">  
                <span class="material-symbols-sharp">search</span> 
            </div>
            <div><button class="add" data-modal-target="#modal-box">Add New Student</button></div> 
        </div>
        <hr>
        <div class="scroll-table" id="student-table">
            <table  cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            <th width="5%">S.N</th>
                            <th>Reg ID</th>
                            <th>School Year</th>
                            <th>Student's Name</th>
                            <th>Father's Name</th>
                            <th>Class</th>
                            <th>Date of Birth</th>
                            <th>Gender</th>
                            <th>Contact</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                        <tbody>
                            @if(!@$search)
                            <!--Fetching data from database-->
                                @foreach ($allData as $key=>$value)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $value['getStudent']['reg_id'] }}</td>
                                        <td>{{ $value['getStudentYear']['name'] }}</td>
                                        <td>{{ $value['getStudent']['name'] }}</td>
                                        <td>{{ $value['getStudent']['father_name'] }}</td>
                                        <td>{{ $value['getStudentClass']['name'] }}</td>
                                        <td>{{ $value['getStudent']['dob'] }}</td>
                                        <td>{{ $value['getStudent']['gender'] }}</td>
                                        <td>{{ $value['getStudent']['contact'] }}</td>
                                        <td>{{ $value['getStudent']['address'] }}</td>
                                        <td class="edit-delete">
                                            <a class="view-btn" title="view" href="{{ route('view.student.details',$value->student_id) }}"><span class="material-symbols-sharp">visibility</span></a>
                                            <a class="edit-btn" title="edit" href="{{ route('edit.student',$value->student_id) }}"><span class="material-symbols-sharp">edit_square</span></a>
                                            <a class="delete-btn" title="promote" href="{{ route('promote.student',$value->student_id) }}"><span class="material-symbols-sharp">open_in_new</span></a>
                                        </td>
                                    </tr> 
                                @endforeach
                            @else
                                @foreach ($allData as $key=>$value)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $value['getStudent']['reg_id'] }}</td>
                                    <td>{{ $value['getStudentYear']['name'] }}</td>
                                    <td>{{ $value['getStudent']['name'] }}</td>
                                    <td>{{ $value['getStudent']['father_name'] }}</td>
                                    <td>{{ $value['getStudentClass']['name'] }}</td>
                                    <td>{{ $value['getStudent']['dob'] }}</td>
                                    <td>{{ $value['getStudent']['gender'] }}</td>
                                    <td>{{ $value['getStudent']['caste'] }}</td>
                                    <td>{{ $value['getStudent']['address'] }}</td>
                                    <td class="edit-delete">
                                        <a class="view-btn" title="view" href="{{ route('view.student.details',$value->student_id) }}"><span class="material-symbols-sharp">visibility</span></a>
                                        <a class="edit-btn" title="edit" href="{{ route('edit.student',$value->student_id) }}"><span class="material-symbols-sharp">edit_square</span></a>
                                        <a class="delete-btn" title="promote" href="{{ route('promote.student',$value->student_id) }}"><span class="material-symbols-sharp">open_in_new</span></a>
                                    </td>
                                </tr> 
                                @endforeach
                            @endif
                        </tbody>
                    </thead>
                </table>
        </div>
        
        <p class="text-muted" id="bottom-text">Showing 1 to {{ count($allData) }} of {{ count($allData) }} entries</p>
    </div>
    <!---MODAL BOX START ---->
    <div class="modal-box large-modal" id="modal-box">
        <div class="modal-header">
            <div class="title"><h1>Create New Student</h1></div>
            <div data-close-button class="modal-close-btn">
                <span class="material-symbols-sharp">close</span> 
            </div>   
        </div>
        <hr>
        <div class="modal-body">
            <form action="{{ route('create.student.registration') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="input-form">
                    <div class="row">
                        <div class="form-group">
                            <h3>Student's Name<span class="danger">*</span></h3>
                            <input type="text" name="student_name" id="student_name">
                            @error('name')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                        <div class="form-group">
                            <h3>Father's Name<span class="danger">*</span></h3>
                            <input type="text" name="father_name" id="father_name">
                            @error('name')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                        <div class="form-group">
                            <h3>Mother's Name<span class="danger">*</span></h3>
                            <input type="text" name="mother_name" id="mother_name">
                            @error('name')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <h3>Email<span class="danger">*</span></h3>
                            <input type="email" name="email" id="email">
                            @error('email')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                        <div class="form-group">
                            <h3>Phone<span class="danger">*</span></h3>
                            <input type="text" name="phone" id="phone">
                            @error('phone')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                        <div class="form-group">
                            <h3>Address<span class="danger">*</span></h3>
                            <input type="text" name="address" id="address">
                            @error('address')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <h3>Local Guardian<span class="danger">*</span></h3>
                            <input type="text" name="local_guardian" id="local_guardian">
                            @error('local_guardian')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                        <div class="form-group">
                            <h3>Relationship to Student<span class="danger">*</span></h3>
                            <select name="local_guardian_relationship" id="local_guardian_relationship">
                                <option selected disabled>Select Relationship</option>
                                <option value="Relative">Relative</option>
                                <option value="Legal Guardian">Legal Guardian</option>
                                <option value="Legal Guardian">Family Friend</option>
                                <option value="Legal Guardian">Host Family</option>
                            </select>
                            @error('local_guardian_relationship')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                        <div class="form-group">
                            <h3>Emergency Contact<span class="danger">*</span></h3>
                            <input type="text" name="local_guardian_contact" id="local_guardian_contact">
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
                                    <option value="{{ $year->id }}">{{ $year->name }}</option>
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
                                    <option value="{{ $classes->id }}">{{ $classes->name }}</option>
                                @endforeach
                            </select>
                            @error('class')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                        <div class="form-group">
                            <h3>Scholorship Amount<span class="danger">*</span></h3>
                            <input type="text" name="discount_amount" id="discount_amount">
                            @error('address')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <h3>DOB<span class="danger">*</span></h3>
                            <input type="date" name="dob" id="dob">
                            @error('dob')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                        <div class="form-group">
                            <h3>Gender<span class="danger">*</span></h3>
                            <select name="gender" id="gender">
                                <option value="" >Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            @error('gender')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                        <div class="form-group">
                            <h3>Religion<span class="danger">*</span></h3>
                            <select name="religion" id="religion">
                                <option selected disabled>Select Religion</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Muslim">Muslim</option>
                                <option value="Buddhist">Buddhist</option>
                                <option value="Christian">Christian</option>
                                <option value="Others">Others</option>
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
                                <option value="Brahmin/Chettri">Brahmin/Chettri</option>
                                <option value="Janajati">Janajati</option>
                                <option value="Dalit">Dalit</option>
                                <option value="Madhesi">Madhesi</option>
                                <option value="Others">Others</option>
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
                            <img id="viewImage"  src="{{url('assets/assets/images/no-image.jpg') }}" 
                            class ="viewImage">
                        </div>
                    </div>
                        <button type="submit" class="create user">Create new student</button>
                    </div> 
                </div>
            </form>    
        </div>
    </div>
    <!---MODAL END ------>
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
<!-- Jquery Ajax -->>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script> --}}
<script src="{{ asset('assets/assets/js/jquery-3.7.1.min.js') }}"></script>
<!-- js function to show image on upload -->
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
