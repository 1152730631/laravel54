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


//课时管理--列表
Route::match(['post','get'],'lesson/index','Admin\LessonController@index');

Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){
    //后台管理员登录

    Route::group(['middleware'=>['auth:admin']],function(){

    });
});

