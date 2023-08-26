@extends('admin.admin_master')
@section('admin')
<main>
    @include('admin.body.header')
    <div class="data-table large-table">
        <div><h2>Edit Employee Details</h2></div>
        <hr>
        <div class="modal-body" style="margin-bottom: 1.5rem;">
            <form action="{{ route('update.employee.registration',$editData->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value={{ $editData->id }}>
                <div class="input-form">
                    <div class="row">
                        <div class="form-group">
                            <h3>Employee's Name<span class="danger">*</span></h3>
                            <input type="text" name="employee_name" id="employee_name" value={{ $editData->name }}>
                            @error('employee_name')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                        <div class="form-group">
                            <h3>Father's Name<span class="danger">*</span></h3>
                            <input type="text" name="father_name" id="father_name" value={{ $editData->father_name }}>
                            @error('father_name')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                        <div class="form-group">
                            <h3>Mother's Name<span class="danger">*</span></h3>
                            <input type="text" name="mother_name" id="mother_name" value={{ $editData->mother_name }}>
                            @error('mother_name')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <h3>Email<span class="danger">*</span></h3>
                            <input type="email" name="email" id="email" value={{ $editData->email }}>
                            @error('email')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                        <div class="form-group">
                            <h3>Phone<span class="danger">*</span></h3>
                            <input type="text" name="phone" id="phone" value="{{ $editData->contact}}">
                            @error('phone')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                        <div class="form-group">
                            <h3>Address<span class="danger">*</span></h3>
                            <input type="text" name="address" id="address" value="{{ $editData->address }}">
                            @error('address')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <h3>Citizenship No.<span class="danger">*</span></h3>
                            <input type="text" name="citizenship_no" id="citizenship_no" value={{ $editData->citizenship_no }}>
                            @error('citizenship_no')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                        <div class="form-group">
                            <h3>Citizenship Issued District<span class="danger">*</span></h3>
                            <select name="citizenship_issued_district">
                                <option disabled selected >Select District</option>
                                <option value="Achham" {{ $editData->citizenship_issued_district=="Achham"?"selected":"" }}>Achham</option>
                                <option value="Arghakhanchi" {{ $editData->citizenship_issued_district=="Arghakhanchi"?"selected":"" }}>Arghakhanchi</option>
                                <option value="Baglung" {{ $editData->citizenship_issued_district=="Baglung"?"selected":"" }}>Baglung</option>
                                <option value="Baitadi" {{ $editData->citizenship_issued_district=="Baitadi"?"selected":"" }}>Baitadi</option>
                                <option value="Bajhang" {{ $editData->citizenship_issued_district=="Bajhang"?"selected":"" }}>Bajhang</option>
                                <option value="Bajura" {{ $editData->citizenship_issued_district=="Bajura"?"selected":"" }}>Bajura</option>
                                <option value="Banke" {{ $editData->citizenship_issued_district=="Banke"?"selected":"" }}>Banke</option>
                                <option value="Bara" {{ $editData->citizenship_issued_district=="Bara"?"selected":"" }}>Bara</option>
                                <option value="Bardiya" {{ $editData->citizenship_issued_district=="Bardiya"?"selected":"" }}>Bardiya</option>
                                <option value="Bhaktapur" {{ $editData->citizenship_issued_district=="Bhaktapur"?"selected":"" }}>Bhaktapur</option>
                                <option value="Bhojpur" {{ $editData->citizenship_issued_district=="Bhojpur"?"selected":"" }}>Bhojpur</option>
                                <option value="Chitwan" {{ $editData->citizenship_issued_district=="Chitwan"?"selected":"" }}>Chitwan</option>
                                <option value="Dadeldhura" {{ $editData->citizenship_issued_district=="Dadeldhura"?"selected":"" }}>Dadeldhura</option>
                                <option value="Dailekh" {{ $editData->citizenship_issued_district=="Dailekh"?"selected":"" }}>Dailekh</option>
                                <option value="Dang" {{ $editData->citizenship_issued_district=="Dang"?"selected":"" }}>Dang</option>
                                <option value="Darchula" {{ $editData->citizenship_issued_district=="Darchula"?"selected":"" }}>Darchula</option>
                                <option value="Dhading" {{ $editData->citizenship_issued_district=="Dhading"?"selected":"" }}>Dhading</option>
                                <option value="Dhankuta" {{ $editData->citizenship_issued_district=="Dhankuta"?"selected":"" }}>Dhankuta</option>
                                <option value="Dhanusa" {{ $editData->citizenship_issued_district=="Dhanusa"?"selected":"" }}>Dhanusa</option>
                                <option value="Dholkha" {{ $editData->citizenship_issued_district=="Dolakha"?"selected":"" }}>Dholkha</option>
                                <option value="Dolpa" {{ $editData->citizenship_issued_district=="Dolpa"?"selected":"" }}>Dolpa</option>
                                <option value="Doti" {{ $editData->citizenship_issued_district=="Doti"?"selected":"" }}>Doti</option>
                                <option value="Gorkha" {{ $editData->citizenship_issued_district=="Gorkha"?"selected":"" }}>Gorkha</option>
                                <option value="Gulmi" {{ $editData->citizenship_issued_district=="Gulmi"?"selected":"" }}>Gulmi</option>
                                <option value="Humla" {{ $editData->citizenship_issued_district=="Humla"?"selected":"" }}>Humla</option>
                                <option value="Ilam" {{ $editData->citizenship_issued_district=="Illam"?"selected":"" }}>Ilam</option>
                                <option value="Jajarkot" {{ $editData->citizenship_issued_district=="Jajarkot"?"selected":"" }}>Jajarkot</option>
                                <option value="Jhapa" {{ $editData->citizenship_issued_district=="Jhapa"?"selected":"" }}>Jhapa</option>
                                <option value="Jumla" {{ $editData->citizenship_issued_district=="Jumla"?"selected":"" }}>Jumla</option>
                                <option value="Kailali" {{ $editData->citizenship_issued_district=="Kailali"?"selected":"" }}>Kailali</option>
                                <option value="Kalikot" {{ $editData->citizenship_issued_district=="Kalikot"?"selected":"" }}>Kalikot</option>
                                <option value="Kanchanpur" {{ $editData->citizenship_issued_district=="Kanchanpur"?"selected":"" }}>Kanchanpur</option>
                                <option value="Kapilvastu" {{ $editData->citizenship_issued_district=="Kapilvastu"?"selected":"" }}>Kapilvastu</option>
                                <option value="Kaski" {{ $editData->citizenship_issued_district=="Kaski"?"selected":"" }}>Kaski</option>
                                <option value="Kathmandu" {{ $editData->citizenship_issued_district=="Kathmandu"?"selected":"" }}>Kathmandu</option>
                                <option value="Kavrepalanchok" {{ $editData->citizenship_issued_district=="Kavrepalanchok"?"selected":"" }}>Kavrepalanchok</option>                                    
                                <option value="Khotang" {{ $editData->citizenship_issued_district=="Khotang"?"selected":"" }}>Khotang</option>
                                <option value="Lalitpur" {{ $editData->citizenship_issued_district=="Lalitpur"?"selected":"" }}>Lalitpur</option>
                                <option value="Lamjung" {{ $editData->citizenship_issued_district=="Lamjung"?"selected":"" }}>Lamjung</option>
                                <option value="Mahottari" {{ $editData->citizenship_issued_district=="Mahottari"?"selected":"" }}>Mahottari</option>
                                <option value="Makwanpur" {{ $editData->citizenship_issued_district=="Makwanpur"?"selected":"" }}>Makwanpur</option>
                                <option value="Manang" {{ $editData->citizenship_issued_district=="Manang"?"selected":"" }}>Manang</option>
                                <option value="Morang" {{ $editData->citizenship_issued_district=="Morang"?"selected":"" }}>Morang</option>
                                <option value="Mugu" {{ $editData->citizenship_issued_district=="Mugu"?"selected":"" }}>Mugu</option>
                                <option value="Mustang" {{ $editData->citizenship_issued_district=="Mustang"?"selected":"" }}>Mustang</option>
                                <option value="Myagdi" {{ $editData->citizenship_issued_district=="Myagdi"?"selected":"" }}>Myagdi</option>
                                <option value="Nawalparasi" {{ $editData->citizenship_issued_district=="Nawalparasi"?"selected":"" }}>Nawalparasi</option>
                                <option value="Nawalpur" {{ $editData->citizenship_issued_district=="Nawalpur"?"selected":"" }}>Nawalpur</option>
                                <option value="Nuwakot" {{ $editData->citizenship_issued_district=="Nuwakot"?"selected":"" }}>Nuwakot</option>
                                <option value="Okhaldhunga" {{ $editData->citizenship_issued_district=="Okhaldhunga"?"selected":"" }}>Okhaldhunga</option>
                                <option value="Palpa" {{ $editData->citizenship_issued_district=="Palpa"?"selected":"" }}>Palpa</option>
                                <option value="Panchthar" {{ $editData->citizenship_issued_district=="Pachthar"?"selected":"" }}>Panchthar</option>
                                <option value="Parbat" {{ $editData->citizenship_issued_district=="Parbat"?"selected":"" }}>Parbat</option>
                                <option value="Parsa" {{ $editData->citizenship_issued_district=="Parsa"?"selected":"" }}>Parsa</option>
                                <option value="Pyuthan" {{ $editData->citizenship_issued_district=="Pyuthan"?"selected":"" }}>Pyuthan</option>
                                <option value="Ramechhap" {{ $editData->citizenship_issued_district=="Ramechhap"?"selected":"" }}>Ramechhap</option>
                                <option value="Rasuwa" {{ $editData->citizenship_issued_district=="Rasuwa"?"selected":"" }}>Rasuwa</option>
                                <option value="Rautahat" {{ $editData->citizenship_issued_district=="Rautahat"?"selected":"" }}>Rautahat</option>
                                <option value="Rolpa" {{ $editData->citizenship_issued_district=="Rolpa"?"selected":"" }}>Rolpa</option>                                    
                                <option value="Rukum East" {{ $editData->citizenship_issued_district=="Rukum East"?"selected":"" }}>Rukum East</option>
                                <option value="Rukum West" {{ $editData->citizenship_issued_district=="Rukum West"?"selected":"" }}>Rukum West</option>
                                <option value="Rupandehi" {{ $editData->citizenship_issued_district=="Rupandehi"?"selected":"" }}>Rupandehi</option>
                                <option value="Salyan" {{ $editData->citizenship_issued_district=="Salyan"?"selected":"" }}>Salyan</option>
                                <option value="Sankhuwasabha" {{ $editData->citizenship_issued_district=="Sankhuwasabha"?"selected":"" }}>Sankhuwasabha</option>
                                <option value="Saptari" {{ $editData->citizenship_issued_district=="Saptari"?"selected":"" }}>Saptari</option>
                                <option value="Sarlahi" {{ $editData->citizenship_issued_district=="Sarlahi"?"selected":"" }}>Sarlahi</option>
                                <option value="Sindhuli" {{ $editData->citizenship_issued_district=="Sindhuli"?"selected":"" }}>Sindhuli</option>
                                <option value="Sindhupalchok" {{ $editData->citizenship_issued_district=="Sindhupalchok"?"selected":"" }}>Sindhupalchok</option>
                                <option value="Siraha" {{ $editData->citizenship_issued_district=="Siraha"?"selected":"" }}>Siraha</option>
                                <option value="Solukhumbu" {{ $editData->citizenship_issued_district=="Solukhumbu"?"selected":"" }}>Solukhumbu</option>
                                <option value="Sunsari" {{ $editData->citizenship_issued_district=="Sunsari"?"selected":"" }}>Sunsari</option>
                                <option value="Surkhet" {{ $editData->citizenship_issued_district=="Surkhet"?"selected":"" }}>Surkhet</option>
                                <option value="Syangja" {{ $editData->citizenship_issued_district=="Syangja"?"selected":"" }}>Syangja</option>
                                <option value="Tanahun" {{ $editData->citizenship_issued_district=="Tanahun"?"selected":"" }}>Tanahun</option>
                                <option value="Taplejung" {{ $editData->citizenship_issued_district=="Taplejung"?"selected":"" }}>Taplejung</option>                                    
                                <option value="Terhathum" {{ $editData->citizenship_issued_district=="Terhathum"?"selected":"" }}>Terhathum</option>
                                <option value="Udayapur" {{ $editData->citizenship_issued_district=="Udayapur"?"selected":"" }}>Udayapur</option>                                  
                            </select>
                            @error('citizenship_issued_district')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                        <div class="form-group">
                            <h3>Issued Date<span class="danger">*</span></h3>
                            <input type="date" name="citizenship_issued_date" value={{ $editData->citizenship_issued_date }}>
                            @error('citizenship_issued_date')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <h3>DOB<span class="danger">*</span></h3>
                            <input type="date" name="dob" value={{ $editData->dob }}>
                            @error('dob')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                        <div class="form-group">
                            <h3>Gender<span class="danger">*</span></h3>
                            <select name="gender" id="gender">
                                <option selected disabled >Select Gender</option>
                                <option value="Male" {{ $editData->gender=='Male'?'Selected' :'' }}>Male</option>
                                <option value="Female"  {{ $editData->gender=='Female'?'Selected' :'' }}>Female</option>
                            </select>
                            @error('gender')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                        <div class="form-group">
                            <h3>Religion<span class="danger">*</span></h3>
                            <select name="religion" id="religion">
                                <option selected disabled>Select Religion</option>
                                <option value="Hindu" {{ $editData->religion =="Hindu"?"Selected":"" }}>Hindu</option>
                                <option value="Muslim"  {{ $editData->religion =="Muslim"?"Selected":"" }}>Muslim</option>                                    <option value="Buddhist"  {{ $editData->religion =="Buddhist"?"Selected":"" }}>Buddhist</option>
                                <option value="Christian"  {{ $editData->religion =="Christian"?"Selected":"" }}>Christian</option>
                                <option value="Others"  {{ $editData->religion =="Others"?"Selected":"" }}>Others</option>
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
                                <option value="Brahmin/Chettri" {{ $editData->caste=="Brahmin/Chettri"?"selected":"" }}>Brahmin/Chettri</option>
                                <option value="Janajati" {{ $editData->caste=="Janajati"?"selected":"" }}>Janajati</option>
                                <option value="Dalit" {{ $editData->caste=="Dalit"?"selected":"" }}>Dalit</option>
                                <option value="Madhesi"{{ $editData->caste=="Madhesi"?"selected":"" }}>Madhesi</option>
                                <option value="Others" {{ $editData->caste=="Others"?"selected":"" }}>Others</option>
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
                            <img id="viewImage"  src="{{ (!empty($editData->profileimg)) ? url('assets/employeeimages/'.$editData->profileimg): url('assets/employeeimages/no-image.jpg') }}" 
                            class ="viewImage">
                        </div>
                    </div>
                <button type="submit" class="create user">Update employee details</button>
            </div> 
        </div>
    </form>  
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
