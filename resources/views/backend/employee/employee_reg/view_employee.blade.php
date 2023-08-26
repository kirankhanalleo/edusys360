@extends('admin.admin_master')
@section('admin')
<main>
    @include('admin.body.header')
    <p class="text-muted pt"><b><a href="{{ route('dashboard') }}">Home</a></b> - <a href="{{ route('view.employee') }}">Employee</a> </p>
    <div class="data-table large-table">
        <div style="display:flex; justify-content:space-between; ">
            <div><h2>Viewing Employees List</h2></div>
            <div class="searchbar">
                <input type="text" id="search-input" onkeyup="searchBar()" placeholder="Search" class="searchbar">  
                <span class="material-symbols-sharp">search</span> 
            </div>
            <div><button class="add" data-modal-target="#modal-box">Register New Employee</button></div> 
        </div>
        <hr>
        <div class="scroll-table" id="employee-table">
            <table  cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th width="5%">S.N</th>
                        <th>Employee ID</th>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Gender</th>
                        <th width="10%">Joined Date</th>
                        <th width="8%">Action</th>
                    </tr>
                    <tbody>
                        <!--Fetching data from database-->
                        @if (count($allData) > 0)
                            @foreach ($allData as $key=>$employee)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $employee->emp_id }}</td>
                                    <td>{{ $employee->name }}</td>
                                    <td>{{ $employee['getDesignation']['name']}}</td>
                                    <td>{{ $employee->contact }}</td>
                                    <td>{{ $employee->address }}</td>
                                    <td>{{ $employee->gender }}</td>
                                    <td>{{ $employee->joined_date }}</td>
                                    <td class="edit-delete" style="margin-left: 0.5rem;">
                                        <a class="view-btn" title="view" href="#"><span class="material-symbols-sharp">visibility</span></a>
                                        <a class="edit-btn" title="edit" href="{{ route('edit.employee.registration',$employee->id) }}"><span class="material-symbols-sharp">edit_square</span></a>
                                    </td>
                                </tr> 
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center">Sorry! No results found.</td>
                            </tr>
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
            <div class="title"><h1>Register New Employee</h1></div>
            <div data-close-button class="modal-close-btn">
                <span class="material-symbols-sharp">close</span> 
            </div>   
        </div>
        <hr>
        <div class="modal-body">
            <form action="{{ route('create.employee.registration') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="input-form">
                    <div class="row">
                        <div class="form-group">
                            <h3>Employee's Name<span class="danger">*</span></h3>
                            <input type="text" name="employee_name" id="employee_name">
                            @error('employee_name')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                        <div class="form-group">
                            <h3>Father's Name<span class="danger">*</span></h3>
                            <input type="text" name="father_name" id="father_name">
                            @error('father_name')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                        <div class="form-group">
                            <h3>Mother's Name<span class="danger">*</span></h3>
                            <input type="text" name="mother_name" id="mother_name">
                            @error('mother_name')
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
                            <h3>Designation<span class="danger">*</span></h3>
                            <select name="designation" id="designation">
                                <option selected disabled>Select Designation</option>
                                @foreach ($designations as $designation )
                                    <option value="{{ $designation->id }}">{{ $designation->name }}</option>
                                @endforeach
                            </select>
                            @error('designation')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                        <div class="form-group">
                            <h3>Joined Date<span class="danger">*</span></h3>
                            <input type="date" name="joined_date" id="joined_date">
                            @error('joined_date')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                        <div class="form-group">
                            <h3>Salary<span class="danger">*</span></h3>
                            <input type="text" name="salary" id="salary">
                            @error('salary')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <h3>Citizenship No.<span class="danger">*</span></h3>
                            <input type="text" name="citizenship_no" id="citizenship_no">
                            @error('citizenship_no')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                        <div class="form-group">
                            <h3>Citizenship Issued District<span class="danger">*</span></h3>
                            <select name="citizenship_issued_district">
                                <option disabled selected >Select District</option>
                                <option value="Achham">Achham</option>
                                <option value="Arghakhanchi">Arghakhanchi</option>
                                <option value="Baglung">Baglung</option>
                                <option value="Baitadi">Baitadi</option>
                                <option value="Bajhang">Bajhang</option>
                                <option value="Bajura">Bajura</option>
                                <option value="Banke">Banke</option>
                                <option value="Bara">Bara</option>
                                <option value="Bardiya">Bardiya</option>
                                <option value="Bhaktapur">Bhaktapur</option>
                                <option value="Bhojpur">Bhojpur</option>
                                <option value="Chitwan">Chitwan</option>
                                <option value="Dadeldhura">Dadeldhura</option>
                                <option value="Dailekh">Dailekh</option>
                                <option value="Dang">Dang</option>
                                <option value="Darchula">Darchula</option>
                                <option value="Dhading">Dhading</option>
                                <option value="Dhankuta">Dhankuta</option>
                                <option value="Dhanusa">Dhanusa</option>
                                <option value="Dholkha">Dholkha</option>
                                <option value="Dolpa">Dolpa</option>
                                <option value="Doti">Doti</option>
                                <option value="Gorkha">Gorkha</option>
                                <option value="Gulmi">Gulmi</option>
                                <option value="Humla">Humla</option>
                                <option value="Ilam">Ilam</option>
                                <option value="Jajarkot">Jajarkot</option>
                                <option value="Jhapa">Jhapa</option>
                                <option value="Jumla">Jumla</option>
                                <option value="Kailali">Kailali</option>
                                <option value="Kalikot">Kalikot</option>
                                <option value="Kanchanpur">Kanchanpur</option>
                                <option value="Kapilvastu">Kapilvastu</option>
                                <option value="Kaski">Kaski</option>
                                <option value="Kathmandu">Kathmandu</option>
                                <option value="Kavrepalanchok">Kavrepalanchok</option>                                    <option value="Khotang">Khotang</option>
                                <option value="Lalitpur">Lalitpur</option>
                                <option value="Lamjung">Lamjung</option>
                                <option value="Mahottari">Mahottari</option>
                                <option value="Makwanpur">Makwanpur</option>
                                <option value="Manang">Manang</option>
                                <option value="Morang">Morang</option>
                                <option value="Mugu">Mugu</option>
                                <option value="Mustang">Mustang</option>
                                <option value="Myagdi">Myagdi</option>
                                <option value="Nawalparasi">Nawalparasi</option>
                                <option value="Nawalpur">Nawalpur</option>
                                <option value="Nuwakot">Nuwakot</option>
                                <option value="Okhaldhunga">Okhaldhunga</option>
                                <option value="Palpa">Palpa</option>
                                <option value="Panchthar">Panchthar</option>
                                <option value="Parbat">Parbat</option>
                                <option value="Parsa">Parsa</option>
                                <option value="Pyuthan">Pyuthan</option>
                                <option value="Ramechhap">Ramechhap</option>
                                <option value="Rasuwa">Rasuwa</option>
                                <option value="Rautahat">Rautahat</option>
                                <option value="Rolpa">Rolpa</option>                                    <option value="Rukum East">Rukum East</option>
                                <option value="Rukum West">Rukum West</option>
                                <option value="Rupandehi">Rupandehi</option>
                                <option value="Salyan">Salyan</option>
                                <option value="Sankhuwasabha">Sankhuwasabha</option>
                                <option value="Saptari">Saptari</option>
                                <option value="Sarlahi">Sarlahi</option>
                                <option value="Sindhuli">Sindhuli</option>
                                <option value="Sindhupalchok">Sindhupalchok</option>
                                <option value="Siraha">Siraha</option>
                                <option value="Solukhumbu">Solukhumbu</option>
                                <option value="Sunsari">Sunsari</option>
                                <option value="Surkhet">Surkhet</option>
                                <option value="Syangja">Syangja</option>
                                <option value="Tanahun">Tanahun</option>
                                <option value="Taplejung">Taplejung</option>                                    <option value="Terhathum">Terhathum</option>
                                <option value="Udayapur">Udayapur</option>                                  
                            </select>
                            @error('citizenship_issued_district')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                        <div class="form-group">
                            <h3>Issued Date<span class="danger">*</span></h3>
                            <input type="date" name="citizenship_issued_date" id="citizenship_issued_date">
                            @error('citizenship_issued_date')
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
                                <option selected disabled >Select Gender</option>
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
                        <button type="submit" class="create user">Register new employee</button>
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
