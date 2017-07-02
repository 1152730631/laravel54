<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $table = 'role';
    protected $primaryKey = 'role_id';

    protected $fillable = ['role_name','role_permission_ids','role_permission_ac'];

    /*
     * [建立Role Manager 1对多关系]
     * [使用关系]
     * ① 属性方式
     * $managers = role模型对象->manager
     * 一个角色对应很多个管理员
     * foreach($managers as $v){
     *
     * $v -> mg_name;//获得model模型具体信息
     * $v -> mg_phone;
     *
     * }
     *
     *
     * ② with()方式
     * $info = Role::with(关系方法名称)->get();
     * $info = Role::with('manager')->get(); 返回一个角色集合
     * foreach($info as $v){
     *     $v -> role_name
     *     $v -> manager;//获得一个当前角色对应的管理员集合
     *      foreach($v->manager as $m){
     *
     *          $m -> username //获取当前角色对应的管理员集合中
     *                         //的一个管理员名称
     *      }
     * }
     *
     *
     *[结构图]
     * Collection集合
     *         单元role
     *              调用角色的属性
     *          managers成员(Collection集合)
     *              遍历managers
     *                  manager对象->mg_id/username
     *
     */

    function manager(){
        return $this->hasMany('App\Http\Models\Manager','mg_role_ids','mg_role');
    }

}
