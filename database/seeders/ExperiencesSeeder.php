<?php

namespace Database\Seeders;

use App\Models\Experience;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ExperiencesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $users = User::pluck('id')->toArray();

        foreach ($users as $user) {
            Experience::create([
                'user_id' => $faker->unique()->randomElement($users),
                'employment_status' => random_int(0, 1),
                'experience' => random_int(1, 10),
                'off_experience' => random_int(1, 5),
                'field' => 'Field ' . random_int(1, 5),
                'position' => 'Position ' . random_int(1, 5),
                'level' => $this->getRandomLevel(),
                'eng_level' => $this->getRandomEngLevel(),
            ]);
        }
    }

    private function getRandomLevel()
    {
        $levels = ['intern', 'junior', 'strong junior', 'middle', 'strong middle', 'senior'];
        return $levels[array_rand($levels)];
    }

    private function getRandomEngLevel()
    {
        $engLevels = ['A1', 'A2', 'B1', 'B2', 'C1', 'C2'];
        return $engLevels[array_rand($engLevels)];
    }
}
