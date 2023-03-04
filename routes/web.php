<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend_Controllers\UserControllers;
use App\Http\Controllers\Backend_Controllers\ProfileController;
use App\Http\Controllers\Backend_Controllers\Configure_System\StudentClassController;
use App\Http\Controllers\Backend_Controllers\Configure_System\AcademicYearController;
use App\Http\Controllers\Backend_Controllers\Configure_System\FeeCategoryController;
use App\Models\AcademicYear;

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
    Route::get('/edit', [ProfileController::class, 'EditProfile'])->name('edit.profile');
    Route::post('/update', [ProfileController::class, 'UpdateProfile'])->name('update.profile');
    Route::get('/password/view', [ProfileController::class, 'ViewPassword'])->name('view.password');
    Route::post('password/update', [ProfileController::class, 'UpdatePassword'])->name('update.password');
});
//All Routes for System Configuration
Route::prefix('configure')->group(function () {
    //Student Class All Routes
    Route::get('/student/class/view', [StudentClassController::class, 'ViewClass'])->name('view.class');
    Route::get('/student/class/add', [StudentClassController::class, 'AddClass'])->name('add.class');
    Route::post('student/class/create', [StudentClassController::class, 'CreateClass'])->name('create.class');
    Route::get('student/class/edit/{id}', [StudentClassController::class, 'EditClass'])->name('edit.class');
    Route::post('/student/class/update/{id}', [StudentClassController::class, 'UpdateClass'])->name('update.class');
    Route::get('/student/class/delete/{id}', [StudentClassController::class, 'DeleteClass'])->name('delete.class');

    //Academic Year All Routes
    Route::get('/academicyear/view', [AcademicYearController::class, 'ViewYear'])->name('view.year');
    Route::get('academicyear/add', [AcademicYearController::class, 'AddYear'])->name('add.year');
    Route::post('academicyear/create', [AcademicYearController::class, 'CreateYear'])->name('create.year');
    Route::get('/academicyear/edit/{id}', [AcademicYearController::class, 'EditYear'])->name('edit.year');
    Route::post('/academicyear/update/{id}', [AcademicYearController::class, 'UpdateYear'])->name('update.year');
    Route::get('/academicyear/delete/{id}', [AcademicYearController::class, 'DeleteYear'])->name('delete.year');

    //Fee Categories All Routes
    Route::get('/fee/category/view', [FeeCategoryController::class, 'ViewFeeCategory'])->name('view.fee.category');
    Route::get('/fee/category/add', [FeeCategoryController::class, 'AddFeeCategory'])->name('add.fee.category');
    Route::post('fee/category/create', [FeeCategoryController::class, 'CreateFeeCategory'])->name('create.fee.category');
    Route::get('fee/category/edit/{id}', [FeeCategoryController::class, 'EditFeeCategory'])->name('edit.fee.category');
    Route::post('fee/category/update/{id}', [FeeCategoryController::class, 'UpdateFeeCategory'])->name('update.fee.category');
    Route::get('fee/category/delete/{id}', [FeeCategoryController::class, 'DeleteFeeCategory'])->name('delete.fee.category');
});
