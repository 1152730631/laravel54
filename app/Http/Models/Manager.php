<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Manager extends Model
{
    protected $table = "manager";   //设置表名
    protected $primaryKey = "mg_id";//设置主键

    //"限制"通过form表单修改的字段,只有如下字段允许修改
    protected $fillable = ['username','password','mg_role_ids','mg_sex','mg_phone','mg_email','mg_remark'];

    use SoftDeletes;
    protected $data = ['deleted_at'];

}
