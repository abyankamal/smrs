<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Result;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentResultController extends Controller
{
    //
    public function index()
    {
        $classes = Classes::all();
        return view('frontend.index', compact('classes'));
    }

    public function SearchResult(Request $request)
    {
        $roll_id = $request->roll_id;
        $class_id = $request->class_id;
        $student = Student::where('roll_id', $roll_id)->where('class_id', $class_id)->get();

        if (!$student) {
            $notification = array(
                'message' => 'Student Not Found',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        $result = Result::where('student_id', $student[0]->id)->get();

        if (count($result) == 0) {
            $notification = array(
                'message' => 'Sorry Result Not Declared Yet',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        return view('frontend.student_result', compact('result'));
    }
}
