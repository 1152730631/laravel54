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
        //Manager::get() 获取全部的数据表信息
        //Manager::fitst() 获取一条数据
        //Manager::fitst()


        /**
         * 调用get方法获得manager数据表中的全部信息
         * get()方法会返回一个collection集合对象,对象里面有成员,每个
         * 成员是一个独立的记录信息 这个成员的类型是manager对象
         * 这个collection 可以进行遍历,会把每一条数据遍历处理
         *
         */
        $info = Manager::get();


        /**
         * 在laravel框架中有函数dd() 可以把一些信息格式化后断点输出
         */
        //dd($info);

        /*
        * 调用view()函数可以展示模块 ,也可以给模板传递信息
        * return view('模板名称,模板')
        * retrun view()
        */
        return view('admin/manager/showlist',['info'=> $info]);
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
            /*
            * 在laravel 框架中有自己的密码加密机制(登录时也用该)
            */
            $shuju = $request->all();

            $shuju['password'] = bcrypt($shuju['password']);//加密处理
            if(Manager::create($shuju)){
                return ['success'=>true];  //array()  会返回json格式，自动json转化
            }else{
                return ['success'=>false];  //array()
            }

        }else{
            //展示监听管理员的表单效果
            return view('admin/manager/tianjia');
        }
    }
}
