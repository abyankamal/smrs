<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use Illuminate\Http\Request;

class StudentResultController extends Controller
{
    //
    public function index()
    {
        $classes = Classes::all();
        return view('frontend.index', compact('classes'));
    }
}
