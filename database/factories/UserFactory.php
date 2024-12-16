<?php

namespace Database\Factories;

use App\Models\Group;
use App\Models\Role;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use function Pest\Laravel\get;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'middle_name' => $this->faker->lastName,
            'login' => $this->faker->unique()->userName,
            'password' => Hash::make('password'),
            'role_id' => Role::all()->random()->id,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (User $user) {
            $roleName = $user->role->name;

            if ($roleName === 'teacher') {
                $groupCount = rand(3, 5);
                $groups = Group::all()->random($groupCount);
                $user->groups()->sync($groups);

                $subjects = Subject::all();
                if($subjects->isNotEmpty()) {
                    $user->subjects()->sync($subjects->random());
                } else {
                    $subjects = Subject::factory()->create();
                    $user->subjects()->sync($subjects);
                }
            }
            elseif ($roleName === 'student') {
                $group = Group::all()->random();
                $user->groups()->sync($group);
            }
        });
    }
}
