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
            $info = Lesson::get();
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
