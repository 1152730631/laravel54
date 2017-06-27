<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    protected $table = "teacher"; //设置表名
    protected $primaryKey = "teacher_id";//设置主键

    //限制'通过form表单修改的字段,'
    protected $fillable = [
       'teacher_name',
        'teacher_phone',
        'teacher_email',
        'teacher_pic',
        'teacher_desc'
    ];

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    /*
     * 建立课时和教师之间的关系
     */

}
