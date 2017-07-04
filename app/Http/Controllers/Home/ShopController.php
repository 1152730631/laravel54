<?php

namespace App\Http\Controllers\Home;

use App\Http\Models\Course;
use App\Http\Models\Order;
use App\Tools\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Qiniu\Auth;

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

    /*
     * 给购物车结算
     */
    public function cart_jiesuan(Request $request)
    {
        $cart = new Cart();
        $cartinfo = $cart->getCartInfo();
        $numberprice = $cart->getNumberPrice();

        //① 生成订单信息
        $info = [
            'order_sn' => uniqid('itcast-'),
            'std_id' => \Auth::guard('home')->user()->std_id,
            'total_price' => $numberprice['price'],
        ];

        $order = Order::create($info);
        //② 生成订单详情信息
        foreach($cartinfo as $v){
            DB::table('order_course')->insert([
                'order_id' => $order->order_id,
                'course_id' => $v['course_id'],
                'course_price' => $v['course_price']
            ]);
        }

        //③ 清空购物车信息
        $cart->delall();
        //④ 支付宝支付
        echo '生成订单,请进行支付宝支付';
    }
}
