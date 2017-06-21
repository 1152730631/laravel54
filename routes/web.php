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

Route::get('admin/manager/login','Admin\ManagerController@login');

Route::get('admin/index','Admin\IndexController@index');

Route::get('admin/index/welcome','Admin\IndexController@welcome');

Route::get('admin/manager/showlist','Admin\ManagerController@showlist');
//后台管理员:添加
Route::any('admin/manager/tianjia','Admin\ManagerController@tianjia');

//修改管理员
/**
 * 路由参数{manager}
 * 在控制器中要对路由的参数进行接收
 *
 */
Route::match(['get','post'],'admin/manager/xiugai/{manager}','Admin\ManagerController@xiugai');