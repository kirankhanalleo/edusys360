@extends('admin.admin_master')
@section('admin')
<main>
    @include('admin.body.header')
    <p class="text-muted pt"><b><a href="{{ route('dashboard') }}">Home</a></b> - <a href="{{ route('view.miscellaneous.cost') }}">Miscellaneous Cost</a> </p>
    <div class="data-table large-table">
        <div style="display:flex; justify-content:space-between; ">
            <div><h2>Viewing Miscellaneous Costs</h2></div>
            <div class="searchbar">
                <input type="text" id="search-input" onkeyup="searchBar()" placeholder="Search" class="searchbar">  
                <span class="material-symbols-sharp">search</span> 
            </div>
            <div><button class="add" data-modal-target="#modal-box">Add Miscellaneous Cost</button></div> 
        </div>
        <hr>
        <div class="scroll-table">
            <table  cellspacing="0" cellpadding="0" id="data-table">
                <thead>
                    <tr>
                        <th width="10%">S.N</th>
                        <th>Date</th>
                        <th>Particulars</th>
                        <th>Quantity</th>
                        <th>Amount</th>
                        <th width="10%">Action</th>
                    </tr>
                    <tbody>
                        <!--Fetching data from database-->
                        @if (count($allData)>0)
                            @foreach ($allData as $key=>$cost)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ date('d-m-Y',strtotime($cost->date))  }}</td>
                                <td>{{ $cost->description  }}</td>
                                <td>{{ $cost->quantity  }}</td>
                                <td>{{ $cost->amount  }}</td>
                                <td class="edit-delete">
                                <a class="edit-btn" title="edit" style="padding-left: 2rem;" href="{{route('edit.miscellaneous.cost',$cost->id) }}"><span class="material-symbols-sharp">edit_square</span></a>
                                </td>
                            </tr> 
                            @endforeach
                        @else
                        <td colspan="5">No data found !</td>
                        @endif
                        
                    </tbody>
                </thead>
            </table>
        </div>
        @if (count($allData)>0)
            <p class="text-muted" id="bottom-text">Showing 1 to {{ count($allData) }} of {{ count($allData) }} entries</p>
        @endif
    </div>
    <!---MODAL BOX START ---->
    <div class="modal-box" id="modal-box">
        <div class="modal-header">
            <div class="title"><h1>Add Miscellaneous Cost</h1></div>
            <div data-close-button class="modal-close-btn">
                <span class="material-symbols-sharp">close</span> 
            </div>   
        </div>
        <hr>
        <div class="modal-body">
            <form action="{{ route('create.miscellaneous.cost') }}" method="post">
                @csrf
                <div class="input-form">
                    <div class="row">
                        <div class="form-group">
                            <h3>Particulars <span class="danger">*</span></h3>
                            <input type="text" name="description" required>
                        </div>
                        <div class="form-group">
                            <h3>Quantity <span class="danger">*</span></h3>
                            <input type="text" name="quantity" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <h3>Date <span class="danger">*</span></h3>
                            <input type="date" name="date" required>
                        </div>
                        <div class="form-group">
                            <h3>Amount <span class="danger">*</span></h3>
                            <input type="text" name="amount" required>
                        </div>
                    </div>
                    <div><br>
                    <button type="submit" class="create">Create Miscellaneous Cost</button>
                    </div> 
                </div>
            </form>    
        </div>
    </div>
    <!---MODAL END ------>
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
