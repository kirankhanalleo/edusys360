<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend_Controllers\UserControllers;
use App\Http\Controllers\Backend_Controllers\ProfileController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');
});

Route::get('/user/logout', [UserController::class, 'Logout'])->name('user.logout');

//All Routes for User Management
Route::prefix('users')->group(function () {
    Route::get('/view', [UserControllers::class, 'ViewUser'])->name('view.user');
    Route::get('/add', [UserControllers::class, 'AddUser'])->name('add.user');
    Route::post('/create', [UserControllers::class, 'CreateUser'])->name('create.user');
    Route::get('/edit/{id}', [UserControllers::class, 'EditUser'])->name('edit.user');
    Route::post('/update/{id}', [UserControllers::class, 'UpdateUser'])->name('update.user');
    Route::get('/delete/{id}', [UserControllers::class, 'DeleteUser'])->name('delete.user');
});

//All Routes for Profile Management
Route::prefix('profile')->group(function () {
    Route::get('/view', [ProfileController::class, 'ViewProfile'])->name('view.profile');
    Route::get('/edit/{id}', [ProfileController::class, 'EditProfile'])->name('edit.profile');
});
