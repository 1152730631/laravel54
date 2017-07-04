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

    //将购物车内容展示出来
    public function cart_account(Request $request)
    {
        //获得购物车课程信息
        $cart = new Cart();
        $info = $cart->getCartInfo();
        //获取购物车课程总数量,总价格
        $numberprice = $cart->getNumberPrice();
        return view('home/shop/cart_account',compact('info','numberprice'));

    }
}
