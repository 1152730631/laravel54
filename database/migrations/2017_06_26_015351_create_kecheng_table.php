<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKechengTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('profession',function(Blueprint $table){

            $table-> increments('pro_id')->unique()->comment('主键');
            $table->string('pro_name',60)->unique()->comment('专业名称');
            $table->string('teacher_ids',60)->nullable()->comment('任课老师的id');
            $table->text('pro_desc')->nullable()->comment('简介');
            $table->char('cover_img',100)->nullable()->comment('封面图');
            $table->text('carousel_imgs',100)->nullable()->comment('轮播图');
            $table->timestamps();
            $table->softDeletes();

        });

        Schema::create('course',function(Blueprint $table){
            $table-> increments('course_id')->unique()->comment('主键');
            $table->integer('pro_id')->comment('归属专业id');
            $table->string('coures_name',60)->unique()->comment('课程名称');
            $table->decimal('coures_price',7,2)->default(0.00)->comment('课程价格');
            $table->text('coures_desc')->nullable()->comment('课程描述');
            $table->string('cover_img',100)->nullable()->comment('封面图片');
            $table->timestamps();
            $table->softDeletes();

        });
        /*
         * 课时表
         */
        Schema::create('lesson',function(Blueprint $table){
            $table-> increments('lesson_id')->unique()->comment('主键');
            $table->integer('course_id')->unique()->comment('归属课程id');
            $table->string('lesson_name',60)->unique()->comment('归属课程id');
            $table->string('cover_img')->comment('封面图');
            $table->string('video_address',100)->nullable()->comment('播放视频地址');
            $table->text('lesson_desc')->nullable()->comment('视频描述');
            $table->integer('lesson_duration')->default(0)->comment('视频分钟数');
            $table->string('teacher_ids',100)->nullable()->comment('讲解老师');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('profession');

    }
}
