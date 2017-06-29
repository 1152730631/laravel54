<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stream extends Model
{
    protected $table = 'stream';
    protected $primaryKey = 'stream_id';

    protected $fillable = ['stream_name'];

    //设置软删除
    use SoftDeletes;
    protected $dates = ['stream_name'];

}
