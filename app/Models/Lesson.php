<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Lesson extends Model
{
    protected $fillable = [
        'day_of_week',
        'time',
        'number_of_lesson',
    ];

    public function cabinet(): BelongsTo
    {
        return $this->belongsTo(Cabinet::class);
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

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function grades(): HasMany
    {
        return $this->hasMany(Grade::class);
    }

}
