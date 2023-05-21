<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Seeder;

class GroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = [
            ['specialty_id' => 1, 'name' => 'ПР-17'],
            ['specialty_id' => 1, 'name' => 'ТК-23'],
            ['specialty_id' => 2, 'name' => 'НГ-67'],
            ['specialty_id' => 2, 'name' => 'СП-54'],
            ['specialty_id' => 3, 'name' => 'ДЖ-45'],
            ['specialty_id' => 3, 'name' => 'АН-11'],
            ['specialty_id' => 4, 'name' => 'ОП-94'],
            ['specialty_id' => 4, 'name' => 'ЛД-23'],
        ];

        foreach ($groups as $group) {
            Group::create($group);
        }
    }
}
