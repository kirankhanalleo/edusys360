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
use App\Http\Controllers\Backend_Controllers\Configure_System\SubjectAssignmentController;
use App\Models\AcademicYear;
use App\Models\SubjectAssignment;
use App\Models\SubjectModel;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


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
//Student Class All Routes
Route::prefix('class')->group(function () {
    Route::get('/view', [StudentClassController::class, 'ViewClass'])->name('view.class');
    Route::get('/add', [StudentClassController::class, 'AddClass'])->name('add.class');
    Route::post('/create', [StudentClassController::class, 'CreateClass'])->name('create.class');
    Route::get('/edit/{id}', [StudentClassController::class, 'EditClass'])->name('edit.class');
    Route::post('/update/{id}', [StudentClassController::class, 'UpdateClass'])->name('update.class');
    Route::get('/delete/{id}', [StudentClassController::class, 'DeleteClass'])->name('delete.class');

    //Assign Subject All Routes
    Route::get('/assign/subject/view', [SubjectAssignmentController::class, 'ViewAssignedSubjects'])->name('view.assign.subjects');
    Route::get('/assign/subject/add', [SubjectAssignmentController::class, 'AddAssignedSubject'])->name('assign.new.subject');
    Route::post('/assign/subject/create', [SubjectAssignmentController::class, 'CreateAssignedSubject'])->name('create.assigned.subject');
    Route::get('/assign/subject/edit/{class_id}', [SubjectAssignmentController::class, 'EditAssignedSubject'])->name('edit.assigned.subject');
    Route::post('/assign/subject/update/{class_id}', [SubjectAssignmentController::class, 'UpdateAssignedSubject'])->name('update.assigned.subject');
});
//Academic Year All Routes
Route::prefix('academicyear')->group(function () {
    Route::get('/view', [AcademicYearController::class, 'ViewYear'])->name('view.year');
    Route::get('/add', [AcademicYearController::class, 'AddYear'])->name('add.year');
    Route::post('/create', [AcademicYearController::class, 'CreateYear'])->name('create.year');
    Route::get('/edit/{id}', [AcademicYearController::class, 'EditYear'])->name('edit.year');
    Route::post('/update/{id}', [AcademicYearController::class, 'UpdateYear'])->name('update.year');
    Route::get('/delete/{id}', [AcademicYearController::class, 'DeleteYear'])->name('delete.year');
});
//Fee All Routes
Route::prefix('fee')->group(function () {
    //Fee Categories All Routes
    Route::get('/category/view', [FeeCategoryController::class, 'ViewFeeCategory'])->name('view.fee.category');
    Route::get('/category/add', [FeeCategoryController::class, 'AddFeeCategory'])->name('add.fee.category');
    Route::post('/category/create', [FeeCategoryController::class, 'CreateFeeCategory'])->name('create.fee.category');
    Route::get('/category/edit/{id}', [FeeCategoryController::class, 'EditFeeCategory'])->name('edit.fee.category');
    Route::post('/category/update/{id}', [FeeCategoryController::class, 'UpdateFeeCategory'])->name('update.fee.category');
    Route::get('/category/delete/{id}', [FeeCategoryController::class, 'DeleteFeeCategory'])->name('delete.fee.category');
});
Route::prefix('feeamount')->group(function () {
    //Fee Category Amount All Routes
    Route::get('/amount/view', [FeeAmountController::class, 'ViewFeeAmount'])->name('view.fee.amount');
    Route::get('/amount/add', [FeeAmountController::class, 'AddFeeAmount'])->name('add.fee.amount');
    Route::post('/amount/create', [FeeAmountController::class, 'CreateFeeAmount'])->name('create.fee.amount');
    Route::get('/amount/edit/{fee_category_id}', [FeeAmountController::class, 'EditFeeAmount'])->name('edit.fee.amount');
    Route::post('/amount/update/{fee_category_id}', [FeeAmountController::class, 'UpdateFeeAmount'])->name('update.fee.amount');
    Route::get('/amount/details/{fee_category_id}', [FeeAmountController::class, 'FeeAmountDetails'])->name('fee.amount.details');
});
//Exam Model All Routes
Route::prefix('exam')->group(function () {
    Route::get('/model/view', [ExamModelController::class, 'ViewExamModel'])->name('view.exam.model');
    Route::get('/model/add', [ExamModelController::class, 'AddExamModel'])->name('add.exam.model');
    Route::post('/model/create', [ExamModelController::class, 'CreateExamModel'])->name('create.exam.model');
    Route::get('/model/edit/{id}', [ExamModelController::class, 'EditExamModel'])->name('edit.exam.model');
    Route::post('/model/update/{id}', [ExamModelController::class, 'UpdateExamModel'])->name('update.exam.model');
    Route::get('/model/delete/{id}', [ExamModelController::class, 'DeleteExamModel'])->name('delete.exam.model');
});
//Subjects All Routes
Route::prefix('course')->group(function () {
    //Manage Subjects All Routes
    Route::get('/subjects/view', [SubjectController::class, 'ViewSubjects'])->name('view.subjects');
    Route::get('subjects/add', [SubjectController::class, 'AddSubjects'])->name('add.subject');
    Route::post('/subjects/create', [SubjectController::class, 'CreateSubjects'])->name('create.subject');
    Route::get('subjects/edit/{id}', [SubjectController::class, 'EditSubjects'])->name('edit.subject');
    Route::post('/subjects/update/{id}', [SubjectController::class, 'UpdateSubjects'])->name('update.subjects');
    Route::get('/subjects/delete/{id}', [SubjectController::class, 'DeleteSubjects'])->name('delete.subject');
});
