<?php

namespace App\Http\Controllers\Backend_Controller\Employee_Management;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\EmployeeSalaryRecords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeRegistrationController extends Controller
{
    public function ViewEmployee()
    {
        $data['allData'] = Employee::all();
        $data['designations'] = Designation::all();
        return view('backend.employee.employee_reg.view_employee', $data);
    }
    public function RegisterEmployee(Request $request)
    {
        DB::transaction(function () use ($request) {
            //Accessing selected year's name from the backend
            $startDate = date('Ym', strtotime($request->joined_date));
            $emp = Employee::all()->sortByDesc('id')->first();

            if ($emp == null) {
                $first = 0;
                $id = $first + 1;
                if ($id < 10) {
                    $reg_id = '000' . $id;
                } elseif ($id < 100) {
                    $reg_id = '00' . $id;
                } elseif ($id < 1000) {
                    $reg_id = '0' . $id;
                }
            } //end if
            else {
                $emp = Employee::first()->orderBy('id', 'DESC')->value('id');
                $id = $emp + 1;
                if ($id < 10) {
                    $reg_id = '000' . $id;
                } elseif ($id < 100) {
                    $reg_id = '00' . $id;
                } elseif ($id < 1000) {
                    $reg_id = '0' . $id;
                }
            } //end else

            // $registration_id = $year . $reg_id;
            $employee = new Employee();
            $employee->emp_id = $startDate . '-' . $reg_id;
            $employee->name = $request->employee_name;
            $employee->degn_id = $request->designation;
            $employee->dob = date('Y-m-d', strtotime($request->dob));
            $employee->joined_date = date('Y-m-d', strtotime($request->joined_date));
            $employee->salary = $request->salary;
            $employee->father_name = $request->father_name;
            $employee->mother_name = $request->mother_name;
            $employee->email = $request->email;
            $employee->address = $request->address;
            $employee->contact = $request->phone;
            $employee->gender = $request->gender;
            $employee->citizenship_no = $request->citizenship_no;
            $employee->citizenship_issued_district = $request->citizenship_issued_district;
            $employee->citizenship_issued_date = $request->citizenship_issued_date;
            $employee->religion = $request->religion;
            $employee->caste = $request->caste;

            if ($request->file('profileimg')) {
                $image = $request->file('profileimg');
                $filename = date('YmdHi') . $image->getClientOriginalName();
                $image->move(public_path('assets/employeeimages'), $filename);
                $employee['profileimg'] = $filename;
            }
            $employee->save();
            $employee_salary = new EmployeeSalaryRecords();
            $employee_salary->emp_id = $employee->id;
            $employee_salary->date_of_effect = date('Y-m-d', strtotime($request->joined_date));
            $employee_salary->prev_salary = $request->salary;
            $employee_salary->current_salary = $request->salary;
            $employee_salary->increases_salary = '0';
            $employee_salary->save();
        });
        $notification = array(
            'message' => 'Employee Registered Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('view.employee')->with($notification);
    }
    public function EditEmployee($id)
    {
        $data['editData'] = Employee::find($id);
        $data['designation'] = Designation::all();
        return view('backend.employee.employee_reg.edit_employee', $data);
    }
    public function UpdateEmployeeDetails(Request $request, $id)
    {
        $employee = Employee::find($id);
        $employee->name = $request->employee_name;
        $employee->dob = date('Y-m-d', strtotime($request->dob));
        $employee->father_name = $request->father_name;
        $employee->mother_name = $request->mother_name;
        $employee->email = $request->email;
        $employee->address = $request->address;
        $employee->contact = $request->phone;
        $employee->gender = $request->gender;
        $employee->citizenship_no = $request->citizenship_no;
        $employee->citizenship_issued_district = $request->citizenship_issued_district;
        $employee->citizenship_issued_date = $request->citizenship_issued_date;
        $employee->religion = $request->religion;
        $employee->caste = $request->caste;

        if ($request->file('profileimg')) {
            $image = $request->file('profileimg');
            @unlink(public_path('assets/employeeimages/' . $employee->profileimg));
            $filename = date('YmdHi') . $image->getClientOriginalName();
            $image->move(public_path('assets/employeeimages'), $filename);
            $employee['profileimg'] = $filename;
        }
        $employee->save();
        $notification = array(
            'message' => 'Employee Updated Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('view.employee')->with($notification);
    }
}
