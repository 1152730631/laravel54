<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManagerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //利用php实现数据表的创建
        //$table 必须使用 Blueprint限制 代表其是对象 并且可以调用
        Schema::create('manager',function(Blueprint $table){

            $table->increments('mg_id')->comment("主键");
            $table->string('username',64)->comment("名称");
            $table->string('password',60)->comment("密码");
            $table->string('mg_role_ids')->comment('角色ids');
            $table->enum('mg_sex',['男','女'])->default('男')->comment('性别');
            $table-> char('mg_phone',11)->nullable()->comment('手机号码');
            $table->string('mg_email',64)->nullable()->comment('邮箱');
            $table->text('mg_remark')->nullable()->comment('备注');
            $table->timestamps(); //创建时间修改时间
            $table->softDeletes();//删除时间
            $table->rememberToken();//token标识
            $table->unique('username');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //删除数据表dropIfExists
        Schema::dropIfExists('manager');

    }
}
