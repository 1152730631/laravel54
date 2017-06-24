<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('role',function(Blueprint $table){
            $table->increments('role_id');
            $table->string('role_name',20)->nullabel();
            $table->string('role_auth_ids',128)->nullabel();
            $table->string('role_auth_ac',128)->nullabel();
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
    }
}
