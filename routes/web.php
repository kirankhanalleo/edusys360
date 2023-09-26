<?php

use App\Http\Controllers\Backend_Controller\Employee_Management\EmployeeLeaveController;
use Illuminate\Support\Facades\Route;
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
use App\Http\Controllers\Backend_Controller\Student_Management\AdmissionFeeController;
use App\Http\Controllers\Backend_Controller\Student_Management\MonthlyFeeController;
use App\Http\Controllers\Backend_Controller\Student_Management\ExamFeeController;
use App\Http\Controllers\Backend_Controller\Employee_Management\EmployeeRegistrationController;
use App\Http\Controllers\Backend_Controller\Employee_Management\EmployeeSalaryController;
use App\Http\Controllers\Backend_Controller\Employee_Management\EmployeeAttendanceController;
use App\Http\Controllers\Backend_Controller\Employee_Management\EmployeeMonthlySalaryController;
use App\Http\Controllers\Backend_Controller\Exam_Management\ExamMarksController;
use App\Http\Controllers\Backend_Controller\Exam_Management\GradePointController;
use App\Http\Controllers\Backend_Controller\PrimaryController;
use App\Http\Controllers\Backend_Controller\Finance_Management\StudentFeeController;
use App\Http\Controllers\Backend_Controller\Finance_Management\FinanceSalaryController;
use App\Http\Controllers\Backend_Controller\Finance_Management\MiscellaneousCostController;
use App\Http\Controllers\Backend_Controller\Report_Analytics\ProfitController;
use App\Http\Controllers\Backend_Controller\Report_Analytics\StudentMarksheetController;
use App\Models\Employee;
use App\Models\EmployeeSalaryRecords;
use App\Models\FinanceEmployeeSalary;
use App\Models\MiscellaneousCost;
use App\Models\StudentFee;
use App\Models\Students;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        $data['students'] = Students::all();
        $data['employee'] = Employee::all();
        $data['income'] = StudentFee::sum('amount');
        $data['expense'] = FinanceEmployeeSalary::sum('amount');
        return view('admin.index', $data);
    })->name('dashboard');
});
Route::get('/user/logout', [UserController::class, 'Logout'])->name('user.logout');
Route::group(['middleware' => 'auth'], function () {
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
        Route::get('/view/{student_id}', [StudentRegistrationController::class, 'ViewStudentDetails'])->name('view.student.details');
        Route::post('/create', [StudentRegistrationController::class, 'CreateStudentRegistration'])->name('create.student.registration');
        Route::get('/list/display', [StudentRegistrationController::class, 'DisplayStudentList'])->name('show.list');
        Route::get('/edit/{student_id}', [StudentRegistrationController::class, 'EditStudentDetails'])->name('edit.student');
        Route::post('/update/{student_id}', [StudentRegistrationController::class, 'UpdateStudentDetails'])->name('update.student.registration');
        Route::get('/promote/{student_id}', [StudentRegistrationController::class, 'PromoteStudent'])->name('promote.student');
        Route::post('/promote/save/{student_id}', [StudentRegistrationController::class, 'SaveStudentPromotion'])->name('promote.student.save');

        //Admission Fee All Routes
        Route::get('/admisson/fee/view', [AdmissionFeeController::class, 'ViewAdmissionFee'])->name('view.admission.fee');
        Route::get('/admisson/fee/view/class', [AdmissionFeeController::class, 'ViewAdmissionFeeByClass'])->name('view.admission.fee.by.class');
        Route::get('/admisson/fee/view/payslip', [AdmissionFeeController::class, 'ViewAdmissionFeePaySlip'])->name('admission.fee.payslip');

        //Monthly Tuition Fee All Routes
        Route::get('/monthly/fee/view', [MonthlyFeeController::class, 'ViewMonthlyFee'])->name('view.monthly.fee');
        Route::get('/monthly/fee/view/class', [MonthlyFeeController::class, 'ViewMonthlyFeeByClass'])->name('view.monthly.fee.by.class');
        Route::get('/monthly/fee/view/payslip', [MonthlyFeeController::class, 'ViewMonthlyFeePaySlip'])->name('monthly.fee.payslip');

        //Exam Fee All Routes
        Route::get('/exam/fee/view', [ExamFeeController::class, 'ViewExamFee'])->name('view.exam.fee');
        Route::get('/exam/fee/view/class', [ExamFeeController::class, 'ViewExamFeeByClass'])->name('view.exam.fee.by.class');
        Route::get('/exam/fee/view/payslip', [ExamFeeController::class, 'ViewExamFeePaySlip'])->name('exam.fee.payslip');
    });
    //Employee Management ALl Routes
    Route::prefix('employee')->group(function () {
        Route::get('/view', [EmployeeRegistrationController::class, 'ViewEmployee'])->name('view.employee');
        Route::post('/register', [EmployeeRegistrationController::class, 'RegisterEmployee'])->name('create.employee.registration');
        Route::get('/edit/{id}', [EmployeeRegistrationController::class, 'EditEmployee'])->name('edit.employee.registration');
        Route::post('/update/{id}', [EmployeeRegistrationController::class, 'UpdateEmployeeDetails'])->name('update.employee.registration');

        //Employee Salary All Routes
        Route::get('/salary/view', [EmployeeSalaryController::class, 'ViewEmployeeSalary'])->name('view.employee.salary');
        Route::get('/salary/increase/{id}', [EmployeeSalaryController::class, 'IncreaseEmployeeSalary'])->name('increase.employee.salary');
        Route::post('/salary/increase/save/{id}', [EmployeeSalaryController::class, 'SaveIncreasedSalary'])->name('increase.employee.salary.save');
        Route::get('/salary/view/details{id}', [EmployeeSalaryController::class, 'ViewSalaryDetails'])->name('view.salary.details');

        //Employee Leave All Routes
        Route::get('/leave/view', [EmployeeLeaveController::class, 'ViewEmployeeLeave'])->name('view.employee.leave');
        Route::post('/leave/create', [EmployeeLeaveController::class, 'CreateEmployeeLeave'])->name('create.employee.leave');
        Route::get('/leave/edit/{id}', [EmployeeLeaveController::class, 'EditEmployeeLeave'])->name('edit.employee.leave');
        Route::post('/leave/update/{id}', [EmployeeLeaveController::class, 'UpdateEmployeeLeave'])->name('update.employee.leave');
        Route::get('/leave/delete/{id}', [EmployeeLeaveController::class, 'DeleteEmployeeLeave'])->name('delete.employee.leave');

        //Employee Attendance All Routes
        Route::get('/attendance/view', [EmployeeAttendanceController::class, 'ViewEmployeeAttendance'])->name('view.employee.attendance');
        Route::get('/attendance/add', [EmployeeAttendanceController::class, 'AddEmployeeAttendance'])->name('add.employee.attendance');
        Route::post('/attendance/save', [EmployeeAttendanceController::class, 'CreateEmployeeAttendance'])->name('create.employee.attendance');
        Route::get('/attendance/edit/{date}', [EmployeeAttendanceController::class, 'EditEmployeeAttendance'])->name('edit.employee.attendance');
        Route::post('/attendance/update', [EmployeeAttendanceController::class, 'UpdateEmployeeAttendance'])->name('update.employee.attendance');
        Route::get('/attendance/view/details/{date}', [EmployeeAttendanceController::class, 'ViewEmployeeAttendanceDetails'])->name('view.employee.attendance.details');

        //Employee Salary All Routes
        Route::get('/monthly/salary/view', [EmployeeMonthlySalaryController::class, 'ViewEmployeeMonthlySalary'])->name('view.employee.monthly.salary');
        Route::get('/monthly/salary/get', [EmployeeMonthlySalaryController::class, 'GetEmployeeMonthlySalary'])->name('get.employee.monthly.salary');
        Route::get('/monthly/salary/view/payslip/{emp_id}', [EmployeeMonthlySalaryController::class, 'ViewEmployeeMonthlySalaryPaySlip'])->name('employee.monthly.salary.payslip');
    });
});
Route::prefix('/exam')->group(function () {
    //Marks Management All Routes
    Route::get('/marks/add', [ExamMarksController::class, 'AddExamMarks'])->name('add.exam.marks');
    Route::post('/marks/create', [ExamMarksController::class, 'CreateStudentExamMarks'])->name('create.student.exam.marks');
    Route::post('/marks/update', [ExamMarksController::class, 'UpdateStudentExamMarks'])->name('update.student.exam.marks');
    Route::get('/marks/edit', [ExamMarksController::class, 'EditStudentExamMarks'])->name('edit.exam.marks');
    Route::get('/marks/getsubject', [PrimaryController::class, 'GetSubject'])->name('class.get.subject');
    Route::get('/marks/getstudents', [PrimaryController::class, 'GetStudents'])->name('class.get.students');
    Route::get('/marks/editstudentsmarks', [ExamMarksController::class, 'EditStudentsMarks'])->name('edit.student.marks');

    //Gradepoint All Routes
    Route::get('/gradepoint/add', [GradePointController::class, 'AddGradePoint'])->name('add.grade.point');
    Route::post('/gradepoint/create', [GradePointController::class, 'CreateGradePoint'])->name('create.grade.point');
    Route::get('/gradepoint/edit/{id}', [GradePointController::class, 'EditGradePoint'])->name('edit.grade.point');
    Route::post('/gradepoint/update/{id}', [GradePointController::class, 'UpdatetGradePoint'])->name('update.grade.point');
});
//Finance Management All Routes
Route::prefix('/finance')->group(function () {
    //Student Fee Management All Routes
    Route::get('/student/fee/view', [StudentFeeController::class, 'ViewStudentFee'])->name('view.student.fee');
    Route::get('/student/fee/add', [StudentFeeController::class, 'AddStudentFee'])->name('add.student.fee');
    Route::get('/student/fee/get', [StudentFeeController::class, 'GetStudentFee'])->name('finance.get.student.fee');
    Route::post('/student/fee/create', [StudentFeeController::class, 'CreateStudentFee'])->name('create.student.fee');

    //Employee Salary Management All Routes
    Route::get('/employee/salary/view', [FinanceSalaryController::class, 'ViewEmployeeSalary'])->name('view.finance.employee.salary');
    Route::get('/employee/salary/add', [FinanceSalaryController::class, 'AddEmployeeSalary'])->name('add.finance.employee.salary');
    Route::get('/employee/salary/get', [FinanceSalaryController::class, 'GetEmployeeSalary'])->name('finance.get.employee.salary');
    Route::post('/employee/salary/create', [FinanceSalaryController::class, 'CreateEmployeeSalary'])->name('create.finance.employee.salary');

    //Miscellaneous Cost All Routes
    Route::get('/miscellaneous/cost/view', [MiscellaneousCostController::class, 'ViewMiscellaneousCost'])->name('view.miscellaneous.cost');
    Route::post('/miscellaneous/cost/create', [MiscellaneousCostController::class, 'CreateMiscellaneousCost'])->name('create.miscellaneous.cost');
    Route::get('/miscellaneous/cost/edit/{id}', [MiscellaneousCostController::class, 'EditMiscellaneousCost'])->name('edit.miscellaneous.cost');
    Route::post('miscellaneous/cost/update/{id}', [MiscellaneousCostController::class, 'UpdateMiscellaneousCost'])->name('update.miscellaneous.cost');
});
//Reporting & Analytics All Routes
Route::prefix('/analytics')->group(function () {
    //Monthly-Annual Profit All Routes
    Route::get('/profit/view', [ProfitController::class, 'ViewProfit'])->name('view.profit');
    Route::get('/profit/get', [ProfitController::class, 'GetProfitByDate'])->name('get.profit.by.date');

    //Student Marksheet Generation
    Route::get('/marksheet/view', [StudentMarksheetController::class, 'ViewMarksheet'])->name('view.marksheet');
    Route::get('/marksheet/get', [StudentMarksheetController::class, 'GetMarksheet'])->name('get.student.marksheet');
});
