<?php

namespace App\Http\Controllers\Home;

use App\Http\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexContriller extends Controller
{
    //index
    public function index(){
        $course = Course::with('lesson')->get();
        return view('home/index/index',compact('course'));
    }
}
