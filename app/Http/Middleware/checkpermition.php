<?php

namespace App\Http\Middleware;

use Closure;

class checkpermition
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
        /*
         * 判断请求是否满足条件
         */
//        if(){
//            return $next($request);
//        }else {
//            //跳转
//            return redirect()->route('admin/manager/login');
//        }


    }
}
