<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/*
 * 订单
 */
class Order extends Model
{
    protected $table = 'order';
    protected $primaryKey = 'order_id';

    protected $fillable = ['order_sn','trade_sn','std_id',
    'total_price','pay_money','pay_time','pay_status'];

    //设置软删除
    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
