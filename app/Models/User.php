<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Model
{
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'login',
        'password',
    ];
}
