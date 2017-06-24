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
    protected $abc = ['deleted_at'];

    /*
     * 创建多模型关联
     */
    function role(){
        //role是关系方法名字,一般就是与其它模型名字一致,可以自定义
        return $this->hasOne('App\Http\Models\Role','role_id','mg_role_ids');
    }

}
