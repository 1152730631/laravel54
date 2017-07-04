<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

/*
 * 订单详情
 */
class OrderCourse extends Model
{
    protected $table = 'qz_order_course';
    protected $primaryKey = 'id';

    protected $fillable = ['order_id','course_id','course_price'];

}
