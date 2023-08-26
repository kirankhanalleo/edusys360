<?php

namespace App\Http\Controllers\Backend_Controller\Employee_Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\EmployeeSalaryRecords;
use App\Models\EmployeeAttendance;
use PDF;

class EmployeeMonthlySalaryController extends Controller
{
    public function ViewEmployeeMonthlySalary()
    {
        return view('backend.employee.employee_monthly_salary.view_employee_monthly_salary');
    }
    public function GetEmployeeMonthlySalary(Request $request)
    {
        $date = date('Y-m', strtotime($request->date));
        if ($date != '') {
            $where[] = ['date', 'like', $date . '%'];
        }
        $allData = EmployeeAttendance::select('emp_id')->groupBy('emp_id')->with(['getEmployee'])->where($where)->get();
        $html['thsource'] = '<th>S.N</th>';
        $html['thsource'] .= '<th>Employee ID</th>';
        $html['thsource'] .= '<th>Employee Name</th>';
        $html['thsource'] .= '<th>Monthly Salary</th>';
        $html['thsource'] .= '<th>Absent Days</th>';
        $html['thsource'] .= '<th>Payable Salary</th>';
        $html['thsource'] .= '<th width="20%">Action</th>';
        foreach ($allData as $key => $data) {
            $attendance = EmployeeAttendance::with(['getEmployee'])->where($where)->where('emp_id', $data->emp_id)->get();
            $absentDays = count($attendance->where('status', 'Absent'));

            $html[$key]['tdsource'] = '<td>' . ($key + 1) . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $data['getEmployee']['emp_id'] . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $data['getEmployee']['name'] . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $data['getEmployee']['salary'] . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $absentDays . '</td>';

            $basicSalary = (float)$data['getEmployee']['salary'];
            $dailySalary = (float)$basicSalary / 30;
            $cutoffSalary = $absentDays * (float)$dailySalary;
            $payableSalary = (float)$basicSalary - (float)$cutoffSalary;

            $html[$key]['tdsource'] .= '<td><b>' . (int)$payableSalary . '</b></td>';
            $html[$key]['tdsource'] .= '<td>';
            $html[$key]['tdsource'] .= '<a style="color:white; background:#df4759; padding:5px 3px; width:70%; border-radius:5px;" target="_blanks" href="' . route("employee.monthly.salary.payslip", $data->emp_id) . '">Generate Pay Slip</a>';
            $html[$key]['tdsource'] .= '</td>';
        }
        return response()->json(@$html);
    }
    public function ViewEmployeeMonthlySalaryPaySlip(Request $request, $emp_id)
    {
        $id = EmployeeAttendance::where('emp_id', $emp_id)->first();
        $date = date('Y-m', strtotime($id->date));
        if ($date != '') {
            $where[] = ['date', 'like', $date . '%'];
        }
        $data['employee_details'] = EmployeeAttendance::with(['getEmployee'])->where($where)->where('emp_id', $id->emp_id)->get();
        $pdf = PDF::loadView('backend.employee.employee_monthly_salary.monthly_salary_payslip_pdf', $data);
        $pdf->setProtection(['print'], '', 'pass');
        return $pdf->stream('payslip.pdf');
    }
}
