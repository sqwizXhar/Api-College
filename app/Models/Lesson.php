<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'semester',
        'day_of_week',
        'time',
        'number_of_lesson',
    ];

    public function cabinet(): BelongsTo
    {
        return $this->belongsTo(Cabinet::class);
    }

    public function semester(): BelongsTo
    {
        return $this->belongsTo(Semester::class);
    }

    public function dates(): HasMany
    {
        return $this->hasMany(Date::class);
    }

    public function getSubjectAttribute()
    {
        $subjectUser = DB::table('subject_user')->where('id', $this->subject_user_id)->first();
        return $subjectUser ? Subject::find($subjectUser->subject_id) : null;
    }

    public function getTeacherAttribute()
    {
        $subjectUser = DB::table('subject_user')->where('id', $this->subject_user_id)->first();
        return $subjectUser ? User::find($subjectUser->user_id) : null;
    }
}
