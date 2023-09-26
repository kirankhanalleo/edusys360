@extends('admin.admin_master')
@section('admin')
<!--JQUERY AJAX CDN-->
<script src="{{ asset('assets/assets/js/jquery-3.7.1.min.js') }}"></script>
<main>
    @include('admin.body.header')
    <p class="text-muted pt"><b><a href="{{ route('dashboard') }}">Home</a></b> - <a href="{{ route('view.assign.subjects') }}">Assign Subjects</a> </p>
    <div class="data-table large-table">
        <div style="display:flex; justify-content:space-between;">
            <div><h2>Assign New Subjects</h2></div>
        </div>
        <hr>
        <div class="modal-body scroll-table scroll-card" style="margin-bottom: 1.5rem;">
            <form action="{{ route('create.assigned.subject') }}" method="post" >
                @csrf
                <div class="add_item">
                    <div class="input-form">
                        <div class="row">
                            <div class="form-group" style="max-width:95%;">
                                <h3>Class<span class="danger">*</span></h3>
                                <select name="class_id">
                                    <option value="" selected disabled>Select Class</option>
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                                    @endforeach
                                </select>
                                @error('class_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror    
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group" style="max-width:40%;">
                                <h3>Subject<span class="danger">*</span></h3>
                                <select name="subject_id[]">
                                    <option value="" selected disabled>Select Subject</option>
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                    @endforeach
                                </select>
                                @error('subject_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror   
                            </div>
                            <div class="form-group" style="max-width:15%;">
                                <h3>Full Marks<span class="danger">*</span></h3>
                                <input type="text" name="full_marks[]">   
                            </div>
                            <div class="form-group" style="max-width:15%;">
                                <h3>Pass Marks<span class="danger">*</span></h3>
                                <input type="text" name="pass_marks[]">   
                            </div>
                            <div>
                                <span class="material-symbols-sharp icon addmore">
                                    add
                                </span>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
                <button type="submit" class="create" style="margin-bottom: 1rem; margin-top:2rem;">Assign Subjects</button>
            </form>    
        </div>
    </div>
</main>
<div style="display: none;">
    <div class="add-remove-item">
        <div class="add_extra_item" id="add_extra_item">
            <div class="delete_extra_item" id="delete_extra_item">
                <div class="row">
                    <div class="form-group" style="max-width:40%;">
                        <h3>Subject<span class="danger">*</span></h3>
                        <select name="subject_id[]">
                            <option value="" selected disabled>Select Subject</option>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                            @endforeach
                        </select>
                        @error('subject_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror   
                    </div>
                    <div class="form-group" style="max-width:15%;">
                        <h3>Full Marks<span class="danger">*</span></h3>
                        <input type="text" name="full_marks[]">   
                    </div>
                    <div class="form-group" style="max-width:15%;">
                        <h3>Pass Marks<span class="danger">*</span></h3>
                        <input type="text" name="pass_marks[]">   
                    </div>
                    <div>
                        <span class="material-symbols-sharp icon addmore">
                            add
                        </span>
                        <span class="material-symbols-sharp icon remove removeadded">
                            remove
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
<script type="text/javascript">
    $(document).ready(function(){
        var count=0;
        $(document).on("click",".addmore",function(){
            var add_extra_item = $("#add_extra_item").html();
            $(this).closest(".add_item").append(add_extra_item);
            count++; 
        });
        $(document).on("click",".removeadded",function(event){
            $(this).closest(".delete_extra_item").remove();
            count-=1;
        });
    });
</script>
@endsection
