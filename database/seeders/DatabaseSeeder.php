<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(GroupSeeder::class);
        $this->call(SubjectSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CabinetSeeder::class);
        $this->call(SemesterSeeder::class);
        $this->call(LessonSeeder::class);
        $this->call(DateSeeder::class);
        $this->call(GradeSeeder::class);
    }
}
