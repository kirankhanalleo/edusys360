<?php

namespace App\Http\Controllers\Backend_Controller\Employee_Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\LeaveRecord;
use App\Models\EmployeeAttendance;

class EmployeeAttendanceController extends Controller
{
    public function ViewEmployeeAttendance()
    {
        $data['allData'] = EmployeeAttendance::select('date')->groupBy('date')->orderBy('id', 'Desc')->get();
        return view('backend.employee.employee_attendance.view_employee_attendance', $data);
    }
    public function AddEmployeeAttendance()
    {
        $data['employees'] = Employee::all();
        return view('backend.employee.employee_attendance.add_employee_attendance', $data);
    }
    public function CreateEmployeeAttendance(Request $request)
    {
        $count = count($request->emp_id);
        for ($i = 0; $i < $count; $i++) {
            $status = 'status' . $i;
            $attendance = new EmployeeAttendance();
            $attendance->date = date('Y-m-d', strtotime($request->date));
            $attendance->emp_id = $request->emp_id[$i];
            $attendance->status = $request->$status;
            $attendance->save();
        }
        $notification = array(
            'message' => 'Attendance Created Successfully !',
            'alert-type' => 'success'
        );
        return redirect()->route('view.employee.attendance')->with($notification);
    }
    public function EditEmployeeAttendance($date)
    {
        $data['editData'] = EmployeeAttendance::where('date', $date)->get();
        $data['employees'] = Employee::all();
        return view('backend.employee.employee_attendance.edit_employee_attendance', $data);
    }
    public function UpdateEmployeeAttendance(Request $request)
    {
        EmployeeAttendance::where('date', $request->date)->delete();
        $count = count($request->emp_id);
        for ($i = 0; $i < $count; $i++) {
            $status = 'status' . $i;
            $attendance = new EmployeeAttendance();
            $attendance->date = date('Y-m-d', strtotime($request->date));
            $attendance->emp_id = $request->emp_id[$i];
            $attendance->status = $request->$status;
            $attendance->save();
        }
        $notification = array(
            'message' => 'Attendance Updated Successfully !',
            'alert-type' => 'success'
        );
        return redirect()->route('view.employee.attendance')->with($notification);
    }
    public function ViewEmployeeAttendanceDetails($date)
    {
        $data['allData'] = EmployeeAttendance::where('date', $date)->get();
        return view('backend.employee.employee_attendance.view_employee_attendance_details', $data);
    }
}
