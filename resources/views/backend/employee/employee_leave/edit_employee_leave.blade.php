@extends('admin.admin_master')
@section('admin')
<main>
    @include('admin.body.header')
    <p class="text-muted pt"><b><a href="{{ route('dashboard') }}">Home</a></b> - <a href="{{ route('view.employee.leave') }}">Manage Leave</a> </p>
    <div class="data-table large-table">
        <div style="display:flex; justify-content:space-between;">
            <div><h2>Edit Employee Leave</h2></div>
        </div>
        <hr>
        <div class="modal-body" style="margin-bottom: 1.5rem;">
            <form action="{{ route('update.employee.leave',$editData->id) }}" method="post">
                @csrf
                <input type="hidden" name="id" value={{ $editData->id }}>
                <div class="input-form">
                    <div class="row">
                        <div class="form-group">
                            <h3>Employee Name <span class="danger">*</span></h3>
                            <select name="emp_id" id="emp_id">
                                <option value="" selected disabled>Select Employee</option>
                                @foreach ($employees as $emp )
                                    <option value="{{ $emp->id }}" {{ ($editData->emp_id==$emp->id)? 'selected':'' }}>{{ $emp->name }}</option>   
                                @endforeach    
                            </select>    
                        </div>
                        <div class="form-group">
                            <h3>Reason for Leave <span class="danger">*</span></h3>
                            <select name="leave_reason_id" id="leave_reason_id">
                                <option value="" selected disabled>Select Reason</option>
                                @foreach ($leave_reason as $reason )
                                    <option value="{{ $reason->id }}"{{ ($editData->leave_reason_id==$reason->id)?'selected':'' }}>{{ $reason->name }}</option>   
                                @endforeach    
                            </select>    
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <h3>Start Date <span class="danger">*</span></h3>
                            <input type="date" min={{ now() }} name="start_date" id="start_date" value={{ $editData->start_date }}>   
                        </div>
                        <div class="form-group">
                            <h3>End Date <span class="danger">*</span></h3>
                            <input type="date" min={{ now() }} name="end_date" id="end_date" value={{ $editData->end_date }}>
                        </div>
                    </div>
                    <div><br>
                    <button type="submit" class="create">Update Leave</button>
                    </div> 
                </div>
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
