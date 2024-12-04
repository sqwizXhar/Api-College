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
        Schema::create('group_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('group_id')->constrained();
            $table->timestamps();
        });

        $users = DB::table('users')->whereNotNull('group_id')->get();

        foreach ($users as $user) {
            DB::table('group_user')->insert([
                'user_id' => $user->id,
                'group_id' => $user->group_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['group_id']);
            $table->dropColumn('group_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('group_id')->nullable()->constrained();
        });

        $userGroups = DB::table('user_group')->get();

        foreach ($userGroups as $user) {
            DB::table('users')->where('id', $user->user_id)->update([
                'group_id' => $user->group_id,
            ]);
        }

        Schema::dropIfExists('group_user');
    }
};
