@extends('admin.admin_master')
@section('admin')
<!--HandleBarJs CDN-->
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.7/handlebars.min.js" integrity="sha512-RNLkV3d+aLtfcpEyFG8jRbnWHxUqVZozacROI4J2F1sTaDqo1dPQYs01OMi1t1w9Y2FdbSCDSQ2ZVdAC8bzgAg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
<script src="{{ asset('assets/assets/js/handlebars-v4.7.7.js') }}"></script>
<!--JQUERY AJAX CDN-->
<script src="{{ asset('assets/assets/js/jquery-3.7.1.min.js') }}"></script>
<main>
    @include('admin.body.header')
    <p class="text-muted pt"><b><a href="{{ route('dashboard') }}">Home</a></b> - <a href="{{ route('view.student.registration') }}">Student List</a> </p>
    <div class="data-table large-table" style="margin-bottom:0rem; padding-bottom:2rem; border-bottom:3px solid #2384B4;">
        <div><h2>View Admission Fee</h2></div>
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
                <h3>Class</h3>
                <select name="class_id" id="class_id">
                    <option selected disabled>Select Class</option>
                    @foreach ($class as $classes )
                        <option value="{{ $classes->id }}">{{ $classes->name }}</option>
                    @endforeach
                </select>   
            </div>
            <div class="form-group" style="padding-top:2.3rem;">
                <button class="create" id="searchData" name="searchData" style="width:40%;">Search</button>
            </div>
        </div>
        <div class="scroll-table">
            <div id="DocumentResults">
                <script id="document-template" type="text/x-handlebars-template">
                    <table cellspacing="0" cellpadding="0"> 
                        <thead>
                            <tr>
                                @{{{thsource}}}
                            </tr>
                        </thead>    
                        <tbody>
                            @{{#each this}}
                                <tr>
                                    @{{{tdsource}}}
                                </tr>
                            @{{/each}}
                        </tbody>
                    </table>
                </script> 
            </div> 
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
<!--HANDLEBARJS Script-->
<script type="text/javascript">
    $(document).on('click','#searchData',function(){
        var year_id=$('#year_id').val();
        var class_id=$('#class_id').val();
        $.ajax({
            url:"{{ route('view.admission.fee.by.class') }}",
            type:"get",
            data:{'year_id':year_id,'class_id':class_id},
            beforeSend: function(){
            },
            success: function(data){
                var source=$('#document-template').html();
                var template=Handlebars.compile(source);
                var html=template(data);
                $('#DocumentResults').html(html);
                $('[data-toggle="tooltip"]').tooltip();
            }
        });
    });
</script>

@endsection
