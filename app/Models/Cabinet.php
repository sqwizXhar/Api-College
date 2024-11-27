<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cabinet extends Model
{

    protected $fillable = [
        'purpose',
        'number',
    ];

    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }
}
