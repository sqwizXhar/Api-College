<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    protected $fillable = [
        'name',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public static function getTeacherRole()
    {
        return Role::where('name', 'teacher')->first();
    }

    public static function getStudentRole()
    {
        return Role::where('name', 'student')->first();
    }

    public static function getAdminRole()
    {
        return Role::where('name', 'admin')->first();
    }

    public function isAdmin(): bool
    {
        return $this->name == 'admin';
    }

    public function isTeacher(): bool
    {
        return $this->name == 'teacher';
    }

    public function isStudent(): bool
    {
        return $this->name == 'student';
    }

}
