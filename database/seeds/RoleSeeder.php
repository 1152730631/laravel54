<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Http\Models\Role::create(['role_id'=>10,'role_auth_ids'=>10,'role_name'=>'主管','role_auth_ac'=>'']);
        \App\Http\Models\Role::create(['role_id'=>11,'role_auth_ids'=>11,'role_name'=>'经理','role_auth_ac'=>'']);
        \App\Http\Models\Role::create(['role_id'=>12,'role_auth_ids'=>12,'role_name'=>'总监','role_auth_ac'=>'']);
    }
}
