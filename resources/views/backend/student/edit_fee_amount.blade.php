@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<div class="main-content">        
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4>EDIT FEE AMOUNT</h4>
            </div>
            <form action="{{ route('update.fee.amount',$editData['0']->fee_category_id) }}" method="post" id="register-form">
                @csrf
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="add_item">
                            <div class="form-group">
                                <label>Fee Category</label>
                                <span class="text-danger">*</span>
                                <select class="form-control" name="fee_category_id">
                                    <option value="" selected disabled>Select Fee Category</option>
                                    @foreach ($fee_categories as $category)
                                        <option value="{{ $category->id }}"{{ ($editData['0']->fee_category_id==$category->id)?"selected":"" }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('fee_category_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            @foreach ($editData as $edit )
                            <div class="delete_extra_item" id="delete_extra_item">
                                <div class="form-row">
                                    <div class="col-md-5"> 
                                        <div class="form-group">
                                            <label>Student Class</label>
                                            <span class="text-danger">*</span>
                                            <select class="form-control" name="class_id[]">
                                                <option value="" selected disabled>Select Class</option>
                                                @foreach ($student_classes as $class)
                                                    <option value="{{ $class->id }}"{{ ($edit->class_id==$class->id)?"selected":"" }}>{{ $class->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('class_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-5"> 
                                        <div class="form-group">
                                            <label>Amount</label>
                                            <span class="text-danger">*</span>
                                            <input type="text" class="form-control" name="amount[]" value="{{ $edit->amount }}">
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
                        <input type="submit" class=" btn btn-success rounded-pill" value="Update Fee Amount">
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
                <div class="col-md-5"> 
                    <div class="form-group">
                        <label>Student Class</label>
                        <span class="text-danger">*</span>
                        <select class="form-control" name="class_id[]">
                            <option value="" selected disabled>Select Class</option>
                            @foreach ($student_classes as $class)
                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                            @endforeach
                        </select>
                        @error('class_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-5"> 
                    <div class="form-group">
                        <label>Amount</label>
                        <span class="text-danger">*</span>
                        <input type="text" class="form-control" name="amount[]">
                    </div>
                </div>
                <div class="col-md-2 pl-3 add-less-btns">
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
