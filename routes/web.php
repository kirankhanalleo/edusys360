<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend_Controllers\UserControllers;
use App\Http\Controllers\Backend_Controllers\ProfileController;
use App\Http\Controllers\Backend_Controllers\Configure_System\StudentClassController;
use App\Http\Controllers\Backend_Controllers\Configure_System\AcademicYearController;
use App\Http\Controllers\Backend_Controllers\Configure_System\FeeCategoryController;
use App\Http\Controllers\Backend_Controllers\Configure_System\FeeAmountController;
use App\Http\Controllers\Backend_Controllers\Configure_System\ExamModelController;
use App\Http\Controllers\Backend_Controllers\Configure_System\SubjectController;
use App\Models\AcademicYear;
use App\Models\SubjectModel;

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

    //Fee Category Amount All Routes
    Route::get('/fee/amount/view', [FeeAmountController::class, 'ViewFeeAmount'])->name('view.fee.amount');
    Route::get('/fee/amount/add', [FeeAmountController::class, 'AddFeeAmount'])->name('add.fee.amount');
    Route::post('fee/amount/create', [FeeAmountController::class, 'CreateFeeAmount'])->name('create.fee.amount');
    Route::get('fee/amount/edit/{fee_category_id}', [FeeAmountController::class, 'EditFeeAmount'])->name('edit.fee.amount');
    Route::post('fee/amount/update/{fee_category_id}', [FeeAmountController::class, 'UpdateFeeAmount'])->name('update.fee.amount');
    Route::get('fee/amount/details/{fee_category_id}', [FeeAmountController::class, 'FeeAmountDetails'])->name('fee.amount.details');

    //Exam Model All Routes
    Route::get('/exam/model/view', [ExamModelController::class, 'ViewExamModel'])->name('view.exam.model');
    Route::get('/exam/model/add', [ExamModelController::class, 'AddExamModel'])->name('add.exam.model');
    Route::post('/exam/model/create', [ExamModelController::class, 'CreateExamModel'])->name('create.exam.model');
    Route::get('/exam/model/edit/{id}', [ExamModelController::class, 'EditExamModel'])->name('edit.exam.model');
    Route::post('/exam/model/update/{id}', [ExamModelController::class, 'UpdateExamModel'])->name('update.exam.model');
    Route::get('/exam/model/delete/{id}', [ExamModelController::class, 'DeleteExamModel'])->name('delete.exam.model');

    //Subjects All Routes
    Route::get('/subjects/view', [SubjectController::class, 'ViewSubjects'])->name('view.subjects');
    Route::get('subjects/add', [SubjectController::class, 'AddSubjects'])->name('add.subject');
    Route::post('/subjects/create', [SubjectController::class, 'CreateSubjects'])->name('create.subject');
    Route::get('subjects/edit/{id}', [SubjectController::class, 'EditSubjects'])->name('edit.subject');
    Route::post('/subjects/update/{id}', [SubjectController::class, 'UpdateSubjects'])->name('update.subjects');
    Route::get('/subjects/delete/{id}', [SubjectController::class, 'DeleteSubjects'])->name('delete.subject');
});
