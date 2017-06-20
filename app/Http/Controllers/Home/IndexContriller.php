<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexContriller extends Controller
{
    //
    public function index(){
        return view('home.index.index');
    }
}
