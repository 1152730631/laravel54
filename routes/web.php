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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/','Home\IndexContriller@index');

Route::get('Home/student/login','Home\StudentController@login');

Route::match(['get','post'],'admin/manager/login','Admin\ManagerController@login')->name('login');



Route::group(['prefix'=>'home','namespace'=>'Home'],function(){
    //前台首页面--学员登录
    Route::get('student/login','StudentController@login');

    //前台个人中心--课程展示
    Route::get('person/course','PersonController@course');
});

//后台管理员 列表
Route::get('admin/manager/showlist','Admin\ManagerController@showlist');
//后台管理员 添加
Route::any('admin/manager/tianjia','Admin\ManagerController@tianjia');
//后台管理员 修改
Route::match(['get','post'],'admin/manager/xiugai/{manager}','Admin\ManagerController@xiugai');
//后台管理员 删除
Route::post('admin/manager/del/{manager}','Admin\ManagerController@del');
//后台管理员 首页
Route::get('admin/index','Admin\IndexController@index');
//后台管理员 首页右侧
Route::get('admin/index/welcome','Admin\IndexController@welcome');

//后台管理员:添加上传图片
Route::post('manager/up_pic','ManagerController@up_pic');

//后台课时管理:停用启用
Route::post('admin/lesson/start_stop/{lesson}','Admin\LessonController@start_stop');

//后台课时管理:添加课时
Route::match(['get','post'],'admin/lesson/tianjia','Admin\LessonController@tianjia');


//后台课时管理:上传视频
Route::post('admin/lesson/up_video','Admin\LessonController@up_video');
//后台课时管理:上传图片
Route::post('admin/lesson/up_pic','Admin\LessonController@up_pic');

//后台课时管理:播放视频
Route::get('admin/lesson/play/{lesson}','Admin\LessonController@play');

//后台课时管理:修改
Route::match(['get','post'],'admin/lesson/xiugai/{lesson}','Admin\LessonController@xiugai');

//课时管理--列表
Route::match(['post','get'],'lesson/index','Admin\LessonController@index');

//直播流--添加
Route::match(['get','post'],'admin/stream/tianjia','Admin\StreamController@tianjin');
//直播流--列表显示
Route::get("admin/stream/index",'Admin\StreamController@index');

//直播课程表--列表
Route::get("admin/livecourse/index",'Admin\LivecourseController@index');

//直播课程表--添加
Route::match(['get','post'],'admin/livecourse/tianjia','Admin\LivecourseController@tianjia');


//Route::match(['get','post'],"admin/livecourse/index","");


Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){
    Route::group(['middleware'=>['auth:admin']],function(){

    });
});

