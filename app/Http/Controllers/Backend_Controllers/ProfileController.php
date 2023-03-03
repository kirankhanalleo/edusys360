<?php

namespace App\Http\Controllers\Backend_Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    public function ViewProfile()
    {
        //Getting authenticated user data
        $id = Auth::User()->id;
        $user = User::find($id);
        return view('backend.user.view_profile', compact('user'));
    }
    public function EditProfile()
    {
        $id = Auth::user()->id;
        $editProfileData = User::find($id);
        return view('backend.user.edit_profile', compact('editProfileData'));
    }
    public function UpdateProfile(Request $request)
    {
        $data = User::find(Auth::user()->id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->telephone = $request->telephone;
        $data->address = $request->address;

        if ($request->file('profileimg')) {
            $image = $request->file('profileimg');
            @unlink(public_path('assets/userimages/profileimg/' . $data->profileimg));
            $filename = date('YmdHi') . $image->getClientOriginalName();
            $image->move(public_path('assets/userimages/profileimg'), $filename);
            $data['profileimg'] = $filename;
        }
        $data->save();
        $notification = array(
            'message' => 'Profile Updated Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('view.profile')->with($notification);
    }
    public function ViewPassword()
    {
        return view('backend.user.view_password');
    }
    public function UpdatePassword(Request $request)
    {
        $validateData = $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:8|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/',
        ]);
        $encryptedPassword = Auth::user()->password;
        if (Hash::check($request->current_password, $encryptedPassword)) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('login');
        } else {
            return redirect()->back();
        }
    }
}
