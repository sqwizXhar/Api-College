<?php

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
        Schema::create('subject_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('subject_id')->constrained();
            $table->timestamps();
        });

        Schema::table('lessons', function (Blueprint $table) {
            $table->foreignId('subject_user_id')->nullable()->constrained();
        });

        $lessons = DB::table('lessons')->whereNotNull('user_id')->whereNotNull('subject_id')->get();

        foreach ($lessons as $lesson) {
            $userSubjectId = DB::table('subject_user')->insertGetId([
                'user_id' => $lesson->user_id,
                'subject_id' => $lesson->subject_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('lessons')->where('id', $lesson->id)->update([
                'subject_user_id' => $userSubjectId,
            ]);
        }

        Schema::table('lessons', function (Blueprint $table) {
            $table->dropForeign(['subject_id']);
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id', 'subject_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lessons', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained();
            $table->foreignId('subject_id')->nullable()->constrained();
        });

        $userSubjects = DB::table('subject_user')->get();

        foreach ($userSubjects as $userSubject) {
            Db::table('lessons')->where('id', $userSubject->id)->update([
                'user_id' => $userSubject->user_id,
                'subject_id' => $userSubject->subject_id,
            ]);
        }

        Schema::table('lessons', function (Blueprint $table) {
            $table->dropColumn('subject_user_id');
        });

        Schema::dropIfExists('subject_user');
    }
};
