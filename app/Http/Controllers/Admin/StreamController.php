<?php

namespace App\Http\Controllers\Admin;


use App\Http\Models\Stream;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StreamController extends Controller
{
    public function index(Request $request){
        //获取直播流列表信息
        $info = Stream::get();
        return view('admin/stream/index',compact('info'));
    }

}
