@extends('admin.admin_master')
@section('admin')
<main>
    @include('admin.body.header')
    <p class="text-muted pt"><b><a href="{{ route('dashboard') }}">Home</a></b> - <a href="{{ route('view.year') }}">School Year</a> </p>
    <div class="data-table large-table">
        <div style="display:flex; justify-content:space-between; ">
            <div><h2>Viewing School Year</h2></div>
            <div class="searchbar">
                <input type="text" id="search-input" onkeyup="searchBar()" placeholder="Search" class="searchbar">  
                <span class="material-symbols-sharp">search</span> 
            </div>
            <div><button class="add" data-modal-target="#modal-box">Add New Year</button></div> 
        </div>
        <hr>
        <div class="scroll-table">
            <table  cellspacing="0" cellpadding="0" id="data-table">
                <thead>
                    <tr>
                        <th width="10%">S.N</th>
                        <th width="80%">School Year</th>
                        <th>Action</th>
                    </tr>
                    <tbody>
                        <!--Fetching data from database-->
                        @foreach ($allData as $key=>$year)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $year->name }}</td>
                                <td class="edit-delete">
                                    <a class="view-btn" title="view" href="#"><span class="material-symbols-sharp">visibility</span></a>
                                    <a class="edit-btn" title="edit" href="{{ route('edit.year',$year->id) }}"><span class="material-symbols-sharp">edit_square</span></a>
                                    <a class="delete-btn" title="delete" id="deleteYear" href="{{ route('delete.year',$year->id) }}"><span class="material-symbols-sharp">delete</span></a>
                                  </td>
                            </tr> 
                        @endforeach
                    </tbody>
                </thead>
            </table>
        </div>
        
        <p class="text-muted" id="bottom-text">Showing 1 to {{ count($allData) }} of {{ count($allData) }} entries</p>
    </div>
    <!---MODAL BOX START ---->
    <div class="modal-box" id="modal-box">
        <div class="modal-header">
            <div class="title"><h1>Create School Year</h1></div>
            <div data-close-button class="modal-close-btn">
                <span class="material-symbols-sharp">close</span> 
            </div>   
        </div>
        <hr>
        <div class="modal-body">
            <form action="{{ route('create.year') }}" method="post">
                @csrf
                <div class="input-form">
                    <div class="form-group">
                        <h3>School Year <span class="danger">*</span></h3>
                        <input type="text" name="name" id="name">
                        @error('name')
                            <p class="error danger">{{ $message }}</p>
                        @enderror    
                    </div>
                    <div>
                        <button type="submit" class="create">Create Year</button>
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
