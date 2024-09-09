<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Student;
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
}
