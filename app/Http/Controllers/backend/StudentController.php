<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    //
    public function AddStudent()
    {
        $classes = Classes::all();
        return view('backend.students.add_student', compact('classes'));
    }
}
