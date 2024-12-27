<?php

namespace App\Services;

use App\Models\Date;
use App\Models\Grade;
use App\Models\User;

class GradeService extends BaseService
{
    public function __construct(Grade $grade)
    {
        parent::__construct($grade);
    }

    public function index(array $validated)
    {
        $user = $validated['user'];
        $date = $validated['date'] ?? null;

        $grade = Grade::whereHas('user', function ($query) use ($user) {
            $query->where('id', $user);
        });

        if ($date != null) {
            $grade->whereHas('date', function ($query) use ($date) {
                $query->where('date', $date);
            });
        }

        return $grade->get();
    }

    public function store(array $validated)
    {
        $grade = new Grade();
        $grade->fill($validated);
        $grade->user()->associate(User::find($validated['user_id']));
        $grade->date()->associate(Date::find($validated['date_id']));
        $grade->save();

        return $grade;
    }

    public function updateGrade(User $user, array $validated)
    {
        $date = $validated['date'];

        $grade = Grade::where('user_id', $user->id)
            ->whereHas('date', function ($query) use ($date) {
                $query->where('date', $date);
            })
            ->first();

        if (!$grade) {
            return ['error' => __('error.user_not_found')];
        }

        $grade->update(['grade' => $validated['grade']]);

        return $grade;
    }
}
