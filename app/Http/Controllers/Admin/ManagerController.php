<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Manager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class ManagerController extends Controller
{

    public function login(){
        return view('admin/manager/login');
    }

    public function showlist(){
        return view('admin/manager/showlist');
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * 管理员添加
     * 两个作用: ① 展示添加表单 ②
     *
     */

    public function tianjia(Request $request){

        /*
         * $request 是当前请求对象,Request 作用是限制$request是对象
         * 每一个控制器方法的第一个参数 都可以设置$request 以便适应
         *
         * ① 接收form表单信息
         * $request -> all();                       获取所有信息
         * $request -> only(['username','email']);  筛选信息
         * $request -> except(['username']);        排除信息 获取除参数以外的其他信息
         * $request -> path();                      请求路径
         * $request -> url();
         * $request -> file();
         * $request -> input('products.0.name'); 获取数据的数组信息
         *
         * ② 获取当前相关功能信息
         * $request -> isMethod('post'); 判断当前是否是post请求
         *
         */

        if($request -> isMethod('post')){
            //收集数据,存储入库
            //$request -> all();

            /*
            * 在laravel 框架中有自己的密码加密机制(登录时也用该)
            */
            $shuju = $request->all();

            //$shuju['password'] = Crypt::();



            /*
            $obj = new Manager();
            $obj->username = $request->input('username');
            $obj->save();*/

            if(Manager::create($shuju)) {
                return ['success' => true]; // 会返回json格式,自动转换json
            }else{
                //return ;
                return ['success' => false];
            }

        }else{
            //展示监听管理员的表单效果
            return view('admin/manager/tianjia');
        }
    }
}
