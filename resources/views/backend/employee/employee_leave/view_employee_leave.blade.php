@extends('admin.admin_master')
@section('admin')
<main>
    @include('admin.body.header')
    <p class="text-muted pt"><b><a href="{{ route('dashboard') }}">Home</a></b> - <a href="{{ route('view.employee.leave') }}">Manage Leave</a> </p>
    <div class="data-table large-table">
        <div style="display:flex; justify-content:space-between; ">
            <div><h2>Viewing Employee Leave</h2></div>
            <div class="searchbar">
                <input type="text" id="search-input" onkeyup="searchBar()" placeholder="Search" class="searchbar">  
                <span class="material-symbols-sharp">search</span> 
            </div>
            <div><button class="add" data-modal-target="#modal-box">Add Leave</button></div> 
        </div>
        <hr>
        <div class="scroll-table">
            <table  cellspacing="0" cellpadding="0" id="data-table">
                <thead>
                    <tr>
                        <th width="10%">S.N</th>
                        <th>Employee ID</th>
                        <th>Name</th>
                        <th>Purpose</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th width="10%">Action</th>
                    </tr>
                    <tbody>
                        <!--Fetching data from database-->
                        @foreach ($allData as $key=>$leave)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $leave['getEmployee']['emp_id'] }}</td>
                                <td>{{ $leave['getEmployee']['name']  }}</td>
                                <td>{{ $leave['getReason']['name']  }}</td>
                                <td>{{ $leave->start_date }}</td>
                                <td>{{ $leave->end_date }}</td>
                                <td class="edit-delete">
                                  <a class="view-btn" title="view" href="#"><span class="material-symbols-sharp">visibility</span></a>
                                  <a class="edit-btn" title="edit" href="{{ route('edit.employee.leave',$leave->id) }}"><span class="material-symbols-sharp">edit_square</span></a>
                                  <a class="delete-btn" title="delete" id="deleteLeave" href="{{ route('delete.employee.leave',$leave->id) }}"><span class="material-symbols-sharp">delete</span></a>
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
    <div class="modal-box" id="modal-box">
        <div class="modal-header">
            <div class="title"><h1>Create Leave</h1></div>
            <div data-close-button class="modal-close-btn">
                <span class="material-symbols-sharp">close</span> 
            </div>   
        </div>
        <hr>
        <div class="modal-body">
            <form action="{{ route('create.employee.leave') }}" method="post">
                @csrf
                <div class="input-form">
                    <div class="row">
                        <div class="form-group">
                            <h3>Employee Name <span class="danger">*</span></h3>
                            <select name="emp_id" id="emp_id">
                                <option value="" selected disabled>Select Employee</option>
                                @foreach ($employees as $emp )
                                    <option value="{{ $emp->id }}">{{ $emp->name }}</option>   
                                @endforeach    
                            </select>    
                        </div>
                        <div class="form-group">
                            <h3>Reason for Leave <span class="danger">*</span></h3>
                            <select name="leave_reason_id" id="leave_reason_id">
                                <option value="" selected disabled>Select Reason</option>
                                @foreach ($leave_reason as $reason )
                                    <option value="{{ $reason->id }}">{{ $reason->name }}</option>   
                                @endforeach    
                            </select>    
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <h3>Start Date <span class="danger">*</span></h3>
                            <input type="date" min={{ now() }} name="start_date" id="start_date">   
                        </div>
                        <div class="form-group">
                            <h3>End Date <span class="danger">*</span></h3>
                            <input type="date" min={{ now() }} name="end_date" id="end_date">
                        </div>
                    </div>
                    <div><br>
                    <button type="submit" class="create">Create Leave</button>
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
