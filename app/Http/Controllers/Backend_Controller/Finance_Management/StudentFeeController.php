<?php

namespace App\Http\Controllers\Backend_Controller\Finance_Management;

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
use App\Models\StudentFee;

class StudentFeeController extends Controller
{
    public function ViewStudentFee()
    {
        $data['allData'] = StudentFee::all();
        return view('backend.finance.student_fee.view_student_fee', $data);
    }
    public function AddStudentFee()
    {
        $data['academicYear'] = AcademicYear::all();
        $data['classes'] = StudentClass::all();
        $data['fee_categories'] = FeeCategory::all();
        return view('backend.finance.student_fee.add_student_fee', $data);
    }
    public function GetStudentFee(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $fee_category_id = $request->fee_category_id;
        $date = date('Y-m', strtotime($request->date));

        $allData = StudentAssignment::with(['getStudentDiscount'])->where('year_id', $year_id)->where('class_id', $class_id)->get();
        $html['thsource'] = '<th>Reg ID</th>';
        $html['thsource'] .= '<th>Student Name</th>';
        $html['thsource'] .= '<th>Father Name</th>';
        $html['thsource'] .= '<th>Total Fee</th>';
        $html['thsource'] .= '<th>Scholorship (%)</th>';
        $html['thsource'] .= '<th width="10%">Net Fee</th>';
        $html['thsource'] .= '<th>Select</th>';
        foreach ($allData as $key => $value) {
            $regFee = FeeCategoryAmount::where('fee_category_id', $fee_category_id)->where('class_id', $value->class_id)->first();
            $studentFee = StudentFee::where('student_id', $value->student_id)->where('year_id', $value->year_id)->where('class_id', $value->class_id)->where('fee_category_id', $value->fee_category_id)->where('date', $date)->get();

            if ($studentFee != null) {
                $checked = 'checked';
            } else {
                $checked = '';
            }
            $color = 'success';
            $html[$key]['tdsource'] = '<td>' . $value['getStudent']['reg_id'] . '<input
            type="hidden" name="fee_category_id" value=" ' . $fee_category_id . '">' . '</td>';

            $html[$key]['tdsource'] .= '<td>' . $value['getStudent']['name'] . '<input
            type="hidden" name="year_id" value=" ' . $value->year_id . '">' . '</td>';

            $html[$key]['tdsource'] .= '<td>' . $value['getStudent']['father_name'] . '<input
            type="hidden" name="class_id" value=" ' . $value->class_id . '">' . '</td>';

            $html[$key]['tdsource'] .= '<td>' . $regFee->amount . '<input
            type="hidden" name="date" value=" ' . $date . '">' . '</td>';

            $html[$key]['tdsource'] .= '<td>' . $value['getStudentDiscount']['discount']  . '</td>';

            $grossFee = $regFee->amount;
            $discountPercent = $value['getStudentDiscount']['discount'];
            $discountAmount = ($discountPercent / 100) * $grossFee;
            $netFee = (float)$grossFee - (float)$discountAmount;

            $html[$key]['tdsource'] .= '<td>' . '<input type="text" style="width:60%; background-color:transparent;" name="amount[]" value=" ' . $netFee . ' "readonly>' . '</td>';

            $html[$key]['tdsource'] .= '<td>' . '<input type="hidden" name="student_id[]" value="' . $value->student_id . '">' . '<input type="checkbox" name="checkmanage[]" id="id{{$key}}" value="' . $key . '" ' . $checked . ' style="transform: scale(1.5);margin-left: 10px;"> <label for="id{{$key}}"> </label> ' . '</td>';
        }
        return response()->json(@$html);
    }
    public function CreateStudentFee(Request $request)
    {
        $date = date('Y-m', strtotime($request->date));
        StudentFee::where('year_id', $request->year_id)->where('class_id', $request->class_id)->where('fee_category_id', $request->fee_category_id)->where('date', $request->date)->delete();
        $checkData = $request->checkmanage;

        if ($checkData != null) {
            for ($i = 0; $i < count($checkData); $i++) {
                $data = new StudentFee();
                $data->year_id = $request->year_id;
                $data->class_id = $request->class_id;
                $data->fee_category_id = $request->fee_category_id;
                $data->student_id = $request->student_id[$checkData[$i]];
                $data->date = $date;
                $data->amount = $request->amount[$checkData[$i]];
                $data->save();
            }
        }
        if (!empty(@$data) || empty($checkData)) {
            $notification = array(
                'message' => 'Data Inserted Successfully!',
                'alert-type' => 'success'
            );
            return redirect()->route('view.student.fee')->with($notification);
        } else {
            $notification = array(
                'message' => 'Data Inserting Failed!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
}
