<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ViewServiceProvider extends ServiceProvider
{
    public function register()
    {
    }
    public function boot()
    {
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $id = Auth::User()->id;
                $user = User::find($id);
                $view->with(compact('user'));
            }
        });
    }
}
