<?php

namespace App\Http\Controllers\Backend_Controller\Student_Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AcademicYear;
use App\Models\ExamModel;
use App\Models\FeeCategory;
use App\Models\FeeCategoryAmount;
use App\Models\StudentAssignment;
use App\Models\Students;
use App\Models\StudentClass;
use App\Models\StudentPrivilege;
use PDF;

class AdmissionFeeController extends Controller
{
    public function ViewAdmissionFee()
    {
        $data['academicYear'] = AcademicYear::all();
        $data['class'] = StudentClass::all();
        return view('backend.student.admissionfee.view_admission_fee', $data);
    }
    public function ViewAdmissionFeeByClass(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        //Where method to filter database query. 
        if ($year_id != '') {
            //Where method takes key value pair
            $where[] = ['year_id', 'like', $year_id . '%'];
        }
        if ($class_id != '') {
            $where[] = ['class_id', 'like', $class_id . '%'];
        }
        $studentData = StudentAssignment::with(['getStudentDiscount'])->where($where)->get();
        $html['thsource'] = '<th width="5%">SN</th>';
        $html['thsource'] .= '<th width="10%">Reg ID</th>';
        $html['thsource'] .= '<th>Name of the Student</th>';
        $html['thsource'] .= '<th>Admission Fee</th>';
        $html['thsource'] .= '<th>Scholorship</th>';
        $html['thsource'] .= '<th>Net Fee</th>';
        $html['thsource'] .= '<th>Action</th>';

        foreach ($studentData as $key => $data) {
            $admission_fee = FeeCategoryAmount::where('fee_category_id', '1')->where('class_id', $data->class_id)->first();
            $html[$key]['tdsource'] = '<td>' . ($key + 1) . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $data['getStudent']['reg_id'] . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $data['getStudent']['name'] . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $admission_fee->amount . '</td>';
            if (!empty($data['getStudentDiscount']['discount'])) {
                $html[$key]['tdsource'] .= '<td>' . $data['getStudentDiscount']['discount'] . '%' . '</td>';
            } else {
                $html[$key]['tdsource'] .= '<td>-</td>';
            }
            $grossFee = $admission_fee->amount;
            $discountPercent = $data['getStudentDiscount']['discount'];
            $discountAmount = ($discountPercent / 100) * $grossFee;
            $netFee = (float)$grossFee - (float)$discountAmount;
            $html[$key]['tdsource'] .= '<td>' . $netFee . '</td>';
            $html[$key]['tdsource'] .= '<td>';
            $html[$key]['tdsource'] .= '<a style="color:white; background:#df4759; padding:5px 3px; width:70%; border-radius:5px;" title="Generate Bill" target="_blanks" href="' . route("admission.fee.payslip") . '?class_id=' . $data->class_id . '&student_id=' . $data->student_id . '">Create Bill</a>';
            $html[$key]['tdsource'] .= '</td>';
        }
        return response()->json(@$html);
    }
    public function ViewAdmissionFeePaySlip(Request $request)
    {
        $student_id = $request->student_id;
        $class_id = $request->class_id;
        $student['data'] = StudentAssignment::with(['getStudent', 'getStudentDiscount'])
            ->where('student_id', $student_id)->where('class_id', $class_id)->first();
        $pdf = PDF::loadView('backend.student.admissionfee.fee_payslip_pdf', $student);
        $pdf->setProtection(['print'], '', 'pass');
        return $pdf->stream('payslip.pdf');
    }
}
