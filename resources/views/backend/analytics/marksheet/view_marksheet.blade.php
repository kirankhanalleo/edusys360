@extends('admin.admin_master')
@section('admin')
<main>
    @include('admin.body.header')
    <p class="text-muted pt"><b><a href="{{ route('dashboard') }}">Home</a></b> - <a href="{{ route('view.marksheet') }}">Marksheet</a> </p>
    <div class="data-table large-table" style="margin-bottom:0rem; padding-bottom:2rem; border-bottom:3px solid #2384B4;">
        <div><h2>Student Marksheet Viewer</h2></div>
        <hr>
        <form action="{{ route('get.student.marksheet') }}" method="get" target="_blank">
        @csrf
        <div class="row" style="padding-top:1.5rem;">
            <div class="form-group" >
                <h3>Academic Year</h3>
                <select name="year_id" id="year_id">
                    <option value="" selected disabled>Select Academic Year</option>
                    @foreach ($academicYear as $year )
                        <option value="{{ $year->id }}">{{ $year->name }}</option>
                    @endforeach
                </select>   
            </div>
            <div class="form-group">
                <h3>Exam</h3>
                <select name="exam_id" id="exam_id">
                    <option value="" selected disabled>Select Exam</option>
                    @foreach ($examModel as $exams )
                        <option value="{{ $exams->id }}">{{ $exams->name }}</option>
                    @endforeach
                </select>   
            </div>
            <div class="form-group">
                <h3>Class</h3>
                <select name="class_id" id="class_id">
                    <option value="" selected disabled>Select Class</option>
                    @foreach ($class as $classes )
                        <option value="{{ $classes->id }}" >{{ $classes->name }}</option>
                    @endforeach
                </select>   
            </div>
            <div class="form-group">
                <h3>Registration ID</h3>
                <input type="text" name="reg_id" id="reg_id">  
            </div>
        </div>
        <div class="row" style="padding-top:2.3rem;">
            <div>
            <button type="submit" class="create" id="search" style="width:max-content; color:rgb(255, 255, 255);">Search</a>
            </div>
        </div>
        </form>
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