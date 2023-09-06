@extends('admin.admin_master')
@section('admin')
<main>
    @include('admin.body.header')
    <p class="text-muted pt"><b><a href="{{ route('dashboard') }}">Home</a></b> - <a href="{{ route('add.grade.point') }}">Grade Point</a> </p>
    <div class="data-table large-table">
        <div style="display:flex; justify-content:space-between; ">
            <div><h2>Viewing Grade Lists</h2></div>
            <div class="searchbar">
                <input type="text" id="search-input" onkeyup="searchBar()" placeholder="Search" class="searchbar">  
                <span class="material-symbols-sharp">search</span> 
            </div>
            <div><button class="add" data-modal-target="#modal-box">Add Grade Point</button></div> 
        </div>
        <hr>
        <div class="scroll-table large-scroll-table" id="data-table">
            <table  cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            <th width="5%">S.N</th>
                            <th>Grade Name</th>
                            <th>Start Marks</th>
                            <th>End Marks</th>
                            <th>Start Point</th>
                            <th>End point</th>
                            <th>Remarks</th>
                            <th>Action</th>
                        </tr>
                        <tbody>
                            <!--Fetching data from database-->
                                @foreach ($allData as $key=>$value)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $value->grade_name }}</td>
                                        <td>{{ $value->start_marks }}</td>
                                        <td>{{ $value->end_marks }}</td>
                                        <td>{{ $value->start_point }}</td>
                                        <td>{{ $value->end_point }}</td>
                                        <td>{{ $value->remarks }}</td>
                                        <td class="edit-delete">
                                            <a class="edit-btn" style="padding-left:2.8rem;" title="edit" href="{{ route('edit.grade.point',$value->id) }}"><span class="material-symbols-sharp">edit_square</span></a>
                                        </td>
                                    </tr> 
                                @endforeach
                        </tbody>
                    </thead>
                </table>
        </div>
        
        <p class="text-muted" id="bottom-text">Showing 1 to {{ count($allData) }} of {{ count($allData) }} entries</p>
    </div>
    <!---MODAL BOX START ---->
    <div class="modal-box large-modal" id="modal-box">
        <div class="modal-header">
            <div class="title"><h1>Create Grade Point</h1></div>
            <div data-close-button class="modal-close-btn">
                <span class="material-symbols-sharp">close</span> 
            </div>   
        </div>
        <hr>
        <div class="modal-body">
            <form action="{{ route('create.grade.point') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="input-form">
                    <div class="row">
                        <div class="form-group">
                            <h3>Grade Name<span class="danger">*</span></h3>
                            <input type="text" name="grade_name" id="grade_name">
                            @error('grade_name')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                        <div class="form-group">
                            <h3>Start Marks<span class="danger">*</span></h3>
                            <input type="text" name="start_marks" id="start_marks">
                            @error('start_marks')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                        <div class="form-group">
                            <h3>End Marks<span class="danger">*</span></h3>
                            <input type="text" name="end_marks" id="end_marks">
                            @error('end_marks')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <h3>Start Point<span class="danger">*</span></h3>
                            <input type="text" name="start_point" id="start_point">
                            @error('start_point')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                        <div class="form-group">
                            <h3>End Point<span class="danger">*</span></h3>
                            <input type="text" name="end_point" id="end_point">
                            @error('address')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                        <div class="form-group">
                            <h3>Remarks<span class="danger">*</span></h3>
                            <input type="text" name="remarks" id="remarks">
                            @error('remarks')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                    </div>
                        <button type="submit" class="create user">Create Grade Point</button>
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
