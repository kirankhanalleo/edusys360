@extends('admin.admin_master')
@section('admin')
<!--HandleBarJs CDN-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.7/handlebars.min.js" integrity="sha512-RNLkV3d+aLtfcpEyFG8jRbnWHxUqVZozacROI4J2F1sTaDqo1dPQYs01OMi1t1w9Y2FdbSCDSQ2ZVdAC8bzgAg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!--JQUERY AJAX CDN-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<main>
    @include('admin.body.header')
    <p class="text-muted pt"><b><a href="{{ route('dashboard') }}">Home</a></b> - <a href="{{ route('view.student.fee') }}">Student Fee</a> </p>
        <div class="data-table large-table" style="margin-bottom:0rem; padding-bottom:2rem; border-bottom:3px solid #2384B4;">
            <div><h2>Add Employee Salary</h2></div>
            <hr>
            <div class="row" style="padding-top:1.5rem; width:40vw;">
                <div class="form-group">
                    <h3>Date</h3>
                    <input type="date" name="date" id="date">  
                </div>
                <div class="form-group" style="padding-top:2.3rem;">
                    <button class="create"  name="search" id="search" style="width:max-content;">Search</button>
                </div>
            </div>
        </div>
        <div class="data-table large-table">
            <div style="display:flex; justify-content:space-between; ">
                <div><h2>Viewing Employee Lists</h2></div>
            </div>
            <hr>
            <div class="scroll-table"> 
                <div id="DocumentResults">
                    <script id="document-template" type="text/x-handlebars-template">
                        <form action="{{ route('create.finance.employee.salary') }}" method="POST">
                            @csrf
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
                            <button type="submit" class="add">Submit</button>
                        </form>    
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
    $(document).on('click','#search',function(){
        var date=$('#date').val();
        $.ajax({
            url:"{{ route('finance.get.employee.salary') }}",
            type:"get",
            data:{'date':date},
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
