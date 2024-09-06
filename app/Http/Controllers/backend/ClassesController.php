<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use Illuminate\Http\Request;

class ClassesController extends Controller
{
    //
    public function CreateClass()
    {
        return view('backend.classes.create');
    }

    public function StoreClass(Request $request)
    {
        $class = new Classes();
        $class->class_name = $request->class_name;
        $class->section = $request->section;
        $class->save();

        $notification = array(
            'message' => 'Classes Create Succesfully',
            'alert-type' => 'success'
        );
        return redirect()->route('manage.class')->with($notification);
    }

    public function ManageClass()
    {
        $classes = Classes::all();
        return view('backend.classes.manage_class', compact('classes'));
    }

    public function EditClass($id)
    {
        $class = Classes::find($id);
        return view('backend.classes.update', compact('class'));
    }

    public function UpdateClass(Request $request)
    {
        $id = $request->id;
        Classes::find($id)->update($request->all());

        $notification = array(
            'message' => 'Classes Update Succesfully',
            'alert-type' => 'success'
        );
        return redirect()->route('manage.class')->with($notification);
    }

    public function DeleteClass($id)
    {
        Classes::find($id)->delete();

        $notification = array(
            'message' => 'Classes Delete Succesfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
