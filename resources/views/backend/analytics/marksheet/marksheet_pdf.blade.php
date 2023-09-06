@extends('admin.admin_master')
@section('admin')
<main>
    @include('admin.body.header')
    <p class="text-muted pt"><b><a href="{{ route('dashboard') }}">Home</a></b> - <a href="{{ route('view.marksheet') }}">Marksheet</a> </p>
    <div class="data-table large-table" style="margin-bottom:2rem; padding-bottom:2rem; border-bottom:3px solid #2384B4;">
        <div><h2>Student Marksheet Viewer</h2></div>
        <hr>
        <div class="Receipt">
            <div class="ReceiptHeader">
                <div class="HeaderText">
                    <p>
                        <span class="HeaderLargeText">
                            EDUS<span class="primary">YS360</span><br/>
                        </span>
                        <span class="HeaderSmallText">
                        A Complete School Management System
                        </span>
                    </p>
                </div>
                <h3 class="h3">{{ $obtMarks['0']['getExam']['name'] }} - {{ $obtMarks['0']['getYear']['name'] }}</h3>
                <h2 class="h2">GRADESHEET</h2>
            </div>
        </div>
        <hr>
        @php
            $getStudent=App\Models\StudentAssignment::where('year_id',$obtMarks['0']->year_id)->where('class_id',$obtMarks['0']->class_id)->first();
        @endphp
        <div class="ReceiptBody">
            <div class="StudentDetails">
                <table>
                    <tr>
                        <td><b>Student's Name:</b> {{ $obtMarks['0']['getStudent']['name'] }}</td>
                        <td><b>Class: </b>{{ $obtMarks['0']['getClass']['name'] }}</td>
                        <td><b>Reg. No:</b> {{ $obtMarks['0']['reg_id'] }}</td>
                        <td><b>Batch:</b> {{ $obtMarks['0']['getYear']['name'] }}</td>
                    </tr>
                </table>
                <table class="stripped-table">
                    <thead>
                        <tr>
                            <th>S.N</th>
                            <th>Subject</th>
                            <th>Letter Grade</th>
                            <th>Grade Point</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalMarks=0;
                            $totalPoint=0;
                        @endphp
                        @foreach ($obtMarks as $key=>$mark )
                            @php
                                $getMark=$mark->marks;
                                $totalMarks=(float)$totalMarks+(float)$getMark;
                                $totalSubject=App\Models\StudentExamMarks::where('year_id',$mark->year_id)->where('class_id',$mark->class_id)->where('exam_id',$mark->exam_id)->where('student_id',$mark->student_id)->get()->count();
                            @endphp
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $mark['getSubjectName']['name'] }}</td>
                                @php
                                    $gradeMarks = App\Models\GradePoint::where([['start_marks','<=', (int)$getMark],['end_marks', '>=',(int)$getMark ]])->first();
                                    $gradeName = $gradeMarks->grade_name;
                                    $gradePoint = $gradeMarks->grade_point;
                                    $totalPoint = (float)$totalPoint+(float)$gradePoint;
                                @endphp
                                <td>{{ $gradeName }}</td>
                                <td>{{ $gradePoint }}</td>
                            </tr>
                        @endforeach
                        @php
                            $totalGrade = 0;
                            $letterGradePoint = (float)$totalPoint/(float)$totalSubject;
                            $totalGrade = App\Models\GradePoint::where([['start_point','<=',$letterGradePoint],['end_point','>=',$letterGradePoint]])->first();
                            $remarks=$totalGrade->remarks;
                            $gpa = (float)$totalPoint/(float)$totalSubject;
                        @endphp
                        <tr>
                            <td colspan="3" style="text-align: right;padding-right: 2rem;"><b>Grade Point Average (GPA)</b></td>
                            <td colspan="3"><b>{{number_format((float)$gpa,2)  }}</b>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: right;padding-right: 2rem;"><b>Remarks</b></td>
                            <td colspan="3"><b>{{ $remarks }}</b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row" style="justify-content: space-between; margin:3rem 5rem 4rem 5rem;">
            <div>
                <hr style="border: solid 1px;  color: #000000; margin-bottom:5px;">
                <b style="font-size: 14px;">Class Teacher</b>
            </div>
            <div>
                <hr style="border: solid 1px; color: #000000; margin-bottom:5px;">
                <b style="font-size: 14px;">School Seal</b>
            </div>
            <div>
                <hr style="border: solid 1px; color: #000000; margin-bottom:5px;">
                <b style="font-size: 14px;">Principal</b>
            </div>
        </div>
        @php
             $nepali_date = Carbon\Carbon::now('Asia/Kathmandu');
        @endphp
        <p>Generated on: {{ $nepali_date }} </p>
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
    .HeaderText{
        text-align: center;
    }
    .HeaderLargeText{
        font-size: 2.5rem;
        letter-spacing: 1px;
        height:1rem;
        font-weight: bolder;
    }
    .primary{
        color:#2384B6;
    }
    .h3{
        text-align: center;
        color:white;
        background: #2384B6;
        height:2.2rem;
        display: block;
        margin: 0 auto;
        width:30%;
        padding-top:2px;
        margin-top: 0.5rem;
        font-size: 18px;
    }
    .h2{
        text-align: center;
        font-size: 18px;
        letter-spacing: 1px;
        margin-top: 0.5rem;
    }
    td{
        padding-bottom:0.5rem;
        font-size: 15px;
        text-align: left;
    }
    table.stripped-table{
        margin-top: -3rem;
        min-width: 100%;
        text-align: center;
    }
    .stripped-table td{
        text-align: center;
    }
</style>
@endsection