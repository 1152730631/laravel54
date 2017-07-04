<?php

namespace App\Http\Controllers\Home;

use App\Http\Models\Course;
use App\Tools\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    //将$course课程信息添加到cart 购物车中
    public function cart_tianjia(Request $request,Course $course){
        $info = [
            'course_id' => $course->course_id,
            'course_name' => $course->coures_name,
            'course_price' => $course->coures_price
        ];

        $cart = new Cart();
        $cart->add($info);
        return view('home/shop/cart_tianjia',compact('course'));
    }
}
