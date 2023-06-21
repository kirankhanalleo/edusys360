<?php

namespace App\Http\Controllers\Backend_Controllers\Configure_System;

use App\Http\Controllers\Controller;
use App\Models\SubjectAssignment;
use App\Models\StudentClass;
use App\Models\SubjectModel;
use Illuminate\Http\Request;

class SubjectAssignmentController extends Controller
{
    public function ViewAssignedSubjects()
    {
        // $data['allData'] = SubjectAssignment::all();
        $data['allData'] = SubjectAssignment::select('class_id')->groupBy('class_id')->get();
        return view('backend.student.view_assigned_subjects', $data);
    }
    public function AddAssignedSubject()
    {
        $data['subjects'] = SubjectModel::all();
        $data['classes'] = StudentClass::all();
        return view('backend.student.add_assigned_subject', $data);
    }
    public function CreateAssignedSubject(Request $request)
    {
        $totalSubject = count($request->subject_id);
        if ($totalSubject != NULL) {
            for ($i = 0; $i < $totalSubject; $i++) {
                $assign_subject = new SubjectAssignment();
                $assign_subject->class_id = $request->class_id;
                $assign_subject->subject_id = $request->subject_id[$i];
                $assign_subject->full_marks = $request->full_marks[$i];
                $assign_subject->pass_marks = $request->pass_marks[$i];
                $assign_subject->save();
            }
        }
        $notification = array(
            'message' => 'Subjects Assigned Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('view.assign.subjects')->with($notification);
    }
    public function EditAssignedSubject($class_id)
    {
        $data['editData'] = SubjectAssignment::where('class_id', $class_id)->orderBy('class_id', 'asc')->get();
        $data['subjects'] = SubjectModel::all();
        $data['classes'] = StudentClass::all();
        return view('backend.student.edit_assigned_subject', $data);
    }
    public function UpdateAssignedSubject(Request $request, $class_id)
    {

        if ($request->subject_id == NULL) {
            $notification = array(
                'message' => 'Failed ! You didnot assign any subject!',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        } else {
            $totalSubject = count($request->subject_id);
            SubjectAssignment::where('class_id', $class_id)->delete();
            if ($totalSubject != NULL) {
                for ($i = 0; $i < $totalSubject; $i++) {
                    $assign_subject = new SubjectAssignment();
                    $assign_subject->class_id = $request->class_id;
                    $assign_subject->subject_id = $request->subject_id[$i];
                    $assign_subject->full_marks = $request->full_marks[$i];
                    $assign_subject->pass_marks = $request->pass_marks[$i];
                    $assign_subject->save();
                }
            }

            $notification = array(
                'message' => 'Subject Assignment Updated Successfully!',
                'alert-type' => 'success'
            );

            return redirect()->route('view.assign.subjects')->with($notification);
        }
    }
    public function SubjectAssignmentDetails($class_id)
    {
        $data['detailsData'] = SubjectAssignment::where('class_id', $class_id)->orderBy('subject_id', 'asc')->get();
        return view('backend.student.view_assigned_subject_details', $data);
    }
}
