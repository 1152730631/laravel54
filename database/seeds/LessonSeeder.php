<?php

use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //两种方式添加数据 Model模型 DB方式
        \Illuminate\Support\Facades\DB::table('lesson')->insert(
            [
//                [
//                    'course_id'=>10,
//                    'lesson_name'=>'jQuery选择器使用3',
//                    'lesson_desc' => 'jQuery选择器使用描述3',
//                    'lesson_duration' => '20',
//                    'cover_img' => ''
//                ],

//                [
//                    'course_id'=>10,
//                    'lesson_name'=>'jQuery选择器使用2',
//                    'lesson_desc' => 'jQuery选择器使用2描述',
//                    'lesson_duration' => '30',
//                    'cover_img' => ''
//
//                ],

                [
                    'course_id'=>11,
                    'lesson_name'=>'linux编辑器的使用',
                    'lesson_desc' => 'linux编辑器的使用描述',
                    'lesson_duration' => '30',
                    'cover_img' => ''
                ],

//                [
//                    'course_id'=>11,
//                    'lesson_name'=>'linux编辑器的使用2',
//                    'lesson_desc' => 'linux编辑器的使用描述2',
//                    'lesson_duration' => '40',
//                    'cover_img' => ''
//                ]
            ]
        );

    }
}
