<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class StudentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $groups = Group::pluck('id')->toArray();
        $users = User::pluck('id')->toArray();

        for ($i = 2; $i <= 10; $i++) {
            $student = new Student();
            $student->user_id = $faker->unique()->randomElement($users);
            $student->group_id = $faker->randomElement($groups);
            $student->firstname = $faker->firstName;
            $student->middlename = $faker->lastName;
            $student->lastname = $faker->lastName;
            $student->image = $faker->imageUrl();
            $student->birth = $faker->date('Y-m-d', '-18 years');
            $student->sex = $faker->randomElement(['чоловіча', 'жіноча']);
            $student->entry_date = $faker->date('Y-m-d', '-4 years');
            $student->graduation_date = $faker->date('Y-m-d', '+1 years');
            $student->educational_degree = $faker->randomElement(['бакалавр', 'магістр', 'аспірант']);
            $student->save();
        }
    }
}
