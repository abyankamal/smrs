<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Models\Result;

class ResultController extends Controller
{
    //
    public function AddResult()
    {
        $classes = Classes::all();
        return view('backend.result.add_result', compact('classes'));
    }

    public function FetchStudent(Request $request)
    {
        $class_id = $request->class_id;
        $students = Student::where('class_id', $class_id)->get();
        $std_data = '<option selected="">-- Select A Student</option>';
        foreach ($students as $student) {
            $std_data .= '<option value="' . $student->id . '">' . $student->name . ' | ' . $student->roll_id . '</option>';
        }

        $class = Classes::with('subjects')->where('id', $class_id)->first();
        $class_subjects = $class->subjects;
        for ($i = 0; $i < count($class_subjects); $i++) {
            $subject_data[$i] = '<label for="english">' . $class_subjects[$i]->subject_name . '</label>
                                <input type="hidden" class="form-control" name="subject_id[]" value="' . $class_subjects[$i]->id . '" type="hidden">
                                <input type="text" class="form-control" name="marks[]" required type="text" placeholder="Enter mark out of 100">';
        }
        return response()->json(['students' => $std_data, 'subjects' => $subject_data]);
    }

    public function FetchStudentResult(Request $request)
    {
        $student_id = $request->student_id;
        $result = Result::where('student_id', $student_id)->get();
        $message = '';
        if ($result) {
            $message = '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                                                <i class="mdi mdi-bullseye-arrow me-2"></i>
                                                The Result Of The Student Has Already Declared!
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>';
        }
        return response()->json(['message' => $message]);
    }

    public function StoreResult(Request $request)
    {
        $sub_count = count($request->subject_id);
        for ($i = 0; $i < $sub_count; $i++) {
            $result = [
                'student_id' => $request->student_id,
                'class_id' => $request->class_id,
                'subject_id' => $request->subject_id[$i],
                'marks' => $request->marks[$i]
            ];
            Result::create($result);
        }
        $notification = array(
            'message' => 'Result Declared Succesfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function ManageResult()
    {
        $results = Result::groupBy('student_id')->get();
        return view('backend.result.manage_result', compact('results'));
    }

    public function EditResult($id)
    {
        $result = Result::where('student_id', $id)->get();
        if (!$result) {
            // Handle case if result is not found (optional)
            $notification = array(
                'message' => 'Id Not Found Succesfully',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        return view('backend.result.edit_result', compact('result'));
    }


    public function UpdateResult(Request $request)
    {
        dd($request->all());
        $sub_count = count($request->subject_id);
        for ($i = 0; $i < $sub_count; $i++) {
            $result = Result::where('id', $request->result_id[$i])->update(
                [
                    'student_id' => $request->student_id[$i],
                    'marks' => $request->marks[$i]
                ]
            );
        }
        $notification = array(
            'message' => 'Result Declared Succesfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
