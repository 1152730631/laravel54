<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    protected $table = 'student';
    protected $primaryKey = 'std_id';

    protected $fillable = ['std_name','password','std_email','std_phone'
    ,'std_sex','std_desc','std_birthday','std_pic'];

    //设置软删除
    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
