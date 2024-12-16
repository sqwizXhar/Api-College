<?php

namespace Database\Factories;

use App\Models\Cabinet;
use App\Models\Semester;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lesson>
 */
class LessonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'day_of_week' => $this->faker->randomElement([
                'Понедельник',
                'Вторник',
                'Среда',
                'Четверг',
                'Пятница'
            ]),
            'time' => $this->faker->time,
            'number_of_lesson' => $this->faker->numberBetween(1, 7),
            'cabinet_id' => Cabinet::all()->random()->id,
            'subject_user_id' => DB::table('subject_user')->inRandomOrder()->value('id'),
            'semester_id' => Semester::all()->random()->id,
        ];
    }
}
