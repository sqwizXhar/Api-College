<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    protected $model = User::class;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teacherRole = Role::getTeacherRole();
        $studentRole = Role::getStudentRole();
        $adminRole = Role::getAdminRole();

        User::factory()->create(['role_id' => $teacherRole]);
        User::factory()->create(['role_id' => $studentRole]);
        User::factory()->create(['role_id' => $adminRole]);

        User::factory()->count(10)->create();
    }
}
