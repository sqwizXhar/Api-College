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
        $teacherRole = Role::teacherRole();
        $studentRole = Role::studentRole();
        $adminRole = Role::adminRole();

        User::factory()->create(['role_id' => $teacherRole]);
        User::factory()->create(['role_id' => $studentRole]);

        User::factory()->create([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'middle_name' => 'Admin',
            'login' => 'admin',
            'password' => Hash::make('password'),
            'role_id' => $adminRole,
        ]);

        User::factory()->count(10)->create();
    }
}
