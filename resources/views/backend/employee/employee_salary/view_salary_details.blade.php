@extends('admin.admin_master')
@section('admin')
<main>
    @include('admin.body.header')
    <p class="text-muted pt"><b><a href="{{ route('dashboard') }}">Home</a></b> - <a href="{{ route('view.employee.salary') }}">Salary</a> </p>
    <div class="data-table large-table">
        <div style="display:flex; justify-content:space-between; ">
            <div><h2>Salary Details of {{ $details->name }} </h2></div>
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
                        <th>Previous Salary</th>
                        <th>Increased Salary</th>
                        <th>Current Salary</th>
                        <th>Date of Effect</th>
                    </tr>
                    <tbody>
                        <!--Fetching data from database-->
                            @foreach ($salary_details as $key=>$salary)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $salary->prev_salary }}</td>
                                    <td>{{ $salary->increases_salary }}</td>
                                    <td>{{ $salary->current_salary }}</td>
                                    <td>{{ date('d-m-Y',strtotime($salary->date_of_effect))  }}</td>
                                </tr> 
                            @endforeach
                    </tbody>
                </thead>
            </table>
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