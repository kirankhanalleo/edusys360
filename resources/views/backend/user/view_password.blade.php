@extends('admin.admin_master')
@section('admin')
<main>
    @include('admin.body.header')
    <p class="text-muted pt"><b><a href="{{ route('dashboard') }}">Home</a></b> - <a href="{{ route('view.password') }}">Change Password</a> </p>
    <div class="data-table large-table">
        <div style="display:flex; justify-content:space-between;">
            <div><h2>Change Password</h2></div>
        </div>
        <hr>
        <div class="modal-body" style="margin-bottom: 1.5rem;">
            <form action="{{ route('update.password') }}" method="post">
                @csrf
                    <div class="input-form">
                        <div class="row">
                            <div class="form-group" style="max-width:75%;">
                                <h3>Current Password<span class="danger">*</span></h3>
                                <input type="password" class="form-control" name="current_password" id="current_password">
                                @error('current_password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group" style="max-width:75%;">
                                <h3>New Password<span class="danger">*</span></h3>
                                <input type="password" class="form-control" name="password" id="password">
                                @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group" style="max-width:75%;">
                                <h3>Confirm Password<span class="danger">*</span></h3>
                                <input type="password_confirmation" class="form-control" name="password_confirmation" id="password_confirmation">
                                @error('password_confirmation')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="create" style="margin-bottom: 1rem;">Update Password</button>
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