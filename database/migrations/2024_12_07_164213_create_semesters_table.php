<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('semesters', function (Blueprint $table) {
            $table->id();
            $table->integer('number');
            $table->date('start_date');
            $table->date('end_date');
            $table->foreignId('group_id')->constrained();
            $table->timestamps();
        });

        Schema::table('lessons', function (Blueprint $table) {
            $table->dropColumn('semester');
            $table->foreignId('semester_id')->nullable()->constrained();
            $table->dropForeign(['group_id']);
            $table->dropColumn('group_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lessons', function (Blueprint $table) {
           $table->foreignId('group_id')->nullable()->constrained();
           $table->addColumn('integer', 'semester');
           $table->dropForeign(['semester_id']);
           $table->dropColumn('semester_id');
        });

        Schema::dropIfExists('semesters');
    }
};
