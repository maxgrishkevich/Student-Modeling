<?php

namespace Database\Seeders;

use App\Models\Mark;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Database\Seeder;

class MarksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $students = Student::pluck('id')->toArray();
        $subjects = Subject::pluck('id')->toArray();

        foreach (range(1, 400) as $index) {
            Mark::create([
                'student_id' => $this->getRandomElement($students),
                'subject_id' => $this->getRandomElement($subjects),
                'semester' => random_int(1, 8),
                'mark' => random_int(60, 100),
            ]);
        }
    }

    private function getRandomElement($array)
    {
        return $array[array_rand($array)];
    }
}
