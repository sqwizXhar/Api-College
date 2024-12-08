<?php

use App\Models\Date;
use App\Models\Grade;
use App\Models\Lesson;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dates', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('lesson_id')->constrained();
            $table->timestamps();
        });

        Schema::table('grades', function (Blueprint $table) {
            $table->foreignId('date_id')->nullable()->constrained();
        });

        $lessons = Lesson::get();

        foreach ($lessons as $lesson) {
            $uniqueDate = Grade::where('lesson_id', $lesson->id)->distinct()->pluck('date');

            foreach ($uniqueDate as $date) {
                $dateId = Date::insertGetId([
                    'date' => $date,
                    'lesson_id' => $lesson->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                Grade::where('lesson_id', $lesson->id)
                    ->where('date', $date)
                    ->update(['date_id' => $dateId]);
            }
        }

        Schema::table('grades', function (Blueprint $table) {
            $table->dropColumn('date');
            $table->dropForeign(['lesson_id']);
            $table->dropColumn('lesson_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('grades', function (Blueprint $table) {
            $table->date('date')->nullable();
            $table->foreignId('lesson_id')->nullable()->constrained();
        });

        $dates = Date::get();

        foreach ($dates as $date) {
            Grade::where('date_id', $date->id)
                ->update([
                    'date' => $date->date,
                    'lesson_id' => $date->lesson_id
                ]);
        }

        Schema::table('grades', function (Blueprint $table) {
            $table->dropForeign(['date_id']);
            $table->dropColumn('date_id');
        });

        Schema::dropIfExists('dates');
    }
};
