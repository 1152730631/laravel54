<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Livecourse;
use App\Http\Models\Stream;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class LivecourseController extends Controller
{
    public function index(Request $request){

        $info = Livecourse::with('stream')->get();
        return view('admin/livecourse/index',compact('info'));

    }

    /**
     * 添加操作
     * @param Request $request
     */
    public function tianjia(Request $request)
    {
        if($request->isMethod('post')){
            //验证
            $rules = [
                'name'=>'required',
                'stream_id'=>'required',
                'start_at'=>'required',
                'end_at'=>'required',
            ];
            $notices = [
                'name.required'=>'名称不能为空',
                'stream_id.required'=>'直播流必选',
                'start_at.required'=>'直播流必选',
                'end_at.required'=>'直播流必选',
            ];
            //制作
            $validator = Validator::make($request->all(),$rules,$notices);

            if($validator->passes()){
                //存储数据入库
                //格式化时间变为时间戳
                $start = strtotime($request->input('start_at'));
                $end = strtotime($request->input('end_at'));
                Livecourse::create([
                    'name'=>$request->input('name'),
                    'stream_id'=>$request->input('stream_id'),
                    'start_at'=>$start,
                    'end_at'=>$end,
                ]);
                return ['success'=>true];
            }else{
                //校验失败
                $errorinfo = collect($validator->messages())->implode('0','|');
                return ['success'=>false,'errorinfo'=>$errorinfo];
            }
        }

        //获取直播流
        $stream = Stream::pluck('stream_name','stream_id');
        return view('admin/livecourse/tianjia',compact('stream'));
    }

}
