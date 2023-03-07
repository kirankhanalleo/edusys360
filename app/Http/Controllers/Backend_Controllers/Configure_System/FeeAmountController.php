<?php

namespace App\Http\Controllers\Backend_Controllers\Configure_System;

use App\Http\Controllers\Controller;
use App\Models\FeeCategoryAmount;
use App\Models\AcademicYear;
use App\Models\FeeCategory;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class FeeAmountController extends Controller
{
    public function ViewFeeAmount()
    {
        // $data['allData'] = FeeCategoryAmount::all();
        $data['allData'] = FeeCategoryAmount::select('fee_category_id')->groupBy('fee_category_id')->get();
        return view('backend.student.view_fee_amount', $data);
    }
    public function AddFeeAmount()
    {
        $data['fee_categories'] = FeeCategory::all();
        $data['student_classes'] = StudentClass::all();
        return view('backend.student.add_fee_amount', $data);
    }
    public function CreateFeeAmount(Request $request)
    {
        $totalClass = count($request->class_id);

        if ($totalClass != NULL) {
            for ($i = 0; $i < $totalClass; $i++) {
                $fee_amount = new FeeCategoryAmount();
                $fee_amount->fee_category_id = $request->fee_category_id;
                $fee_amount->class_id = $request->class_id[$i];
                $fee_amount->amount = $request->amount[$i];
                $fee_amount->save();
            }
        }

        $notification = array(
            'message' => 'Fee Amount Created Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('view.fee.amount')->with($notification);
    }
}
