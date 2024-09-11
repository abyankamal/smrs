<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Student;
use App\Models\Result;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    //
    public function AddStudent()
    {
        $classes = Classes::all();
        return view('backend.students.add_student', compact('classes'));
    }

    public function StoreStudent(Request $request)
    {
        $student = new Student();
        $student->name = $request->name;
        $student->email = $request->email;
        $student->roll_id = $request->roll_id;
        $student->class_id = $request->class_id;
        $student->dob = $request->dob;
        $student->gender = $request->gender;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $imageName = date('YmdHi') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/student_profile'), $imageName);
            $student['photo'] = $imageName;
        }
        $student->save();;

        $notification = array(
            'message' => 'Student Add Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function ManageStudent()
    {
        $students = Student::all();
        return view('backend.students.manage_student', compact('students'));
    }

    public function EditStudent($id)
    {
        $student = Student::find($id);
        $classes = Classes::all();
        return view('backend.students.edit_student', compact('student', 'classes'));
    }

    public function UpdateStudent(Request $request)
    {
        $id = $request->id;
        $student = Student::find($id);
        $student->name = $request->name;
        $student->email = $request->email;
        $student->roll_id = $request->roll_id;
        $student->class_id = $request->class_id;
        $student->dob = $request->dob;
        $student->gender = $request->gender;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $imageName = date('YmdHi') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/student_profile'), $imageName);
            $student['photo'] = $imageName;
        }
        $student->save();

        $notification = array(
            'message' => 'Student Update Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function DeleteStudent($id)
    {
        $student = Student::find($id)->delete();
        @unlink(public_path('uploads/student_profile/' . $student->photo));
        Result::where('student_id', $id)->delete();
        $student->delete();

        $notification = array(
            'message' => 'Student Delete Succesfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
