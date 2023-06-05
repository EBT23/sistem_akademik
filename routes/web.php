<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TopicController;
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
        Route::post('/student-update/{id}','update_student')->name('update.student');
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

    Route::controller(TopicController::class)->group( function (){
        Route::get('/topic','topic')->name('topic');
        Route::post('/topic/add','add_topic')->name('add.topic');
        Route::post('/topic/update/{id}','update_topic')->name('update.topic');
        Route::delete('/topic/delete/{id}','delete_topic')->name('delete.topic');
    });

    Route::controller(InformationController::class)->group( function (){
        Route::get('/information','index')->name('information');
        Route::post('/information/add','add_information')->name('add.information');
        Route::post('/information/update/{id}','update_information')->name('update.information');
        Route::delete('/information/delete/{id}','delete_information')->name('delete.information');
    });

    Route::controller(ProfileController::class)->group( function(){
        Route::get('/profile', 'profile')->name('profile');
        Route::post('/profile-update', 'updateProfile')->name('update.profile');
    });
});