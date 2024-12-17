<?php

use App\Http\Controllers\Api\CabinetController;
use App\Http\Controllers\Api\DateController;
use App\Http\Controllers\Api\GradeController;
use App\Http\Controllers\Api\GroupController;
use App\Http\Controllers\Api\LessonController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\SemesterController;
use App\Http\Controllers\Api\SubjectController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::get('students', [UserController::class, 'getStudents'])->name('users.students');
Route::get('teachers', [UserController::class, 'getTeachers'])->name('users.teachers');
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

Route::post('login', [UserController::class, 'login'])->name('user.login');

Route::apiResources([
    'users' => UserController::class,
    'groups' => GroupController::class,
    'roles' => RoleController::class,
    'subjects' => SubjectController::class,
    'cabinets' => CabinetController::class,
    'lessons' => LessonController::class,
    'grades' => GradeController::class,
    'dates' => DateController::class,
    'semesters' => SemesterController::class,
]);
