<?php

use Illuminate\Database\Seeder;

class CouersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \Illuminate\Support\Facades\DB::table('course')->insert(
            [
                [
                    "pro_id" => 100,
                    "coures_name" => 'js课程',
                    "coures_desc" => '强大',

                ],
                [
                    "pro_id" => 101,
                    "coures_name" => 'ajax课程',
                    "coures_desc" => '强大',

                ]
            ]
        );
    }
}
