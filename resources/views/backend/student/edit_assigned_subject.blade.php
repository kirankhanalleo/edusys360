@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<div class="main-content">        
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4>EDIT ASSIGNED SUBJECT</h4>
            </div>
            <form action="{{ route('update.assigned.subject',$editData['0']->class_id) }}" method="post" id="register-form">
                @csrf
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="add_item">
                            <div class="form-group">
                                <label>Class</label>
                                <span class="text-danger">*</span>
                                <select class="form-control" name="class_id">
                                    <option value="" selected disabled>Select Class</option>
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id }}"{{ ($editData['0']->class_id==$class->id)?"selected":"" }}>{{ $class->name }}</option>
                                    @endforeach
                                </select>
                                @error('class_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            @foreach ($editData as $edit )
                            <div class="delete_extra_item" id="delete_extra_item">
                                <div class="form-row">
                                    <div class="col-md-5"> 
                                        <div class="form-group">
                                            <label>Subject</label>
                                            <span class="text-danger">*</span>
                                            <select class="form-control" name="subject_id[]">
                                                <option value="" selected disabled>Select Subject</option>
                                                @foreach ($subjects as $subject)
                                                    <option value="{{ $subject->id }}"{{ ($edit->subject_id==$subject->id)?"selected":"" }}>{{ $subject->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('subject_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2"> 
                                        <div class="form-group">
                                            <label>Full Marks</label>
                                            <span class="text-danger">*</span>
                                            <input type="text" class="form-control" name="full_marks[]" value="{{ $edit->full_marks }}">
                                        </div>
                                    </div>
                                    <div class="col-md-2"> 
                                        <div class="form-group">
                                            <label>Pass Marks</label>
                                            <span class="text-danger">*</span>
                                            <input type="text" class="form-control" name="pass_marks[]" value="{{ $edit->pass_marks }}">
                                        </div>
                                    </div>
                                    <div class="col-md-2 add-less-btns">
                                        <span class="btn btn-primary addmore"><i class="fa fa-plus-circle"></i></span>
                                        <span class="btn btn-danger removeadded"><i class="fa fa-minus-circle"></i></span>
                                    </div> 
                                </div>
                            </div>    
                            @endforeach
                        </div>
                        <input type="submit" class=" btn btn-success rounded-pill" value="Update Assigned Subject">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="add-remove-item col-md-12">
    <div class="add_extra_item" id="add_extra_item">
        <div class="delete_extra_item" id="delete_extra_item">
            <div class="form-row">
                <div class="col-md-4"> 
                    <div class="form-group">
                        <label>Subject</label>
                        <span class="text-danger">*</span>
                        <select class="form-control" name="subject_id[]">
                            <option value="" selected disabled>Select Subject</option>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}"{{ ($edit->subject_id==$subject->id)?"selected":"" }}>{{ $subject->name }}</option>
                            @endforeach
                        </select>
                        @error('subject_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-2"> 
                    <div class="form-group">
                        <label>Full Marks</label>
                        <span class="text-danger">*</span>
                        <input type="text" class="form-control" name="full_marks[]" value="{{ $edit->full_marks }}">
                    </div>
                </div>
                <div class="col-md-2"> 
                    <div class="form-group">
                        <label>Pass Marks</label>
                        <span class="text-danger">*</span>
                        <input type="text" class="form-control" name="pass_marks[]" value="{{ $edit->pass_marks }}">
                    </div>
                </div>
                <div class="col-md-2 add-less-btns">
                    <span class="btn btn-primary addmore"><i class="fa fa-plus-circle"></i></span>
                    <span class="btn btn-danger removeadded"><i class="fa fa-minus-circle"></i></span>
                </div> 
            </div>
        </div>
    </div>
</div>
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
