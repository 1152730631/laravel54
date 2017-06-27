<?php

use App\Http\Models\Teacher;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //factory(Teacher::class, 50)->create();
//        $teacher = factory(Teacher::class)->times(5)->make();
//        Teacher::insert($teacher->toArray());
//
//        $teacher = Teacher::find(1);
//        $teacher->teacher_name = 'Aufree';
//        $teacher->save();

        $faker = Faker\Factory::create('ja_JP');
        for($i = 0; $i < 50;$i++){
            Teacher::create([
                'teacher_name' => $faker->name,
                'teacher_phone' => '12345678901',
                'teacher_email' => $faker->email,
                'teacher_desc' => '木叶最强',
                'teacher_pic' => 'zzz',
                'teacher_pic' => 'xxx'
            ]);
        }

    }
}
