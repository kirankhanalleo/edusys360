@extends('admin.admin_master')
@section('admin')
<main>
    @include('admin.body.header')
    <p class="text-muted pt"><b><a href="{{ route('dashboard') }}">Home</a></b> - <a href="{{ route('add.grade.point') }}">Grade Point</a> </p>
    <div class="data-table large-table">
        <div style="display:flex; justify-content:space-between;">
            <div><h2>Edit Grade Point</h2></div>
        </div>
        <hr>
        <div class="modal-body" style="margin-bottom: 1.5rem;">
            <form action="{{ route('update.grade.point',$editData->id) }}" method="post">
                @csrf
                    <div class="input-form">
                        <div class="row">
                            <div class="form-group">
                                <h3>Grade Name<span class="danger">*</span></h3>
                                <input type="text" name="grade_name" value="{{ $editData->grade_name }}" >
                                @error('grade_name')
                                    <p class="error danger">{{ $message }}</p>
                                @enderror    
                            </div>
                            <div class="form-group">
                                <h3>Start Marks<span class="danger">*</span></h3>
                                <input type="text" name="start_marks" value="{{ $editData->start_marks }}">
                                @error('start_marks')
                                    <p class="error danger">{{ $message }}</p>
                                @enderror    
                            </div>
                            <div class="form-group">
                                <h3>End Marks<span class="danger">*</span></h3>
                                <input type="text" name="end_marks" value="{{ $editData->end_marks }}">
                                @error('end_marks')
                                    <p class="error danger">{{ $message }}</p>
                                @enderror    
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <h3>Start Point<span class="danger">*</span></h3>
                                <input type="text" name="start_point" value="{{ $editData->start_point }}">
                                @error('start_point')
                                    <p class="error danger">{{ $message }}</p>
                                @enderror    
                            </div>
                            <div class="form-group">
                                <h3>End Point<span class="danger">*</span></h3>
                                <input type="text" name="end_point" value="{{ $editData->end_point }}">
                                @error('address')
                                    <p class="error danger">{{ $message }}</p>
                                @enderror    
                            </div>
                            <div class="form-group">
                                <h3>Remarks<span class="danger">*</span></h3>
                                <input type="text" name="remarks" value="{{ $editData->remarks }}">
                                @error('remarks')
                                    <p class="error danger">{{ $message }}</p>
                                @enderror    
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="create" style="margin-bottom: 1rem;">Update Grade</button>
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
