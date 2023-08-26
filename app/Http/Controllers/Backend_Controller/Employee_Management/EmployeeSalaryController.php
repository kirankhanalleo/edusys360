<?php

namespace App\Http\Controllers\Backend_Controller\Employee_Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\EmployeeSalaryRecords;

class EmployeeSalaryController extends Controller
{
    public function ViewEmployeeSalary()
    {
        $data['allData'] = Employee::all();
        return view('backend.employee.employee_salary.view_employee_salary', $data);
    }
    public function IncreaseEmployeeSalary($id)
    {
        $data['editData'] = Employee::find($id);
        return view('backend.employee.employee_salary.increase_employee_salary', $data);
    }
    public function SaveIncreasedSalary(Request $request, $id)
    {
        $employee = Employee::find($id);
        $prev_salary = $employee->salary;
        $current_salary = (float)$prev_salary + (float)$request->increases_salary;
        $employee->salary = $current_salary;
        $employee->save();

        $employee_salary = new EmployeeSalaryRecords();
        $employee_salary->emp_id = $employee->id;
        $employee_salary->date_of_effect = date('Y-m-d', strtotime($request->date_of_effect));
        $employee_salary->prev_salary = $prev_salary;
        $employee_salary->current_salary = $current_salary;
        $employee_salary->increases_salary = (float)$request->increases_salary;
        $employee_salary->save();

        $notification = array(
            'message' => 'Salary Increases Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('view.employee.salary')->with($notification);
    }
    public function ViewSalaryDetails($id)
    {
        $data['details'] = Employee::find($id);
        $data['salary_details'] = EmployeeSalaryRecords::where('emp_id', $data['details']->id)->get();
        return view('backend.employee.employee_salary.view_salary_details', $data);
    }
}
