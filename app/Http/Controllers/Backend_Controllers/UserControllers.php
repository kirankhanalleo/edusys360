<?php

namespace App\Http\Controllers\Backend_Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserControllers extends Controller
{
    public function ViewUser()
    {
        //importing data as array from database
        $data['allData'] = User::where('userrole', 'Admin')->get();
        //returning view page with the received data
        return view('backend.user.view_user', $data);
    }
    public function AddUser()
    {
        return view('backend.user.add_user');
    }
    public function CreateUser(Request $request)
    {
        $validateData = $request->validate([
            'email' => 'required|unique:users',
            'name' => 'required',
            // 'userrole' => 'required|in:Admin,Accountant',
            'password' => 'required|min:8|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/'
        ]);
        $data = new User();
        $data->userrole = 'Admin';
        $data->role = $request->role;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->save();

        $notification = array(
            'message' => 'User Created Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('view.user')->with($notification);
    }
    public function EditUser($id)
    {
        $editData = User::find($id);
        return view('backend.user.edit_user', compact('editData'));
    }
    public function UpdateUser(Request $request, $id)
    {
        $data =  User::find($id);
        $data->userrole = $request->userrole;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->save();

        $notification = array(
            'message' => 'User Updated Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('view.user')->with($notification);
    }
    public function DeleteUser($id)
    {
        $user = User::find($id);
        $user->delete();

        $notification = array(
            'message' => 'User Deleted Successfully !',
            'alert-type' => 'success'
        );
        return redirect()->route('view.user')->with($notification);
    }
}
