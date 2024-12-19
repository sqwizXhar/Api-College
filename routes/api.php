<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CabinetController;
use App\Http\Controllers\Api\DateController;
use App\Http\Controllers\Api\GradeController;
use App\Http\Controllers\Api\GroupController;
use App\Http\Controllers\Api\LessonController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\SemesterController;
use App\Http\Controllers\Api\SubjectController;
use App\Http\Controllers\Api\UserController;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login'])->name('user.login');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('lessons', LessonController::class)->only('index');
    Route::get('teachers', [UserController::class, 'getTeachers'])->name('users.teachers');

    Route::middleware(CheckRole::class . ':admin')->prefix('admin')->group(function () {
        Route::apiResources([
            'users' => UserController::class,
            'roles' => RoleController::class,
            'cabinets' => CabinetController::class,
            'groups' => GroupController::class,
            'subjects' => SubjectController::class,
            'lessons' => LessonController::class,
            'semesters' => SemesterController::class,
        ]);

        Route::get('dates', DateController::class)->name('dates.index');
        Route::get('students', [UserController::class, 'getStudents'])->name('users.students');
        Route::get('admins', [UserController::class, 'getAdmins'])->name('users.admins');
        Route::get('group/users', [GroupController::class, 'getGroupUsers'])->name('groups.users');
        Route::post('group/{group}/user/{user}', [GroupController::class, 'storeGroupUser'])->name('group.user.store');
        Route::put('group/{group}/user/{user}', [GroupController::class, 'updateGroupUser'])->name('group.user.update');
        Route::delete('group/{group}/user', [GroupController::class, 'destroyGroupUser'])->name('group.users.destroy');
        Route::get('user/subjects', [UserController::class, 'getUserSubjects'])->name('users.subjects');
        Route::get('user/{user}/subjects', [UserController::class, 'showUserSubjects'])->name('user.subjects');
        Route::post('user/{user}/subject/{subject}', [UserController::class, 'storeUserSubject'])->name('user.subject.store');
        Route::put('user/{user}/subject/{subject}', [UserController::class, 'updateUserSubject'])->name('user.subject.update');
        Route::delete('user/{user}/subject', [UserController::class, 'destroyUserSubject'])->name('user.subjects.destroy');
    });

    Route::apiResource('grades', GradeController::class)->middleware(CheckRole::class . ':teacher');
    Route::apiResource('grades', GradeController::class)->only('index')->middleware(CheckRole::class . ':student');
});


