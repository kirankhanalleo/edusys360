<?php

namespace App\Http\Controllers\Backend_Controller\Finance_Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MiscellaneousCost;

class MiscellaneousCostController extends Controller
{
    public function ViewMiscellaneousCost()
    {
        $data['allData'] = MiscellaneousCost::orderBy('id', 'desc')->get();
        return view('backend.finance.miscellaneous_cost.view_miscellaneous_cost', $data);
    }
    public function CreateMiscellaneousCost(Request $request)
    {
        $data = new MiscellaneousCost();
        $data->date = date('Y-m-d', strtotime($request->date));
        $data->description = $request->description;
        $data->quantity = $request->quantity;
        $data->amount = $request->amount;
        $data->save();
        $notification = array(
            'message' => 'Miscellaneous Cost Added Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('view.miscellaneous.cost')->with($notification);
    }
    public function EditMiscellaneousCost($id)
    {
        $data['editData'] = MiscellaneousCost::find($id);
        return view('backend.finance.miscellaneous_cost.edit_miscellaneous_cost', $data);
    }
    public function UpdateMiscellaneousCost(Request $request, $id)
    {
        $data = MiscellaneousCost::find($id);
        $data->date = date('Y-m-d', strtotime($request->date));
        $data->description = $request->description;
        $data->quantity = $request->quantity;
        $data->amount = $request->amount;
        $data->save();
        $notification = array(
            'message' => 'Miscellaneous Cost Updated Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('view.miscellaneous.cost')->with($notification);
    }
}
