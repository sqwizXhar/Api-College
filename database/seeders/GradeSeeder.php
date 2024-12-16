<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    protected $model = Grade::class;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Grade::factory()->count(10)->create();
    }
}
