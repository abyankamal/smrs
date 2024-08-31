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
        return redirect()->back()->with($notification);
    }
}
