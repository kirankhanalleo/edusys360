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
        return view('backend.setup.view_fee_amount', $data);
    }
    public function AddFeeAmount()
    {
        $data['fee_categories'] = FeeCategory::all();
        $data['student_classes'] = StudentClass::all();
        return view('backend.setup.add_fee_amount', $data);
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
    public function EditFeeAmount($fee_category_id)
    {
        $data['editData'] = FeeCategoryAmount::where('fee_category_id', $fee_category_id)->orderBy('class_id', 'asc')->get();
        $data['fee_categories'] = FeeCategory::all();
        $data['student_classes'] = StudentClass::all();
        return view('backend.setup.edit_fee_amount', $data);
    }
    public function UpdateFeeAmount(Request $request, $fee_category_id)
    {
        if ($request->class_id == NULL) {
            $notification = array(
                'message' => 'Failed ! You didnot set any amount!',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        } else {
            $totalClass = count($request->class_id);
            FeeCategoryAmount::where('fee_category_id', $fee_category_id)->delete();
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
                'message' => 'Fee Amount Updated Successfully!',
                'alert-type' => 'success'
            );

            return redirect()->route('view.fee.amount')->with($notification);
        }
    }
    public function FeeAmountDetails($fee_category_id)
    {
        $data['detailsData'] = FeeCategoryAmount::where('fee_category_id', $fee_category_id)->orderBy('class_id', 'asc')->get();
        return view('backend.setup.view_fee_amount_details', $data);
    }
}
