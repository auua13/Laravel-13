<?php

use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController; 
use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'welcome')->name('home');

Route::get('/home', function () {
    return view ('home');
});

Route::get('/about', function () {
    return view ('about');
});

Route::get('/layout', function () {
    return view ('layout');
});

Route::prefix('admin')->group (function () {
    
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/about', [AboutController::class, 'index']);

    Route::get('/student', [StudentController::class, 'index'])
        ->name('admin.student.index');
    Route::post('/student', [StudentController::class, 'store'])
        ->name('admin.student.store');
    Route::put('/student/{student}', [StudentController::class, 'update'])
        ->name('admin.student.update');
    Route::delete('/student/{student}', [StudentController::class, 'destroy'])
        ->name('admin.student.destroy');

    Route::get('/classroom', [ClassroomController::class, 'index'])
        ->name('admin.classroom.index');
    Route::post('/classroom', [ClassroomController::class, 'store'])
        ->name('admin.classroom.store');
    Route::put('/classroom/{classroom}', [ClassroomController::class, 'update'])
        ->name('admin.classroom.update');
    Route::delete('/classroom/{classroom}', [ClassroomController::class, 'destroy'])
        ->name('admin.classroom.destroy');

    Route::get('/teacher', [TeacherController::class, 'index'])
        ->name('admin.teacher.index');
    Route::post('/teacher', [TeacherController::class, 'store'])
        ->name('admin.teacher.store');
    Route::put('/teacher/{teacher}', [TeacherController::class, 'update'])
        ->name('admin.teacher.update');
    Route::delete('/teacher/{teacher}', [TeacherController::class, 'destroy'])
        ->name('admin.teacher.destroy');

    Route::get('/subject', [SubjectController::class, 'index'])
        ->name('admin.subject.index');
    Route::post('/subject', [SubjectController::class, 'store'])
        ->name('admin.subject.store');
    Route::put('/subject/{subject}', [SubjectController::class, 'update'])
        ->name('admin.subject.update');
    Route::delete('/subject/{subject}', [SubjectController::class, 'destroy'])
        ->name('admin.subject.destroy');

});