<?php

namespace App\Services;

use App\Models\Group;
use App\Models\Semester;

class SemesterService extends BaseService
{
    public function __construct(Semester $semester)
    {
        parent::__construct($semester);
    }

    public function getSemesters(array $validated)
    {
        $group = $validated['group'];

        return Semester::whereHas('group', function ($query) use ($group) {
            $query->where('name', $group);
        })
            ->orderBy('number')
            ->get();
    }

    public function createSemester(array $validated)
    {
        $semester = new Semester();
        $semester->fill($validated);
        $semester->group()->associate(Group::find($validated['group_id']));
        $semester->save();

        return $semester;
    }

    public function updateSemester(Semester $semester, array $validated)
    {
        $semester->group()->associate($validated['group_id']);

        $semester->update($validated);

        return $semester;
    }
}