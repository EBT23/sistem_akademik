<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'login_action'])->name('login.action');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('index');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::controller(StudentController::class)->group( function(){
        Route::get('/student','student')->name('student');
        Route::post('/student/add','add_student')->name('add.student');
        Route::delete('student-delete/{id}','delete_student')->name('delete.student');
    });

    Route::controller(TeacherController::class)->group( function (){
        Route::get('/teacher','teacher')->name('teacher');
        Route::post('/teacher/add','add_teacher')->name('add.teacher');
        Route::post('/teacher-delete/{id}','delete_teacher')->name('delete.teacher');
    });

    Route::controller(ScheduleController::class)->group( function (){
        Route::get('/schedule','schedule')->name('schedule');
        Route::post('/schedule/add','add_schedule')->name('add.schedule');
        Route::post('/schedule/update/{id}','update_schedule')->name('update.schedule');
        Route::delete('/schedule/delete/{id}','delete_schedule')->name('delete.schedule');
    });

    Route::controller(MateriController::class)->group( function (){
        Route::get('/materi','materi')->name('materi');
        Route::post('/materi/add','add_materi')->name('add.materi');
        Route::post('/materi/update/{id}','update_materi')->name('update.materi');
        Route::delete('/materi/delete/{id}','delete_materi')->name('delete.materi');
    });

    Route::controller(ProfileController::class)->group( function(){
        Route::get('/profile', 'profile')->name('profile');
        Route::post('/profile-update', 'updateProfile')->name('update.profile');
    });
});