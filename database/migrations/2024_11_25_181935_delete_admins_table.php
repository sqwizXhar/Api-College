<?php

use App\Models\Role;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $admins = DB::table('admins')->get();

        foreach ($admins as $admin) {
            DB::table('users')->insert([
                'first_name' => Str::random(5),
                'last_name' => Str::random(5),
                'middle_name' => Str::random(5),
                'login' => $admin->login,
                'password' => $admin->password,
                'role_id' => Role::where('name', 'admin')->first()->id,
                'group_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        Schema::dropIfExists('admins');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('admins', function (Blueprint $table) {
           $table->id();
           $table->string('login');
           $table->string('password');
           $table->timestamps();
        });
    }
};
