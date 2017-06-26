<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Lesson;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LessonController extends Controller
{
    //
    /**
     * 课时列表显示
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        if($request->isMethod('post')) {

            //① 负责帮组datatable获得数据
            //获得纪录总条数
            $cnt = Lesson::count();

            //获得课时列表信息
            //【实现排序】，获得排序的条件， order by 字段 asc/desc
            $n = $request->input('order.0.column');         //字段序号
            $order = $request->input('columns.'.$n.'.data'); //获得排序字段
            $by = $request->input('order.0.dir');               //顺序

            //【实现分页】
            $offset = $request->input('start');
            $len = $request->input('length');

            //【检索模糊查找】
            $search = $request->input('search.value');

            $info = Lesson::orderBy($order,$by)->offset($offset)->limit($len)->
            where('lesson_name','like',"%$search%")->
            orWhere('lesson_desc','like',"%$search%")->
            with(['course'=>function($c){
//                //$c->orderBy('course_id','desc');
//                //$c->where('course_price','>',1000);
                $c->with('profession');
            }])->
            get();



            //把$info数据传递给客户端的datatable使用
            return [
                'draw' => $request->get('draw'),
                'recordsTotal' => $cnt,
                'recordsFiltered' => $cnt,
                'data' => $info,
            ];
        }

        //② 展示列表页面

        return view('admin/lesson/index');
    }

}
