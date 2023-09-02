<?php

namespace App\Http\Controllers\Backend_Controller\Finance_Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\EmployeeSalaryRecords;
use App\Models\EmployeeAttendance;
use App\Models\FinanceEmployeeSalary;

class FinanceSalaryController extends Controller
{
    public function ViewEmployeeSalary()
    {
        $data['allData'] = FinanceEmployeeSalary::all();
        return view('backend.finance.employee_salary.view_employee_salary', $data);
    }
    public function AddEmployeeSalary()
    {
        return view('backend.finance.employee_salary.add_employee_salary');
    }
    public function GetEmployeeSalary(Request $request)
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
        $html['thsource'] .= '<th>Select</th>';
        foreach ($allData as $key => $data) {
            $finance_salary = FinanceEmployeeSalary::where('emp_id', $data->id)->where('date', $date)->first();

            if ($finance_salary != null) {
                $checked = 'checked';
            } else {
                $checked = '';
            }

            $attendance = EmployeeAttendance::with(['getEmployee'])->where($where)->where('emp_id', $data->emp_id)->get();
            $absentDays = count($attendance->where('status', 'Absent'));

            $html[$key]['tdsource'] = '<td>' . ($key + 1) . '</td>';

            $html[$key]['tdsource'] .= '<td>' . $data['getEmployee']['emp_id'] .
                '<input type="hidden" name="date" value="' . $date . '"> ' . '</td>';

            $html[$key]['tdsource'] .= '<td>' . $data['getEmployee']['name'] . '</td>';

            $html[$key]['tdsource'] .= '<td>' . $data['getEmployee']['salary'] . '</td>';

            $html[$key]['tdsource'] .= '<td>' . $absentDays . '</td>';

            $basicSalary = (float)$data['getEmployee']['salary'];
            $dailySalary = (float)$basicSalary / 30;
            $cutoffSalary = $absentDays * (float)$dailySalary;
            $payableSalary = (float)$basicSalary - (float)$cutoffSalary;

            $html[$key]['tdsource'] .= '<td><b>' . (int)$payableSalary .
                '<input type="hidden" name="amount[]" value="' . $payableSalary . '">' . '</b></td>';

            $html[$key]['tdsource'] .= '<td>' . '<input type="hidden" name="emp_id[]" value="' . $data->emp_id . '">' . '<input type="checkbox" name="checkmanage[]" id="id{{$key}}" value="' . $key . '" ' . $checked . ' style="transform: scale(1.5);margin-left: 10px;"> <label for="id{{$key}}"> </label> ' . '</td>';
        }
        return response()->json(@$html);
    }
    public function CreateEmployeeSalary(Request $request)
    {

        $date = date('Y-m', strtotime($request->date));
        FinanceEmployeeSalary::where('date', $request->date)->delete();
        $checkData = $request->checkmanage;

        if ($checkData != null) {
            for ($i = 0; $i < count($checkData); $i++) {
                $data = new FinanceEmployeeSalary();
                $data->date = $date;
                $data->emp_id = $request->emp_id[$checkData[$i]];
                $data->amount = $request->amount[$checkData[$i]];
                $data->save();
            }
        }
        if (!empty(@$data) || empty($checkData)) {
            $notification = array(
                'message' => 'Data Inserted Successfully!',
                'alert-type' => 'success'
            );
            return redirect()->route('view.finance.employee.salary')->with($notification);
        } else {
            $notification = array(
                'message' => 'Data Inserting Failed!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
}
