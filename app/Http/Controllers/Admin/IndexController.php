<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    //
    public function index(){

        //获得当前登录系统管理员对应的全部的权限信息
        //$mg_id = \Auth::guard('admin');
        $mg_id = \Auth::guard('admin')->user();

        dd($mg_id);exit;
        //获取角色的信息
        //join('role as r',主表联系字段,'=',当前表联系字段)
        $roleinfo = \DB::table('manager as m')->
            join('role as r','m.mg_role_ids','=','r.role_id')->
            select('role_permission_ids')->
            where('m.mg_id',$mg_id)->
            firsh();

        try{
            //有正确分配角色的普通管理员
            $permission_ids = explode(',',$roleinfo->role_permission_ids);

            //一级的
            $permissionA = \DB::table('permission')->
                whereIn('ps_id',$permission_ids)->
                where('ps_level','0')->
                get();

            //二级的
            $permissionB = \DB::table('permission')->
                whereIn('ps_id',$permission_ids)->
                where('ps_level','1')->
                get();

        }catch(\Exception $e){

            //超级管理员权限
            if($mg_id == 3){

                //一级
                $permissionA = \DB::table('permission')->
                    whereIn('ps_level','0')->
                    get();
                //二级
                $permissionB = \DB::table('permission')->
                    whereIn('ps_level','1')->
                    get();
            }else{
                //② 未分配角色
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
