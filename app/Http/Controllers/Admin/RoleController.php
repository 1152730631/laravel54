<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    //
    public function index(){
        $info = Role::get();

        return view('admin/role/index',compact('info'));
    }


}
