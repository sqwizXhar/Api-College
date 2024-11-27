<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subject extends Model
{
    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }

    protected $fillable = [
        'title',
    ];
}
