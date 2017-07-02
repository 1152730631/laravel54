<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Permission;
use App\Http\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    //展示角色列表
    public function index(){
        $info = Role::get();

        return view('admin/role/index',compact('info'));
    }

    //修改角色列表
    public function xiugai(Request $request ,Role $role){



        if($request->isMethod('post')){

            //角色名称校验
            $rules = [
                'role_name'=>'required|unique:role,role_name,'.$role->role_id.',role_id',
            ];
            $notices = [
                'role_name.required'=>'名称必填',
                'role_name.unique'=>'名称重复',
            ];
            $validator = \Validator::make($request->all(),$rules,$notices);

            if($validator->passes()){
                //给角色修改信息,角色名称,权限ids,权限的ac
                $role_name = $request->input('role_name');
                $role_permission_ids = implode(',',$request->input('quanxian'));
                $role_permission_ac = Permission::whereIn('ps_id',$request->input('quanxian'))
                    ->select(\DB::raw('concat(ps_c,"-",ps_a) as jie'))
                    ->where('ps_level','1')
                    ->pluck('jie');

                $permission_ac = implode(',',$role_permission_ac->toArray());
                $r = $role->update([
                    'role_name' => $role_name,
                    'role_permission_ids' => $role_permission_ids,
                    'role_permission_ac' => $permission_ac
                ]);

                if($r) {
                    return ['success' => true];
                }else{
                    return ['success' => false];
                }

            }else{
                $errorinfo = collect($validator->messages())->implode('0','|');
                return ['success' => false,'errorinfo' => $errorinfo];
            }
        }

        $permissionA = Permission::where('ps_level','0')->get();
        $permissionB = Permission::where('ps_level','1')->get();

        return view('admin/role/xiugai',compact('role','permissionA','permissionB'));
    }


}
