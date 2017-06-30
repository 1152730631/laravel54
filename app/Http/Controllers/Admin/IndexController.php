<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\CountValidator\Exception;

class IndexController extends Controller
{
    //
    public function index(){

        //获得当前登录系统管理员对应的全部的权限信息
        $mg_id = \Auth::guard('admin')->user()->mg_id;

         $roleinfo = \DB::table('manager as m')->
                join('role as r','m.mg_role_ids','=','r.role_id')->
                select('role_permission_ids')->
                where('mg_id',$mg_id)->
                first();

        try {
            //正常情况下获取数据

            $role_permission_ids = explode(',', $roleinfo->role_permission_ids);

            $permissionA = \DB::table('permission')->
            whereIn('ps_id', $role_permission_ids)->
            where('ps_level', '0')->
            get();

            $permissionB = \DB::table('permission')->
            whereIn('ps_id', $role_permission_ids)->
            where('ps_level', '1')->
            get();


        }catch(\Exception $e){
            //超级管理员情况下获取
            if($mg_id == 3){
                //超级管理员全部权限
                //一级的
                $permissionA = \DB::table('permission')->
                    where('ps_level','0')->
                    get();
                //二级的
                $permissionB = \DB::table('permission')->
                    where('ps_level','1')->
                    get();
            }else {
                $permissionA = [];
                $permissionB = [];
            }
        }
        return view('admin/index/index',compact('permissionA','permissionB'));
    }

    public function welcome(){
        return view('admin/index/welcome');
    }
}
