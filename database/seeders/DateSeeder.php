<?php

namespace Database\Seeders;

use App\Models\Date;
use App\Models\Lesson;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DateSeeder extends Seeder
{
    protected $model = Date::class;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Date::factory()->count(10)->create();
    }
}
