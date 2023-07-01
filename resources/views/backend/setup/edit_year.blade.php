@extends('admin.admin_master')
@section('admin')
<main>
    @include('admin.body.header')
    <p class="text-muted pt"><b><a href="{{ route('dashboard') }}">Home</a></b> - <a href="{{ route('view.year') }}">School Year</a> </p>
    <div class="data-table large-table">
        <div style="display:flex; justify-content:space-between;">
            <div><h2>Edit School Year</h2></div>
        </div>
        <hr>
        <div class="modal-body" style="margin-bottom: 1.5rem;">
            <form action="{{ route('update.year',$editData->id) }}" method="post">
                @csrf
                    <div class="input-form">
                        <div class="row">
                            <div class="form-group" style="max-width:75%;">
                                <h3>School Year<span class="danger">*</span></h3>
                                <input type="text" class="form-control" name="name" id="name" value="{{ $editData->name }}">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="create" style="margin-bottom: 1rem;">Update School Year</button>
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
