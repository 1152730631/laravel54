@extends('home/buju/layout')
@section('content')

<link rel="stylesheet" href="/home/css/page-learing-pay.css" />
<script type="text/javascript" src="/home/plugins/jquery/dist/jquery.js"></script>
<script type="text/javascript" src="/home/plugins/bootstrap/dist/js/bootstrap.js"></script>

<!--主体内容-->
<div class="container">
    <div class="learing-pay">
        <table style="width:100%;">
@foreach($info as $v)     
<tr>
    <td width="30%">课程名称: {{$v['course_name']}}</td>
    <td width="15%">价格: {{$v['course_price']}}</td>
    <td width="*">删除</td>
</tr>
@endforeach
        </table>
    </div>
    <div class="learing-pay" style="margin:20px 0;">
        <div>已经选择了{{$numberprice['number']}}个商品</div>
        <div>总价格为：{{$numberprice['price']}}</div>

        <div><a href="{{url('home/shop/cart_jiesuan')}}" class="btn btn-primary" style="display:inline;">去结算</a></div>
        
    </div>
</div>
@endsection