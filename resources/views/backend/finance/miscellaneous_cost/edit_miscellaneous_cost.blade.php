@extends('admin.admin_master')
@section('admin')
<main>
    @include('admin.body.header')
    <p class="text-muted pt"><b><a href="{{ route('dashboard') }}">Home</a></b> - <a href="{{ route('view.miscellaneous.cost') }}">Miscellaneous Cost</a> </p>
    <div class="data-table large-table">
        <div style="display:flex; justify-content:space-between;">
            <div><h2>Edit Miscellaneous Cost</h2></div>
        </div>
        <hr>
        <div class="modal-body" style="margin-bottom: 1.5rem;">
            <form action="{{ route('update.miscellaneous.cost',$editData->id) }}" method="post">
                @csrf
                <input type="hidden" name="id" value={{ $editData->id }}>
                <div class="input-form">
                    <div class="row">
                        <div class="form-group">
                            <h3>Particulars<span class="danger">*</span></h3>
                            <input type="text"  name="description" value={{ $editData->description }}>   
                        </div>
                        <div class="form-group">
                            <h3>Quantity <span class="danger">*</span></h3>
                            <input type="text"  name="quantity" value={{ $editData->quantity }}>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <h3>Date<span class="danger">*</span></h3>
                            <input type="date"  name="date" value={{ $editData->date }}>   
                        </div>
                        <div class="form-group">
                            <h3>Amount <span class="danger">*</span></h3>
                            <input type="text"  name="amount" value={{ $editData->amount }}>
                        </div>
                    </div>
                    <div><br>
                    <button type="submit" class="create">Update Miscellaneous Cost</button>
                    </div> 
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
