<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    protected $table = 'manager';   //设置表名
    protected $primaryKey = "mg_id";//设置主键
    protected $fileable = ['username','password','mg_role_ids','mg_sex','mg_phone','mg_email','mg_remark'];       //设置

}
