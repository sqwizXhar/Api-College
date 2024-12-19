<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Date extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
    ];

    public function __invoke($dates, $semester = null)
    {
        $dateQuery = self::whereHas('lesson', function ($query) use ($semester) {
            if($semester) {
                $query->where('semester_id', $semester);
            }
        })->whereIn('date', $dates)
            ->get();

        return $dateQuery;
    }

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    public function grades(): HasMany
    {
        return $this->hasMany(Grade::class);
    }
}
