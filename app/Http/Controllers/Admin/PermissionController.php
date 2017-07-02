<?php

namespace App\Http\Controllers\Admin;


use App\Http\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    /*
     * 展示用户权限
     */
    public function index(){
        $info = Permission::get();

        //$info = generateTree($info);

        return view('admin/permission/index',compact('info'));
    }
}
