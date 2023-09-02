@extends('admin.admin_master')
@section('admin')
<main>
    @include('admin.body.header')
    <p class="text-muted pt"><b><a href="{{ route('dashboard') }}">Home</a></b> - <a href="{{ route('add.exam.marks') }}">Exam Marks Entry</a> </p>
    {{-- <form method="get" action="">
        @csrf --}}
        <div class="data-table large-table" style="margin-bottom:0rem; padding-bottom:2rem; border-bottom:3px solid #2384B4;">
            <div><h2>Exam Marks Entry</h2></div>
            <hr>
            <div class="row" style="padding-top:1.5rem;">
                <div class="form-group" >
                    <h3>Academic Year</h3>
                    <select name="year_id" id="year_id">
                        <option selected disabled>Select Academic Year</option>
                        @foreach ($academicYear as $year )
                            <option value="{{ $year->id }}">{{ $year->name }}</option>
                        @endforeach
                    </select>   
                </div>
                <div class="form-group">
                    <h3>Exam</h3>
                    <select name="exam_id" id="exam_id">
                        <option selected disabled>Select Exam</option>
                        @foreach ($exam_model as $exams )
                            <option value="{{ $exams->id }}">{{ $exams->name }}</option>
                        @endforeach
                    </select>   
                </div>
                <div class="form-group">
                    <h3>Class</h3>
                    <select name="class_id" id="class_id">
                        <option selected disabled>Select Class</option>
                        @foreach ($class as $classes )
                            <option value="{{ $classes->id }}" >{{ $classes->name }}</option>
                        @endforeach
                    </select>   
                </div>
                <div class="form-group">
                    <h3>Subject</h3>
                    <select name="subject_id" id="subject_id">
                        <option value="">Select Subject</option>
                    </select>   
                </div>
            </div>
            <div class="form-group" style="padding-top:2.3rem;">
                <button class="create" id="search" style="width:max-content;">Search</button>
            </div>
        </div>
        <div class="data-table large-table display-none" id="marks-generate-table">
            <div style="display:flex; justify-content:space-between; ">
                <div><h2>Viewing Student Lists</h2></div>
            </div>
            <hr>
            <div class="scroll-table">
                <table  cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th>Reg ID</th>
                                <th>Student's Name</th>
                                <th>Father's Name</th>
                                <th>Marks</th>
                            </tr>
                        </thead>
                        <tbody id="marks-entry-tr">

                        </tbody>
                </table>
            </div>
        </div>
    {{-- </form> --}}
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
{{-- Jquery Ajax --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<script type="text/javascript">
$(function(){
    $(document).on('change','#class_id',function(){
        var class_id=$('#class_id').val();
        $.ajax({
            url:"{{ route('class.get.subject') }}",
            type:"GET",
            data:{class_id:class_id},
            success:function(data){
                var html = '<option value="">Select Subject</option>';
                $.each(data,function(key,v){
                    html +='<option value="'+v.id+'">'+v.subject.name+'</option>';
                });
                $('#subject_id').html(html);
            }
        });
    });
});
</script>
<script type="text/javascript">
    $(document).on('click','#search', function(){
        var year_id=$('#year_id').val();
        var class_id=$('#class_id').val();
        var exam_id=$('#exam_id').val();
        var subject_id=$('#subject_id').val();

        $.ajax({
            url:"{{ route('class.get.students') }}",
            type:"GET",
            data:{'year_id':year_id,'class_id':class_id},
            success: function(data) {
                $('#marks-generate-table').removeClass('display-none');
                var html='';
                $.each( data, function(key,v){
                    html +=
                    '<tr>'+
                        '<td>'+v.getStudent.reg_id+'</td>'+
                        '<td>'+v.getStudent.name+'</td>'+
                        '<td>'+v.getStudent.father_name+'</td>'+
                        '<td> <input type="text" name="marks[]"></td>'+
                    '</tr>';
                });
                html =$('#marks-entry-tr').html(html);
            }
        });
    });
</script>
@endsection

