@extends('admin.admin_master')
@section('admin')
<!--HandleBarJs CDN-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.7/handlebars.min.js" integrity="sha512-RNLkV3d+aLtfcpEyFG8jRbnWHxUqVZozacROI4J2F1sTaDqo1dPQYs01OMi1t1w9Y2FdbSCDSQ2ZVdAC8bzgAg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!--JQUERY AJAX CDN-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<main>
    @include('admin.body.header')
    <p class="text-muted pt"><b><a href="{{ route('dashboard') }}">Home</a></b> - <a href="{{ route('view.employee.monthly.salary') }}">Employee Monthly Salary</a> </p>
    <div class="data-table large-table" style="margin-bottom:0rem; padding-bottom:2rem; border-bottom:3px solid #2384B4;">
        <div><h2>Monthly/Annual Account Report</h2></div>
        <hr>
        <div class="row" style="padding-top:1.5rem;">
            <div class="form-group">
                <h3>Start Date</h3>
                <input type="date" name="start_date" id="start_date">  
            </div>
            <div class="form-group">
                <h3>End Date</h3>
                <input type="date" name="date" id="end_date">  
            </div>
            <div class="form-group" style="padding-top:2.3rem; max-width:30vw;">
                <button class="create" id="searchData" name="searchData" style="width:40%;">Search</button>
            </div>
        </div>
        <div class="table">
            <div id="DocumentResults">
                <script id="document-template" type="text/x-handlebars-template">
                    @{{{tableheader}}}
                    <table cellspacing="0" cellpadding="0" class="striped-table">    
                        <tbody>
                            @{{{tdsource}}}
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
    .table{
        max-width: 70vw;
    }
    table{
        margin-top: -2rem;
    }
</style>
<!--HANDLEBARJS Script-->
<script type="text/javascript">
    $(document).on('click','#searchData',function(){
        var start_date=$('#start_date').val();
        var end_date=$('#end_date').val();
        $.ajax({
            url:"{{ route('get.profit.by.date') }}",
            type:"get",
            data:{'start_date':start_date,'end_date':end_date},
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
