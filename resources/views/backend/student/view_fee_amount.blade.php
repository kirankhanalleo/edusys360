@extends('admin.admin_master')
@section('admin')
<main>
    @include('admin.body.header')
    <p class="text-muted pt"><b><a href="{{ route('dashboard') }}">Home</a></b> - <a href="{{ route('view.fee.category') }}">Fee Categories Amount</a> </p>
    <div class="data-table large-table">
        <div style="display:flex; justify-content:space-between; ">
            <div><h2>Viewing Fee Categories Amount</h2></div>
            <div class="searchbar">
                <input type="text" id="search-input" onkeyup="searchBar()" placeholder="Search" class="searchbar">  
                <span class="material-symbols-sharp">search</span> 
            </div>
            <div><a href="{{ route('add.fee.amount') }}"><button class="add" >Add Fee Amount</button></a></div> 
        </div>
        <hr>
        <div class="scroll-table">
            <table  cellspacing="0" cellpadding="0" id="data-table">
                <thead>
                    <tr>
                        <th width="10%">S.N</th>
                        <th width="80%">Fee Category</th>
                        <th>Action</th>
                    </tr>
                    <tbody>
                        <!--Fetching data from database-->
                        @foreach ($allData as $key=>$amount)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $amount['fee_category']['name'] }}</td>
                                <td class="edit-delete">
                                    <a class="view-btn" title="view" href="{{  route('fee.amount.details',$amount->fee_category_id) }}"><span class="material-symbols-sharp">visibility</span></a>
                                    <a class="edit-btn" title="edit" href="{{ route('edit.fee.amount',$amount->fee_category_id) }}"><span class="material-symbols-sharp">edit_square</span></a>
                                    <a class="delete-btn" title="delete" class="disabled-link" href="javascript:void(0)"><span class="material-symbols-sharp">delete</span></a>
                                  </td>
                            </tr> 
                        @endforeach
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
