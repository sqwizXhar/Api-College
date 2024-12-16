<?php

namespace Database\Factories;

use App\Models\Date;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Grade>
 */
class GradeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'grade' => $this->faker->numberBetween(2,5),
            'date_id' => Date::all()->random()->id,
            'user_id' => User::whereHas('role', function ($query) {
                $query->where('name', 'student');
            })->inRandomOrder()->value('id'),
        ];
    }
}
