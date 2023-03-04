@extends('admin.admin_master')
@section('admin')
<div class="main-content">        
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4>EDIT FEE CATEGORY</h4>
            </div>
            <form action="{{ route('update.fee.category',$editData->id) }}" method="post" id="register-form">
                @csrf
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Fee Category</label>
                            <span class="text-danger">*</span>
                            <input type="text" class="form-control" name="name" id="name" value="{{ $editData->name }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <input type="submit" class=" btn btn-success rounded-pill" value="Update Category">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
