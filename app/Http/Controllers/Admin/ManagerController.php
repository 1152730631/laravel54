<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Manager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class ManagerController extends Controller
{

    public function login(Request $request)
    {
        if($request->isMethod('post')){

            //用户名和密码 非空 校验
            //验证码非空、正确 校验
            $rules = [
                'username' => 'required',
                'password' => 'required',
                'verify_code' => 'required | captcha',
            ];
            $notices = [
                'username.required' => '用户名必填',
                'password.required' => '密码必填',
                'verify_code.required' => '验证码必填',
                'verify_code.captcha' => '验证码不正确',
            ];

            $name = $request->input('username');
            $pwd  = $request->input('password');



            //制作验证
            $validator = Validator::make(['username'=>$name,'password'=>$pwd],$rules,$notices);
            //判断验证
            if($validator->passes()){
                //去数据库校验用户名和密码
                $name = $request->input('username');
                $pwd  = $request->input('password');
                //Auth限定使用的guard，并调用attempt()方法校验用户名和密码
                if(Auth::guard('admin')->attempt(['username'=>$name,'password'=>$pwd])){
                    return redirect('admin/index');
                }else{
                    return redirect('admin/manager/login')
                        ->withErrors(['errorinfo'=>'用户名或密码错误'])
                        ->withInput();
                }
            }else{
                //调回到之前的login登录页面，同时把相关的错误信息 和 用户输入信息返回
                return redirect('admin/manager/login')
                    ->withErrors($validator)
                    ->withInput();
            }
        }else{
            return view('admin/manager/login');
        }
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

//        Manager::select('username','password')->get();
//        Manager::select()->where('mg_email','like','guan%')->get();
//        Manager::select()->where('mg_email','tianqi@163.com')->get();

        //或的where条件设置
        //Manager::select()->where('mg_id','>=',8)->orWhere('mg_id','<=',4);
        //且关系查询 多个where连贯操作
        //$info1 = Manager::select()->where('mg_id','>=',1)->where('useranem','like','%j%');
//        Manager::select('mg_id','username')->get();
//        Manager::select('mg_id','username')->where('mg_id','>=',2)->get();
//        Manager::select('mg_id','username')->where('mg_id','>=',2)->where('mg_username','like','%j%')->git();
//
//        Manager::select('mg_id','username')->orderBy('mg_id','desc')->get();
//        Manager::select()->groupBy('mg_sex')->get();

        //dd(Manager::where('mg_id','>','2')->count());
        //dd(Manager::where('mg_id','>','2')->sum());
//        Manager::where('mg_id','<','2')->avg();
//        Manager::where('mg_id','<','2')->max();

        /**
         * 在laravel框架中有函数dd() 可以把一些信息格式化后断点输出
         */
        //dd($info);

        /*
        * 调用view()函数可以展示模块 ,也可以给模板传递信息
        * return view('模板名称,模板')
        * retrun view()
        */

        /*
         * manager对象 -> role -> role_name
         * ① 调用属性方式:被动方式,数据使用就立即通过sql语句查询 不使用查询
         * ② with()方式 无论role关系是否实现,都要用sql查询出来 该方式更加节省资源
         */

        //$info = Manager::with('role')->get();

        /*
         * 制作数据分页
         */
        $info = Manager::with('role')->paginate(3);

        return view('admin/manager/showlist',compact('info'));
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

       if( $request -> isMethod('post')){

           /**
            * 定义 rules 验证规则
            *
            * $rules = [
            *   字段名称 => '规则|规则|规则...'
            * ]
            *
            * 规则 ①: unique 字段唯一 用法: unique:表名,字段名称[,区别id,主键id]
            *   'username' => 'unique:manager,username'
            *
            *
            *   修改form表单 字段唯一
            *   注意:要判断 我本身的名字 和 id 与 我当前修改的id是否一致 如果一致即可修改
            *   unique:manager,username,12
            *
            *    如果数据表主键名称不是id 可以通过第4个内容进行限制
            *    unique:manager,username,12,mg_id
            *
            *
            * 规则 ②: min:数字
            *   校验输入信息位数不能小于多个字符
            *   'username' => 'min:4'
            *
            *   confirmed 校验两个字段内容是否一致 常用密码和确认密码
            *   字段名称: password 和 password_confirmation
            *   'password' => 'confirmed'
            *   password 内容会自动与 'password_confirmation'的内容做比较
            *   第二个字段名称比第一个字段名称多 '_confirmation'
            *
            * 规则 ③: accepted校验bool值 用于判断协议
            * 规则 ④: after:date 判断日期在date之后
            *   'birthday' => "before:"1990-12-17
            *
            * 规则 ⑤: array: 判断内容数组
            * 规则 ⑥: date: 判断内容是日期
            * 规则 ⑦: email: 判断邮箱
            * 规则 ⑧: in:12,13,13 内容范围判断
            * 规则 ⑨: ip ip判断
            * 规则 10: numeric 数组判断
            * 规则 11: regex 正则判断
            *
            */


           $rules = [
               'username' => 'required|min:4',
               'password' => 'required|min:4'
           ];

           $notices = [
               'username.required' => '用户名必须填写',
               'username.min' => '用户名位数不能少于4位',
               'password.required' => '密码必须填写',
               'password.min' => '密码位数不能少于4位'
           ];

           $validator = Validator::make($request->all(),$rules,$notices);

           if($validator->passes()){

               $shuju = $request->except(['_token']);
               $shuju['password'] = bcrypt($shuju['password']);
               Manager::create($shuju);
               return ['success'=>true];

           }else{
               $errorinfo = collect($validator->messages())->implode('0','|');
               return ['success' => false,'errorinfo'=>$errorinfo];
           }

       }else {
           return view('admin/manager/tianjia');
       }



        //if($request -> isMethod('post')){
            //收集数据,存储入库
            /*
            * 在laravel 框架中有自己的密码加密机制(登录时也用该)
            */
            //var_dump($request);exit;
            //$shuju = $request->all();
            //echo $shuju;exit;
//            $shuju['password'] = bcrypt($shuju['password']);//加密处理
//            if(Manager::create($shuju)){
//                return ['success'=>true];  //array()  会返回json格式，自动json转化
//            }else{
//                return ['success'=>false];  //array()
//            }



//        }else{
//            //展示监听管理员的表单效果

//        }
    }

    /**
     * @param Request $requers
     * @param Manager $manager 通过$manager对象来接收传递过来的参数id
     * laravel 内部会根据id为条件 把对应的数据查询出来并传递
     * 给$manager直接传递给模板去显示
     *
     * 注意 $manager 要与路由参数的 manager 保持一致
     */

    public function xiugai(Request $request ,Manager $manager){

        if($request -> isMethod('post')){
             $info = $request->all();
            if($manager->update($info)){
                return ['success' => true];
            }else{
                return ['success' => false];
            }

        }
        return view('admin/manager/xiugai',['manager'=>$manager]);
    }


    public function del(Manager $manager){

        if($manager -> delete()){
            return ['success'=>true];
        }else {
            return ['success' => false];
        }


    }


    /*
     * 管理员退出方法
     */
    public function logout(){




        Auth::guard('hou')->logout();
        return redirect('admin/manager/login');

    }

}
