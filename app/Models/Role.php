<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function scopeTeacherRole($query)
    {
        return $query->where('name', 'teacher')->first();
    }

    public function scopeStudentRole($query)
    {
        return $query->where('name', 'student')->first();
    }

    public function scopeAdminRole($query)
    {
        return $query->where('name', 'admin')->first();
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

    public function scopeRole($query, $roleName)
    {
        return $query->where('name', $roleName)->first()->id;
    }

    public function scopeRoleName($query, $roleId)
    {
        return $query->where('id', $roleId)->first()->name;
    }

}
