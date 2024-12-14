<?php

namespace App\Console\Commands;

use App\Models\Date;
use App\Models\Lesson;
use Carbon\Carbon;
use Illuminate\Console\Command;

class GenerateDates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-dates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate dates';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        $currentDayOfWeek = Carbon::now()->dayOfWeek;

        $daysOfWeek = [
            1 => 'Понедельник',
            2 => 'Вторник',
            3 => 'Среда',
            4 => 'Четверг',
            5 => 'Пятница',
        ];

        if (array_key_exists($currentDayOfWeek, $daysOfWeek)) {
            $lessons = Lesson::where('day_of_week', $daysOfWeek[$currentDayOfWeek])->get();

            foreach ($lessons as $lesson) {
                $date = new Date();
                $date->date = $currentDate;
                $date->lesson_id = $lesson->id;
                $date->save();
            }
        }

        $this->info('Dates generated successfully');
    }
}
