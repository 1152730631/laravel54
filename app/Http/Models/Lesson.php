<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lesson extends Model
{
    //
    protected $table = "lesson";   //设置表名
    protected $primaryKey = "lesson_id";//设置主键

    //"限制"通过form表单修改的字段,只有如下字段允许修改
    protected $fillable = ['course_id','lesson_name','cover_img','video_address','lesson_desc','lesson_duration','teacher_ids'];


    //设置软删除
    use SoftDeletes;
    protected $dates = ['deleted_at'];


}
