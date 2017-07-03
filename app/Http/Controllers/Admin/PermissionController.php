<?php

namespace App\Http\Controllers\Admin;


use App\Http\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

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

    /*
     * 添加用户权限
     */
    public function tianjia(Request $request)
    {
        if($request->isMethod('post')){
            $rules = [
                'ps_name' => 'required'
            ];
            $notion = [
                'ps_name.required' => '权限名不能为空'
            ];
            $validator = Validator::make($request->all(),$rules,$notion);
            if($validator->passes()){
                $shuju = $request->all();
                $shuju['ps_level'] = $shuju['ps_pid'] == 0 ? '0' : '1';
                Permission::create($shuju);
                return ['success' => true];
            }else{
                $errorinfo = collect($validator->messages())->implode('0','1');
                return ['success' => false,'errorinfo' => $errorinfo];
            }

        }
        $permissionA  = Permission::where('ps_level','0')->pluck('ps_name','ps_id');
        return view('admin/permission/tianjia',compact('permissionA'));
    }

}
