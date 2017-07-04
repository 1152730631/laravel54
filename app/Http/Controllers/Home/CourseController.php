<?php

namespace App\Http\Controllers\Home;

use App\Http\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    public function detail(Request $request,Course $course)
    {
        //dd($course->coures_name);exit();
        return view('home/course/detail',compact('course'));
    }
}
