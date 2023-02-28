<?php

namespace App\Http\Controllers\Backend_Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    public function EditProfile($id)
    {
    }
}
