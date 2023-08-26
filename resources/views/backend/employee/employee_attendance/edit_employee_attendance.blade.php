@extends('admin.admin_master')
@section('admin')
<main>
    @include('admin.body.header')
    <p class="text-muted pt"><b><a href="{{ route('dashboard') }}">Home</a></b> - <a href="{{ route('view.employee.attendance') }}">Attendance Records</a> </p>
    <div class="data-table large-table" style="margin-bottom:0rem; padding-bottom:2rem; border-bottom:3px solid #2384B4;">
        <div><h2>Employee Attendance Records</h2></div>
        <hr>
        <form method="post" action="{{ route('update.employee.attendance') }}"> 
            @csrf
            <div class="row" style="padding-top:1.5rem; width:30%;">
                <div class="form-group">
                    <h3>Attendance Date</h3>
                    <input type="date" name="date" value={{ $editData['0']['date'] }} id="date">  
                </div>
            </div>
    </div>
    <div class="data-table large-table">
        <div style="display:flex; justify-content:space-between; ">
            <div><h2>Edit Attendance Records</h2></div>
            <div class="searchbar">
                <input type="text" id="search-input" onkeyup="searchBar()" placeholder="Search" class="searchbar">  
                <span class="material-symbols-sharp">search</span> 
            </div>
            <div>
                <input type="hidden">
            </div>
        </div>
        <hr>
        <div class="scroll-table">
            <table  cellspacing="2" cellpadding="0" id="data-table">
                <thead>
                    <tr>
                        <th rowspan="2" width="5%" style="vertical-align: middle;">S.N</th>
                        <th rowspan="2"  style="vertical-align: middle;">Employee Name</th>
                        <th colspan="3" width="30%"  style="vertical-align: middle;">Status</th>                        </tr>
                    <tr>
                        <th style="background-color: var(--color-dark); display:table-cell;">Present</th>
                        <th style="background-color: var(--color-dark); display:table-cell;">Leave</th>
                        <th style="background-color: var(--color-dark); display:table-cell;">Absent</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($editData as $key=>$data )
                    <tr id="div{{ $data->id }}">
                        <input type="hidden" name="emp_id[]" value="{{ $data->emp_id }}">
                        <td>{{ $key+1 }}</td>
                        <td>{{ $data['getEmployee']['name'] }}</td>
                        <td colspan="3">
                            <div style="display: flex; justify-content:space-evenly;">
                                <div> 
                                    <input type="radio" name="status{{ $key }}" value="Present" id="present" {{ ($data->status=='Present')?'checked':'' }}>
                                    <label for="present{{ $key }}">Present</label>
                                </div>
                                <div>
                                    <input type="radio" name="status{{ $key }}" value="Leave" id="leave"  {{ ($data->status=='Leave')?'checked':'' }}>
                                    <label for="leave{{ $key }}">Leave</label>
                                </div>
                                <div>
                                    <input type="radio" name="status{{ $key }}" value="Absent" id="absent"  {{ ($data->status=='Absent')?'checked':'' }}>
                                    <label for="absent{{ $key }}">Absent</label>
                                </div>
                            </div>
                        </td>
                    </tr>  
                    @endforeach
                </tbody>
            </table>
            <div class="form-group">
                <button type="submit" class="create" style="margin-top:1.5rem; width:max-content;">Update Attendance</button>
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