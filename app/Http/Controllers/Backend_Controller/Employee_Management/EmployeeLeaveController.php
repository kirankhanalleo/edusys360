<?php

namespace App\Http\Controllers\Backend_Controller\Employee_Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LeaveReason;
use App\Models\LeaveRecord;
use App\Models\Employee;

class EmployeeLeaveController extends Controller
{
    public function ViewEmployeeLeave()
    {
        $data['allData'] = LeaveRecord::orderBy('id', 'desc')->get();
        $data['employees'] = Employee::all();
        $data['leave_reason'] = LeaveReason::all();
        return view('backend.employee.employee_leave.view_employee_leave', $data);
    }
    public function CreateEmployeeLeave(Request $request)
    {
        $data = new LeaveRecord();
        $data->emp_id = $request->emp_id;
        $data->leave_reason_id = $request->leave_reason_id;
        $data->start_date = $request->start_date;
        $data->end_date = $request->end_date;
        $data->save();
        $notification = array(
            'message' => 'Leave Created Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('view.employee.leave')->with($notification);
    }
    public function EditEmployeeLeave($id)
    {
        $data['editData'] = LeaveRecord::find($id);
        $data['employees'] = Employee::all();
        $data['leave_reason'] = LeaveReason::all();
        return view('backend.employee.employee_leave.edit_employee_leave', $data);
    }
    public function UpdateEmployeeLeave(Request $request, $id)
    {
        $data = LeaveRecord::find($id);
        $data->emp_id = $request->emp_id;
        $data->leave_reason_id = $request->leave_reason_id;
        $data->start_date = $request->start_date;
        $data->end_date = $request->end_date;
        $data->save();
        $notification = array(
            'message' => 'Leave Updated Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('view.employee.leave')->with($notification);
    }
    public function DeleteEmployeeLeave($id)
    {
        $leave = LeaveRecord::find($id);
        $leave->delete();
        $notification = array(
            'message' => 'Leave Deleted Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('view.employee.leave')->with($notification);
    }
}
