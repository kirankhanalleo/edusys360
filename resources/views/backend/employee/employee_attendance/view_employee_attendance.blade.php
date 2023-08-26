@extends('admin.admin_master')
@section('admin')
<main>
    @include('admin.body.header')
    <p class="text-muted pt"><b><a href="{{ route('dashboard') }}">Home</a></b> - <a href="{{ route('view.employee.attendance') }}">Attendance Record</a> </p>
    <div class="data-table large-table">
        <div style="display:flex; justify-content:space-between; ">
            <div><h2>Viewing Employee Attendance Records</h2></div>
            <div class="searchbar">
                <input type="text" id="search-input" onkeyup="searchBar()" placeholder="Search" class="searchbar">  
                <span class="material-symbols-sharp">search</span> 
            </div>
            <div><a href="{{ route('add.employee.attendance') }}"><button class="add">Add Attendance</button></a></div> 
        </div>
        <hr>
        <div class="scroll-table">
            <table  cellspacing="0" cellpadding="0" id="data-table">
                <thead>
                    <tr>
                        <th width="10%">S.N</th>
                        <th>Date</th>
                        <th width="10%">Action</th>
                    </tr>
                    <tbody>
                        <!--Fetching data from database-->
                        @if(count($allData)>0)
                        @foreach ($allData as $key=>$attendance)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $attendance->date }}</td>
                                <td class="edit-delete" style="margin-left: 1.5rem;">
                                  <a class="view-btn" title="view" href="{{ route('view.employee.attendance.details',$attendance->date) }}"><span class="material-symbols-sharp">visibility</span></a>
                                  <a class="edit-btn" title="edit" href="{{ route('edit.employee.attendance',$attendance->date) }}"><span class="material-symbols-sharp">edit_square</span></a>
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
