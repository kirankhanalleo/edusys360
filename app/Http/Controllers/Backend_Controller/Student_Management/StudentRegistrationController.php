<?php

namespace App\Http\Controllers\Backend_Controller\Student_Management;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Students;
use App\Models\StudentPrivilege;
use App\Models\StudentAssignment;
use App\Models\StudentClass;

class StudentRegistrationController extends Controller
{
    public function ViewStudentRegistration()
    {
        $data['academicYear'] = AcademicYear::all();
        $data['class'] = StudentClass::all();
        $data['scholorship'] = StudentPrivilege::all();

        $data['year_id'] = AcademicYear::orderBy('id', 'asc')->first()->id;
        $data['class_id'] = StudentClass::orderBy('id', 'desc')->first()->id;
        $data['allData'] = StudentAssignment::where('year_id', $data['year_id'])->where('class_id', $data['class_id'])->get();
        return view('backend.student.view_student', $data);
    }
    public function DisplayStudentList(Request $req)
    {
        $data['academicYear'] = AcademicYear::all();
        $data['class'] = StudentClass::all();
        $data['scholorship'] = StudentPrivilege::all();
        $data['year_id'] = $req->year_id;
        $data['class_id'] = $req->class_id;

        $data['allData'] = StudentAssignment::where('year_id', $req->year_id)->where('class_id', $req->class_id)->get();
        return view('backend.student.view_student', $data);
    }
    public function ViewStudentDetails($student_id)
    {
        $data['academicYear'] = AcademicYear::all();
        $data['class'] = StudentClass::all();
        $data['scholorship'] = StudentPrivilege::all();
        $data['editData'] = StudentAssignment::with(['getStudent', 'getStudentDiscount'])->where('student_id', $student_id)->first();
        return view('backend.student.view_student_details', $data);
    }
    public function CreateStudentRegistration(Request $request)
    {
        DB::transaction(function () use ($request) {
            //Accessing selected year's name from the backend
            $year = AcademicYear::find($request->academic_year)->name;
            $std = Students::all()->sortByDesc('id')->first();

            if ($std == null) {
                $first = 0;
                $id = $first + 1;
                if ($id < 10) {
                    $reg_id = '000' . $id;
                } elseif ($id < 100) {
                    $reg_id = '00' . $id;
                } elseif ($id < 1000) {
                    $reg_id = '0' . $id;
                }
            } //end if
            else {
                $std = Students::first()->orderBy('id', 'DESC')->value('id');
                $id = $std + 1;
                if ($id < 10) {
                    $reg_id = '000' . $id;
                } elseif ($id < 100) {
                    $reg_id = '00' . $id;
                } elseif ($id < 1000) {
                    $reg_id = '0' . $id;
                }
            } //end else

            // $registration_id = $year . $reg_id;
            $student = new Students();
            $student->reg_id = $year . '-' . $reg_id;
            $student->name = $request->student_name;
            $student->father_name = $request->father_name;
            $student->mother_name = $request->mother_name;
            $student->email = $request->email;
            $student->contact = $request->phone;
            $student->address = $request->address;
            $student->local_guardian = $request->local_guardian;
            $student->local_guardian_relationship = $request->local_guardian_relationship;
            $student->local_guardian_contact = $request->local_guardian_contact;
            $student->dob = date('Y-m-d', strtotime($request->dob));
            $student->gender = $request->gender;
            $student->religion = $request->religion;
            $student->caste = $request->caste;

            if ($request->file('profileimg')) {
                $image = $request->file('profileimg');
                $filename = date('YmdHi') . $image->getClientOriginalName();
                $image->move(public_path('assets/studentimages'), $filename);
                $student['profileimg'] = $filename;
            }
            $student->save();
            //Student Assignment
            $student_assignment = new StudentAssignment();
            $student_assignment->student_id = $student->id;
            $student_assignment->year_id = $request->academic_year;
            $student_assignment->class_id = $request->class;
            $student_assignment->save();
            //Student Privilege
            $scholorship = new StudentPrivilege();
            $scholorship->student_assignment_id = $student_assignment->id;
            $scholorship->fee_category_id = '1';
            $scholorship->discount = $request->discount_amount;
            $scholorship->save();

            $scholorship->save();
        });
        $notification = array(
            'message' => 'Student Created Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('view.student.registration')->with($notification);
    }
    public function EditStudentDetails($student_id)
    {
        $data['academicYear'] = AcademicYear::all();
        $data['class'] = StudentClass::all();
        $data['scholorship'] = StudentPrivilege::all();
        $data['editData'] = StudentAssignment::with(['getStudent', 'getStudentDiscount'])->where('student_id', $student_id)->first();
        return view('backend.student.edit_student', $data);
    }
    public function UpdateStudentDetails(Request $request, $student_id)
    {
        DB::transaction(function () use ($request, $student_id) {

            $student = Students::find($student_id);
            $student->name = $request->student_name;
            $student->father_name = $request->father_name;
            $student->mother_name = $request->mother_name;
            $student->email = $request->email;
            $student->contact = $request->phone;
            $student->address = $request->address;
            $student->local_guardian = $request->local_guardian;
            $student->local_guardian_relationship = $request->local_guardian_relationship;
            $student->local_guardian_contact = $request->local_guardian_contact;
            $student->dob = date('Y-m-d', strtotime($request->dob));
            $student->gender = $request->gender;
            $student->religion = $request->religion;
            $student->caste = $request->caste;

            if ($request->file('profileimg')) {
                $image = $request->file('profileimg');
                @unlink(public_path('assets/studentimages/' . $student->profileimg));
                $filename = date('YmdHi') . $image->getClientOriginalName();
                $image->move(public_path('assets/studentimages'), $filename);
                $student['profileimg'] = $filename;
            }
            $student->save();
            //Student Assignment
            $student_assignment = StudentAssignment::where('id', $request->id)->where('student_id', $student_id)->first();
            $student_assignment->student_id = $student->id;
            $student_assignment->year_id = $request->academic_year;
            $student_assignment->class_id = $request->class;
            $student_assignment->save();
            //Student Privilege
            $scholorship = StudentPrivilege::where('student_assignment_id', $request->id)->first();
            $scholorship->discount = $request->discount_amount;
            $scholorship->save();

            $scholorship->save();
        });
        $notification = array(
            'message' => 'Student Updated Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('view.student.registration')->with($notification);
    }
    public function PromoteStudent($student_id)
    {
        $data['academicYear'] = AcademicYear::all();
        $data['class'] = StudentClass::all();
        $data['scholorship'] = StudentPrivilege::all();
        $data['editData'] = StudentAssignment::with(['getStudent', 'getStudentDiscount'])->where('student_id', $student_id)->first();
        return view('backend.student.promote_student', $data);
    }
    public function SaveStudentPromotion(Request $request, $student_id)
    {
        DB::transaction(function () use ($request, $student_id) {

            $student = Students::find($student_id);
            $student->name = $request->student_name;
            $student->father_name = $request->father_name;
            $student->mother_name = $request->mother_name;
            $student->email = $request->email;
            $student->contact = $request->phone;
            $student->address = $request->address;
            $student->local_guardian = $request->local_guardian;
            $student->local_guardian_relationship = $request->local_guardian_relationship;
            $student->local_guardian_contact = $request->local_guardian_contact;
            $student->dob = date('Y-m-d', strtotime($request->dob));
            $student->gender = $request->gender;
            $student->religion = $request->religion;
            $student->caste = $request->caste;

            if ($request->file('profileimg')) {
                $image = $request->file('profileimg');
                @unlink(public_path('assets/studentimages/' . $student->profileimg));
                $filename = date('YmdHi') . $image->getClientOriginalName();
                $image->move(public_path('assets/studentimages'), $filename);
                $student['profileimg'] = $filename;
            }
            $student->save();
            //Student Assignment
            $student_assignment = new StudentAssignment();
            $student_assignment->student_id = $student->id;
            $student_assignment->year_id = $request->academic_year;
            $student_assignment->class_id = $request->class;
            $student_assignment->save();
            //Student Privilege
            $scholorship = new StudentPrivilege();
            $scholorship->student_assignment_id = $student_assignment->id;
            $scholorship->fee_category_id = '1';
            $scholorship->discount = $request->discount_amount;
            $scholorship->save();

            $scholorship->save();
        });
        $notification = array(
            'message' => 'Student Promoted Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('view.student.registration')->with($notification);
    }
}
