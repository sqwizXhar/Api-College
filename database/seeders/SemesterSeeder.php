<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Semester;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SemesterSeeder extends Seeder
{
    protected $model = Semester::class;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Semester::factory()->count(10)->create();
    }
}
