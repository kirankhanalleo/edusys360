<?php

namespace App\Http\Controllers\Backend_Controllers\Configure_System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeeCategory;

class FeeCategoryController extends Controller
{
    public function ViewFeeCategory()
    {
        $data['allData'] = FeeCategory::all();
        return view('backend.setup.view_fee_category', $data);
    }
    public function AddFeeCategory()
    {
        return view('backend.setup.add_fee_category');
    }
    public function CreateFeeCategory(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|unique:fee_categories,name'
        ]);
        $data = new FeeCategory();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Fee Category Created Successfully !',
            'alert-type' => 'success'
        );
        return redirect()->route('view.fee.category')->with($notification);
    }
    public function EditFeeCategory($id)
    {
        $editData = FeeCategory::find($id);
        return view('backend.setup.edit_fee_category', compact('editData'));
    }
    public function UpdateFeeCategory(Request $request, $id)
    {
        $data = FeeCategory::find($id);

        $validateData = $request->validate([
            'name' => 'required|unique:fee_categories,name,' . $data->id
        ]);

        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Fee Category Updated Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('view.fee.category')->with($notification);
    }
    public function DeleteFeeCategory($id)
    {
        $category = FeeCategory::find($id);
        $category->delete();

        $notification = array(
            'message' => 'Fee Category Deleted Successfully !',
            'alert-type' => 'success'
        );
        return redirect()->route('view.fee.category')->with($notification);
    }
}
