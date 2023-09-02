@extends('admin.admin_master')
@section('admin')
<main>
    @include('admin.body.header')
    <p class="text-muted pt"><b><a href="{{ route('dashboard') }}">Home</a></b> - <a href="{{ route('view.student.fee') }}">Student Fee</a> </p>
    <div class="data-table large-table">
        <div style="display:flex; justify-content:space-between; ">
            <div><h2>Viewing Employee Salary Details</h2></div>
            <div class="searchbar">
                <input type="text" id="search-input" onkeyup="employeeSearchBar()" placeholder="Search" class="searchbar">  
                <span class="material-symbols-sharp">search</span> 
            </div>
            <div>
                <button class="add" onclick="window.location.href='{{ route('add.finance.employee.salary') }}'">Add Employee Salary</button>
            </div> 
        </div>
        <hr>
        <div class="scroll-table" id="employee-table">
            <table  cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th width="5%">S.N</th>
                        <th>Employee ID</th>
                        <th>Employee Name</th>
                        <th>Amount</th>
                        <th>Date</th>
                    </tr>
                    <tbody>
                        <!--Fetching data from database-->
                        @if (count($allData) > 0)
                            @foreach ($allData as $key=>$salary)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $salary['getEmployee']['emp_id'] }}</td>
                                    <td>{{ $salary['getEmployee']['name'] }}</td>
                                    <td>{{ (int)$salary->amount }}</td>
                                    <td>{{ date('M Y',strtotime($salary->date)) }}</td>
                                </tr> 
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8" class="text-center">Sorry! No results found.</td>
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
{{-- Jquery Ajax --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
