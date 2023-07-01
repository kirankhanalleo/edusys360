<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
use App\Http\Controllers\Backend_Controllers\Configure_System\DesignationController;
use App\Http\Controllers\Backend_Controller\Student_Management\StudentRegistrationController;
use App\Models\AcademicYear;
use App\Models\SubjectAssignment;
use App\Models\SubjectModel;
use App\Models\Designation;
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
Route::prefix('system')->group(function () {
    //Class Management All Routes
    Route::get('class/view', [StudentClassController::class, 'ViewClass'])->name('view.class');
    Route::get('class/add', [StudentClassController::class, 'AddClass'])->name('add.class');
    Route::post('class/create', [StudentClassController::class, 'CreateClass'])->name('create.class');
    Route::get('class/edit/{id}', [StudentClassController::class, 'EditClass'])->name('edit.class');
    Route::post('class/update/{id}', [StudentClassController::class, 'UpdateClass'])->name('update.class');
    Route::get('class/delete/{id}', [StudentClassController::class, 'DeleteClass'])->name('delete.class');
    //Assign Subject All Routes
    Route::get('/subject/view', [SubjectAssignmentController::class, 'ViewAssignedSubjects'])->name('view.assign.subjects');
    Route::get('/subject/add', [SubjectAssignmentController::class, 'AddAssignedSubject'])->name('assign.new.subject');
    Route::post('/subject/create', [SubjectAssignmentController::class, 'CreateAssignedSubject'])->name('create.assigned.subject');
    Route::get('/subject/edit/{class_id}', [SubjectAssignmentController::class, 'EditAssignedSubject'])->name('edit.assigned.subject');
    Route::post('/subject/update/{class_id}', [SubjectAssignmentController::class, 'UpdateAssignedSubject'])->name('update.assigned.subject');
    Route::get('/subject/details/{class_id}', [SubjectAssignmentController::class, 'SubjectAssignmentDetails'])->name('assigned.subject.details');

    //Academic Year All Routes
    Route::get('year/view', [AcademicYearController::class, 'ViewYear'])->name('view.year');
    Route::get('year/add', [AcademicYearController::class, 'AddYear'])->name('add.year');
    Route::post('year/create', [AcademicYearController::class, 'CreateYear'])->name('create.year');
    Route::get('year/edit/{id}', [AcademicYearController::class, 'EditYear'])->name('edit.year');
    Route::post('year/update/{id}', [AcademicYearController::class, 'UpdateYear'])->name('update.year');
    Route::get('year/delete/{id}', [AcademicYearController::class, 'DeleteYear'])->name('delete.year');

    //Fee Categories All Routes
    Route::get('fee/category/view', [FeeCategoryController::class, 'ViewFeeCategory'])->name('view.fee.category');
    Route::get('fee/category/add', [FeeCategoryController::class, 'AddFeeCategory'])->name('add.fee.category');
    Route::post('fee/category/create', [FeeCategoryController::class, 'CreateFeeCategory'])->name('create.fee.category');
    Route::get('fee/category/edit/{id}', [FeeCategoryController::class, 'EditFeeCategory'])->name('edit.fee.category');
    Route::post('fee/category/update/{id}', [FeeCategoryController::class, 'UpdateFeeCategory'])->name('update.fee.category');
    Route::get('fee/category/delete/{id}', [FeeCategoryController::class, 'DeleteFeeCategory'])->name('delete.fee.category');

    //Fee Category Amount All Routes
    Route::get('fee/amount/view', [FeeAmountController::class, 'ViewFeeAmount'])->name('view.fee.amount');
    Route::get('fee/amount/add', [FeeAmountController::class, 'AddFeeAmount'])->name('add.fee.amount');
    Route::post('fee/amount/create', [FeeAmountController::class, 'CreateFeeAmount'])->name('create.fee.amount');
    Route::get('fee/amount/edit/{fee_category_id}', [FeeAmountController::class, 'EditFeeAmount'])->name('edit.fee.amount');
    Route::post('fee/amount/update/{fee_category_id}', [FeeAmountController::class, 'UpdateFeeAmount'])->name('update.fee.amount');
    Route::get('fee/amount/details/{fee_category_id}', [FeeAmountController::class, 'FeeAmountDetails'])->name('fee.amount.details');

    //Exam Model All Routes
    Route::get('exam/model/view', [ExamModelController::class, 'ViewExamModel'])->name('view.exam.model');
    Route::get('exam/model/add', [ExamModelController::class, 'AddExamModel'])->name('add.exam.model');
    Route::post('exam/model/create', [ExamModelController::class, 'CreateExamModel'])->name('create.exam.model');
    Route::get('exam/model/edit/{id}', [ExamModelController::class, 'EditExamModel'])->name('edit.exam.model');
    Route::post('exam/model/update/{id}', [ExamModelController::class, 'UpdateExamModel'])->name('update.exam.model');
    Route::get('exam/model/delete/{id}', [ExamModelController::class, 'DeleteExamModel'])->name('delete.exam.model');

    //Manage Subjects All Routes
    Route::get('/subjects/view', [SubjectController::class, 'ViewSubjects'])->name('view.subjects');
    Route::get('subjects/add', [SubjectController::class, 'AddSubjects'])->name('add.subject');
    Route::post('/subjects/create', [SubjectController::class, 'CreateSubjects'])->name('create.subject');
    Route::get('subjects/edit/{id}', [SubjectController::class, 'EditSubjects'])->name('edit.subject');
    Route::post('/subjects/update/{id}', [SubjectController::class, 'UpdateSubjects'])->name('update.subjects');
    Route::get('/subjects/delete/{id}', [SubjectController::class, 'DeleteSubjects'])->name('delete.subject');

    //Designation All Routes
    Route::get('designation/view', [DesignationController::class, 'ViewDesignation'])->name('view.designation');
    Route::post('designation/create', [DesignationController::class, 'CreateDesignation'])->name('create.designation');
    Route::get('designation/edit/{id}', [DesignationController::class, 'EditDesignation'])->name('edit.designation');
    Route::post('designation/update/{id}', [DesignationController::class, 'UpdateDesignation'])->name('update.designation');
    Route::get('designation/delete/{id}', [DesignationController::class, 'DeleteDesignation'])->name('delete.designation');
});
//Student Registration All Routes
Route::prefix('student')->group(function () {
    Route::get('/view', [StudentRegistrationController::class, 'ViewStudentRegistration'])->name('view.student.registration');
    Route::post('/create', [StudentRegistrationController::class, 'CreateStudentRegistration'])->name('create.student.registration');
    Route::get('/list/display', [StudentRegistrationController::class, 'DisplayStudentList'])->name('show.list');
    Route::get('/edit/{student_id}', [StudentRegistrationController::class, 'EditStudentDetails'])->name('edit.student');
    Route::post('/update/{student_id}', [StudentRegistrationController::class, 'UpdateStudentDetails'])->name('update.student.registration');
    Route::get('/promote/{student_id}', [StudentRegistrationController::class, 'PromoteStudent'])->name('promote.student');
    Route::post('/promote/save/{student_id}', [StudentRegistrationController::class, 'SaveStudentPromotion'])->name('promote.student.save');
});
