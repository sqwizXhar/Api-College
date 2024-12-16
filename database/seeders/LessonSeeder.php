<?php

namespace Database\Seeders;

use App\Models\Lesson;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    protected $model = Lesson::class;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Lesson::factory()->count(10)->create();
    }
}
