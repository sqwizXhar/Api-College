<?php

namespace Database\Factories;

use App\Models\Group;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Semester>
 */
class SemesterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number' => $this->faker->numberBetween(1, 10),
            'start_date' => $this->faker->date(format: 'Y/m/d'),
            'end_date' => $this->faker->date(format: 'Y/m/d'),
            'group_id' => Group::all()->random()->id,
        ];
    }
}
