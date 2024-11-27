<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\CabinetController;
use App\Http\Controllers\Api\GroupController;
use App\Http\Controllers\Api\LessonController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\SubjectController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::get('students', [UserController::class, 'getStudents'])->name('users.students');
Route::get('teachers', [UserController::class, 'getTeachers'])->name('users.teachers');

Route::apiResources([
    'users' => UserController::class,
    'groups' => GroupController::class,
    'roles' => RoleController::class,
    'subjects' => SubjectController::class,
    'cabinets' => CabinetController::class,
    'lessons' => LessonController::class,
    'admins' => AdminController::class,
]);
