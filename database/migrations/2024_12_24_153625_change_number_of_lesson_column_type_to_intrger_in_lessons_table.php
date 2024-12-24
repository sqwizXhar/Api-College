<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('lessons', function (Blueprint $table) {
            Db::statement('ALTER TABLE lessons ALTER COLUMN number_of_lesson TYPE INTEGER USING number_of_lesson::INTEGER');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lessons', function (Blueprint $table) {
            DB::statement('ALTER TABLE lessons ALTER COLUMN number_of_lesson TYPE varchar USING number_of_lesson::VARCHAR');
        });
    }
};
