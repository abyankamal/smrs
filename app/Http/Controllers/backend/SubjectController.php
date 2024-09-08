<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    //
    public function CreateSubject()
    {
        return view('backend.subjects.create');
    }

    public function StoreSubject(Request $request)
    {
        $request->validate([
            'subject_name' => 'required',
            'subject_code' => 'required',
        ]);
        $subject = new Subject();
        $subject->subject_name = $request->subject_name;
        $subject->subject_code = $request->subject_code;
        $subject->save();

        $notification = array(
            'message' => 'Subject Create Succesfully',
            'alert-type' => 'success'
        );
        return redirect()->route('manage.subject')->with($notification);
    }

    public function ManageSubject()
    {
        $subjects = Subject::all();
        return view('backend.subjects.manage_subject', compact('subjects'));
    }

    public function Editsubject($id)
    {
        $subject = Subject::find($id);
        return view('backend.subjects.update', compact('subject'));
    }

    public function Updatesubject(Request $request)
    {
        $id = $request->id;
        Subject::find($id)->update($request->all());

        $notification = array(
            'message' => 'Subjectes Update Succesfully',
            'alert-type' => 'success'
        );
        return redirect()->route('manage.subject')->with($notification);
    }

    public function Deletesubject($id)
    {
        Subject::find($id)->delete();

        $notification = array(
            'message' => 'Subjectes Delete Succesfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function AddSubjectCombination()
    {
        $classes = Classes::all();
        $subjects = Subject::all();

        return view('backend.subjects.add_subject_combination', compact('classes', 'subjects'));
    }

    public function StoreSubjectCombination(Request $request)
    {
        $class = Classes::find($request->class_id);
        $subjects = $request->subject_ids;
        $class->subjects()->attach($subjects);

        $notification = array(
            'message' => 'Combination Done Succesfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function ManageSubjectCombination()
    {
        $results = DB::table('classes_subject')
            ->join('classes', 'classes_subject.classes_id', '=', 'classes.id')
            ->join('subjects', 'classes_subject.subjects_id', '=', 'subjects.id')
            ->select(
                'classes_subject.*',
                'classes.class_name as class_name',
                'classes.section as section',
                'subjects.subject_name as subject_name'
            )
            ->get();

        return view('backend.subjects.manage_subject_combination', compact('results'));
    }

    public function DeactivateSubjectCombination($id)
    {
        $results = DB::table('classes_subject')->select('status')->where('id', $id)->first();
        if ($results->status == 1) {
            DB::table('classes_subject')->select('status')->where('id', $id)->update(['status' => 0]);
            $notification = array(
                'message' => 'Subject De-Activate Succesfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } else {
            DB::table('classes_subject')->select('status')->where('id', $id)->update(['status' => 1]);
            $notification = array(
                'message' => 'Subject Activate Succesfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
    }
}
