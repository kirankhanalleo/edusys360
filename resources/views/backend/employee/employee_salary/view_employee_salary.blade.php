@extends('admin.admin_master')
@section('admin')
<main>
    @include('admin.body.header')
    <p class="text-muted pt"><b><a href="{{ route('dashboard') }}">Home</a></b> - <a href="{{ route('view.employee') }}">Employee</a> </p>
    <div class="data-table large-table">
        <div style="display:flex; justify-content:space-between; ">
            <div><h2>Viewing Employees Salary List</h2></div>
            <div class="searchbar">
                <input type="text" id="search-input" onkeyup="searchBar()" placeholder="Search" class="searchbar">  
                <span class="material-symbols-sharp">search</span> 
            </div>
        </div>
        <hr>
        <div class="scroll-table" id="employee-table">
            <table  cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th width="5%">S.N</th>
                        <th>Employee ID</th>
                        <th>Name</th>
                        <th>Joined Date</th>
                        <th>Salary</th>
                        <th width="8%">Action</th>
                    </tr>
                    <tbody>
                        <!--Fetching data from database-->
                        @if (count($allData) > 0)
                            @foreach ($allData as $key=>$employee)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $employee->emp_id }}</td>
                                    <td>{{ $employee->name }}</td>
                                    <td>{{ date('d-m-Y',strtotime($employee->joined_date))  }}</td>
                                    <td>{{ $employee->salary }}</td>
                                    <td class="edit-delete" style="margin-left: 0.5rem;">
                                        <a class="edit-btn" title="increase" href="{{ route('increase.employee.salary',$employee->id) }}"><span class="material-symbols-sharp">add_circle</span></a>
                                        <a class="view-btn" title="view" href="{{ route('view.salary.details',$employee->id) }}"><span class="material-symbols-sharp">visibility</span></a>
                                    </td>
                                </tr> 
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center">Sorry! No results found.</td>
                            </tr>
                        @endif
                    </tbody>
                </thead>
            </table>
        </div>
        
        <p class="text-muted" id="bottom-text">Showing 1 to {{ count($allData) }} of {{ count($allData) }} entries</p>
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