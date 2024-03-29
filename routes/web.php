<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AngkatanController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NilaiUjianCotroller;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\PendaftaranController;

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
        Route::delete('/teacher-delete/{id}','delete_teacher')->name('delete.teacher');
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

    Route::controller(NilaiUjianCotroller::class)->group( function (){
        Route::get('/nilai_ujian','nilai_ujian')->name('nilai_ujian');
        Route::post('/nilai_ujian/add','add_nilai_ujian')->name('add.nilai_ujian');
        Route::post('/nilai_ujian/update/{id}','update_nilai_ujian')->name('update.nilai_ujian');
        Route::delete('/nilai_ujian/delete/{id}','delete_nilai_ujian')->name('delete.nilai_ujian');
        Route::get('/export-nilai-ujian', 'exportPdf')->name('export.nilai-ujian');
        Route::get('/export-nilai-lpk', 'exportPdfLpk')->name('export.nilai-lpk');
    });
    
    Route::controller(ProfileController::class)->group( function(){
        Route::get('/profile', 'profile')->name('profile');
        Route::post('/profile-update', 'updateProfile')->name('update.profile');
    });
    Route::controller(PendaftaranController::class)->group( function(){
        Route::get('/pendaftaran', 'pendaftaran')->name('pendaftaran');
        Route::post('/pendaftaran/acc_status_pembayaran/{id}', 'acc_status_pembayaran')->name('acc_status_pembayaran');
        Route::post('/pendaftaran/batalkan_status_pembayaran/{id}', 'batalkan_status_pembayaran')->name('batalkan_status_pembayaran');
        Route::delete('/pendaftaran/delete/{id}', 'delete_pendaftaran')->name('delete.pendaftaran');
    });

     Route::controller(AngkatanController::class)->group( function (){
        Route::get('angkatan','angkatan')->name('angkatan');
        Route::post('angkatan/add','add_angkatan')->name('add.angkatan');
        Route::post('angkatan/update/{id}','update_angkatan')->name('update.angkatan');
        Route::delete('angkatan/delete/{id}','delete_angkatan')->name('delete.angkatan');
    });
});