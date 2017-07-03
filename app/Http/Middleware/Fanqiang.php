<?php

namespace App\Http\Middleware;

use Closure;

class fanqiang
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $admin_id = \Auth::guard('admin')->user()->mg_id;
        $admin_name = \Auth::guard('admin')->user()->username;

        if($admin_name != 'root'){
            //判断'管理员是否有权限方法当前请求'
            //① 获得当前请求的'控制器-操作方法'
            $nowCA = getCurrentControllerName().'-'.getCurrentMethodName();
            //② 获取当前管理员本身具备的访问权限 '控制器-操作方法,控制器-操作方法'
            $roleinfo = \DB::table('manager as m')
                ->join('role as r','r.role_id','=','m.mg_role_ids')
                ->where('m.mg_id',$admin_id)
                ->select('r.role_permission_ac')
                ->first();
            $haveCA = $roleinfo->role_permission_ac;
            //③ 判断① 在② 中是否存在 存在可以继续访问.否则停止请求
            if(strpos($haveCA,$nowCA) == false){
                exit('您没有权限访问');
            }
        }

        return $next($request);

    }
}
