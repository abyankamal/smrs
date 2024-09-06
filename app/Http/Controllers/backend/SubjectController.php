<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

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
}
