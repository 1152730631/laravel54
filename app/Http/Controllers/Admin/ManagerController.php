<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ManagerController extends Controller
{

    public function login(){
        return view('admin/manager/login');
    }

    public function showlist(){
        return view('admin/manager/showlist');
    }

    public function tianjia(){
        return view('admin/manager/tianjia');
    }
}
