@extends('admin.admin_master')
@section('admin')
<main>
    @include('admin.body.header')
    <p class="text-muted pt"><b><a href="{{ route('dashboard') }}">Home</a></b> - <a href="{{ route('view.user') }}">Users</a> </p>
    <div class="data-table large-table">
        <div style="display:flex; justify-content:space-between; ">
            <div><h2>Viewing Users</h2></div>
            <div class="searchbar">
                <input type="text" id="search-input" onkeyup="userSearchBar()" placeholder="Search for user.." class="searchbar">  
                <span class="material-symbols-sharp">search</span> 
            </div>
            <div><button class="add" data-modal-target="#modal-box">Add User</button></div> 
        </div>
        <hr>
        <div class="scroll-table">
            <table  cellspacing="0" cellpadding="0" id="user-table">
                <thead>
                    <tr>
                        <th>S.N</th>
                        <th width="20%">Role</th>
                        <th width="30%">Name</th>
                        <th width="30%">Email</th>
                        <th width="10%">Action</th>
                    </tr>
                    <tbody>
                        <!--Fetching data from database-->
                        @foreach ($allData as $key=>$user)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $user->userrole }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td class="edit-delete">
                                    <a class="view-btn" title="view" href="#"><span class="material-symbols-sharp">visibility</span></a>
                                    <a class="edit-btn" title="edit" href="{{ route('edit.user',$user->id) }}"><span class="material-symbols-sharp">edit_square</span></a>
                                    <a class="delete-btn" title="delete" href="{{ route('delete.user',$user->id) }}"><span class="material-symbols-sharp">delete</span></a>
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
            <div class="title"><h1>Create New User</h1></div>
            <div data-close-button class="modal-close-btn">
                <span class="material-symbols-sharp">close</span> 
            </div>   
        </div>
        <hr>
        <div class="modal-body">
            <form action="{{ route('create.user') }}" method="post">
                @csrf
                <div class="input-form">
                    <div class="row">
                        <div class="form-group">
                            <h3>User Role<span class="danger">*</span></h3>
                            <select name="userrole" id="userrole">
                                <option value="" >Select Role</option>
                                <option value="Admin">Admin</option>
                                <option value="Accountant">Accountant</option>
                            </select>
                            @error('usertype')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                        <div class="form-group">
                            <h3>Full Name<span class="danger">*</span></h3>
                            <input type="text" name="name" id="name">
                            @error('name')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <h3>Email<span class="danger">*</span></h3>
                            <input type="email" name="email" id="email">
                            @error('email')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                        <div class="form-group">
                            <h3>Password<span class="danger">*</span></h3>
                            <input type="password" name="password" id="password">
                            @error('password')
                                <p class="error danger">{{ $message }}</p>
                            @enderror    
                        </div>
                    </div>
                        <button type="submit" class="create user">Create new user</button>
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
