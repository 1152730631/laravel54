<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/','Home\IndexContriller@index');

Route::match(['get','post'],'home/student/login','Home\StudentController@login');

Route::match(['get','post'],'admin/manager/login','Admin\ManagerController@login')->name('login');



Route::group(['prefix'=>'home','namespace'=>'Home'],function(){
    //前台首页面--学员登录
    Route::get('student/login','StudentController@login');

    //前台个人中心--课程展示
    Route::get('person/course','PersonController@course');
});



Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){
    //后台管理员--登录
    Route::match(['get','post'],'manager/login','ManagerController@login')->name('login');
    Route::group(['middleware'=>['auth:admin']],function(){
        //后台管理员--退出
        Route::get('manager/logout','ManagerController@logout');
        //后台管理员--列表
        Route::get('manager/showlist','ManagerController@showlist');
        //后台管理员--添加
        Route::match(['get','post'],'manager/tianjia','ManagerController@tianjia');

        Route::group(['middleware'=>['fanqiang']],function(){

            //后台管理员--修改
            Route::match(['get','post'],'manager/xiugai/{manager}','ManagerController@xiugai');
            //后台管理员--删除
            Route::post('manager/del/{manager}','ManagerController@del');
            //后台管理员--处理附件
            Route::post('manager/up_pic','ManagerController@up_pic');

            //后台--首页面
            Route::get('index/index','IndexController@index');
            //后台--首页面(右侧部分)
            Route::get('index/welcome','IndexController@welcome');

            //课时管理--列表
            Route::match(['get','post'],'lesson/index','LessonController@index');
            //课时管理--停用操作
            Route::post('lesson/start_stop/{lesson}','LessonController@start_stop');
            //课时管理--添加
            Route::match(['get','post'],'lesson/tianjia','LessonController@tianjia');
            //课时管理--上传视频
            Route::post('lesson/up_video','LessonController@up_video');
            //课时管理--上传封面图
            Route::post('lesson/up_pic','LessonController@up_pic');
            //课时管理--播放视频
            Route::get('lesson/play/{lesson}','LessonController@play');
            //课时管理--修改
            Route::match(['get','post'],'lesson/xiugai/{lesson}','LessonController@xiugai');
            //课时管理--批量删除
            Route::post('lesson/delall','LessonController@delall');

            //直播流--添加
            Route::match(['get','post'],'stream/tianjia','StreamController@tianjia');
            //直播流--列表显示
            Route::get('stream/index','StreamController@index');

            //直播课程--添加
            Route::match(['get','post'],'livecourse/tianjia','LivecourseController@tianjia');
            //直播课程--列表显示
            Route::get('livecourse/index','LivecourseController@index');


            //直播课程--获得推流地址
            Route::get('livecourse/getpush/{stream}/{livecourse}','LivecourseController@getpush');

            //角色列表展示
            Route::get('role/index','RoleController@index');

            //修改角色
            Route::match(['get','post'],"role/xiugai/{role}",'RoleController@xiugai');

            //用户权限列表展示
            Route::get('permission/index','PermissionController@index');

            //添加用户权限
            Route::match(['get','post'],'permission/tianjia','PermissionController@tianjia');

        });
    });
});

